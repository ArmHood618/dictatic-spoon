<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['daerah',
                        'alamat',
                        'kota',
                        'kode_pos'];
    
    public function pegawai(){
        return $this->hasMany('App\Pegawai','id_cabang');
    }

    public function transaksi(){
        return $this->hasMany('App\Transaksi');
    }
}
