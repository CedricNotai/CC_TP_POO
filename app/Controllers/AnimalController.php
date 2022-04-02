<?php
namespace App\Controllers;
use App\Models\Animal;
use App\Models\Keeper;
use App\Models\Adoption;
use App\Models\Enclosure;
use App\Models\Treatment;
use App\Interfaces\Display;

class AnimalController extends Controller implements Display {

    public function index() {
        // need the database connection to instantiate keeper
        $animals = (new Animal($this->getDatabase()))->all();

        return $this->view("animal." . Display::INDEX_ROUTE, compact('animals'));
    }

    public function show(int $id) {
        $animal = (new Animal($this->getDatabase()))->findById($id);
        
        $keeper = $animal->getFavoriteKeeper();
        if ($keeper) {
            $favoriteKeeperId = $keeper->keeper_id;
            $favoriteKeeper = (new Keeper($this->getDatabase()))->findById($favoriteKeeperId);
        } else {
            $favoriteKeeper = null;
        }

        $treatments = $animal->getTreatments();
        if ($treatments) {
            foreach ($treatments as $treatment) {
                $treatment = new Treatment($this->getDatabase());
            }
        } else {
            $treatments = null;
        }

        $enclosure = $animal->getEnclosure();
        $enclosureId = $enclosure->enclosure_id;
        $currentEnclosure = (new Enclosure($this->getDatabase()))->findById($enclosureId);
        $adoptions = (new Adoption($this->getDatabase()))->all();

        return $this->view("animal." . Display::SHOW_ROUTE, compact('animal', 'favoriteKeeper', 'currentEnclosure', 'treatments', 'adoptions'));
    }
}