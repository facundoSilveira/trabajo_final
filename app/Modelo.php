<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "modelos";
    //
    public function tipo_recurso(){
        return $this->belongsTo(TipoRecurso::class);
    }
    public function recurso(){
        return $this->hasOne(Recurso::class);
    }

}
