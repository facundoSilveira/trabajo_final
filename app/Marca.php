<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;


class Marca extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "marcas";
    //relaciones
    public function equipo()
    {
        return $this->hasMany(Equipo::class);
    }
}
