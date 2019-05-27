<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'pengadaan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_supplier',
                           'tanggal',
                            'isConfirmed'];

    public function supplier(){
        return $this->belongsTo('App\Supplier','id_supplier');
    }

    public function sparepart(){
        return $this->belongsToMany('App\Sparepart','detil_pengadaan','id_pengadaan','id_sparepart')->withPivot('jumlah');
    }
}
