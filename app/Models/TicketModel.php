<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table            = 'ticket_chat';
    protected $primaryKey       = 'id_chat';
    protected $allowedFields    = [
        'id_chat',
        'subject',
        'assigned_id_cs',
        'destination_id_user', 
        'destination_user_name', 
        'destination_level',      
        'ticket',
        'priority',
        'ticketstatus',
        'datetime',
        'creator_id',
        'creator_name'        
    ];

    public function updateTicket($update_ticket, $id_chat)
    {
        $query = $this->db->table($this->table)->update($update_ticket, array('id_chat'=>$id_chat));
        return $query;
    }
    public function deleteTicket($id_chat)
    {
        $query = $this->db->table($this->table)->delete(array('id_chat'=>$id_chat));
        return $query;
    }
}


?>