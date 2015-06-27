<?php
/**
 * Created by PhpStorm.
 * User: Lidya
 * Date: 6/26/2015
 * Time: 6:41 AM
 */

class Database {


    private static $username = "root";
    private static $password= '';
    private static $server= "localhost";
    private static $database = "srms_db";

    private static  $conn;
    public static function connect()
    {

        if (self::$conn == null) {
            try {
                SELF::$conn = new PDO("mysql:host=" . SELF::$server . ";dbname=" . SELF::$database, SELF::$username, SELF::$password);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conn;

    }

    public function disconnet()
    {
        self::$conn =null;
    }
    }

