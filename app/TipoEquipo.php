<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class TipoEquipo extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "tipo_equipos";
    public function equipo()
    {
        return $this->hasMany(Equipo::class);
    }
}
