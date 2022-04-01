<?php
namespace App\Models;
use DateTime;

class Keeper extends Model {
    protected $table = "keepers";

    public function getDetails()
    {
        return $this->getContactDetails() . "<br>" . $this->getAllInfo();
    }

    private function getGender()
    {
        switch (strtolower($this->keeper_gender)) {
            case "f":
                return "Sexe : Femme";
                break;
            case "m":
                return "Sexe : Homme";
                break;
            default:
                return "Sexe : Inconnu";
                break;
        }
    }

    public function getSomeInfo() {
        return $this->getGender() . "<br> Spécialité : " . $this->keeper_speciality . "<br>";
    }

    public function getAllInfo() {
        $entryDate = (new DateTime($this->keeper_entry_date))->format('d/m/Y');
        $exitDate = (new DateTime($this->keeper_exit_date))->format('d/m/Y');

        return
            $this->getSomeInfo() . "<br>" .
            "Nombre de traitements maximum par jour : " . $this->keeper_max_daily_treatments . "<br>" .
            ($this->keeper_entry_date ? "Date d'entrée : {$entryDate} <br>" : '' ) .
            ($this->keeper_exit_date ? "Date de sortie : {$exitDate} <br>" : '' ) . $this->getMoreInfo();
    }

    public function getManager(int $managerId = null)
    {
        if ($managerId) {
            $sql = "SELECT * FROM keepers WHERE keeper_id = ?";
            return $this->query($sql, [$managerId], true);    
        }
    }

    public function getTreatedAnimals(int $keeperId)
    {
        $sql = "SELECT DISTINCT a.* FROM animals as a
        INNER JOIN treatments as t ON t.treatment_animal_id = a.animal_id
        INNER JOIN keepers as k ON t.treatment_keeper_id = k.keeper_id
        WHERE k.keeper_id = ?";

        return $this->query($sql, [$keeperId]);
    }

    public function assignAnimal($keeperId, $animalId)
    {
        $sql = "INSERT INTO treatments (treatment_keeper_id, treatment_animal_id)VALUES (? , ?)";

        return $this->query($sql, [$keeperId, $animalId]);
    }
}