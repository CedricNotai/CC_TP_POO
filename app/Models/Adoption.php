<?php
namespace App\Models;

class Adoption extends Model {
    protected $table = "adoptions";

    public function getAnimalId()
    {
        $sql = "SELECT a.animal_id FROM animals AS a
        INNER JOIN adoptions AS ad ON ad.adoption_animal_id = a.animal_id
        WHERE ad.adoption_id = ?";

        $adoptionId = $this->adoption_id;

        return $this->query($sql, [$adoptionId], true);
    }

    public function getOwnerId()
    {
        $sql = "SELECT o.owner_id FROM owners AS o
        INNER JOIN adoptions AS ad ON ad.adoption_owner_id = o.owner_id
        WHERE ad.adoption_id = ?";

        $adoptionId = $this->adoption_id;

        return $this->query($sql, [$adoptionId], true);
    }
}