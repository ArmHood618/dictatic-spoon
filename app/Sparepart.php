<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'sparepart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_letak',
                        'id_ruang',
                        'nama',
                        'tipe',
                        'stok',
                        'stok_min',
                        'harga_beli',
                        'harga_jual'];

    public function letak(){
        return $this->belongsTo('App\Letak','id_letak');
    }

    public function ruang(){
        return $this->belongsTo('App\Ruang','id_ruang');
    }

    public function detil_pengadaan(){
        return $this->hasMany('App\DetilPengadaan','id_sparepart');
    }

    public function motor_sparepart(){
        return $this->hasMany('App\MotorSparepart','id_sparepart');
    }

    public function sisa_stok(){
        return $this->hasMany('App\SisaStok','id_sparepart');
    }

    public function detil_sparepart(){
        return $this->hasMany('App\DetiSparepart','id_sparepart');
    }
}
