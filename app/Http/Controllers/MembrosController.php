<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembrosController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $LoginAuth = true;
        }
        else{
            $LoginAuth = false;
        }
        return view('conteudo.membros',['LoginAuth' => $LoginAuth]);
    }

    public function Registrar(Request $request){
        
    }
}
