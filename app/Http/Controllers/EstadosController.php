<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Epicrisis;
use App\User;
use App\Responsable;
use App\Estado;
use App\Estado_Epicrisis;
use App\Animal;
use DataTables;
use Carbon\Carbon;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado = Estado::all()->pluck('estado', 'pk_id_estado');
        return view('Veterinaria.Estado.index',compact('estado'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $estado = Estado::pluck('estado', 'pk_id_estado');
        return view('Veterinaria.Estado.edit',compact('epicrisis','estado'));
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
        if($epicrisis->fk_id_estado != $request->get('pk_id_estado'))
        {
            $estado_epicrisis = new Estado_Epicrisis();
            $estado_epicrisis->fecha = Carbon::now();
            $estado_epicrisis->fk_id_epicrisis = $epicrisis->pk_id_epicrisis;
            $estado_epicrisis->fk_id_estado = $request->get('pk_id_estado');
            $estado_epicrisis->save();
        }
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
        //
    }
}
