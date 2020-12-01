<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class InformeServicioRecurso extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //public $table = "estados";
    //
    public function informe(){
        return $this->belongsTo(InformeServicio::class);

    }
    public function recurso(){
        return $this->belongsTo(Recurso::class);

    }
    
}
