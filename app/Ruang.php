<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruang_penempatan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['ruang','kode'];

    public function sparepart(){
        return $this->hasMany('App\Sparepart','id_ruang');
    }
}
