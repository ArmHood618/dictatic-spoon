<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SisaStok extends Model
{
    protected $table = 'sisa_stok';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_sparepart',
                        'bulan',
                        'tahun',
                        'sisa_stok'];

    public function sparepart(){
        return $this->belongsTo('App\Sparepart','id_sparepart');
    }
}
