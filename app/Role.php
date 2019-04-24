<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','keterangan'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function pegawai(){
        return $this->hasMany('App\Pegawai','id_role');
    }
}
