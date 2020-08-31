<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva sucursal";
        return view('sucursal.sucursal-nuevo', compact('titulo'));
    }
}

?>