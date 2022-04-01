<?php
namespace App\Controllers;
use App\Interfaces\Display;
use App\Models\Owner;

class OwnerController extends Controller implements Display {

    public function index() {
        // need the database connection to instantiate owner
        $owners = (new Owner($this->getDatabase()))->all();

        return $this->view("owner." . Display::INDEX_ROUTE, compact('owners'));
    }

    public function show(int $id) {
        $owner = (new Owner($this->getDatabase()))->findById($id);;

        return $this->view("owner." . Display::SHOW_ROUTE, compact('owner'));
    }
}