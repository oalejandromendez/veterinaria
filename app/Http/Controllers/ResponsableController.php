<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use DataTables;
use App\Http\Requests\ResponsableRequest;

class ResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Veterinaria.Responsables.index');
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
            $responsables = Responsable::all();
            return Datatables::of($responsables)
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
        return view('Veterinaria.Responsables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResponsableRequest $request)
    {
        $responsable = new Responsable();
        $responsable->fill($request->all());
        $responsable->save();
        return response([
            'msg' => 'Responsable creado exitosamente.',
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
        $responsables = Responsable::findOrFail($id);
        return view(
            'Veterinaria.Responsables.edit',
            compact('responsables')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResponsableRequest $request, $id)
    {
        $responsable = Responsable::find($id);
        $responsable->fill($request->all());
        $responsable->update();
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
        $responsable = Responsable::find($id);
        $responsable->delete();
        return response(['msg' => 'Los datos han sido eliminados exitosamente.',
            'title' => 'Datos Eliminados!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
        ->header('Content-Type', 'application/json');
    }
}
