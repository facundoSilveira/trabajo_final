<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class TipoComprobante extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "tipo_comprobantes";
    public function equipo()
    {
        return $this->hasMany(Equipo::class);
    }
    public function cabeceraMovimiento(){
        return $this->hasMany(CabeceraMovimiento::class);
    }
}
