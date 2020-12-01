<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class TipoRecurso extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "tipo_recursos";
    //relaciiones
    public function modelo()
    {
        return $this->hasMany(Modelo::class);
    }

}
