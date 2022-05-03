<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Servicio;
use App\Configuracion;
use App\Movimiento;
use App\Pedido;
use App\User;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function index()
    {
        $users = User::all();
        $equipos = Equipo::withTrashed()->get();
        $servicios = Servicio::withTrashed()->get();
        $movimientos = Movimiento::withTrashed()->get();
        $pedidos = Pedido::withTrashed()->get();
        $auditoriasEquipo = collect();
        $auditoriasServicio = collect();
        $auditoriasMovimiento = collect();
        $auditoriasPedido = collect();



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
        foreach ($movimientos as $movimiento) {
            if (!$movimiento->audits->isEmpty()) {
                foreach($movimiento->audits as $a){
                    $auditoriasMovimiento->add($a);
                }
            }
        }
        foreach ($pedidos as $pedido) {
            if (!$pedido->audits->isEmpty()) {
                foreach($pedido->audits as $a){
                    $auditoriasPedido->add($a);
                }
            }
        }

        return view('auditoria.index', compact('auditoriasEquipo', 'auditoriasServicio', 'auditoriasMovimiento', 'auditoriasPedido', 'users'));
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

    public function showMovimientos($idMovimiento , $id){
        $tabla = 'MOVIMIENTOS';
        $movimientos = Movimiento::withTrashed()->get() ;
        foreach($movimientos as $movimiento){
            if($movimiento->id == $idMovimiento){
                $auditoria = $movimiento->audits()->find($id);
                // dd($auditoria->getModified());
                // dd(empty($auditoria->old_values)) ;
                return view('auditoria.show' , compact('auditoria' , 'tabla')) ;
            }
        }
    }

    public function showPedidos($idPedido , $id){
        $tabla = 'PEDIDOS';
        $pedidos = Pedido::withTrashed()->get() ;
        foreach($pedidos as $pedido){
            if($pedido->id == $idPedido){
                $auditoria = $pedido->audits()->find($id);
                // dd($auditoria->getModified());
                // dd(empty($auditoria->old_values)) ;
                return view('auditoria.show' , compact('auditoria' , 'tabla')) ;
            }
        }
    }
}
