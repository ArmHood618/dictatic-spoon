<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nama',
                        'alamat',
                        'no_telp'];

    public function sales(){
        return $this->hasMany('App\Sales','id_supplier');
    }

    public function pengadaan(){
        return $this->hasMany('App\Pengadaan','id_supplier');
    }
}
