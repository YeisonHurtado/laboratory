<?php

namespace App\Http\Controllers;

use App\Laboratory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaboratoryController extends Controller
{
    public function listLaboratories($name = "")
    {
        if ($name != ""){
            $laboratories = Laboratory::select("*")->where('NAME','like','%'.$name.'%')->get();
        } else {
            $laboratories = Laboratory::all();
        }

        return view('laboratory.list', compact('laboratories'));
    }

    public function idLaboratory()
    {
        $laboratory = Laboratory::max('ID') + 1;
        $result = compact('laboratory');
        return response()->json($result);
    }
    
    public function edit($id)
    {
        $laboratory = Laboratory::find($id);
        $arrayLab = compact('laboratory');
        $product = $laboratory->products;
        $arrayProd = compact('product');
        $response = array_merge($arrayLab, $arrayProd);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $laboratory = new Laboratory();
        $validate = Validator::make($request->all(),[
            'name_lab'=>'required',
            'dire_lab'=>'required',
            'email_lab'=>'required|email|unique:LABORATORIES,EMAIL'
        ]);

        if ($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }


        $laboratory->ID = $request->get('idLab');
        $laboratory->NAME = $request->get('name_lab');
        $laboratory->LEGAL_REPRE = $request->get('rep_legal');
        $laboratory->ADDRESS = $request->get('dire_lab');
        $laboratory->TEL = $request->get('tel_lab');
        $laboratory->CEL = $request->get('cel_lab');
        $laboratory->EMAIL = $request->get('email_lab');
        $result = $laboratory->save();

        if ($request->get('codigo_prod')){
            $products = array('code','cost');
            $code = array();
            $cost = array();

            foreach ($request->get('codigo_prod') as $index => $value){
                $products['code'][$index] = $value;
                $code[$index] = $value;
            }
            foreach ($request->get('costo_prod') as $index => $value){
                $products['cost'][$index] = $value;
                $cost[$index] = $value;
            }

            $length = count($cost);

            $id = $request->get('idLab');
            $laboratories = Laboratory::find($id);

            for ($i = 0; $i < $length; $i++){
                $laboratories->products()->toggle([$code[$i]=>['COST'=>$cost[$i]]]);
            }
        }


        if ($result){
            return response()->json(['save'=>'true']);
        } else {
            return response()->json(['save'=>'false']);
        }
    }
    
    public function update(Request $request, $id)
    {
        $laboratory = Laboratory::find($id);

        $countEmail = Laboratory::all()->where('EMAIL',$request->get('email_lab'))->where('ID','!=',$id)->count();

        $validate = Validator::make($request->all(),[
            'dire_lab' => 'required',
            'tel_lab'=>'required',
            'cel_lab'=>'required',
            'email_lab' => 'required|email'
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }

        if ($countEmail == 0) {
            $laboratory->NAME = $request->get('name_lab');
            $laboratory->LEGAL_REPRE = $request->get('rep_legal');
            $laboratory->ADDRESS = $request->get('dire_lab');
            $laboratory->TEL = $request->get('tel_lab');
            $laboratory->CEL = $request->get('cel_lab');
            $laboratory->EMAIL = $request->get('email_lab');
            $result = $laboratory->save();

            if ($request->get('codigo_prod')){
                $products = array('code','cost');
                $code = array();
                $cost = array();

                foreach ($request->get('codigo_prod') as $index => $value){
                    $products['code'][$index] = $value;
                    $code[$index] = $value;
                }
                foreach ($request->get('costo_prod') as $index => $value){
                    $products['cost'][$index] = $value;
                    $cost[$index] = $value;
                }

                $length = count($cost);

                $id = $request->get('idLab');
                $laboratories = Laboratory::find($id);

                for ($i = 0; $i < $length; $i++){
                    $laboratories->products()->syncWithoutDetaching([$code[$i]=>['COST'=>$cost[$i]]]);
                }
            }

            if ($result){
                return response()->json(['update'=>'true']);
            } else {
                return response()->json(['update'=>'false']);
            }
        } else {
            return response()->json(['email'=>'exist']);
        }
    }

    public function destroy($id)
    {
        $laboratory = Laboratory::find($id);
        $name = $laboratory->NAME;
        $result = $laboratory->delete();
        if ($result) {
            return response()->json(['success'=>'true','name'=>$name]);
        } else {
            return responser()->json(['success'=>'false']);
        }
    }

    public function removeProduct ($code)
    {
        $product = Product::find($code);
        $result = $product->laboratories()->detach();

        if ($result) {
            return response()->json(['removeP'=>'true']);
        } else {
            return response()->json(['removeP'=>'false']);
        }
    }
}
