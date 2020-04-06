<?php


class UserShopBuildings extends Model
{
    protected $tableName = 'bg_users_shopbuildings';

    public static function getAll($column, $ownerId)
    {
        $shopBuilding =  parent::getAll($column, $ownerId);
        $buildings = ShopBuilding::all();
        for($i = 0; $i<count($shopBuilding); $i++) {
            $costoBase = $buildings[$i]->costo;
            $livello = $shopBuilding[$i]->livello;
            $shopBuilding[$i]->nome = $buildings[$i]->nome;
            $shopBuilding[$i]->costo = $costoBase*($livello+1)*($livello*$livello*ceil($livello/10)+1);
            $shopBuilding[$i]->descrizione = $buildings[$i]->descrizione;

        }
        return $shopBuilding;
    }

    public function create(array $attr = [])
    {

        $userId = $attr['user_id'];
        $buildings = ShopBuilding::all();
        try {
            foreach ($buildings as $building) {

                parent::create(['user_id' => $userId,
                    'building_id' => $building->id]);
            }
        }catch(Exception $e) {

        }
    }

    public static function get($userId, $buildingId) {
        $arr = static::getAll('user_id',$userId);
        foreach($arr as $ele)
            if($arr->building_id === $buildingId)
                return $ele;
    }

    public static  function upgrade($userId, $buildingId)
    {
        $conn = DB::create()->getConn();
        $stmt = $conn->prepare("update bg_users_shopbuildings set livello=livello+1 where user_id=:user and building_id=:building");
        $stmt->execute([
            'user' => $userId,
            'building' => $buildingId,
        ]);
    }

}