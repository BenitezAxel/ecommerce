<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorVendedor extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo vendedor";
        return view('vendedor.vendedor-nuevo', compact('titulo'));
    }

}