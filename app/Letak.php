<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letak extends Model
{
    protected $table = 'letak';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['letak','kode'];

    public function sparepart(){
        return $this->hasMany('App\Sparepart','id_letak');
    }
}
