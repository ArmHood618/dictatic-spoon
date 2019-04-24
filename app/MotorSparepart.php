<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorSparepart extends Model
{
    protected $table = 'motor_sparepart';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_motor',
                        'id_sparepart'];

    public function motor(){
        return $this->belongsTo('App\Motor','id_motor');
    }

    public function sparepart(){
        return $this->belongsTo('App\Sparepart','id_sparepart');
    }
}
