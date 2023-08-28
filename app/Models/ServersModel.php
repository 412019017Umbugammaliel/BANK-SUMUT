<?php
    namespace App\Models;
    
    use CodeIgniter\Model;    

    class ServersModel extends Model 
    {
        protected $table = 'servers';
        protected $primaryKey = 'id_user';
        // protected $timeStamp = true;

        protected $allowedFields = [
            'id_user', //var 20 
            'server_id', //int 10 
            'host_server', //var 255 
            'primary_ip', // var 20 
            'gateway', //var 20 
            'data_center', //int 3 
            'windows_license', //int 3 
            'cpu', //int 2 
            'memory', //int 5 
            'satuan_memory', //var 5
            'storage', //int 10 
            'vms', //int 3 
            'server_country', //var 100 
            'server_location', //var 255 
            'power_status' //var 4
        ];


        public function updateDataServer($update_item,$id_user)
        {
            $query = $this->db->table($this->table)->update($update_item, array('id_user'=>$id_user));
            return $query;
        }
        // public function deleteDataServer($id_user)
        // {
        //     $query = $this->db->table($this->table)->delete(array('id_user'=>$id_user));
        //     return $query;
        // }
    }
?>