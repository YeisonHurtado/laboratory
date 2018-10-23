<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Muestra un listado de todos los productos
    public function listproducts($parameter = "")
    {
        if ($parameter != ""){
            $products = Product::select('PRODUCT_CODE','PRODUCT_NAME','PRODUCT_VAL')->where('PRODUCT_CODE', 'like','%'.$parameter.'%')->orderBy('PRODUCT_CODE','desc')->get();
        } else {
            $products = Product::select('PRODUCT_CODE','PRODUCT_NAME','PRODUCT_VAL')->orderBy('PRODUCT_CODE','desc')->get();
        }

        return view('product.list', compact('products'));
    }

    public function searchNameProduct($parameter="")
    {
        $products = Product::select('PRODUCT_CODE','PRODUCT_NAME','PRODUCT_VAL')->where('PRODUCT_NAME', 'like','%'.$parameter.'%')->orderBy('PRODUCT_CODE','desc')->get();
        return view('product.list', compact('products'));
    }
    
    public function edit($code)
    {
        $product = Product::find($code);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        if ($request->ajax()){
            $product = new Product();
            $countProduct = Product::all()->where('PRODUCT_CODE',$request->get('cod_product'))->count();
            if ($countProduct == 0) {
                $product->PRODUCT_CODE = $request->get('cod_product');
                $product->PRODUCT_NAME = $request->get('name_product');
                $product->PRODUCT_VAL = $request->get('product_value');
                $result = $product->save();
                if ($result) {
                    return response()->json(['save' => 'true']);
                } else {
                    return response()->json(['save' => 'false']);
                }
            } else {
                return response()->json(['exists' => 'true']);
            }
        }
    }

    public function update(Request $request, $code)
    {
        $product = Product::find($code);
        $product->PRODUCT_CODE = $request->get('cod_product');
        $product->PRODUCT_NAME = $request->get('name_product');
        $product->PRODUCT_VAL = $request->get('product_value');
        $result = $product->save();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }
    
    public function destroy($code)
    {
        $product = Product::find($code);
        $result = $product->delete();
        if ($result) {
            return response()->json(['success'=>'true']);
        } else {
            return responser()->json(['success'=>'false']);
        }
    }
}
