<?php

namespace App\Controllers;

use App\Models\ConfirmaModel;
use App\Models\RedefinicaoModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $tokenConfirma;
    protected $tokenRedefinicao;
    protected $defaultEmail;
    protected $defaultName;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->tokenConfirma = new ConfirmaModel();
        $this->tokenRedefinicao = new RedefinicaoModel();
        $this->defaultEmail = "ifprojeto54@gmail.com";
        $this->defaultName = "if projeto";
    }

    public function login()
    {
        $email = filter_var($this->request->getPost("email"), FILTER_SANITIZE_EMAIL);
        $senha = filter_var($this->request->getPost("senha"), FILTER_SANITIZE_STRIPPED);

        $this->session->setFlashdata("email", $email);

        $auth = $this->userModel->auhLogin($email, $senha);

        if ($auth) {
            $user = $this->userModel->findByEmail($email);

            $data = [
                "user" => $user,
                "logged" => true
            ];
            $this->session->set($data);
            return redirect()->to(base_url("/home"));
        } else {
            $this->session->setFlashdata("erro", "Erro ao logar, tente novamente!");
            return redirect()->back();
        }
    }

    public function register()
    {
        $nome = filter_var($this->request->getPost("nome"), FILTER_SANITIZE_STRIPPED);
        $sobreNome = filter_var($this->request->getPost("sobrenome"), FILTER_SANITIZE_STRIPPED);
        $email = filter_var($this->request->getPost("email"), FILTER_SANITIZE_EMAIL);
        $senha = filter_var($this->request->getPost("senha"), FILTER_SANITIZE_STRIPPED);

        $userData = [
            "nome" => $nome,
            "sobrenome" => $sobreNome,
            "email" => $email
        ];
        $this->session->setFlashdata($userData);

        $register = $this->userModel->register($nome, $sobreNome, $email, $senha);

        if ($register) {
            $user = $this->userModel->findByEmail($email);
            $token = strtoupper(bin2hex(random_bytes(5)));
            $this->tokenConfirma->insert(["token" => $token, "id_usuario" => $user->id]);

            $sendEmail = new Email();
            $htmlMessage = view("confirmEmail", ["nome" => $nome, "codigo" => $token]);

            if ($sendEmail->send($this->defaultEmail, $this->defaultName, $user->email, "Confirmação de email", $htmlMessage)) {
                $this->session->set("user", $user);
                $this->session->setFlashdata("info", "Sigas as instruções no seu endereço de email para continuar.");
                return redirect()->to(base_url("/login"));
            } else {
                $this->tokenConfirma->where("id_usuario", $user->id)->delete();
                $this->userModel->delete($user->id);
                $this->session->setFlashdata("erro", "Tivemos um erro ao enviar o email de confirmação, tente novamente!");
                return redirect()->to(base_url("/cadastro"));
            }
        } else {
            $this->session->setFlashdata("erro", "Email indisponível!");
            return redirect()->back();
        }
    }

    public function confirm($token)
    {
        $confirmToken = filter_var($token, FILTER_SANITIZE_STRIPPED);

        $user = $this->session->get("user");
        $confirm = $this->tokenConfirma->confirmToken($confirmToken, $user->id);
        if ($confirm) {
            $data = ["active" => "1"];
            $this->userModel->update($user->id, $data);

            $this->session->setFlashdata("sucesso", "Tudo pronto, agora você pode logar-se!");
            return redirect()->to(base_url("/login"));
        } else {
            $this->session->setFlashdata("erro", "Link inválido!");
            return redirect()->to(base_url("/login"));
        }
    }

    public function forget()
    {
        $email = filter_var($this->request->getPost("email"), FILTER_SANITIZE_EMAIL);

        $user = $this->userModel->findByEmail($email);
        if ($user) {
            $this->session->setFlashdata("email", $email);
            $token = strtoupper(bin2hex(random_bytes(3)));
            $this->tokenRedefinicao->insert(["token" => $token, "id_usuario" => $user->id]);

            $sendEmail = new Email();
            $htmlMessage = view("codReset", ["nome" => $user->first_name, "codigo" => $token]);

            if ($sendEmail->send($this->defaultEmail, $this->defaultName, $user->email, "Confirmação de email", $htmlMessage)) {
                $this->session->set("user", $user);
                $this->session->setFlashdata("info", "Enviamos o código de confirmação para o seu email!");
                return redirect()->to(base_url("/confirm-code"));
            } else {

                $this->session->setFlashdata("erro", "Tivemos um erro ao enviar o email de redefinição, tente novamente!");
                return redirect()->to(base_url("/esqueci"));
            }
        } else {
            $this->session->setFlashdata("erro", "Email inválido!");
            return redirect()->back();
        }
    }

    public function reset()
    {
        $token = filter_var($this->request->getPost("token"), FILTER_SANITIZE_STRING);
        $user = $this->session->get("user");
        $data = [
            "token" => $token,
            "id_usuario" => $user->id
        ];
        $verify = $this->tokenRedefinicao->where($data)->find();

        if ($verify) {
            $this->session->setFlashdata("info", "Insira sua nova senha!");
            return redirect()->to(base_url("/reset"));
        } else {
            $this->session->setFlashdata("erro", "Código inválido!");
            return redirect()->back();
        }
    }

    public function resetPasswd()
    {
        $senha = filter_var($this->request->getPost("passwd"), FILTER_SANITIZE_STRIPPED);
        $idUser = filter_var($this->request->getPost("idUser"), FILTER_SANITIZE_STRIPPED);

        $this->userModel->update($idUser, ["passwd" => password_hash($senha, PASSWORD_DEFAULT)]);

        $this->session->setFlashdata("sucesso", "Senha alterada com sucesso!");
        return redirect()->to(base_url("/login"));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
