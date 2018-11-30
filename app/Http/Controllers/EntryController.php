<?php

namespace App\Http\Controllers;

use App\Articulator;
use App\Box;
use App\Entry;
use App\Invoice;
use App\InvoicePos;
use App\Laboratory;
use App\Order;
use App\Patient;
use App\Payment;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Monolog\Handler\IFTTTHandler;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validate = Validator::make($request->all(),[
            'no_orden'=>'required|numeric',
            'fecha_ingreso'=>'required|date',
            'laboratorio'=>'required',
            'no_factura'=>'required',
            'recibo_caja'=>'required',
            'preescripcion'=>'required'
        ]);

        if ($request->get('metodo_pago') == 2){
            $validate = Validator::make($request->all(),[
                'no_orden'=>'required|numeric',
                'fecha_ingreso'=>'required|date',
                'laboratorio'=>'required',
                'no_factura'=>'required',
                'preescripcion'=>'required'
            ]);
        }

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        $patient = Patient::find($request->get('doc_paciente'));
        $laboratory = Laboratory::find($request->get('laboratorio'));
        $idLab = $laboratory->ID;
        $order = Order::find($request->get('no_orden'));
        $payment = Payment::find($request->get('id_payment'));

        $saveInvoice = false;
        $saveInvoicePos = false;
        $saveReceipt = false;

        if ($request->get('metodo_pago') == 1){
            $invoice = new Invoice();
            $invoice->IDFACTURA = $request->get('no_factura');
            $invoice->TOTAL = $request->get('total_item');
            $invoice->CANCELADO = 0;
            $saveInvoice = $invoice->save();

            if ($saveInvoice){
                $receipt = new Receipt();
                $receipt->ID = $request->get('recibo_caja');
                $receipt->ID_NUM_PAGOS = $request->get('id_payment');
                $receipt->CONSIGNADO = $request->get('total_cancelado');
                $saveReceipt = $invoice->receipts()->save($receipt);
            }

        } else if ($request->get('metodo_pago') == 2){
            $invoicePos = new InvoicePos();
            $invoicePos->ID = $request->get('no_factura');
            $invoicePos->ID_PAGO = $request->get('id_payment');
            $invoicePos->TOTAL = $request->get('total_cancelado');
            $saveInvoicePos = $invoicePos->save();
        }

        if ($saveReceipt || $saveInvoicePos){
            $entry = new Entry();
            $entry->LABORATORIO_ID = $idLab;
            $entry->FECHA_INGRESO = $request->get('fecha_ingreso');
            $entry->PREESCRIPCION = $request->get('preescripcion');

            $tooth = array();

            foreach ($request->get('diente') as $index => $value){
                $tooth[$index] = $value;
            }

            $count = count($tooth);
            $j = 0;

            while ($j < $count){
                $nTooth = $tooth[$j];
                $entry->$nTooth = 1;
                $j++;
            }
            $result = $order->entry()->save($entry);

            if ($result && $request->get('cant_art') != "NA"){
                $code = array();
                $observation = array();

                foreach ($request->get('cod_art') as $index => $value){
                    $code[$index] = $value;
                }

                foreach ($request->get('ob_art') as $index => $value){
                    $observation[$index] = $value;
                }

                $countArt = count($code);

                if ($request->get('cant_art') == 1){
                    $articulator = new Articulator();
                    $articulator->ID = $code[0];
                    $articulator->OBSERVACIONES = $observation[0];
                    $entry->articulators()->save($articulator);
                }
                else if ($request->get('cant_art') == 2){
                    $k = 0;
                    while ($k < $countArt){
                        $articulator = new Articulator();
                        $articulator->ID = $code[$k];
                        $articulator->OBSERVACIONES = $observation[$k];
                        $entry->articulators()->save($articulator);
                        $k++;
                    }
                }

                if ($request->get('no_caja') != ""){
                    $box = Box::find($request->get('no_caja'));
                    $patient->box()->save($box);
                }
            }

            if ($result){
                return response()->json(['save'=>'true']);
            } else {
                return response()->json(['save'=>'false']);
            }
        } else {
            return response()->json(['invoice'=>'false']);
        }
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
        //
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
        //
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
