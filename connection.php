<?php
class Database {
    public static $connection;

    public static function setUpConnection() {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "2006@Sanuga", "elisha", "3306");
            
            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }

    public static function iud($q) {
        Database::setUpConnection();
        if (Database::$connection->query($q) === TRUE) {
            return true;
        } else {
            return "Error: " . Database::$connection->error;
        }
    }

    public static function search($q) {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        if ($resultset === FALSE) {
            return "Error: " . Database::$connection->error;
        }
        return $resultset;
    }
}
