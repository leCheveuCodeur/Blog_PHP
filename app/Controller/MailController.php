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

    /**
     * Display contact page
     * @return void
     */
    public function contact(): void
    {
        $errors = '';
        $message = '';

        if (!empty($this->POST)) {
            // detect spam bot
            if (empty($this->POST['surname']) && $this->POST['surname'] === '') {
                \extract($this->mail->sendMail($this->POST));
            }
        }
        $form = new BootstrapForm();
        $alert = $this->Comment->alert();
        $this->render('mail.contact', \compact('alert', 'form', 'errors', 'message'));
    }
}
