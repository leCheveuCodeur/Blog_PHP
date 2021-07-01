<?php

namespace Core\Services\Mail;

use Core\Config;
use PHPMailer\PHPMailer\SMTP;
use Core\Services\Gloabls\Globals;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private $mail;

    public function __construct()
    {
        $this->initMail();
    }

    /**
     * Initiate a Mail object
     * @return void
     * @throws Exception
     */
    private function initMail()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        $this->mail = new PHPMailer;
        if (!empty($config->get('smtp_debug'))) {
            $this->mail->isSMTP();
            $this->mail->SMTPDebug = intval($config->get('smtp_debug'));
            $this->mail->Host = $config->get('smtp_host');
            $this->mail->Port = intval($config->get('smtp_port'));
            if ($config->get('smtp_auth') == 1) {
                $this->mail->SMTPAuth = !empty($config->get('smtp_auth'));
                $this->mail->Username = $config->get('smtp_user');
                $this->mail->Password = $config->get('smtp_pass');
            }
        } else {
            $this->mail->isMail();
        }
        $this->mail->CharSet = 'UTF-8';
        $this->mail->setLanguage('fr');
        $this->mail->WordWrap = 78;
        $this->mail->addAddress($config->get('mail_address'));
    }

    /**
     * Generate the Mail sending
     * @param array $POST
     * @return array with the \compat function | !! use \extract to retrieve
     */
    public function sendMail(array $POST): array
    {
        $errors = '';
        $message = '';

        $this->mail->setFrom($POST['mail'], $POST['name']);
        $this->mail->Subject = $POST['subject'];
        $this->mail->Body = nl2br($POST['content']);
        $this->mail->AltBody = nl2br($POST['content']);
        $this->mail->IsHTML(false);

        if (!$this->mail->send()) {
            $errors = $this->mail->ErrorInfo;
        } else {
            $message = 'Message envoyé !';
        }

        return \compact('errors', 'message');
    }
}
