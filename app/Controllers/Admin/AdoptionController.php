<?php
namespace App\Controllers\Admin;
use App\Models\Owner;
use App\Models\Animal;
use App\Models\Adoption;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class AdoptionController extends Controller {
    use IsAdmin;

    public function index()
    {
        $this->isAdmin();
        $adoptions = (new Adoption($this->getDatabase()))->all();
        return $this->view('admin.adoption.index', compact('adoptions'));
    }

    public function create()
    {
        $this->isAdmin();
        $animalsList = (new Animal($this->getDatabase()))->all();
        $ownersList = (new Owner($this->getDatabase()))->all();

        return $this->view('admin.adoption.form', compact('animalsList', 'ownersList'));
    }

    public function insert()
    {
        $this->isAdmin();
        $adoption = (new Adoption($this->getDatabase()));
        $result = $adoption->create($_POST);

        if ($result) {
            echo "Création ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/adoptions" . "\">Retour</a>";
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $adoption = (new Adoption($this->getDatabase()))->findById($id);
        $animalsList = (new Animal($this->getDatabase()))->all();
        $ownersList = (new Owner($this->getDatabase()))->all();

        return $this->view('admin.adoption.form', compact('adoption', 'animalsList', 'ownersList'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $adoption = new Adoption($this->getDatabase());
        $result = $adoption->update($id, $_POST);

        if ($result) {
            echo "Modification ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/adoptions" . "\">Retour</a>";
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $adoption = new Adoption($this->getDatabase());
        $result = $adoption->destroy($id);

        if ($result) {
            echo "Suppression ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/adoptions" . "\">Retour</a>";
        }
    }
}