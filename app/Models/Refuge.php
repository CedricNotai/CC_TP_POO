<?php
namespace App\Models;

class Refuge extends Model {
    protected $table = "refuges";

    public function __toString()
    {
        return $this->refuge_name . " est situé " . $this->refuge_address . ", à " . $this->refuge_city . " (" . $this->refuge_zip_code . ").<br> Nous sommes joignables par téléphone au " . wordwrap($this->refuge_phone, 2, ' ', true) .". <br>";
    }
}