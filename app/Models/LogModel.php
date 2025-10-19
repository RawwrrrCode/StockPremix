<?php

namespace App\Models;
use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id_log';
    protected $allowedFields = [
        'id_user', 'aktivitas', 'deskripsi', 'ip_address', 'user_agent', 'created_at'
    ];

    public function getAllLogs()
    {
        return $this->select('activity_log.*, users.full_name')
                    ->join('users', 'users.id_user = activity_log.id_user', 'left')
                    ->orderBy('activity_log.created_at', 'DESC')
                    ->findAll();
    }
}
