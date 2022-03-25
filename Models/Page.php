<?php
namespace Models;

class Page extends Database {
    // private $columns=[];
    protected static $table;
    protected static $viewPath;

    public static function find($id) 
    {
        $idColumn = substr(static::$table, 0, -1) . '_id'; // table name without s
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $idColumn . ' = ?';
        $find=Database::query($sql,$id);
        $results = $find->fetch();
        return $results;
    }

    protected function getPage() {
        $sql = 'SELECT * FROM ' . static::$table;
        $stmt = Database::prepare($sql);
        $stmt->execute([]);

        $results = $stmt->fetchAll();
        return $results;
    }

    public function showPage() {
        $results = $this->getPage();
        require_once APP_ROOT . static::$viewPath;
    }
}