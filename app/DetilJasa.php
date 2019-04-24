<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilJasa extends Model
{
    protected $table = 'detil_jasa';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_transaksi',
                            'id_jasa',
                            'jumlah'];
    
    public function transaksi(){
        return $this->belongsTo('App\Transaksi');
    }

    public function jasa(){
        return $this->belongsTo('App\Jasa');
    }
}
