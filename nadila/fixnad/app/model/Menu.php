<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama','gambar','harga','stok','ket'
    ];

}
