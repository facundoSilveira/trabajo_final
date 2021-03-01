<?php

namespace App\Http\Controllers;

use App\Estado;
use App\HistorialEstado;
use App\Tecnico;
use Illuminate\Http\Request;
use App\Servicio;
use Dompdf\Renderer;

class EstadisticaController extends Controller
{
    //estadistica serciios tecnicos
    public function Index()
    {
        //codigo para tecinicos
        $tecnicosList = Tecnico::all();
        $tecnicos = [];


        foreach ($tecnicosList as $tecnico){
            $cantServicio = 0;
            $sercicosTecnico = Servicio::where(['tecnico_id'=>$tecnico->id])->get();
           // return $sercicosTecnico;
            foreach ($sercicosTecnico as $servicio){

                if (HistorialEstado::where(['servicio_id'=> $servicio->id, 'estado_id'=> 6])->exists()){
                    $cantServicio ++;

                }
            }
            $tecnicos[$tecnico->nombre.' '.$tecnico->apellido] = $cantServicio;

        }
        //fin de codigo para tecnicos

        //cantidad de servicios por cada estado
        $estadosList = Estado::all();
        $estados =[];
        $servicioList = Servicio::all();
        foreach ($estadosList as $estado){
            $cantEstado = 0;
            foreach ($servicioList as $servicio){
                if(HistorialEstado::where(['servicio_id'=> $servicio->id, 'estado_id'=> $estado->id])->exists()){
                    $cantEstado ++;
                }

            }
            $estados[$estado->nombre] = $cantEstado;
        }


        return view('estadisticas.index', compact('tecnicos', 'estados'));
    }
}
