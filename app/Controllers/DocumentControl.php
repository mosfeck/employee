<?php

namespace App\Controllers;

// use CodeIgniter\Controller;
// use App\Models\DepartModel;


class DocumentControl extends BaseController
{
    public function index()
    {
        $to = 'rahimaaktarsonia@gmail.com';
        $subject = 'Email Test';
        $message = 'Testing the email class.';
        $filepath = 'https://codeigniter.com/assets/images/ci-logo-big.png';

        $email = \Config\Services::email();

        $email->setFrom('mosfeckbd@gmail.com', 'Mosfeck uddin');
        $email->setTo($to);
        // $email->setCC('another@another-example.com');
        // $email->setBCC('them@their-example.com');

        $email->setSubject($subject);
        $email->setMessage($message);
        $email->attach($filepath);

        if($email->send())
        {
            echo "Mail sent";
        }else{
            echo "invalid";
        }
    }
}
