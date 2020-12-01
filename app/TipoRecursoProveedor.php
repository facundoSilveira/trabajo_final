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
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }
}
