<?php
namespace App\Controllers;
use App\Models\Owner;
use App\Models\Adoption;
use App\Interfaces\Display;

class OwnerController extends Controller implements Display {

    public function index() {
        // need the database connection to instantiate owner
        $owners = (new Owner($this->getDatabase()))->all();

        return $this->view("owner." . Display::INDEX_ROUTE, compact('owners'));
    }

    public function show(int $id) {
        $owner = (new Owner($this->getDatabase()))->findById($id);
        $adoptions = (new Adoption($this->getDatabase()))->all();

        return $this->view("owner." . Display::SHOW_ROUTE, compact('owner', 'adoptions'));
    }
}