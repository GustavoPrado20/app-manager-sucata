<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancasController extends Controller
{
    public function index()
    {
        return view('conteudo.finanças');
    }
}
