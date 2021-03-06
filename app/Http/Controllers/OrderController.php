<?php

namespace App\Http\Controllers;

use App\Consult;
use App\Order;
use App\Product;
use App\Payment;
use App\Receipt;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function products()
    {
        $products = Product::select('PRODUCT_CODE','PRODUCT_NAME','PRODUCT_VAL')->orderBy('PRODUCT_CODE','desc')->get();
        return view('receipt.productList', compact('products'));
    }

    public function productsOrder($idOrden)
    {
        $result = $order = Order::find($idOrden);
        //$count = count(compact('order'));

        if ($result == null){
            return response()->json(['show'=>'false']);
        }

        $consult = $order->consult;
        $payment = $order->payments->first();
        $product = $order->products;
        $student = $consult->student;
        $patient = $consult->patient;
        $box = $patient->box;

        $arrayOrder = compact('order');
        $arrayPayment = compact('payment');
        $arrayProducts = compact('product');
        $arrayStudent = compact('student');
        $arrayPatient = compact('patient');
        $arrayBox = compact('box');
        $response = array_merge($arrayOrder, $arrayPayment, $arrayProducts, $arrayStudent, $arrayPatient, $arrayBox);

        $entry = $order->entry;

        if (!$entry){
            return response()->json($response);
        } else {
            $exists = array(true);
            $exists = compact('exists');
            $receipt = $payment->receipt;
            $invoice = new Invoice();
            if (!$receipt || $receipt == null){
                $invoice = $payment->invoicePos;
            } else {
                $invoice = $receipt->invoice;
            }
            $payment = $order->payments->last();

            $arrayPayment = compact('payment');
            $receipt = compact('receipt');
            $invoice = compact('invoice');
            $entry = compact('entry');
            $response = array_merge($arrayOrder, $arrayPayment, $arrayProducts, $arrayStudent, $arrayPatient, $receipt, $invoice, $entry, $arrayBox, $exists);
            return response()->json($response);
        }
    }

    public function orderFinal($idOrden)
    {
        $result = $order = Order::find($idOrden);
        //$count = count(compact('order'));

        if ($result == null){
            return response()->json(['show'=>'false']);
        }

        $consult = $order->consult;
        $product = $order->products;
        $student = $consult->student;
        $patient = $consult->patient;
        $box = $patient->box;
        $payment = $order->payments()->first();
        $receipt = $payment->receipt;
        $invoice = $receipt->invoice;

        $arrayOrder = compact('order');
        $arrayPayment = compact('payment');
        $arrayInvoice = compact('invoice');
        $arrayProducts = compact('product');
        $arrayStudent = compact('student');
        $arrayPatient = compact('patient');
        $arrayBox = compact('box');
        $response = array_merge($arrayOrder, $arrayPayment, $arrayInvoice, $arrayProducts, $arrayStudent, $arrayPatient, $arrayBox);

        return response()->json($response);
    }

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
            'mto_pago'=>'required'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        if ($request->get('code_product')){
            $consult = new Consult(['EST_COD'=>$request->get('code_student'),'HCLINICA'=>$request->get('nhc')]);
            $consult->save();
            $idConsult = Consult::all();
            $idConsult = $idConsult->last();

            $code = array();
            $quantity = array();
            $total = array();
            $totalPercent = array();

            foreach ($request->get('code_product') as $index => $value){
                $code[$index] = $value;
            }
            foreach ($request->get('quantity') as $index => $value){
                $quantity[$index] = $value;
            }
            foreach ($request->get('total_item') as $index => $value){
                $total[$index] = $value;
            }
            foreach ($request->get('total') as $index => $value){
                $totalPercent[$index] = $value;
            }

            $length = count($total);
            $result = false;

            for ($i = 0; $i < $length; $i++){
                $order = new Order();
                $order->METODO_PAGO = $request->get('mto_pago');
                $order->TOTAL_ORDEN = $total[$i];
                if ($request->get('mto_pago') == 2){
                    $order->CANCELADO = 1;
                }
                $result = $idConsult->orders()->save($order);
                $orders = Order::all();
                $idOrder = $orders->last();
                $payment = new Payment(['CONSIGNADO'=>$totalPercent[$i]]);
                $idOrder->payments()->save($payment);
                $idOrder->products()->attach([$code[$i]=>['CANTIDAD'=>$quantity[$i],'TOTAL_ITEM'=>$total[$i]]]);
            }

            if ($result){
                return response()->json(['save'=>'true', 'ID'=>$idConsult->ID]);
            } else {
                return response()->json(['save'=>'false']);
            }
        }
        else {
            return response()->json(['products'=>'false']);
        }
    }

    public function storeSecondPayment(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'mto_pago'=>'required',
            'total_pagar'=>'required|numeric'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        if ($request->get('code_product')){

            $order = Order::find($request->get('id_order'));
            $order->CANCELADO = 1;
            $payment = new Payment(['CONSIGNADO'=>$request->get('total_pagar'), 'PENDIENTE'=>0]);
            $order->save();
            $consult = $order->consult;
            $result = $order->payments()->save($payment);

            if ($result){
                return response()->json(['save'=>'true', 'ID'=>$order->IDORDEN]);
            } else {
                return response()->json(['save'=>'false']);
            }
        }
        else {
            return response()->json(['products'=>'false']);
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
