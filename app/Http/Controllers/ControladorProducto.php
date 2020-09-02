<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Entidades\Producto;
use App\Entidades\Sucursal;


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

