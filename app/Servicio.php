<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class Servicio extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //relaciones
    public function tipo_servicio()
    {
        return $this->belongsTo(TipoServicio::class);
    }

    public function prioridad(){
        return $this->belongsTo(Prioridad::class);
    }
    public function historiales(){
        return $this->hasMany(HistorialEstado::class);
    }
    public function accesorios(){
        return $this->belongsToMany(Accesorio::class);
    }
    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
    public function tecnico(){
        return $this->belongsTo(Tecnico::class);
    }
    public function informe(){
        return $this->hasOne(InformeServicio::class);
    }

    public function recursosUtilizados(){
        return $this->hasMany(RecursoUtilizado::class);
    }

    public function getEstado()
    {
        return $this->historiales->last()->estado->nombre;
    }

   
}
