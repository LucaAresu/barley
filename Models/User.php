<?php
require_once 'Model.php';

class User extends Model
{

    public function create(array $attr = [])
    {
        parent::create($attr);

        $this->risorse = new Resource();
        $this->risorse->create(['user_id' => $this->id, 'last_update' => time()]);
        $this->farmBuildings = new UserFarmBuildings();
        $this->farmBuildings->create(['user_id' => $this->id]);
        $this->shopBuildings = new UserShopBuildings();
        $this->shopBuildings->create(['user_id' => $this->id]);

    }

    public static function find(int $id)
    {
        $user =  parent::find($id);
        $user->risorse = Resource::get($user->id);
        $user->farmBuildings = UserFarmBuildings::getAll('user_id', $user->id);
        $user->shopBuildings = UserShopBuildings::getAll('user_id', $user->id);

        return $user;
    }

    public static function whereEqual($column, $val)
    {
        $user =  parent::whereEqual($column, $val);

        $user->risorse = Resource::get($user->id);
        $user->farmBuildings = UserFarmBuildings::getAll('user_id', $user->id);
        $user->shopBuildings = UserShopBuildings::getAll('user_id', $user->id);

        return $user;
    }
}