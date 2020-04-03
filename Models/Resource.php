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
        $this->soldi = $this->soldi + ($newUpdate - $this->last_update)* $this->clienti;
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
        ]);
    }


}