<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'pengadaan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_supplier',
                           'tanggal'];

    public function supplier(){
        return $this->belongsTo('App\Supplier','id_supplier');
    }

    public function detil_pengadaan(){
        return $this->hasMany('App\DetilPengadaan','id_pengadaan');
    }
}
