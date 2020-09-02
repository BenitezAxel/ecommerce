<?php

namespace App\Http\Controllers;

require app_path() . '/start/constants.php';

class ControladorIncidente extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo incidente";
        return view('incidente.incidente-nuevo', compact('titulo'));
    }
    public function index()
    {
        $titulo = "Listado de Incidentes";
        return view('incidente.incidente-index', compact('titulo'));
    }


}
