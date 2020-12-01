<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Medida extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //relaciones
    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }
}
