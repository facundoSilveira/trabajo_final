<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class HistorialEstado extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //relaciones
    public function servicio(){
        return $this->belongsTo(Servicio::class);

    }
    public function estado(){
        return $this->belongsTo(Estado::class);

    }
}
