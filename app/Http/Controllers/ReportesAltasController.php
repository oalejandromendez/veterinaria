<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Epicrisis;

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
        return view('Veterinaria.ReportesAltas.index',compact('anios'));
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
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
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
        $datos = [];
        $datos['etiqueta'] = $request->get('id_estado');
        $datos['labels_altas'] = $labelsAltas;
        $datos['data_altas'] = array($dataAltas);
        return json_encode($datos);
    }
}
