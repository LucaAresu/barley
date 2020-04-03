<?php
require_once 'Model.php';

class User extends Model
{

    public static function find(int $id)
    {
        $user =  parent::find($id);
        $user->risorse = Resource::get($user->id);

        return $user;
    }

    public static function whereEqual($column, $val)
    {
        $user =  parent::whereEqual($column, $val);

        $user->risorse = Resource::get($user->id);

        return $user;
    }
}