<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'id',
        'name',
        'pass',
        'email',
        'hash',
    ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    //callbacks
    protected $beforeInsert = ['passwordEncrypt'];
    protected $beforeUpdate = ['updatePasswordEncrypt'];

    public function login($email, $pass) {
        $rs = $this->where('email', $email)->first();

        if (!empty($rs)) {
            if (password_verify($pass, $rs->pass)) {
                return $rs;
            }
        }
        return null;
    }

    protected function passwordEncrypt($data) {
        $data['data']['pass'] = password_hash($data['data']['pass'], PASSWORD_DEFAULT);
        return $data;
    }

    protected function updatePasswordEncrypt($data) {
        if (is_array($data) && array_key_exists('data', $data) && array_key_exists('pass', $data['data'])) {
            $pass = $data['data']['pass'];
            $data['data']['pass'] = password_hash($pass, PASSWORD_DEFAULT);
        }
        return $data;
    }

}
