<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class TipoRecursoProveedor extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "tipo_recurso_proveedors";
    //relaciiones
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function tipo_recurso()
    {
        return $this->belongsTo(TipoRecurso::class);
    }
}
