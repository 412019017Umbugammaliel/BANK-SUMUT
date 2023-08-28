<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityChatModel extends Model
{
    protected $table            = 'activity_chat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id',
        'id_chat',
        'message_id',
        'id_user', 
        'user_name',       
        'desc_chat',
        'date_chat',
        'time_chat',
        'destination_id_user',
        'destination_user_name',
        'assigned_id_cs',
        'status_read',
        'creator_id',
        'creator_name',
        'file_upload',
        'ext_file',
        'file_size'
    ];

    public function setReadChat($set_read, $messageID)
    {
        $query = $this->db->table($this->table)->update($set_read, array('message_id'=>$messageID));
        return $query;
    }
    public function setReadAllChat($set_read, $paramIDchat, $paramDestId)
    {
        $query = $this->db->table($this->table)->where('id_chat', $paramIDchat)->where('destination_id_user', $paramDestId)->update($set_read);
        return $query;
    }
    public function deleteMsg($message_ID)
    {
        $query = $this->db->table($this->table)->delete(array('message_id'=>$message_ID));
        return $query;
    }
}


?>