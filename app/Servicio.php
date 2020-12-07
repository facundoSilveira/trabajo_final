<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate \ Database \ Eloquent \ SoftDeletes;
class Servicio extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //relaciones


    public function prioridad(){
        return $this->belongsTo(Prioridad::class);
    }
    public function historiales(){
        return $this->hasMany(HistorialEstado::class);
    }
    public function accesorios(){
        return $this->belongsToMany(Accesorio::class);
    }
    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }
    public function tecnico(){
        return $this->belongsTo(Tecnico::class);
    }
    public function informe(){
        return $this->hasOne(InformeServicio::class);
    }

    public function recursosUtilizados(){
        return $this->hasMany(RecursoUtilizado::class);
    }
    public function tipos(){
        return $this->hasMany(ServicioTipoServicio::class);
    }

    public function getPrecio()
    {
        $precio = 0 ;
        foreach ($this->tipos as $tipo) {
            $precio = $tipo->tipo->precio ;
        }
        return $precio ;
    }

    public function getEstado()
    {
        return $this->historiales->last()->estado->nombre;
    }

    public function duracionEstimada($tipoServicios)
    {
        $servicios = Servicio::all();
        $suma = 0;
        $div = 0;
        for ($i=0; $i < sizeof ($servicios) ; $i++) {
            foreach ($servicios[$i]->tipos as $tipo) {
                if ($tipo->tipo->id == $tipoServicios[$i]->id) {
                    $inicio = Carbon::Create(HistorialEstado::where(['estado_id'=>5,'servicio_id'=>$servicios[$i]->id])->first()->date);
                    $fin =Carbon::Create(HistorialEstado::where(['estado_id'=>6,'servicio_id'=>$servicios[$i]->id])->first()->date);

                    $suma += date_diff($inicio, $fin);
                    // $suma += ($inicio->diff($fin));
                    $div += 1;
                    return $suma;
                }
            }
            if ($div != 0) {
                $resul = $suma / $div;
                
                return ($resul);
            } else {
                return 0;
            } ;
            }

    }


}
