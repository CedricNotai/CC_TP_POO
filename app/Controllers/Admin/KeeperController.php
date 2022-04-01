<?php
namespace App\Controllers\Admin;
use App\Models\Animal;
use App\Models\Keeper;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class KeeperController extends Controller {
    use IsAdmin;

    public function index()
    {
        $this->isAdmin();
        $keepers = (new Keeper($this->getDatabase()))->all();

        return $this->view('admin.keeper.index', compact('keepers'));
    }

    public function create()
    {
        $this->isAdmin();
        $keepersList = (new Keeper($this->getDatabase()))->all();
        $animalsList = (new Animal($this->getDatabase()))->all();;

        return $this->view('admin.keeper.form', compact('keepersList', 'animalsList'));
    }

    public function insert()
    {
        $this->isAdmin();
        $keeper = new Keeper($this->getDatabase());
        $result = $keeper->create($_POST);

        if ($result) {
            echo "Création ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/keepers" . "\">Retour</a>";
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $keeper = (new Keeper($this->getDatabase()))->findById($id);
        $keepersList = (new Keeper($this->getDatabase()))->all();
        $animalsList = (new Animal($this->getDatabase()))->all();

        return $this->view('admin.keeper.form', compact('keeper', 'keepersList', 'animalsList'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $keeper = new Keeper($this->getDatabase());
        $result = $keeper->update($id, $_POST);

        if ($result) {
            echo "Modification ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/keepers" . "\">Retour</a>";
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $keeper = new Keeper($this->getDatabase());
        $result = $keeper->destroy($id);

        if ($result) {
            echo "Suppression ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/keepers" . "\">Retour</a>";
        }
    }
}