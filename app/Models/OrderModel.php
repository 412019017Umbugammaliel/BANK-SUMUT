<?php
    namespace App\Models;
    
    use CodeIgniter\Model;    

    class OrderModel extends Model 
    {
        protected $table = 'orders';
        protected $primaryKey = 'order_code';
        protected $timeStamp = true;

        protected $allowedFields = ['order_code','id_user','customer','product','date','time','payment','total'];
    }
?>