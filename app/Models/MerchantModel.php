<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchantModel extends Model
{
    protected $table = 'merchant';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = ['id_barang', 'nama_barang', 'gambar_barang', 'harga_barang'];
}
?>