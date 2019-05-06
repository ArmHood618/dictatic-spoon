<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $table = 'jasa';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['jenis',
                        'harga'];
    
    public function transaksi(){
        return $this->belongsToMany('App\Transaksi','detil_jasa','id_jasa','id_transaksi')->withPivot('jumlah');
    }
}
