<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Pedido extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $guarded = [];
    public function detalles(){
        return $this->hasMany(Detalle::class);
    }
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
}
