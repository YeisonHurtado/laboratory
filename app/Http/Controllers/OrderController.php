<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Payment;
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
        $order = Order::find($idOrden);
        $arrayOrder = compact('order');
        $product = $order->products;
        $arrayProducts = compact('product');
        $student = $order->student;
        $arrayStudent = compact('student');
        $patient = $order->patient;
        $arrayPatient = compact('patient');
        $response = array_merge($arrayOrder, $arrayProducts, $arrayStudent, $arrayPatient);
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
            'mto_pago'=>'required',
            'total_pagar'=>'required|numeric'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        if ($request->get('code_product')){
            $order = new Order();
            $order->EST_COD = $request->get('code_student');
            $order->HCLINICA = $request->get('nhc');
            $order->METODO_PAGO = $request->get('mto_pago');
            $order->TOTAL_ORDEN = $request->get('total');
            if ($request->get('mto_pago') == 2){
                $order->CANCELADO = 1;
            }
            $result = $order->save();

            $code = array();
            $quantity = array();
            $total = array();

            foreach ($request->get('code_product') as $index => $value){
                $code[$index] = $value;
            }
            foreach ($request->get('quantity') as $index => $value){
                $quantity[$index] = $value;
            }

            foreach ($request->get('total_item') as $index => $value){
                $total[$index] = $value;
            }

            $length = count($total);
            $orders = Order::all();
            $idOrder = $orders->last();

            $payment = new Payment(['CONSIGNADO'=>$request->get('total_pagar')]);
            $idOrder->payments()->save($payment);

            for ($i = 0; $i < $length; $i++){
                $idOrder->products()->attach([$code[$i]=>['CANTIDAD'=>$quantity[$i],'TOTAL_ITEM'=>$total[$i]]]);
            }

            if ($result){
                return response()->json(['save'=>'true']);
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
            $result = $order->payments()->save($payment);

            if ($result){
                return response()->json(['save'=>'true']);
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
