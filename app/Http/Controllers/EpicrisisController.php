<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Epicrisis;
use App\User;
use App\Responsable;
use App\Estado;
use App\Animal;
use DataTables;
use Carbon\Carbon;

class EpicrisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Veterinaria.Epicrisis.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $epicrisis = Epicrisis::with('animal','responsable','estado','usuario')->get();
            return Datatables::of($epicrisis)
            ->addColumn('Responsable', function($epicrisis){
                return $epicrisis->responsable->nombre." ".$epicrisis->responsable->apellido;
            })
            ->addColumn('Medico', function($epicrisis){
                return $epicrisis->usuario->name." ".$epicrisis->usuario->lastname;
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
        $medicos = User::selectRaw('id, CONCAT(name," ",lastname) AS nombre')
        ->whereHas('roles', function ($query) {
            return $query->where('name', '=', 'VETERINARIO');
        })->pluck('nombre', 'id');
        $responsables = Responsable::pluck('cedula', 'pk_id_responsables');
        $estado = Estado::pluck('estado', 'pk_id_estado');
        return view('Veterinaria.Epicrisis.create',compact('medicos','responsables','estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $epicrisis = new Epicrisis();
        $epicrisis->fecha_de_admision = Carbon::createFromFormat('d/m/Y', $request->get('fecha_de_admision'));
        $epicrisis->fk_id_medico_veterinario = $request->get('id');
        $epicrisis->fk_id_animal = $request->get('pk_id_animales');
        $epicrisis->fk_id_responsable = $request->get('pk_id_responsables');
        $epicrisis->motivo_consulta = $request->get('motivo_consulta');
        $epicrisis->vacunas = $request->get('vacunas');
        $epicrisis->alergias = $request->get('alergias');
        $epicrisis->enfermedades_anteriores = $request->get('enfermedades_anteriores');
        $epicrisis->cirugias = $request->get('cirugias');
        $epicrisis->pulso = $request->get('pulso');
        $epicrisis->temperatura = $request->get('temperatura');
        $epicrisis->peso = $request->get('peso');
        $epicrisis->examenes_clinicos = $request->get('examenes_clinicos');
        $epicrisis->diagnostico = $request->get('diagnostico');
        $epicrisis->fk_id_estado = $request->get('pk_id_estado');
        $epicrisis->save();
        return response([
            'msg' => 'Epicrisis creada exitosamente.',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $epicrisis = Epicrisis::findOrFail($id);

        $medicos = User::selectRaw('id, CONCAT(name," ",lastname) AS nombre')
        ->whereHas('roles', function ($query) {
            return $query->where('name', '=', 'VETERINARIO');
        })->pluck('nombre', 'id');
        $responsables = Responsable::pluck('cedula', 'pk_id_responsables');
        $animal = new Animal();
        $idAnimal = $epicrisis->animal->responsable()->pluck('pk_id_responsables')[0];
        $animales = $animal->where('fk_id_propietario', $idAnimal)->get()->pluck('nombre', 'pk_id_animales');
        $estado = Estado::pluck('estado', 'pk_id_estado');
        return view('Veterinaria.Epicrisis.edit',compact('epicrisis','medicos','responsables','estado','animales'));
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
        $epicrisis = Epicrisis::findOrFail($id);
        $epicrisis->fecha_de_admision = Carbon::createFromFormat('d/m/Y', $request->get('fecha_de_admision'));
        $epicrisis->fk_id_medico_veterinario = $request->get('id');
        $epicrisis->fk_id_animal = $request->get('pk_id_animales');
        $epicrisis->fk_id_responsable = $request->get('pk_id_responsables');
        $epicrisis->motivo_consulta = $request->get('motivo_consulta');
        $epicrisis->vacunas = $request->get('vacunas');
        $epicrisis->alergias = $request->get('alergias');
        $epicrisis->enfermedades_anteriores = $request->get('enfermedades_anteriores');
        $epicrisis->cirugias = $request->get('cirugias');
        $epicrisis->pulso = $request->get('pulso');
        $epicrisis->temperatura = $request->get('temperatura');
        $epicrisis->peso = $request->get('peso');
        $epicrisis->examenes_clinicos = $request->get('examenes_clinicos');
        $epicrisis->diagnostico = $request->get('diagnostico');
        $epicrisis->fk_id_estado = $request->get('pk_id_estado');
        $epicrisis->update();
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
        $epicrisis = Epicrisis::findOrFail($id);
        $epicrisis->delete();
        return response(['msg' => 'Los datos han sido eliminados exitosamente.',
            'title' => 'Datos Eliminados!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
        ->header('Content-Type', 'application/json');
    }
}
