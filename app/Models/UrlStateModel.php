<?php

namespace App\Models;

use CodeIgniter\Model;

class UrlStateModel extends Model {

    protected $DBGroup = 'default';
    protected $table = 'url_states';
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

}
