<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class InformeServicio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "informe_servicios";
    //
    public function servicio(){
        return $this->belongsTo(Servicio::class);

    }

    public function tecnico(){
        return $this->belongsTo(Tecnico::class);

    }

    public function informeRecurso(){
        return $this->hasMany(InformeServicioRecurso::class);
    }
}
