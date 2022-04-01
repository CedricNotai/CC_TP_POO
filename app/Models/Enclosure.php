<?php
namespace App\Models;

class Enclosure extends Model {
    protected $table = "enclosures";

    public function getName()
    {
        return "E-" . $this->enclosure_name;
    }
}