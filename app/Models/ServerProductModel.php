<?php
    namespace App\Models;
    
    use CodeIgniter\Model;    

    class ServerProductModel extends Model 
    {
        protected $table = 'server_product';
        protected $primaryKey = 'id_product';
        protected $timeStamp = true;

        protected $allowedFields = ['id_product','product_name','product_price','product_variant','product_unit'];

       
    }
?>