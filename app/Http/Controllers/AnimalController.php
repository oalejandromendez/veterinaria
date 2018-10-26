<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Responsable;
use DataTables;
use Carbon\Carbon;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Veterinaria.Animales.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            /**
             * Obtiene todos los procesos de autoevaluacion asignados al usuario y a los cuales ya les fue
             * asignada una encuesta.
             */
            $animales = Animal::with('responsable')->get();
            return Datatables::of($animales)
                ->editColumn('fecha_nacimiento', function ($animales) {
                    return $animales->fecha_nacimiento ? with(new Carbon($animales->fecha_nacimiento))->format('d/m/Y') : '';
                })
                ->addColumn('propietario', function($animales){
                    return $animales->responsable->nombre." ".$animales->responsable->apellido;
                })
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsable = Responsable::all()
        ->pluck('cedula', 'pk_id_responsables');
        return view('Veterinaria.Animales.create',compact('responsable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animal = new Animal();
        $animal->fill($request->only(['nombre', 'raza','color']));
        $animal->sexo = $request->get('sexo');
        $animal->fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->get('fecha_nacimiento'));
        $animal->seniales_particulares = $request->get('seniales_particulares');
        $animal->fk_id_propietario = $request->get('pk_id_responsables');
        $animal->save();
        return response([
            'msg' => 'Animal creado exitosamente.',
            'title' => '¡Proceso exitoso!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
        ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animales = Animal::where('fk_id_propietario', $id)->get()->pluck('nombre', 'pk_id_animales');
        return json_encode($animales);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animales = Animal::findOrFail($id);
        $responsable = Responsable::all()
        ->pluck('cedula', 'pk_id_responsables');
        return view('Veterinaria.Animales.edit',compact('animales','responsable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->fill($request->only(['nombre', 'raza','color']));
        $animal->sexo = $request->get('sexo');
        $animal->fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->get('fecha_nacimiento'));
        $animal->seniales_particulares = $request->get('seniales_particulares');
        $animal->fk_id_propietario = $request->get('pk_id_responsables');
        $animal->save();
        return response([
            'msg' => 'Datos modificados exitosamente.',
            'title' => '¡Proceso exitoso!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
        ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return response(['msg' => 'Los datos han sido eliminados exitosamente.',
            'title' => 'Datos Eliminados!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
        ->header('Content-Type', 'application/json');
    }
}
