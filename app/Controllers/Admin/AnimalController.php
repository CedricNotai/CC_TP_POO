<?php
namespace App\Controllers\Admin;
use App\Models\Animal;
use App\Models\Keeper;
use App\Models\Enclosure;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class AnimalController extends Controller {
    use IsAdmin;
    private $args = array(
        'animal_name'   => FILTER_SANITIZE_ADD_SLASHES,
        'animal_species'   => FILTER_SANITIZE_ADD_SLASHES,
        'animal_gender'   => FILTER_SANITIZE_ADD_SLASHES,
        'animal_image_url'   => FILTER_SANITIZE_URL,
        'animal_weight'   => FILTER_SANITIZE_NUMBER_INT,
        'animal_info'   => FILTER_SANITIZE_ADD_SLASHES,
        'animal_favorite_keeper'   => FILTER_SANITIZE_NUMBER_INT,
        'animal_enclosure_id'   => FILTER_SANITIZE_NUMBER_INT,
        'animal_birth_date'   => FILTER_DEFAULT,
        'animal_death_date'   => FILTER_DEFAULT,
        'animal_entry_date'   => FILTER_DEFAULT,
        'animal_chip_number'   => FILTER_SANITIZE_NUMBER_INT,
    );

    public function index()
    {
        $this->isAdmin();
        $animals = (new Animal($this->getDatabase()))->all();

        return $this->view('admin.animal.index', compact('animals'));
    }

    public function create()
    {
        $this->isAdmin();
        $keepersList = (new Keeper($this->getDatabase()))->all();
        $enclosuresList = (new Enclosure($this->getDatabase()))->all();

        return $this->view('admin.animal.form', compact('keepersList', 'enclosuresList'));
    }

    public function insert()
    {
        $this->isAdmin();
        $animal = new Animal($this->getDatabase());
        $result = $animal->create(filter_input_array(INPUT_POST, $this->args));

        if ($result) {
            echo "Création ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/animals" . "\">Retour</a>";
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $animal = (new Animal($this->getDatabase()))->findById($id);
        $keepersList = (new Keeper($this->getDatabase()))->all();
        $enclosuresList = (new Enclosure($this->getDatabase()))->all();

        return $this->view('admin.animal.form', compact('animal', 'keepersList', 'enclosuresList'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $animal = new Animal($this->getDatabase());
        $result = $animal->update($id, filter_input_array(INPUT_POST, $this->args));

        if ($result) {
            echo "Modification ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/animals" . "\">Retour</a>";
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $animal = new Animal($this->getDatabase());
        $result = $animal->destroy($id);

        if ($result) {
            echo "Suppression ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/animals" . "\">Retour</a>";
        }
    }
}