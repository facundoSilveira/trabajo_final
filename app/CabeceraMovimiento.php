<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class CabeceraMovimiento extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "cabecera_movimientos";
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
    public function tipoComprobante()
    {
        return $this->belongsTo(TipoComprobante::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
