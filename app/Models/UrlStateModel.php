<?php

namespace App\Models;

use CodeIgniter\Model;

class UrlStateModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'url_state';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        'id',
        'user_id',
        'url',
        'status_code',
        'response',
        'created_at',
        'updated_at',
    ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function list($user_id = null) {
        $builder = $this->db->table('url_state');
        $builder->select('
            url_state.id,
            url_state.url,
            url_state.status_code,
            url_state.updated_at,
            url_state.created_at,
            url_state.user_id,
            users.name as username
           '
        );

        $builder->join('users', 'users.id = url_state.user_id', 'LEFT');
        if (!empty($user_id)) {
            $builder->where('url_state.user_id', (int) $user_id);
        }
        $builder->where('url_state.deleted_at', null);
        return $builder->get()->getResultObject();
    }

}
