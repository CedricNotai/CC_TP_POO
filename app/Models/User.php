<?php
namespace App\Models;

class User extends Model {
    protected $table = "users";

    public function getByUserName(string $username)
    {
        $sql = "SELECT * FROM {$this->table}
        WHERE user_name = ?";

        return $this->query($sql, [$username], true);
    }
}