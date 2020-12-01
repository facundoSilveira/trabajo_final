<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Accesorio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "accesorios";
    //
    public function servicios(){
        return $this->belongsToMany(Servicio::class);

    }
}
