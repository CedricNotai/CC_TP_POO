<?php
namespace App\Controllers;
use App\Models\Refuge;

class RefugeController extends Controller {
    public function index() {
        $refuge = (new Refuge($this->getDatabase()))->all();;

        // get the latest refuge in table
        $refuge = end($refuge);

        return $this->view('home', compact('refuge'));
    }
}