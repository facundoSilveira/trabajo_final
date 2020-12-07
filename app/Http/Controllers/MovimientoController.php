<?php

namespace App\Http\Controllers;

use App\Movimiento;
use Illuminate\Http\Request;
use App\CabeceraMovimiento;
use App\Proveedor;
use App\TipoComprobante;
use App\TipoMovimiento;
use App\Recurso;
use Exception;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los movimientos guardados en la B.D y visualizarlos
        $movimientos = Movimiento::all();
        //compac genera un array con la info que queremos
        return view('movimientos.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedors = Proveedor::all();

        $tipo_comprobantes = TipoComprobante::all();
        $tipo_movimientos = TipoMovimiento::all();
        $recursos = Recurso::all();
      //  $tecnicos= Tecnico::all();
        return view('movimientos.create', compact('proveedors','tipo_comprobantes','tipo_movimientos', 'recursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validaciones
        $data = request()->validate([
            'fecha' => 'required',
            'proveedor_id' => 'required',
            'numeroComprobante' => 'required |regex:/^([0-9\s\-\+\(\)]*)$/| unique:cabecera_movimientos' ,
            'tipo_comprobante_id' => 'required',
            'recurso.*' => 'required',
            //'FechaMovimiento' => 'required',
            'tipo_movimiento_id' => 'required',
            'cantidad.*' => 'required |integer|min:1',
            'precio.*' => 'required',

        ]) ;
        //creo la cabecera de movimiento
        //
        $cabeceraMovimiento = new CabeceraMovimiento();

        $cabeceraMovimiento->fecha= $request->fecha;
        $cabeceraMovimiento->fechaComprobante = $request->fechaComprobante ;
        $cabeceraMovimiento->numeroComprobante = $request->numeroComprobante ;
        $cabeceraMovimiento->tipo_comprobante_id = $request->tipo_comprobante_id ;
        $cabeceraMovimiento->proveedor_id = $request->proveedor_id ;
        $cabeceraMovimiento->save();
       // return $request;
    try{
        for ( $i = 0; $i < sizeof( $request->cantidad ); $i++){
            $movimiento = new Movimiento();
            $movimiento->cantidad = $request->cantidad[$i] ;
            $movimiento->precio = $request->precio[$i] ;
            $movimiento->tipo_movimiento_id = $request->tipo_movimiento_id ;
            $movimiento->cabecera_movimiento_id = $cabeceraMovimiento->id;
            $movimiento->recurso_id = $request->recurso[$i];
           // $recurso = Recurso::find($request->recurso[$i]);
           // return $recurso;
           // $recurso->stock = $recurso->stock + $request->cantidad[$i];
           //return $request->recurso[$i];
            $movimiento->save();
           // return $movimiento;
            $recurso = Recurso::find($request->recurso[$i]) ;
            //return $recurso;
            $recurso->stock = $recurso->stock + $request->cantidad[$i];
            $recurso->precio =  $request->precio[$i] ;
          //  print 'recurso->stock';

            $recurso->update();

        }
        return redirect(route('movimientos.index'))->with('success','movimiento registrado con exito!');

    }catch(Exception $e){
        return redirect(route('movimientos.create'))->with('error','Cargue los datos correctamente!');
    }



       // return redirect(route('movimientos.index'))->with('success','movimiento guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Movimiento $movimiento)
    {
        // $movimiento = movimiento::find($id);
        return view('movimientos.show', compact('movimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimiento $movimiento)
    {
        return view('movimientos.edit', compact('movimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimiento $movimiento)
    {
         //funcion fill se encarga de actualizar los datos q recibimos
         $movimiento->fill($request->all());
         $movimiento->update();
         return redirect(route('movimientos.index'))->with('success','movimiento actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimiento $movimiento)
    {
        $movimiento->delete();
        return redirect(route('movimientos.index'))->with('success','movimiento eliminado con exito!');
    }
}
