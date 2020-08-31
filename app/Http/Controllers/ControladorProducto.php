<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Entidades\Sistema\Productos;
require app_path().'/start/constants.php';
use Session;
 
class ControladorProducto extends Controller{
   public function nuevo(){
       $titulo = "Nuevo producto";
 
      return view('producto.producto-nuevo', compact('titulo'));   
   }
 
}
