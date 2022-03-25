<?php 
namespace Models;

use \PDO;
use \PDOException;

class Database {
    protected $connection;
    protected static $instance;

    // Database connection information
    private const DBNAME = 'd6-poo-php-tp';
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = 'root';

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:dbname=' . self::DBNAME . ';host=' . self::HOST, self::USER , self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->connection;
        }
        catch (PDOException $e)
        {
            echo 'Une erreur est survenue :'. $e->getMessage();
            die();
        }
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    private static function getInstance()
    {
        if (is_null(static::$instance))
        {
            static::$instance=new static();
        }
        return static::$instance;
    }

    public static function query($sql,$params=null)
    {
        $instance = static::getInstance();
        $statement = $instance->prepare($sql);
        $statement->execute([$params]);
        return $statement;
    }
}