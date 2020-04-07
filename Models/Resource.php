<?php


class Resource extends Model
{

    public static function get($userId) {
        $res = static::whereEqual('user_id', $userId);
        $res->updateRisorse($userId);
        return $res;
    }


    private function updateRisorse($userId) {
        $newUpdate = time();
        $secondiPassati = $newUpdate - $this->last_update;
        if($secondiPassati) {

            $shopBuilding = ShopBuilding::all();
            $userShop = UserShopBuildings::getAll('user_id', $userId);
            $consumo = [];
            $prezzo = [];
            $listaRisorse = [];
            //calcolo prezzo e consumi per comodità
            for($i = 0; $i< count($shopBuilding); $i++) {
                $consumo[$i] = $shopBuilding[$i]->consumo * $userShop[$i]->livello;
                $prezzo[$i] = $shopBuilding[$i]->prezzo_risorsa * $userShop[$i]->livello;
                $listaRisorse[] = $shopBuilding[$i]->risorsa;
            }

            //prima produco le risorse

            $userBuildings = UserFarmBuildings::getAll('user_id', $userId);

            for($i = 0; $i< count($listaRisorse); $i++) {
                $risorsa = $listaRisorse[$i];
                $ed = FarmBuilding::whereEqual('risorsa', $risorsa);
                $this->$risorsa = $this->$risorsa + $secondiPassati * $ed->produzione_base * $userBuildings[$i]->livello *ceil($userBuildings[$i]->livello/3) *ceil($userBuildings[$i]->livello/20);
            }

            //se ci sono più di 100.000 clienti riduco il numero di iterazioni per migliorare le prestazioni
            //il limite dei clienti è un milione per evitare di raggiungere la fine troppo velocemente
            if($this->clienti > 100000) {
                $peso = 10;
                $iterazioni = floor($this->clienti/10);
            }else {
                $iterazioni = $this->clienti;
                $peso = 1;
            }

            //calcolo guadagno
            for ($i = 0; $i < $iterazioni; $i++) {
                $risorsaSpesa = mt_rand(0, sizeof($consumo));
                $listaRisorse[$risorsaSpesa];
                if ($this->$risorsa - $consumo[$risorsaSpesa]*$peso <= 0) {
                    //se non c'è risorsa e ci sono più di 50 clienti si possono perdere
                    if($this->$risorsa === 0 && $this->clienti>50) {
                            $this->clienti-= mt_rand(0,$peso);
                    }
                    //se c'è meno risorsa di quella richiesta si compra solo quello che c'è, e si mette la risorsa a 0
                    $this->soldi += $prezzo[$risorsaSpesa] * $this->$risorsa*$secondiPassati*$peso;
                    $this->$risorsa = 0;
                } else {
                    //situazione normale
                    $this->$risorsa -= $consumo[$risorsaSpesa]*$peso;
                    $this->soldi += $consumo[$risorsaSpesa] * $prezzo[$risorsaSpesa]*$secondiPassati*$peso;
                }
            }

            $this->last_update = $newUpdate;

            $this->save();
        }
    }



    private function upd(array $attr) {

        $conn = DB::create()->getConn();

        $sql = "update $this->tableName set ";
        foreach($attr as $key => $val)
            $sql.= "$key=:$key, ";
        $sql = substr($sql,0,strlen($sql)-2);
        $sql.= " where user_id=:id";
        $stmt = $conn->prepare($sql);
        $attr['id'] = $this->user_id;
        $stmt->execute($attr);
        foreach($attr as $key => $val)
            $this->$key = $val;
    }

    public function save() {
        global $vinto;
        if(!$vinto) {
            $this->upd([
                'soldi' => $this->soldi,
                'last_update' => $this->last_update,
                'clienti' => $this->clienti,
                'caffe' => $this->caffe,
                'carote' => $this->carote,
                'torte' => $this->torte,
            ]);
        }
    }


}