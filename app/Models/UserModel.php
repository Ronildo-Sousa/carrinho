<?php

namespace App\Models;

use App\Controllers\Email;
use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = "users";
    protected $primaryKey = "id";

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['first_name', 'last_name', 'email', 'passwd', 'active'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    public function findByEmail($email)
    {
        $sql = "SELECT id, first_name,last_name,email,passwd,active FROM users WHERE email = :email:";
        $res = $this->db->query($sql, ["email" => $email]);
        if ($res->getResult()) {
            return $res->getResult()[0];
        }
        return null;
    }

    public function auhLogin($email, $password)
    {
        $passDB = ($this->findByEmail($email));
        if ($passDB && (password_verify($password, $passDB->passwd)) && ($passDB->active == "1")) {
            return true;
        }
        return false;
    }

    public function register($nome,$sobrenome,$email,$senha){
        $hasUser = $this->findByEmail($email);

        if (!$hasUser) {
            $data = [
                "first_name" => $nome,
                "last_name" => $sobrenome,
                "email" => $email,
                "passwd" => password_hash($senha,PASSWORD_DEFAULT)
            ];
            $this->insert($data);
            return true;
        }
        return false;
    }
}
