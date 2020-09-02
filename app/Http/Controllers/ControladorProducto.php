<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
 
use Illuminate\Http\Request;
use App\Entidades\Producto;
=======

>>>>>>> e1d6faa5a86a9c174f0578da99142f88eabe4bcd
use App\Entidades\Sucursal;

require app_path() . '/start/constants.php';

<<<<<<< HEAD
require app_path().'/start/constants.php';
use Session;
 
class ControladorProducto extends Controller{
   public function nuevo(){
       $titulo = "Nuevo producto";
       $sucural = new Sucursal();
       $array_sucursal = $sucural->obtenerTodos();
      return view('producto.producto-nuevo', compact('titulo', 'array_sucursal'));   
   }
 
}
=======
class ControladorProducto extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo producto";
        $sucursal = new Sucursal();
        $array_sucursal = $sucursal->obtenerTodos();
        return view('producto.producto-nuevo', compact('titulo', 'array_sucursal'));
    }
>>>>>>> e1d6faa5a86a9c174f0578da99142f88eabe4bcd

}
