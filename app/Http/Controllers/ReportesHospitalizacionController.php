<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Epicrisis;

class ReportesHospitalizacionController extends Controller
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
        return view('Veterinaria.ReportesHospitalizacion.index',compact('anios'));
    }
    public function obtenerDatos(Request $request)
    {
        $labelsHospitalizacion = [];
        $dataHospitalizacion = [];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
            $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                return $query->where('estado', '=', 'HOSPITALIZACION');
            })
            ->whereMonth('fecha','=',$i)
            ->get();
            if($estados_epicrisis)
            {
                array_push($labelsHospitalizacion, $meses[$i-1]);
                array_push($dataHospitalizacion, count($estados_epicrisis));
            }
            else
            {
                array_push($labelsHospitalizacion, $meses[$i-1]);
                array_push($dataHospitalizacion, 0);
            }
        }
        $datos = [];
        $datos['labels_hospitalizacion'] = $labelsHospitalizacion;
        $datos['data_hospitalizacion'] = array($dataHospitalizacion);
        return json_encode($datos);
    }

    public function filtro(Request $request)
    {
        $labelsHospitalizacion = [];
        $dataHospitalizacion = [];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
            $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                return $query->where('estado', '=', 'HOSPITALIZACION');
            })
            ->whereYear('fecha','=',$request->get('id_estado'))
            ->whereMonth('fecha','=',$i)
            ->get();
            if($estados_epicrisis)
            {
                array_push($labelsHospitalizacion, $meses[$i-1]);
                array_push($dataHospitalizacion, count($estados_epicrisis));
            }
            else
            {
                array_push($labelsHospitalizacion, $meses[$i-1]);
                array_push($dataHospitalizacion, 0);
            }
        }
        $datos = [];
        $datos['etiqueta'] = $request->get('id_estado');
        $datos['labels_hospitalizacion'] = $labelsHospitalizacion;
        $datos['data_hospitalizacion'] = array($dataHospitalizacion);
        return json_encode($datos);
    }
}
