<?php
namespace App\Models;
use DateTime;

class Animal extends Model {
    protected $table = "animals";

    public function getFavoriteKeeper()
    {
        $sql = "SELECT k.keeper_id 
        FROM keepers AS k
        INNER JOIN animals AS a ON a.animal_favorite_keeper = k.keeper_id
        WHERE a.animal_id = ?";

        $animalId = $this->animal_id; 
        return $this->query($sql, [$animalId], true);
    }

    public function getEnclosure()
    {
        $sql = "SELECT e.enclosure_id
        FROM enclosures AS e
        INNER JOIN animals AS a ON a.animal_enclosure_id = e.enclosure_id
        WHERE a.animal_id = ?";
        $animalId = $this->animal_id;

        return $this->query($sql, [$animalId], true);
    }

    private function getGender()
    {
        switch (strtolower($this->animal_gender)) {
            case "f":
                return "Sexe : Femelle";
                break;
            case "m":
                return "Sexe : Mâle";
                break;
            default:
                return "Sexe : Inconnu";
                break;
        }
    }

    private function getSpecies()
    {
        return "Espèce : " . $this->animal_species;
    }

    public function getSomeInfo()
    {
        return $this->getGender() . "<br>" . $this->getSpecies();
    }

    public function getAllInfo()
    {
        $birthDate = (new DateTime($this->animal_birth_date))->format('d/m/Y');
        $entryDate = (new DateTime($this->animal_entry_date))->format('d/m/Y');

        if ($this->animal_death_date) {
            $deathDate = (new DateTime($this->animal_death_date))->format('d/m/Y');
        } else {
            $deathDate=null;
        }

        return $this->getSomeInfo() . "<br>Date de naissance : " . $birthDate . "<br>" . ($this->animal_death_date ? "Date de décès : " . $deathDate . "<br>" : "") . "Poids : " . $this->animal_weight . " kg<br> Arrivé au refuge le " . $entryDate . "<br> Numéro de puce : " . $this->getChipNumber() . "<br>" . $this->getMoreInfo();
    }

    public function getChipNumber()
    {
        return "PUCE-" . $this->animal_chip_number;
    }

    public function getTreatments()
    {
        $sql = "SELECT * FROM treatments WHERE treatment_animal_id = ?";
        return $this->query($sql, [$this->animal_id]);
    }
}