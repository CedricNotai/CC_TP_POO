<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require '../vendor/autoload.php';

use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

// virtual host configuration issue? 
define('URL_PREFIX', "/d6-poo-php-tp");

// define a const that leads to the views folder
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR .  'views' . DIRECTORY_SEPARATOR);

// define a const that leads to script files
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router\Router($_GET['url']);
$router->get('/', 'App\Controllers\RefugeController@index');
$router->get('/keepers/', 'App\Controllers\KeeperController@index');
$router->get('/keepers/:id', 'App\Controllers\KeeperController@show');
$router->get('/animals/', 'App\Controllers\AnimalController@index');
$router->get('/animals/:id', 'App\Controllers\AnimalController@show');
$router->get('/owners/', 'App\Controllers\OwnerController@index');
$router->get('/owners/:id', 'App\Controllers\OwnerController@show');
$router->get('/adoptions/', 'App\Controllers\AdoptionController@index');
$router->get('/adoptions/:id', 'App\Controllers\AdoptionController@show');

// Connexion
$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@loginPost');
$router->get('/logout', 'App\Controllers\UserController@logOut');

$router->get('/admin/panel', 'App\Controllers\UserController@admin');

// RU Refuge
$router->get('/admin/refuge', 'App\Controllers\Admin\RefugeController@index');
$router->get('/admin/refuge/edit/:id', 'App\Controllers\Admin\RefugeController@edit');
$router->post('/admin/refuge/edit/:id', 'App\Controllers\Admin\RefugeController@update');

// CRUD Keeper
$router->get('/admin/keepers', 'App\Controllers\Admin\KeeperController@index');
$router->get('/admin/keepers/create', 'App\Controllers\Admin\KeeperController@create');
$router->post('/admin/keepers/create', 'App\Controllers\Admin\KeeperController@insert');
$router->post('/admin/keepers/delete/:id', 'App\Controllers\Admin\KeeperController@destroy');
$router->get('/admin/keepers/edit/:id', 'App\Controllers\Admin\KeeperController@edit');
$router->post('/admin/keepers/edit/:id', 'App\Controllers\Admin\KeeperController@update');

// CRUD Animal
$router->get('/admin/animals', 'App\Controllers\Admin\AnimalController@index');
$router->get('/admin/animals/create', 'App\Controllers\Admin\AnimalController@create');
$router->post('/admin/animals/create', 'App\Controllers\Admin\AnimalController@insert');
$router->post('/admin/animals/delete/:id', 'App\Controllers\Admin\AnimalController@destroy');
$router->get('/admin/animals/edit/:id', 'App\Controllers\Admin\AnimalController@edit');
$router->post('/admin/animals/edit/:id', 'App\Controllers\Admin\AnimalController@update');

// CRUD Owner
$router->get('/admin/owners', 'App\Controllers\Admin\OwnerController@index');
$router->get('/admin/owners/create', 'App\Controllers\Admin\OwnerController@create');
$router->post('/admin/owners/create', 'App\Controllers\Admin\OwnerController@insert');
$router->post('/admin/owners/delete/:id', 'App\Controllers\Admin\OwnerController@destroy');
$router->get('/admin/owners/edit/:id', 'App\Controllers\Admin\OwnerController@edit');
$router->post('/admin/owners/edit/:id', 'App\Controllers\Admin\OwnerController@update');

// CRUD Adoptions
$router->get('/admin/adoptions', 'App\Controllers\Admin\AdoptionController@index');
$router->get('/admin/adoptions/create', 'App\Controllers\Admin\AdoptionController@create');
$router->post('/admin/adoptions/create', 'App\Controllers\Admin\AdoptionController@insert');
$router->post('/admin/adoptions/delete/:id', 'App\Controllers\Admin\AdoptionController@destroy');
$router->get('/admin/adoptions/edit/:id', 'App\Controllers\Admin\AdoptionController@edit');
$router->post('/admin/adoptions/edit/:id', 'App\Controllers\Admin\AdoptionController@update');

// CRUD Treatments
$router->get('/admin/treatments', 'App\Controllers\Admin\TreatmentController@index');
$router->get('/admin/treatments/create', 'App\Controllers\Admin\TreatmentController@create');
$router->post('/admin/treatments/create', 'App\Controllers\Admin\TreatmentController@insert');
$router->post('/admin/treatments/delete/:id', 'App\Controllers\Admin\TreatmentController@destroy');
$router->get('/admin/treatments/edit/:id', 'App\Controllers\Admin\TreatmentController@edit');
$router->post('/admin/treatments/edit/:id', 'App\Controllers\Admin\TreatmentController@update');

// CRUD Enclos
$router->get('/admin/enclosures', 'App\Controllers\Admin\EnclosureController@index');
$router->get('/admin/enclosures/create', 'App\Controllers\Admin\EnclosureController@create');
$router->post('/admin/enclosures/create', 'App\Controllers\Admin\EnclosureController@insert');
$router->post('/admin/enclosures/delete/:id', 'App\Controllers\Admin\EnclosureController@destroy');
$router->get('/admin/enclosures/edit/:id', 'App\Controllers\Admin\EnclosureController@edit');
$router->post('/admin/enclosures/edit/:id', 'App\Controllers\Admin\EnclosureController@update');

try {
    $router->run();
} catch (NotFoundException $e) {
    echo $e->getMessage();
    // return $e->error404(); // for custom 404
}
