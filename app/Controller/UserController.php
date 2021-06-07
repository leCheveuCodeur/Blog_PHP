<?php

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;

class UserController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    public function login()
    {
        $errors = \false;
        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getDb());
            if ($auth->login($_POST["usernameOrEmail"], $_POST["password"])) {
                $this->previousPage();
            } else {
                $errors = "Identifiants incorrect";
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('user.login', \compact('form', 'errors'));
    }

    public function add()
    {
        $errors = \false;
        if (!empty($_POST)) {
            if ($_POST['password'] !== $_POST['password2']) {
                $errors = "Mot de passe incorrect";
            } else {
                $passwordHash = \password_hash($_POST['password'], \PASSWORD_DEFAULT);

                $user = $this->User->create([
                    "username" => $_POST["username"],
                    "email" => $_POST["email"],
                    "password" => $passwordHash
                ]);

                if ($user) {
                    $this->previousPage();
                }
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('user.add', \compact('form', 'errors'));
    }

    public function deconnect()
    {
        \session_destroy();
        $this->previousPage();
    }
}
