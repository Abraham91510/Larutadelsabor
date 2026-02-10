<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Pagina;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;


class HomeController extends Controller
{
    public function __invoke(){
        return view ('hello');
    }

    public function inicio(){
   
        $datos["nombre"] = "Equipo 2";
        $datos["fecha"] = "2026-02-10";
        $datos["actividad"] = "Pagina principal";
        $datos["nombre_empresa"] = "La Ruta del Sabor";

        return view('inicio', $datos);
    }



}
