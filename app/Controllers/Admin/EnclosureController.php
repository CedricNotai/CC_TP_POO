<?php
namespace App\Controllers\Admin;
use App\Models\Animal;
use App\Models\Keeper;
use App\Models\Enclosure;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class EnclosureController extends Controller {
    use IsAdmin;

    public function index()
    {
        $this->isAdmin();
        $enclosures = (new Enclosure($this->getDatabase()))->all();;

        return $this->view('admin.enclosure.index', compact('enclosures'));
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('admin.enclosure.form');
    }

    public function insert()
    {
        $this->isAdmin();
        $enclosure = new Enclosure($this->getDatabase());
        $result = $enclosure->create($_POST);

        if ($result) {
            echo "Création ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/enclosures" . "\">Retour</a>";
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $enclosure = (new Enclosure($this->getDatabase()))->findById($id);

        return $this->view('admin.enclosure.form', compact('enclosure'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $enclosure = new Enclosure($this->getDatabase());
        $result = $enclosure->update($id, $_POST);

        if ($result) {
            echo "Modification ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/enclosures" . "\">Retour</a>";
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $enclosure = new Enclosure($this->getDatabase());
        $result = $enclosure->destroy($id);

        if ($result) {
            echo "Suppression ok";
            echo "<a href=\"" . URL_PREFIX ."/admin/keepers" . "\">Retour</a>";
        }
    }
}