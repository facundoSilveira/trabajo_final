<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use SebastianBergmann\Diff\Diff;
use OwenIt\Auditing\Contracts\Auditable;

class Servicio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $guarded = [];

    //relaciones


    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class);
    }
    public function historiales()
    {
        return $this->hasMany(HistorialEstado::class);
    }
    public function accesorios()
    {
        return $this->belongsToMany(Accesorio::class);
    }
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
    public function informe()
    {
        return $this->hasOne(InformeServicio::class);
    }

    public function recursosUtilizados()
    {
        return $this->hasMany(RecursoUtilizado::class);
    }
    public function tipos()
    {
        return $this->hasMany(ServicioTipoServicio::class);
    }

    public function getPrecio()
    {
        $precio = 0;
        foreach ($this->tipos as $tipo) {
            $precio = $tipo->tipo->precio;
        }
        return $precio;
    }

    public function getEstado()
    {
        return $this->historiales->last()->estado->nombre;
    }

    public function duracionEstimada($tipoServicios)
    {
        //CODIGO NUEVO
        $suma=0;
        $div=0;
        $id_tipos = [];
        foreach ($tipoServicios as $tipo) {
            array_push($id_tipos, $tipo->tipo->id);
        }
        $stringConsulta = "";
        $j = 1;


        foreach ($id_tipos as $i){
            $i = intval($i);
            if (count($id_tipos) != $j){
                $stringConsulta = $stringConsulta."tipo_servicio_id = ".strval($i)." or ";
                $j += 1;
            }else{
                $stringConsulta = $stringConsulta."tipo_servicio_id = ".strval($i);
                $j += 1;
            }
        }


        $servicios = DB::table('servicio_tipo_servicios')->whereRaw(strval($stringConsulta))->get();

        foreach ($servicios as $servicio){
            //return  Carbon::Create(HistorialEstado::where(['estado_id' => 6, 'servicio_id' => $servicio->servicio_id])->first()->date);
            try{
                $inicio = Carbon::Create(HistorialEstado::where(['estado_id' => 5, 'servicio_id' => $servicio->servicio_id])->first()->date);
                $fin = Carbon::Create(HistorialEstado::where(['estado_id' => 6, 'servicio_id' => $servicio->servicio_id])->first()->date);
                $dif = date_diff($inicio, $fin);
                $suma += (int)$dif->format("%a");
                $div+= 1;
            }catch(Exception $e){

            }

        }
        if ($div != 0) {
            $resul = $suma / $div;

            return ($resul);
        } else {
            // return "hola";
            return 0;
        };



       // $servicios = ServicioTipoServicio::where(['tipo_servicio_id'=>$id_tipos])->get();

        return $servicios;





        //return  $tipoServicios;
        $id_tipos = [];
        foreach ($tipoServicios as $tipo) {
            array_push($id_tipos, $tipo->tipo->id);
        }
        // return $id_tipos;
        $servicios = Servicio::all();//
        $suma = 0;
        $div = 0;
        for ($i = 0; $i < sizeof($servicios); $i++) {
            foreach ($servicios[$i]->tipos as $tipo) {
                // return $tipoServicios[$i] ;
                if (in_array($tipo->id, $id_tipos)) {
                    // return "chau";
                    $inicio = Carbon::Create(HistorialEstado::where(['estado_id' => 5, 'servicio_id' => $servicios[$i]->id])->first()->date);
                    $fin = Carbon::Create(HistorialEstado::where(['estado_id' => 6, 'servicio_id' => $servicios[$i]->id])->first()->date);
                    $dif = date_diff($inicio, $fin);
                    $suma += (int)$dif->format("%a");


                    //   $suma += ($inicio->diff($fin));

                    $div += 1;
                    // return $suma;
                }
            }
        }
        return $div;
        if ($div != 0) {
            $resul = $suma / $div;

            return ($resul);
        } else {
            // return "hola";
            return 0;
        };
    }
}
