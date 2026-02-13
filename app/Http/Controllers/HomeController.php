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
        $datos["nombre_empresa"] = "La Ruta del Sabor";
        $datos["eslogan_empresa"] = "Siempre visible. Siempre a tiempo.";
        $datos["logo_empresa"] = "Imagenes/La Ruta Del Sabor_Logo.ico";
        $datos["ruta_pagina_principal"] = route('inicio');
        $datos["descripcion_empresa"] = "Plataforma digital que conecta clientes 
        con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.";

        $datos["enlace_inicio"] = [
            "icono" => "bi-house",
            "texto" => "Inicio",
            "url" => route('inicio')
        ];

        $datos["enlace_ayuda"] = [
            "icono" => "bi-question-circle",
            "texto" => "Ayuda",
            "url" => route('inicio')
        ];

        $datos["facebook"] = [
            "icono" => "bi-facebook",
            "url" =>  route('inicio')
        ];

        $datos["instagram"] = [
            "icono" => "bi-instagram",
            "url" => route('inicio')
        ];

        $datos["twitter"] = [
            "icono" => "bi-twitter",
            "url" => route('inicio')
        ];

        $datos["whatsapp"] = [
            "icono" => "bi-whatsapp",
            "url" =>  route('inicio')
        ];

        return view('inicio', $datos);
    }
}
