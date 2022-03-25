<?php
namespace Controllers;
use Models\Refuge;

class RefugeController extends Refuge {
    // There is only 1 refuge in the databse
    private $refugeId = 1;

    public function findRefuge() {
        $refuge = $this->find($this->refugeId);
        require_once APP_ROOT . '/Views/home.php';
    }
}