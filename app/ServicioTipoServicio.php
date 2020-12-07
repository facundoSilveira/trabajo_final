<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class ServicioTipoServicio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //relaciones
    public function servicio(){
    return $this->belongsTo(Servicio::class);

    }
    public function tipo(){
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');

    }
}
