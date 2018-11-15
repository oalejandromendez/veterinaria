<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Epicrisis;
use App\User;

class ReportesAltasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anios = Estado_Epicrisis::selectRaw('YEAR(fecha) as fecha')
        ->orderBy('fecha', 'desc')
        ->get()->pluck('fecha','fecha'); 
        $medicos = User::selectRaw('id, CONCAT(name," ",lastname) AS nombre')
        ->whereHas('roles', function ($query) {
            return $query->where('name', '=', 'VETERINARIO');
        })->pluck('nombre', 'id');
        return view('Veterinaria.ReportesAltas.index',compact('anios','medicos'));
    }
    public function obtenerDatos(Request $request)
    {
        $labelsAltas = [];
        $dataAltas = [];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
            $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                return $query->where('estado', '=', 'DE ALTA');
            })
            ->whereMonth('fecha','=',$i)
            ->get();
            if($estados_epicrisis)
            {
                array_push($labelsAltas, $meses[$i-1]);
                array_push($dataAltas, count($estados_epicrisis));
            }
            else
            {
                array_push($labelsAltas, $meses[$i-1]);
                array_push($dataAltas, 0);
            }
        }
        $datos = [];
        $datos['labels_altas'] = $labelsAltas;
        $datos['data_altas'] = array($dataAltas);
        return json_encode($datos);
    }

    public function filtro(Request $request)
    {
        $labelsAltas = [];
        $dataAltas = [];
        $datos = [];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
            if($request->get('id_estado') && $request->get('id_medico')){
                $medicos = User::selectRaw('CONCAT(name," ",lastname) AS nombre')
                ->where('id','=',$request->get('id_medico'))->first();
                $datos['etiqueta'] = "Año ". $request->get('id_estado'). " Medico ". $medicos->nombre ;
                $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                    return $query->where('estado', '=', 'DE ALTA');
                })
                ->whereHas('epicrisis', function ($query) use($request) {
                    return $query->where('fk_id_medico_veterinario', '=', $request->get('id_medico'));
                })
                ->whereYear('fecha','=',$request->get('id_estado'))
                ->whereMonth('fecha','=',$i)
                ->get();
                if($estados_epicrisis)
                {
                    array_push($labelsAltas, $meses[$i-1]);
                    array_push($dataAltas, count($estados_epicrisis));
                }
                else
                {
                    array_push($labelsAltas, $meses[$i-1]);
                    array_push($dataAltas, 0);
                }
            }
            elseif($request->get('id_estado'))
            {
                $datos['etiqueta'] = "Año ". $request->get('id_estado');
                $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                    return $query->where('estado', '=', 'DE ALTA');
                })
                ->whereYear('fecha','=',$request->get('id_estado'))
                ->whereMonth('fecha','=',$i)
                ->get();
                if($estados_epicrisis)
                {
                    array_push($labelsAltas, $meses[$i-1]);
                    array_push($dataAltas, count($estados_epicrisis));
                }
                else
                {
                    array_push($labelsAltas, $meses[$i-1]);
                    array_push($dataAltas, 0);
                }
            }
            elseif($request->get('id_medico'))
            {
                $medicos = User::selectRaw('CONCAT(name," ",lastname) AS nombre')
                ->where('id','=',$request->get('id_medico'))->first();
                $datos['etiqueta'] = "Medico ".$medicos->nombre;
                $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                    return $query->where('estado', '=', 'DE ALTA');
                })
                ->whereHas('epicrisis', function ($query) use($request) {
                    return $query->where('fk_id_medico_veterinario', '=', $request->get('id_medico'));
                })
                ->whereMonth('fecha','=',$i)
                ->get();
                if($estados_epicrisis)
                {
                    array_push($labelsAltas, $meses[$i-1]);
                    array_push($dataAltas, count($estados_epicrisis));
                }
                else
                {
                    array_push($labelsAltas, $meses[$i-1]);
                    array_push($dataAltas, 0);
                }
            }
        }
        $datos['labels_altas'] = $labelsAltas;
        $datos['data_altas'] = array($dataAltas);
        return json_encode($datos);
    }
}
