<?php
namespace App\Controllers\Admin;
use App\Models\Refuge;
use App\Traits\IsAdmin;
use App\Controllers\Controller;

class RefugeController extends Controller {
    use IsAdmin;

    public function index()
    {
        $this->isAdmin();
        $refuge = (new Refuge($this->getDatabase()))->all();
        $refuge = end($refuge);        
        
        return $this->view('admin.refuge.index', compact('refuge'));
    }

    public function edit(int $id)
    {
        $this->isAdmin();
        $refuge = (new Refuge($this->getDatabase()))->all();
        $refuge = end($refuge);        
        return $this->view('admin.refuge.form', compact('refuge'));
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $refuge = (new Refuge($this->getDatabase()))->all();
        $refuge = end($refuge);        
        $result = $refuge->update($id, $_POST);

        if ($result) {
            echo "Modification ok<br>";
            echo "<a href=\"" . URL_PREFIX ."/admin/refuge" . "\">Retour</a>";
        }
    }
}