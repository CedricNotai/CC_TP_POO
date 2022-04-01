<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function login()
    {
        return $this->view('auth.login');
    } 

    public function loginPost()
    {
        $user = (new User($this->getDatabase()))->getByUserName($_POST['user_name']);
        if (password_verify($_POST['user_password'], $user->user_password)) {
            $_SESSION['auth'] = (int) $user->user_is_admin;
            return header('Location: ' . URL_PREFIX . "/admin/panel");
        } else {
            echo "Mauvais mot de passe. Veuillez réessayer";
            echo "<a href=\"" . URL_PREFIX ."/login/" . "\">Retour</a>";

        }
    }

    public function admin()
    {
        return $this->view('admin.panel');
    }

    final public function logOut()
    {
        session_destroy();
        return header('Location: ' . URL_PREFIX . "/");    }
}