<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table            = 'log_activity';
    protected $primaryKey       = 'id_log';
    protected $allowedFields    = [
        'id_log',        
        'id_user',
        'user_name',
        'category',
        'date_time',
        'desc_log_activity',
        'status_read'
    ];

    public function updateLog($update_log, $id_Log)
    {
        $query = $this->db->table($this->table)->update($update_log, array('id_log'=>$id_Log));
        return $query;
    }
    public function deleteLog($id_log)
    {
        $query = $this->db->table($this->table)->delete(array('id_log'=>$id_log));
        return $query;
    }
}
?>