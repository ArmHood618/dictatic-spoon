<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_cabang', 'id_role', 'nama',
         'alamat', 'no_telp', 'gaji',
         'username', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function cabang(){
        return $this->belongsTo('App\Cabang','id_cabang');
    }

    public function role(){
        return $this->belongsTo('App\Role','id_role');
    }

    public function transaksi_pegawai(){
        return $this->hasMany('App\TransaksiPegawai','id_pegawai');
    }
}
