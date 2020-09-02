<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorVendedor extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo vendedor";
        $vendedor = new Vendedor;
        $array_vendedor = $vendedor->obtenerTodos();        
        return view('vendedor.vendedor-nuevo', compact('titulo'));
    }

}