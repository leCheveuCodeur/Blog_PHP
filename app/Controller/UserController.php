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
        $POST = $this->globals->getPOST();
        if (!empty($POST)) {
            $auth = new DBAuth(App::getInstance()->getDb());
            if ($auth->login($POST['usernameOrEmail'], $POST['password'])) {
                return $this->previousPage();
            }
            $errors = 'Identifiants incorrect';
        }

        $form = new BootstrapForm($POST);
        $this->render('user.login', \compact('form', 'errors'));
    }

    /**
     * Adding a new User
     * @return void
     */
    public function add()
    {
        $errors = \false;
        $POST = $this->globals->getPOST();
        if (!empty($POST)) {
            if ($POST['password'] !== $POST['password2']) {
                $errors = 'Mot de passe incorrect';
            } else {
                $passwordHash = \password_hash($POST['password'], \PASSWORD_DEFAULT);

                try {
                    $user = $this->User->create([
                        'username' => $POST['username'],
                        'email' => $POST['email'],
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

        $form = new BootstrapForm($POST);
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
