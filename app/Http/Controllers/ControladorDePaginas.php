<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorDePaginas extends Controller
{
    public function home(){
        return redirect('home');
    }
    public function abrir($slug){
         return view ($slug);
    }
}
