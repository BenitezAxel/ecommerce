<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;

require app_path() . '/start/constants.php';

class ControladorProducto extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo producto";
        $sucursal = new Sucursal();
        $array_sucursal = $sucursal->obtenerTodos();
        return view('producto.producto-nuevo', compact('titulo', 'array_sucursal'));
    }

}
