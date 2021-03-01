<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Pedido extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public function detalles(){
        return $this->hasMany(Detalle::class);
    }
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
