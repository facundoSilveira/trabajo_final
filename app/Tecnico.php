<?php

namespace App;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "tecnicos";

    //relacion
    public function direccion(){
        return $this->belongsTo(Direccion::class);
    }
    public function servicio(){
        return $this->hasOne(Servicio::class);
    }

    public function informes(){
        return $this->hasMany(InformeServicio::class);
    }
}
