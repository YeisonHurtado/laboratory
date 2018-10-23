<?php

namespace App\Http\Controllers\Auth;

use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Usuario;

class LoginController extends Controller
{
    public function login (Request $request)
    {
        $credentials = $this->validate($request, [
            $this->username() => 'required|exists:USERS,USERNAME',
            'PASSWORD' => 'required'
        ]);

        $user = Usuario::select("*")->where("USERNAME",$request->get('USERNAME'))->where("PASSWORD",$request->get('PASSWORD'))->count();

        if(count($credentials) > 0 && $user > 0){
            return redirect('/menu');
        }

        return back()
        ->withErrors(['USERNAME' => 'Estas credenciales no coinciden con nuestros registros']);
    }

    public function username()
    {
        return "USERNAME";
    }
}
