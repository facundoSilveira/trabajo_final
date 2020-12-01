<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class MarcaRecurso extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "marca_recursos";
    //
    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }
}
