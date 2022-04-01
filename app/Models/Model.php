<?php
namespace App\Models;
use PDO;
use Database\DatabaseConnection;

abstract class Model {
    // Connect to database in children only
    protected $database;
    protected $table; // table name in database
    protected $tablePrefix;
    protected $idColumn;

    public function __construct() {
        $this->database = new DatabaseConnection;
        $this->tablePrefix = substr($this->table, 0, -1);
        $this->idColumn = $this->tablePrefix . "_id";
    }

    // general function to get all, returns an array
    public function all() : array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql);
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->idColumn} = ?";

        // set 3rd argument to true in order to fetch and not fetchAll
        return $this->query($sql, [$id], true);
    }

    public function getContactDetails()
    {
        return $this->getIdentity() . "<br>" . ($this->getLocation() ?? $this->getLocation()) . "<br>" . $this->getContact();
    }

    public function getIdentity() {
        $lastName = $this->tablePrefix . "_last_name";
        $firstName = $this->tablePrefix . "_first_name";
        return $this->$firstName . " " . mb_strtoupper($this->$lastName);
    }

    private function getLocation() {
        $address = $this->tablePrefix . "_address";
        $zipCode = $this->tablePrefix . "_zip_code";
        $city = $this->tablePrefix . "_city";
        if (isset($this->$address) || isset($this->$zipCode) || isset($this->$city)) {
            return $this->$address . " - " . $this->$city . " (" . $this->$zipCode . ")";
        }
    }

    private function getContact() {
        $phone = $this->tablePrefix . "_phone";
        $email = $this->tablePrefix . "_email";
        return "Tél : " . $this->$phone . "<br> Email : " . $this->$email;
    }

    public function getMoreInfo()
    {
        $info = $this->tablePrefix . "_info";
        if (is_null($this->$info)) {
            return "";
        } else {
            return "Informations supplémentaires : " . $this->$info;
        }
    }

    // function for sql queries // single : fetch or fetchAll
    public function query(string $sql, array $params = null, bool $single = null)
    {
        // if there are no params, then query, else prepare and execute
        $method = is_null($params) ? 'query' : 'prepare';

        // check if no value is expected to be returned
        if (
            strpos($sql, 'DELETE') === 0 || strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0) {
                $statement = DatabaseConnection::getPDO()->$method($sql);
                $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->database]);
                return $statement->execute($params);
            }

        // if single is null, fetchAll, else fetch
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $statement = DatabaseConnection::getPDO()->$method($sql);

        // set PDO to fetch classes (Models), also needs the connection to database (3rd argument of setFetchMode)
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->database]);

        // if query, then fetch, else execute then fetch 
        if ($method === 'query') {
            return $statement->$fetch();
        } else {
            $statement->execute($params);
            return $statement->$fetch();
        }
    }

    public function create(array $data, ?array $relations = null)
    {
        $columnNames = "";
        $values = "";
        $i = 1;

        foreach($data as $key=>$value) {
            if ($value == "1970-01-01" ) {
                $data[$key] = null;
            }

            if ($value == "") {
                $data[$key] = null;
            }

            $comma = $i === count($data) ? "" : ", ";
            $columnNames .= "{$key}{$comma}";
            $values .= ":{$key}{$comma}";
            $i++;
        }

        $sql = "INSERT INTO {$this->table} ($columnNames) VALUES ($values)";
        return $this->query($sql, $data);
    }

    public function update(int $id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach($data as $key => $value) {
            if ($value == "1970-01-01" ) {
                $data[$key] = null;
            }

            if ($value == "") {
                $data[$key] = null;
            }

            // if we get to the last data, we don't add comma
            $comma = $i === count($data) ? "" : ", ";
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET {$sqlRequestPart} WHERE {$this->idColumn} = :id"; 
        return $this->query($sql, $data);
    }

    // returns bool
    public function destroy(int $id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->idColumn} = ?";
        return $this->query($sql, [$id]);
    }
}