<?php

namespace App\Http\Controllers;

use App\Detalle;
use App\Pedido;
use App\Proveedor;
use App\Recurso;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //Aca voy a obtener todos los movimientos guardados en la B.D y visualizarlos
        $pedidos = Pedido::all();
        //compac genera un array con la info que queremos
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $proveedors = Proveedor::all();

        $recursos = Recurso::all();
      //  $tecnicos= Tecnico::all();
        return view('pedidos.create', compact('proveedors', 'recursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $data = request()->validate([
            'fecha' => 'required',
            'recurso.*' => 'required',
            'cantidad.*' => 'required |integer|min:1',


        ]) ;
        //creo la cabecera de movimiento
        //

       // return $request;
    // try{
        $pedido= new Pedido();
        $pedido->fecha = $request->fecha ;
        $pedido->proveedor_id = $request->proveedor_id ;
        $pedido->confirmado= true;
        $pedido->save();
        for ( $i = 0; $i < sizeof( $request->recurso ); $i++){
            $detalle = New Detalle();
            $detalle->cantidad = $request->cantidad[$i];
            $detalle->recurso_id = $request->recurso[$i];
            $detalle->pedido_id =  $pedido->id;

            $detalle->save();
           // return $movimiento;
          ;
          //  print 'recurso->stock';


        }
      //  return $pedido->proveedor_id;

        if ($pedido->proveedor_id =! null  ){
            $pedido->proveedor->enviarMail($pedido);
        }

       // return "ok";
        return redirect(route('pedidos.index'))->with('success','pedido registrado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        $recursos = Recurso::all();
        $proveedors = Proveedor::all();
        return view('pedidos.edit', compact('pedido', 'recursos', 'proveedors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
        // $pedido->fill($request->all());
        // $pedido->update();
        foreach ($pedido->detalles as $d) {
            $d->delete();
        }
        for ($i = 0; $i < sizeof($request->recurso); $i++) {
            $detalle = new Detalle();
            $detalle->pedido_id = $pedido->id;
            $detalle->recurso_id = $request->recurso[$i];
            $detalle->cantidad = $request->cantidad[$i];
            $detalle->save();
        }


        $pedido->proveedor_id = $request->proveedor_id;
        $pedido->confirmado = true;
        //$pedido->user_id = auth()->user()->id;
        $pedido->update();
        $pedido->proveedor->enviarMail($pedido);
        return redirect(route('pedidos.index'))->with('success','pedido actualizado con exito!');
      //  return redirect()->route('pedidos.index')->with('confirmar', 'ok');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
