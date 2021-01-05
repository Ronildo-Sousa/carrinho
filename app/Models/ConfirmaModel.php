<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfirmaModel extends Model
{

    protected $table = "token_confirmacao";
    protected $primaryKey = "id";

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['token', 'id_usuario', 'created_at'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    public function confirmToken($token,$userId){
        $sql = "SELECT id FROM token_confirmacao WHERE token = :token: AND id_usuario = :userId:";

        $res = $this->db->query($sql,["token"=>$token, "userId"=>$userId]);
        if ($res->getResult()) {
            return $res->getResult()[0];
        }
        return null;
    }
}
