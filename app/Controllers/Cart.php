<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public function add()
    {
        $logged = $this->session->get("logged");
        if ($logged) {
            $quantidade = $this->request->getPost("quantidade");
            $id = $this->request->getPost("id");
            $name = $this->request->getPost("name");
            $image = $this->request->getPost("image");
            $price = $this->request->getPost("price");
            $total = ($price * $quantidade);

            $product = [
                "id" => $id,
                "name" => $name,
                "image" => $image,
                "price" => $price,
                "total" => $total
            ];

            $cart = ["product" => $product, "quantidade" => $quantidade];
            $_SESSION["cart"][] = $cart;

            return "ok";
        } else {
            $this->session->setFlashdata("erro", "Faça login para ter acesso a está página!");
            return redirect()->to(base_url());
        }
    }

    public function show()
    {
        $logged = $this->session->get("logged");
        if ($logged) {
            $productsCart = $this->session->get("cart");

            if ($productsCart) {
                $total = 0;
                foreach ($productsCart as $product) {
                    $total += $product["product"]["total"];
                }
                $data = [
                    "session" => $this->session,
                    "productsCart" => $productsCart,
                    "total" => $total
                ];
                echo view("templates/header");
                echo view("cart", $data);
                echo view("templates/footer");
            } else {
                $this->session->setFlashdata("erro", "nenhum produto no carrinho!");
                echo view("templates/header");
                echo view("cart", ["session" => $this->session]);
                echo view("templates/footer");
            }
        } else {
            $this->session->setFlashdata("erro", "Faça login para ter acesso a está página!");
            return redirect()->to(base_url());
        }
    }

    public function remove()
    {
        $index = $this->request->getPost("index");
        
        if (sizeof($_SESSION["cart"]) == 1) {
            echo sizeof($_SESSION["cart"]);
            unset($_SESSION["cart"]);
            $this->session->setFlashdata("sucesso","Item removido!");
            return redirect()->back();
        } else {
            
            unset($_SESSION["cart"][$index]);
            
            $this->session->setFlashdata("sucesso","Item removido!");
            return redirect()->back();
        }
    }

    public function done()
    {
        $this->session->setFlashdata("info","Desculpe, ainda não implementamos esta funcionalidade!");  
        return redirect()->back();  
    }

    public function buy()
    {
        $logged = $this->session->get("logged");
        if ($logged) {
            $id = $this->request->getPost("productId");
            $name = $this->request->getPost("productName");
            $image = $this->request->getPost("productImage");
            $price = $this->request->getPost("productPrice");
            $quantidade = 1;
            $total = ($price * $quantidade);

            $product = [
                "id" => $id,
                "name" => $name,
                "image" => $image,
                "price" => $price,
                "total" => $total
            ];

            $cart = ["product" => $product, "quantidade" => $quantidade];
            $_SESSION["cart"][] = $cart;

            return redirect()->to(base_url("/cart"));
        } else {
            $this->session->setFlashdata("erro", "Faça login para ter acesso a está página!");
            return redirect()->to(base_url());
        }    
    }
}
