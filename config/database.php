<?php

class Database {

    private static $host = "localhost";
    private static $user = "root";
    private static $password = "root";
    private static $dbName = "04masw";
    private static $port = 3306;

    public static function getConnection() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $mysqli = new mysqli(
                self::$host,
                self::$user,
                self::$password,
                self::$dbName,
                self::$port
            );
            $mysqli->set_charset("utf8");
            return $mysqli;
        } catch (mysqli_sql_exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }
}
