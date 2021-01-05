<?php

namespace App\Controllers;

class Web extends BaseController
{
    public function index()
    {
        $data = [
            "session" => $this->session
        ];
        echo view("templates/header");
        echo view("login", $data);
        echo view("templates/footer");
    }
    public function home()
    {
        $logged = $this->session->get("logged");
        if ($logged) {

            $data = [
                "session" => $this->session,
                "products" => $this->productModel->findAll()
            ];
            echo view("templates/header");
            echo view("home", $data);
            echo view("templates/footer");
        } else {
            $this->session->setFlashdata("erro", "Faça login para ter acesso a está página!");
            return redirect()->to(base_url());
        }
    }
    public function cadastro()
    {
        $data = [
            "session" => $this->session
        ];
        echo view("templates/header");
        echo view("cadastro", $data);
        echo view("templates/footer");
    }

    public function forget()
    {
        $data = [
            "session" => $this->session
        ];
        echo view("templates/header");
        echo view("esqueci", $data);
        echo view("templates/footer");
    }

    public function confirm()
    {
        $data = [
            "session" => $this->session
        ];
        echo view("templates/header");
        echo view("confirmReset", $data);
        echo view("templates/footer");
    }

    public function reset()
    {
        $data = [
            "session" => $this->session
        ];
        echo view("templates/header");
        echo view("reset", $data);
        echo view("templates/footer");
    }

    
}
