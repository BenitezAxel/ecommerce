<?php

namespace App\Http\Controllers;

use App\Entidades\Localidad;
use App\Entidades\Provincia;

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

        return view('sucursal.sucursal-nuevo', compact('titulo', 'array_localidad', 'array_provincia'));
    }

    public function editar($id) //TODO: Preguntar si hace falta obtener todos para localidad y provincia
    {
        $titulo = "Modificar Sucursal";

        $sucursal = new Sucursal();
        $sucursal->obtenerPorId($id);
        
        $localidad = new Localidad();
        $array_localidad = $localidad->obtenerTodos();

        $provincias = new Provincias();
        $array_provincia = $provincia->obtenerTodos();

        return view('sucursal.sucursal-nuevo', compact('sucursal', 'array_localidad', 'array_provincia'));
    }

    public function guardar(Request $request)
    {
        try{
            $titulo = "Sucursal";
            $entidadSucursal = new Sucursal();
            $entidadSucursal->cargarDesdeRequest($request);

            if ($entidadSucursal->direccion == "" || $entidadSucursal->fk_idlocalidad == "" || $entidadSucursal->fk_idprovincia == ""){
                $msg["ESTADO"] = MSG_ERROR;
            } else {
                if($_POST["id"] > 0){
                    $entidadSucursal->guardar();
                } else {
                    $entidadSucursal->insertar();
                    $_POST["id"] = $entidadSucursal->idsucursal;
                }
            }

        } catch (Exception $e){

        }
    }
}

?>