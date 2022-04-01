<?php
namespace App\Controllers\Admin;
use App\Models\Animal;
use App\Models\Keeper;
use App\Models\Treatment;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class TreatmentController extends Controller {
    use IsAdmin;

    public function index()
    {
        $this->isAdmin();
        $treatments = (new Treatment($this->getDatabase()))->all();;

        return $this->view('admin.treatment.index', compact('treatments'));
    }

    public function create()
    {
        $this->isAdmin();
        $animalsList = (new Animal($this->getDatabase()))->all();
        $keepersList = (new Keeper($this->getDatabase()))->all();

        return $this->view('admin.treatment.form', compact('animalsList', 'keepersList'));
    }

    public function insert()
    {
        $this->isAdmin();
        $treatment = new Treatment($this->getDatabase());
        $result = $treatment->create($_POST);

        if ($result) {
            echo "Création ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/treatments" . "\">Retour</a>";
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $treatment = (new Treatment($this->getDatabase()))->findById($id);
        $animalsList = (new Animal($this->getDatabase()))->all();
        $keepersList = (new Keeper($this->getDatabase()))->all();;

        return $this->view('admin.treatment.form', compact('treatment', 'animalsList', 'keepersList'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $treatment = new Treatment($this->getDatabase());
        $result = $treatment->update($id, $_POST);

        if ($result) {
            echo "Modification ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/treatments" . "\">Retour</a>";
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $treatment = new Treatment($this->getDatabase());
        $result = $treatment->destroy($id);

        if ($result) {
            echo "Suppression ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/keepers" . "\">Retour</a>";
        }
    }
}