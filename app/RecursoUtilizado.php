<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class RecursoUtilizado extends Model
{
    use SoftDeletes;
    protected $guarded = [];
   // public $table = "estados";
    //
    public function servicio(){
        return $this->belongsTo(Servicio::class);

    }
    public function recurso(){
        return $this->belongsTo(Recurso::class);

    }
}
