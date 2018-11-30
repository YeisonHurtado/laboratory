<?php

namespace App\Http\Controllers;

use App\Consult;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ConsultController extends Controller
{
    public function allOrders($idConsult)
    {
        $consult = Consult::find($idConsult);
        $student = $consult->student;
        $patient = $consult->patient;
        $orders = $consult->orders;
        $product = array();
        $i = 0;
        foreach ($orders as $order){
            $product[$i] = $order->products;
            $i++;
        }

        $consult = compact('consult');
        $student = compact('student');
        $patient = compact('patient');
        $orders = compact('orders');
        $product = compact('product');
        $response = array_merge($consult, $student, $patient, $orders, $product);
        return response()->json($response);
    }

    public function onlyOneOrder($idOrder)
    {
        $order = Order::find($idOrder);
        $consult = $order->consult;
        $student = $consult->student;
        $patient = $consult->patient;
        $product = $order->products;

        $consult = compact('consult');
        $student = compact('student');
        $patient = compact('patient');
        $order = compact('order');
        $product = compact('product');
        $response = array_merge($consult, $student, $patient, $order, $product);
        return response()->json($response);
    }

    public function printOrder($idConsult, $idOrder)
    {
        Excel::create('Orden de pago', function ($excel) use($idConsult, $idOrder){

            $excel->sheet('Recibo', function ($sheet) use($idConsult, $idOrder){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Arial',
                        'size'      =>  11,
                        'bold'      =>  false
                    )
                ));
                $sheet->mergeCells('A1:B1');
                $sheet->cell('A1:B1', function($cell) {
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                    $cell->setFont(array(
                        'name'     => 'Calibri Light',
                        'size'       => '11',
                        'bold'       =>  true
                    ));
                });
                $sheet->cell('A2:A10', function ($cell){
                    $cell->setAlignment('left');
                    $cell->setValignment('center');
                    $cell->setFont(array(
                        'bold' =>  true
                    ));
                });
                $sheet->cell('B', function ($cell){
                    $cell->setAlignment('left');
                    $cell->setValignment('center');
                });
                $sheet->setWidth(array(
                    'A'=>24,
                    'B'=>50
                ));
                $sheet->setColumnFormat(array(
                    'B4' => '$#,##0_-'
                ));
                $sheet->setSize(array(
                    'A1' => array(
                        'height'=> 22
                    ),
                    'A3' => array(
                        'width'=> 24,
                        'height'=> 46
                    ),
                    'B3' => array(
                        'height'=> 46
                    )
                ));
                $sheet->cell('B4:B5', function ($cell){
                    $cell->setAlignment('left');
                });

                $consult = Consult::find($idConsult);
                $student = $consult->student;
                $patient = $consult->patient;
                $order = Order::find($idOrder);
                $product = $order->products;

                foreach ($product as $item){
                    $sheet->row(1,['ORDEN DE PAGO No. '.$idOrder]);
                    $sheet->row(2,['Código del producto:',$item->PRODUCT_CODE]);
                    $sheet->row(3,['Descripción del producto:',$item->PRODUCT_NAME]);
                    $sheet->row(4,['Valor unitario:',$item->PRODUCT_VAL]);
                    $sheet->row(5,['Unidades:',$item->pivot->CANTIDAD]);
                    $sheet->row(7,['Código estudiante:',$student->EST_COD]);
                    $sheet->row(8,['Nombre estudiante:',$student->NOMBRE_EST]);
                    $sheet->row(9,['Documento del paciente:',$patient->NUM_PACIENTE]);
                    $sheet->row(10,['Nombre del paciente:',$patient->NOMBRE]);
                }
            });
        })->export('xls');

//        Excel::create('Laravel Excel', function($excel) {
//
//            $excel->sheet('Productos', function($sheet) {
//
//                $products = Product::all();
//
//                $sheet->fromArray($products);
//
//            });
//        })->export('xls');
    }
}
