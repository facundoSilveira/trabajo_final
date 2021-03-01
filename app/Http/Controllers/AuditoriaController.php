<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Servicio;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index()
    {

        $equipos = Equipo::withTrashed()->get();
        $servicios = Servicio::withTrashed()->get();
        $auditoriasEquipo = collect();
        $auditoriasServicio = collect();

        foreach ($equipos as $equipo) {
            if (!$equipo->audits->isEmpty()) {
                foreach($equipo->audits as $a){
                    $auditoriasEquipo->add($a);
                }
            }
        }
        foreach ($servicios as $servicio) {
            if (!$servicio->audits->isEmpty()) {
                foreach($servicio->audits as $a){
                    $auditoriasServicio->add($a);
                }
            }
        }


        return view('auditoria.index', compact('auditoriasEquipo', 'auditoriasServicio'));
    }


    public function showEquipos($idEquipo , $id){
        $tabla = 'EQUIPOS';
        $equipos = Equipo::withTrashed()->get() ;
        foreach($equipos as $equipo){
            if($equipo->id == $idEquipo){
                $auditoria = $equipo->audits()->find($id);
                // dd($auditoria->getModified());
                // dd(empty($auditoria->old_values)) ;
                return view('auditoria.show' , compact('auditoria' , 'tabla')) ;
            }
        }
    }
    public function showServicios($idServicio , $id){
        $tabla = 'SERVICIO';
        $servicios = Servicio::withTrashed()->get() ;
        foreach($servicios as $servicio){
            if($servicio->id == $idServicio){
                $auditoria = $servicio->audits()->find($id);
                // dd($auditoria->getModified());
                // dd(empty($auditoria->old_values)) ;
                return view('auditoria.show' , compact('auditoria' , 'tabla')) ;
            }
        }
    }
}
