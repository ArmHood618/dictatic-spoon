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
    
    public function detil_jasa(){
        return $this->hasMany('App\DetilJasa','id_jasa');
    }
}
