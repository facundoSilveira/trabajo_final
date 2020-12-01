<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Movimiento extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "movimientos";
    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class);
    }
    public function cabeceraMovimiento()
    {
        return $this->belongsTo(CabeceraMovimiento::class);
    }
    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }
}
