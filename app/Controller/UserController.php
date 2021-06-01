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
            if ($auth->login($_POST["username"], $_POST["password"])) {
                header('Refresh:0');
            } else {
                $errors = \true;
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('user.login', \compact('form', 'errors'));
    }

    public function add()
    {

        if (!empty($_POST)) {
            $user = $this->User->create([
                "firstName" => $_POST["firstName"],
                "lastName" => $_POST["lastName"],
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "password" => $_POST["password"]
            ]);

            if ($user) { //TODO a completer par un message  et une redirection
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('user.add', \compact('form'));
    }
}
