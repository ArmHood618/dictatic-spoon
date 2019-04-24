<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $table = 'merek';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['merek'];

    public function motor(){
        return $this->hasMany('App\Motor','id_merek');
    }
}
