<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Detalle extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    //relaciones
    public function recurso(){
    return $this->belongsTo(Recurso::class);

    }
    public function pedido(){
        return $this->belongsTo(Pedido::class);

    }
}
