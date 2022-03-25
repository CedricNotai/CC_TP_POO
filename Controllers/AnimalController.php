<?php
namespace Controllers;
use Models\Animal;

class AnimalController extends Animal {
    public function createAnimal($animalName, $animalBirthDate, $animalSpecies, $animalGender) {
        $this->setPage($animalName, $animalBirthDate, $animalSpecies, $animalGender);
    }

    public function showPage($animalId) {
        $results = $this->getPage($animalId);
        require_once APP_ROOT . '/Views/home.php';
    }
}