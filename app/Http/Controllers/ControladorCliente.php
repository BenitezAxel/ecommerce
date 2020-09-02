<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorCliente extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo cliente";

        $entidad = new Cliente();
        $array_cliente= $entidad->obtenerTodos();

        return view('cliente.cliente-nuevo', compact('titulo'));
    }
    public function index(){
        $titulo = "Listado de Clientes";
        return view('cliente.cliente-listado', compact('titulo'));
    }

   
}

?>
