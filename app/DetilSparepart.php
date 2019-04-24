<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilSparepart extends Model
{
    protected $table = 'detil_sparepart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_transaksi',
                            'id_sparepart',
                            'jumlah'];
    
    public function transaksi(){
        return $this->belongsTo('App\Transaksi','id_transaksi');
    }

    public function sparepart(){
        return $this->belongsTo('App\Sparepart','id_sparepart');
    }
}
