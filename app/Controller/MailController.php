<?php

namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Mail\Mail;

class MailController extends AppController
{
    private $mail;

    public function __construct()
    {
        parent::__construct();
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
        $this->render('mail.contact', \compact('form', 'errors', 'message'));
    }
}
