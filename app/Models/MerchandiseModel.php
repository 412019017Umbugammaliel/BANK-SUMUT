<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchandiseModel extends Model
{
    protected $table = 'merchandise';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = ['id_barang', 'nama_barang', 'gambar_barang', 'harga_barang'];
}
?>