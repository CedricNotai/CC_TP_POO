<?php
namespace App\Models;
use DateTime;

class Owner extends Model {
    protected $table = "owners";

    public function getAllInfo() {
        $registrationDate = (new DateTime($this->owner_registration_date))->format('d/m/Y');

        return
            $this->getContactDetails() . "<br>" .
            "Date d'enregistrement : " . $registrationDate . "<br>" .
            $this->getMoreInfo();
    }
}