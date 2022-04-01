<?php
namespace App\Traits;

trait IsAdmin {
    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) {
            return true;
        } else {
            return Header('Location :' . URL_PREFIX . "/login");
        }
    }
}