<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Equipo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $guarded = [];
    public $table = "equipos";

    //relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class,'marca_id');
    }
    public function tipo_equipo(){
        return $this->belongsTo(TipoEquipo::class);
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

}
