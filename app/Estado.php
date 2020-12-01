<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = "estados";
    //
    public function historiales(){
        return $this->hasMany(HistorialEstado::class);

    }
}
