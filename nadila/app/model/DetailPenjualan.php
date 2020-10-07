<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'id_penjualan','id_menu','qty','sub_total'
    ];
    public function Menu(){
    	return $this->belongsTo('App\model\Menu','id_menu','id');
    }
    public function User(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}
