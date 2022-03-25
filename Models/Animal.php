<?php
namespace Models;

class Animal extends Database 
{
    //test
    protected function getPage($animalId) {
        $sql = "SELECT * FROM animals WHERE animal_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$animalId]);

        $results = $stmt->fetchAll();
        return $results;
    }

    //test
    protected function setPage($animalName, $animalBirthDate, $animalSpecies, $animalGender) {
        $sql = "INSERT INTO animals (animal_name, animal_birth_date, animal_species, animal_gender) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$animalName, $animalBirthDate, $animalSpecies, $animalGender]);
    }
}