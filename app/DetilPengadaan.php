<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilPengadaan extends Model
{
    protected $table = 'detil_pengadaan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_pengadaan',
                            'id_sparepart',
                            'jumlah'];
    
    public function pengadaan(){
        return $this->belongsTo('App\Pengadaan','id_pengadaan');
    }

    public function sparepart(){
        return $this->belongsTo('App\Sparepart','id_sparepart');
    }
}
