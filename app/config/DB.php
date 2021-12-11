<?php
namespace App\Config;
use mysqli;

class DB {
    public static $mysqli;

    public function __construct()
    {
        $host = ConfigHelper::getConfig('database.host');
        $user = ConfigHelper::getConfig('database.user');
        $pass = ConfigHelper::getConfig('database.pass');
        $db = ConfigHelper::getConfig('database.db');
        self::$mysqli = new mysqli($host, $user, $pass, $db);
        if (self::$mysqli->connect_errno) {
            echo "Не удалось подключиться к БД - ".self::$mysqli->connect_error;
        } else {
            self::$mysqli->set_charset("utf-8");
        }
    }
}
