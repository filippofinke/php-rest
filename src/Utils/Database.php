<?php
/**
 * @author Filippo Finke
 */
namespace FilippoFinke\Utils;

class Database
{
    private static $host = "127.0.0.1";
    private static $username = "root";
    private static $password = "";    
    private static $database = "";
    private static $connection = null;


    public static function setHost($host)
    {
        self::$host = $host;
    }
    
    public static function setUsername($username)
    {
        self::$username = $username;
    }

    public static function setPassword($password)
    {
        self::$password = $password;
    }

    public static function setDatabase($database)
    {
        self::$database = $database;
    }

    /**
     * throws PDOException
     */
    public static function getConnection()
    {
        if (!self::$connection) {
            self::$connection = new \PDO("mysql:host=".self::$host.";dbname=".self::$database, self::$username, self::$password);
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}
