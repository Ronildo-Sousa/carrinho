<?php

namespace App\Controllers;

use App\Models\UserModel;

class Email extends BaseController
{
    protected $email;

    public function __construct()
    {
        $this->email = \Config\Services::email();
    }


    public function send($from,$fromName,$to,$subject,$message)
    {
        $this->email->setFrom($from, $fromName);
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if($this->email->send()){
            return true;
        }
        return false;
    }
}
