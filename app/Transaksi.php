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

    public function sparepart(){
        return $this->belongsToMany('App\Sparepart','detil_sparepart','id_transaksi','id_sparepart')->withPivot('jumlah');
    }

    public function jasa(){
        return $this->belongsToMany('App\Jasa','detil_jasa','id_transaksi','id_jasa')->withPivot('jumlah');
    }

    public function pegawai(){
        return $this->belongsToMany('App\Pegawai','transaksi_pegawai','id_transaksi','id_pegawai');
    }
}
