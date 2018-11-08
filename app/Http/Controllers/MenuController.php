<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function index ()
    {
        $now = Carbon::now();
        return view('menu.menu', compact('now'));
    }
}
