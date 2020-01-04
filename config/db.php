<?php
class Database
{
    private static $bdd = null;

    private function __construct() { }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=127.0.0.1;dbname=tasks_db", 'root', 'root_password');
        }
        return self::$bdd;
    }
}