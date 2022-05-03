<?php

namespace App\Http\Controllers;

use App\Tecnico;
use App\Direccion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aca voy a obtener todos los tecnicos guardados en la B.D y visualizarlos
        $tecnicos = Tecnico::all();
        //compac genera un array con la info que queremos
        return view('tecnicos.index', compact('tecnicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnicos.create');
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
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:tecnicos',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
            'email' => 'required|email|unique:tecnicos',
            'password' => 'required',
        ]) ;
        //creo un nuevo tecnico y loguardo en la B.D
        $direccion = new Direccion();
        $direccion->calle = $request->calle ;
        $direccion->altura = $request->altura ;

        $direccion->save();

        $tecnico = new tecnico();

        $tecnico->nombre = $request->nombre ;
        $tecnico->apellido = $request->apellido ;
        $tecnico->dni = $request->dni ;
        $tecnico->telefono = $request->telefono ;
        $tecnico->email = $request->email ;
        $tecnico->direccion_id = $direccion->id;

        $tecnico->save();


        $user = User::create([
            'name' => $tecnico->nombre,
            'email' => $tecnico->email,
            'password' => Hash::make($request->password) ,
        ]);
        $user->assignRoles('Tecnico');

        $tecnico->update(['user_id'=>$user->id]);
        return redirect(route('tecnicos.index'))->with('success','tecnico guardado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tecnico  $tecnico
     * @return \Illuminate\Http\Response
     */
    public function show(Tecnico $tecnico)
    {
       // $tecnico = tecnico::find($id);
       return view('tecnicos.show', compact('tecnico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tecnico  $tecnico
     * @return \Illuminate\Http\Response
     */
    public function edit(Tecnico $tecnico)
    {
        return view('tecnicos.edit', compact('tecnico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tecnico  $tecnico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tecnico $tecnico)
    {

        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'telefono' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
            'email' => 'required',
            'password' => 'required',
        ]) ;
        //creo un nuevo tecnico y loguardo en la B.D
        $direccion = $tecnico->direccion;
        $direccion->calle = $request->calle ;
        $direccion->altura = $request->altura ;

        $direccion->update();

        $tecnico->nombre = $request->nombre ;
        $tecnico->apellido = $request->apellido ;
        $tecnico->dni = $request->dni ;
        $tecnico->telefono = $request->telefono ;
        $tecnico->email = $request->email ;
        $tecnico->direccion_id = $direccion->id;

        $tecnico->update();
        //funcion fill se encarga de actualizar los datos q recibimos
        // $tecnico->fill($request->all());
        // $tecnico->update();
        return redirect(route('tecnicos.index'))->with('success','tecnico actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tecnico  $tecnico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tecnico $tecnico)
    {
        //
        $tecnico->delete();
        return redirect(route('tecnicos.index'))->with('success','tecnico eliminado con exito!');
    }
}
