<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class Proveedor extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "proveedors";
    //relacion
    public function direccion(){
        return $this->belongsTo(Direccion::class);
    }
    public function tipoRecursoProveedores(){
        return $this->hasMany(TipoRecursoProveedor::class);
    }
    public function cabeceraMovimiento(){
        return $this->hasMany(CabeceraMovimiento::class);
    }
}
