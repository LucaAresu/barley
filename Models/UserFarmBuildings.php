<?php


class UserFarmBuildings extends Model
{

    protected $tableName = 'bg_users_farmbuildings';

    public static function getAll($column, $ownerId)
    {
        $farmBuildings =  parent::getAll($column, $ownerId);
        $buildings = FarmBuilding::all();
        for($i = 0; $i<count($farmBuildings); $i++) {
            $farmBuildings[$i]->nome = $buildings[$i]->nome;
            $farmBuildings[$i]->costo = $buildings[$i]->costo * ($farmBuildings[$i]->livello+1);
        }
        return $farmBuildings;
    }

    public function create(array $attr = [])
    {
        $userId = $attr['user_id'];
        $buildings = FarmBuilding::all();
        foreach($buildings as $building)
        parent::create(['user_id' => $userId,
            'building_id' => $building->id]);
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
        $stmt = $conn->prepare("update bg_users_farmbuildings set livello=livello+1 where user_id=:user and building_id=:building");
        $stmt->execute([
            'user' => $userId,
            'building' => $buildingId,
        ]);
    }
}