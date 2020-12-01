<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index()
    {

        $equipos = Equipo::withTrashed()->get();
        $auditoriasEquipo = collect();

        foreach ($equipos as $equipo) {
            if (!$equipo->audits->isEmpty()) {
                foreach($equipo->audits as $a){
                    $auditoriasEquipo->add($a);
                }
            }
        }


        return view('auditoria.index', compact('auditoriasEquipo'));
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
}
