<?php

namespace App\Controller;

use App;
use Core\Services\Auth\DBAuth;
use Core\Services\HTML\BootstrapForm;
use Exception;
use PDOException;

class UserController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    /**
     * Verify the login
     * @return void
     * @throws PDOException
     */
    public function login()
    {
        $errors = \false;
        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getDb());
            if ($auth->login($_POST['usernameOrEmail'], $_POST['password'])) {
                $this->previousPage();
            } else {
                $errors = 'Identifiants incorrect';
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('user.login', \compact('form', 'errors'));
    }

    /**
     * Adding a new User
     * @return void
     */
    public function add()
    {
        $errors = \false;
        if (!empty($_POST)) {
            if ($_POST['password'] !== $_POST['password2']) {
                $errors = 'Mot de passe incorrect';
            } else {
                $passwordHash = \password_hash($_POST['password'], \PASSWORD_DEFAULT);

                try {
                    $user = $this->User->create([
                        'username' => $_POST['username'],
                        'email' => $_POST['email'],
                        'password' => $passwordHash
                    ]);
                } catch (Exception $errors) {
                    $errors = 'Pseudo ou Email deja utilisé, veuillez changer';
                }

                if ($errors === \false) {
                    return $this->previousPage();
                }
            }
        }

        $form = new BootstrapForm($_POST);
        $this->render('user.add', \compact('form', 'errors'));
    }

    /**
     * User logout
     * @return void
     */
    public function deconnect()
    {
        \session_destroy();
        $this->previousPage();
    }
}
