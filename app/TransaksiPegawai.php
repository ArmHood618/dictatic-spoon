<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPegawai extends Model
{
    protected $table = 'transaksi_pegawai';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_transaksi',
                        'id_pegawai'];

    public function transaksi(){
        return $this->belongsToMany('App\transaksi','id_transaksi');
    }

    public function pegawai(){
        return $this->belongsToMany('App\Pegawai','id_pegawai');
    }
}
