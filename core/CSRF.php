<?php


class CSRF
{


    public static function createToken()
    {
        return bin2hex(random_bytes(24));
    }
}