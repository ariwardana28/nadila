<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'id_user','alamat','total','status','tanggal','status','file'
    ];
    public function User(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}
