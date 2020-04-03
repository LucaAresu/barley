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
        $userBuildings = UserFarmBuildings::getAll('user_id', $userId);
        $ed = FarmBuilding::whereEqual('risorsa','caffe');

        $this->soldi = $this->soldi + $secondiPassati * $this->clienti;
        $this->caffe = $this->caffe+ $secondiPassati * $ed->produzione_base * $userBuildings[0]->livello;
        $ed = FarmBuilding::whereEqual('risorsa','carote');
        $this->carote = $this->carote+ $secondiPassati * $ed->produzione_base * $userBuildings[1]->livello;
        $this->last_update = $newUpdate;

        $this->save();
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
        ]);
    }


}