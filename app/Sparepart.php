<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Sparepart extends Model
{
    use Sortable;
    protected $table = 'sparepart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_letak',
                        'id_ruang',
                        'nama',
                        'tipe',
                        'stok',
                        'stok_min',
                        'harga_beli',
                        'harga_jual'];
    public $sortable = ['id_letak',
    'id_ruang',
    'nama',
    'tipe',
    'stok',
    'stok_min',
    'harga_beli',
    'harga_jual'];

    public function letak(){
        return $this->belongsTo('App\Letak','id_letak');
    }

    public function ruang(){
        return $this->belongsTo('App\Ruang','id_ruang');
    }

    public function detil_pengadaan(){
        return $this->hasMany('App\DetilPengadaan','id_sparepart');
    }

    public function motor(){
        return $this->belongsToMany('App\Motor','motor_sparepart','id_sparepart','id_motor')->withPivot('id');
    }

    public function sisa_stok(){
        return $this->hasMany('App\SisaStok','id_sparepart');
    }

    public function transaksi(){
        return $this->belongsToMany('App\Transaksi','detil_sparepart','id_sparepart','id_transaksi')->withPivot('jumlah');
    }
}
