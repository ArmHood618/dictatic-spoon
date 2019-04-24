<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_cabang',
                        'id_motor',
                        'jenis_transaksi',
                        'tanggal',
                        'nama',
                        'no_telp',
                        'no_plat',
                        'tanggal_lunas',
                        'isLunas',
                        'isSelesai'];

    public function cabang(){
        return $this->belongsTo('App\Cabang','id_cabang');
    }

    public function motor(){
        return $this->belongsTo('App\Motor','id_motor');
    }

    public function detil_sparepart(){
        return $this->hasMany('App\DetilSparepart','id_transaksi');
    }

    public function detil_jasa(){
        return $this->hasMany('App\DetilJasa','id_transaksi');
    }
}
