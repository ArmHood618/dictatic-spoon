<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $table = 'motor';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_merek',
                        'tipe'];

    public function merek(){
        return $this->belongsTo('App\Merek','id_merek');
    }

    public function transaksi(){
        return $this->hasOne('App\Transaksi','id_motor');
    }

    public function motor_sparepart(){
        return $this->hasMany('App\MotorSparepart','id_motor');
    }
}
