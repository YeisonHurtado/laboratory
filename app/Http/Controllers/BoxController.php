<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function boxList()
    {
        $boxes = Box::all();
        return view('box.list', compact('boxes'));
    }
}
