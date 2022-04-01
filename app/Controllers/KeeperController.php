<?php
namespace App\Controllers;
use App\Interfaces\Display;
use App\Models\Keeper;

class KeeperController extends Controller implements Display {

    public function index() {
        // need the database connection to instantiate keeper
        $keepers = (new Keeper($this->getDatabase()))->all();

        return $this->view("keeper." . Display::INDEX_ROUTE, compact('keepers'));
    }

    public function show(int $id) {
        $keeper = (new Keeper($this->getDatabase()))->findById($id);

        return $this->view("keeper." . Display::SHOW_ROUTE, compact('keeper'));
    }
}