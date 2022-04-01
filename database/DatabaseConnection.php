<?php
namespace Database;
use PDO;

class DatabaseConnection {
    // Database connection information
    private const DBNAME = 'd6-poo-php-tp';
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = 'root';

    static $pdo;
    
    // should return a PDO instance
    public static function getPDO() : PDO {

        // check if PDO has already been instanciated
        if (self::$pdo === null) {
            // new PDO with options to display errors and get objects instead of arrays
            self::$pdo = new PDO('mysql:dbname=' . self::DBNAME . ';host=' . self::HOST, self::USER , self::PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);

        }
        return self::$pdo;
    }  
}