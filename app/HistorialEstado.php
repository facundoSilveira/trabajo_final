<?php

namespace App;
use Illuminate\Support\Carbon;

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
    public function getFechaHora(){
        $transformacion = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);
        return $transformacion->format('d/m/Y H:i:s');

    }
}
