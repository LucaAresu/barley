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

            $consumo[0] = $shopBuilding[0]->consumo * $userShop[0]->livello;
            $consumo[1] = $shopBuilding[1]->consumo * $userShop[1]->livello;
            $consumo[2] = $shopBuilding[2]->consumo * $userShop[2]->livello;

            $prezzo[0] = $shopBuilding[0]->prezzo_risorsa * $userShop[0]->livello;
            $prezzo[1] = $shopBuilding[1]->prezzo_risorsa * $userShop[1]->livello;
            $prezzo[2] = $shopBuilding[2]->prezzo_risorsa * $userShop[2]->livello;

            //prima produco le risorse

            $userBuildings = UserFarmBuildings::getAll('user_id', $userId);

            $ed = FarmBuilding::whereEqual('risorsa', 'caffe');
            $this->caffe = $this->caffe + $secondiPassati * $ed->produzione_base * $userBuildings[0]->livello *ceil($userBuildings[0]->livello/3) *ceil($userBuildings[0]->livello/20);

            $ed = FarmBuilding::whereEqual('risorsa', 'carote');
            $this->carote = $this->carote + $secondiPassati * $ed->produzione_base  * $userBuildings[1]->livello *ceil($userBuildings[1]->livello/3)* ceil($userBuildings[1]->livello/20);

            $ed = FarmBuilding::whereEqual('risorsa', 'torta');
            $this->torte = $this->torte + $secondiPassati * $ed->produzione_base  * $userBuildings[2]->livello *ceil($userBuildings[2]->livello/3)*ceil($userBuildings[2]->livello/20);


            if($this->clienti > 100000) {
                $peso = 10;
                $iterazioni = floor($this->clienti/10);
            }else {
                $iterazioni = $this->clienti;
                $peso = 1;
            }

            for ($i = 0; $i < $iterazioni; $i++) {
                $risorsaSpesa = mt_rand(0, sizeof($consumo));
                switch($risorsaSpesa) {
                    case 0: $risorsa = 'caffe'; break;
                    case 1: $risorsa = 'carote'; break;
                    case 2: $risorsa = 'torte'; break;
                }
                if ($this->$risorsa - $consumo[$risorsaSpesa] <= 0) {
                    if($this->$risorsa === 0 && $this->clienti>50) {
                        if(mt_rand(0,4) === 0)
                            $this->clienti-= $peso;
                    }
                    $this->soldi += $prezzo[$risorsaSpesa] * $this->$risorsa*$secondiPassati*$peso;
                    $this->$risorsa = 0;
                } else {
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