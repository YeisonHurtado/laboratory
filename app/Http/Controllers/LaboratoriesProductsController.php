<?php

namespace App\Http\Controllers;

use App\Laboratory;
use Illuminate\Http\Request;

class LaboratoriesProductsController extends Controller
{
    public function store(Request $request)
    {
        /*$id = $request->get('idLab');
        $laboratory = Laboratory::find($id);

        foreach ($request->all() as $product){
            $laboratory->products()->toggle([$product['codigo_prod']=>['COST'=>$product['costo_prod']]]);
        }

        //$laboratory->products()->toggle([$code=>['cost'=>$cost]]);


        return response()->json(['save'=>"true"]);*/
    }
}
