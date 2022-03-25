<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));

$refuge = new Controllers\RefugeController();
$refuge->findRefuge(1);
$refuge->showPage();
