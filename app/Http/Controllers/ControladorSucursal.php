<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva sucursal";

        $localidad = new Localidad();
        $array_localidad = $localidad->obtenerTodos();

        $provincia = new Provincia();
        $array_provincia = $provincia->obtenerTodos();

        return view('sucursal.sucursal-nuevo', compact('titulo'));
    }
}

?>