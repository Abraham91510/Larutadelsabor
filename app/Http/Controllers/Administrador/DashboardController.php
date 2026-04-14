<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('administrador.pages.dashboard');
    }
}