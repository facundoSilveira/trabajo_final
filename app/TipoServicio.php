<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class TipoServicio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function servicios(){
        return $this->hasMany(ServicioTipoServicio::class);
    }


}

