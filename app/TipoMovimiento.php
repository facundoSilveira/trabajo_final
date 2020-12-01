<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class TipoMovimiento extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "tipo_movimientos";
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
