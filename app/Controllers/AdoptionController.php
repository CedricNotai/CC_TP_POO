<?php
namespace App\Controllers;
use App\Interfaces\Display;
use App\Models\Owner;
use App\Models\Animal;
use App\Models\Adoption;

class AdoptionController extends Controller implements Display {

    public function index() {
        // need the database connection to instantiate adoption
        $adoptions = (new Adoption($this->getDatabase()))->all();

        return $this->view("adoption." . Display::INDEX_ROUTE, compact('adoptions'));
    }

    public function show(int $id) {
        $adoption = (new Adoption($this->getDatabase()))->findById($id);
        $animal = (new Animal($this->getDatabase()))->findById($adoption->adoption_animal_id);;
        $owner = (new Owner($this->getDatabase()))->findById($adoption->adoption_owner_id);

        return $this->view("adoption." . Display::SHOW_ROUTE, compact('adoption', 'animal', 'owner'));
    }
}