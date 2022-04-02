<?php
namespace App\Controllers\Admin;
use App\Models\Owner;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class OwnerController extends Controller {
    use IsAdmin;
    public function index()
    {
        $this->isAdmin();
        $owners = (new Owner($this->getDatabase()))->all();
        return $this->view('admin.owner.index', compact('owners'));
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('admin.owner.form');
    }

    public function insert()
    {
        $this->isAdmin();
        $owner = new Owner($this->getDatabase());
        $result = $owner->create($_POST);

        if ($result) {
            echo "Création ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/owners" . "\">Retour</a>";
        }
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $owner = (new Owner($this->getDatabase()))->findById($id);

        return $this->view('admin.owner.form', compact('owner'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $owner = new Owner($this->getDatabase());
        $result = $owner->update($id, $_POST);

        if ($result) {
            echo "Modification ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/owners" . "\">Retour</a>";
        }
    }

    public function destroy(int $id)
    {
        $this->isAdmin();
        $owner = new Owner($this->getDatabase());
        $result = $owner->destroy($id);

        if ($result) {
            echo "Suppression ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/keepers" . "\">Retour</a>";
        }
    }
}