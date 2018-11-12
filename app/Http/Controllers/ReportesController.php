<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado_Epicrisis;

class ReportesController extends Controller
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
        return view('Veterinaria.Reportes.index',compact('anios'));
    }
    public function obtenerDatos(Request $request)
    {
        $labelsDecesos = [];
        $dataDecesos = [];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
            $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                return $query->where('estado', '=', 'DECESO');
            })
            ->whereMonth('fecha','=',$i)
            ->get();
            if($estados_epicrisis)
            {
                array_push($labelsDecesos, $meses[$i-1]);
                array_push($dataDecesos, count($estados_epicrisis));
            }
            else
            {
                array_push($labelsDecesos, $meses[$i-1]);
                array_push($dataDecesos, 0);
            }
        }
        $datos = [];
        $datos['labels_decesos'] = $labelsDecesos;
        $datos['data_decesos'] = array($dataDecesos);
        return json_encode($datos);
    }

    public function filtro(Request $request)
    {
        $labelsDecesos = [];
        $dataDecesos = [];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
        for($i=1;$i<=12;$i++){
            $estados_epicrisis = Estado_Epicrisis::whereHas('estado', function ($query) {
                return $query->where('estado', '=', 'DECESO');
            })
            ->whereYear('fecha','=',$request->get('id_estado'))
            ->whereMonth('fecha','=',$i)
            ->get();
            if($estados_epicrisis)
            {
                array_push($labelsDecesos, $meses[$i-1]);
                array_push($dataDecesos, count($estados_epicrisis));
            }
            else
            {
                array_push($labelsDecesos, $meses[$i-1]);
                array_push($dataDecesos, 0);
            }
        }
        $datos = [];
        $datos['etiqueta'] = $request->get('id_estado');
        $datos['labels_decesos'] = $labelsDecesos;
        $datos['data_decesos'] = array($dataDecesos);
        return json_encode($datos);
    }
    public function pdf_documento(Request $request)
    {
        $imagenes = explode('|', $request->get('json_datos'));
        $pdf = PDF::loadView('Veterinaria.Reportes.pdf', compact('imagenes'));
        return $pdf->download('reporte_encuestas.pdf');
    }
}
