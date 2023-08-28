<?php
    namespace App\Models;
    
    use CodeIgniter\Model;    

    class UserServersModel extends Model 
    {
        protected $table = 'user_servers';
        protected $primaryKey = 'id_user';
        // protected $timeStamp = true;

        protected $allowedFields = [
            'id_user',
            'user_name',
            'first_name',
            'last_name',
            'user_email',
            'user_phone',
            'password',
            'level',
            'status',
            'type_two_auth',
            'two_factor_auth',
            'foto',
            'status_active_user'
        ];


        public function updateDataUser($updateProfile,$id_user)
        {
            $query = $this->db->table($this->table)->update($updateProfile, array('id_user'=>$id_user));
            return $query;
        }
        public function deleteDataUser($id_user)
        {
            $query = $this->db->table($this->table)->delete(array('id_user'=>$id_user));
            return $query;
        }
    }
?>