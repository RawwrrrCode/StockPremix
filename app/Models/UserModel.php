<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'username', 'password', 'full_name', 'role', 'email', 'status', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = false;

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
