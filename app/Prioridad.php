<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Prioridad extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function recursos(){
        return $this->hasMany(Recurso::class);
    }
}
