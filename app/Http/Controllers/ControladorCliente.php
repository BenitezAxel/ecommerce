<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorCliente extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo cliente";
        return view('cliente.cliente-nuevo', compact('titulo'));
    }

}

?>
