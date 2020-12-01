<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "direccions";

    //relaciones
    public function clientes(){
        return $this->hasOne(Cliente::class);
    }
    public function tecnicos(){
        return $this->hasOne(Tecnico::class);
    }
    public function proveedores(){
        return $this->hasOne(Proveedor::class);
    }


}
