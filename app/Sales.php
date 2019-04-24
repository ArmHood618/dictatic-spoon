<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_supplier',
                        'nama',
                        'no_telp'];

    public function supplier(){
        return $this->belongsTo('App\Supplier','id_supplier');
    }
}
