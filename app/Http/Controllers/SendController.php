<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Send;
use Illuminate\Http\Request;

class SendController extends Controller
{
    public function waiting()
    {
        $entries = Entry::select('INGRESO.FECHA_INGRESO', 'INGRESO.ID AS INGRESO_ID','INGRESO.ID_ORDEN','FACTURA.IDFACTURA','ORDEN_PAGO.METODO_PAGO',
            'LABORATORIES.NAME','INGRESO.PREESCRIPCION','ESTUDIANTE.EST_COD','ESTUDIANTE.NOMBRE_EST','PACIENTE.NUM_PACIENTE', 'PACIENTE.NOMBRE')
            ->join('LABORATORIES','INGRESO.LABORATORIO_ID','=','LABORATORIES.ID')
            ->join('ORDEN_PAGO','INGRESO.ID_ORDEN','=','ORDEN_PAGO.IDORDEN')
            ->join('CONSULTA','ORDEN_PAGO.CONSULTA_ID','=','CONSULTA.ID')
            ->join('ESTUDIANTE','CONSULTA.EST_COD','=','ESTUDIANTE.EST_COD')
            ->join('PACIENTE','CONSULTA.HCLINICA','=','PACIENTE.NUM_PACIENTE')
            ->join('NUMERO_PAGOS','ORDEN_PAGO.IDORDEN','=','NUMERO_PAGOS.ID_ORDEN')
            ->join('RECIBO_CAJA','NUMERO_PAGOS.ID','=','RECIBO_CAJA.ID_NUM_PAGOS')
            ->join('FACTURA','FACTURA.IDFACTURA','=','RECIBO_CAJA.ID_FACTURA')
            ->leftJoin('ENVIO','INGRESO.ID','=','ENVIO.INGRESO_ID')->whereNull('ENVIO.INGRESO_ID')->get();

        $entries2 = Entry::select('INGRESO.FECHA_INGRESO', 'INGRESO.ID AS INGRESO_ID','INGRESO.ID_ORDEN','FACTURA_POS.ID','ORDEN_PAGO.METODO_PAGO',
            'LABORATORIES.NAME','INGRESO.PREESCRIPCION', 'ESTUDIANTE.EST_COD','ESTUDIANTE.NOMBRE_EST','PACIENTE.NUM_PACIENTE', 'PACIENTE.NOMBRE')
            ->join('LABORATORIES','INGRESO.LABORATORIO_ID','=','LABORATORIES.ID')
            ->join('ORDEN_PAGO','INGRESO.ID_ORDEN','=','ORDEN_PAGO.IDORDEN')
            ->join('CONSULTA','ORDEN_PAGO.CONSULTA_ID','=','CONSULTA.ID')
            ->join('ESTUDIANTE','CONSULTA.EST_COD','=','ESTUDIANTE.EST_COD')
            ->join('PACIENTE','CONSULTA.HCLINICA','=','PACIENTE.NUM_PACIENTE')
            ->join('NUMERO_PAGOS','ORDEN_PAGO.IDORDEN','=','NUMERO_PAGOS.ID_ORDEN')
            ->join('FACTURA_POS','NUMERO_PAGOS.ID','=','FACTURA_POS.ID_PAGO')
            ->leftJoin('ENVIO','INGRESO.ID','=','ENVIO.INGRESO_ID')->whereNull('ENVIO.INGRESO_ID')->get();
        return view('pending.receptions.list', compact('entries'), compact('entries2'));
    }

    public function store(Request $request)
    {
        $date = new \DateTime();
        $date = $date->format('d-m-Y');
        $entry = Entry::find($request->get('reception'));
        $send = new Send();
        $send->FECHA_ENVIO = $date;
        $result = $entry->send()->save($send);

        if ($result){
            return response()->json(['save'=>true]);
        } else {
            return response()->json(['save'=>false]);
        }

    }
}
