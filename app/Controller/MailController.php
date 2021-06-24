<?php

namespace App\Controller;

use Core\Services\HTML\BootstrapForm;
use Core\Services\Mail\Mail;

class MailController extends AppController
{
    private $mail;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
        $this->mail = new Mail;
    }

    public function contact()
    {
        $errors = '';
        $message = '';

        if (!empty($_POST)) {
            \extract($this->mail->sendMail());
        }
        $form = new BootstrapForm();
        $alert = $this->Comment->alert();
        $this->render('mail.contact', \compact('alert', 'form', 'errors', 'message'));
    }
}
