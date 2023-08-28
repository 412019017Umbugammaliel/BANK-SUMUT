<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Email\Email;
use Config\Email as EmailConfig;

class EmailController extends BaseController
{
    public function sendEmail()
    {
        $email = new Email();
        $emailConfig = new EmailConfig();

        $email->initialize($emailConfig);
        $email->setFrom('informatik.web.development@gmail.com', 'DevWeb');
        $email->setTo('alberttan101112@gmail.com');
        $email->setSubject('Test');
        $email->setMessage('Ini hanya test kirim email!');

        if ($email->send()) {
            echo 'Email sent successfully.';
        } else {
            echo 'Email sending failed.';
        }
    }
}
