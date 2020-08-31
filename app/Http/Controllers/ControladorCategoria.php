<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Menu;
 
require app_path().'/start/constants.php';
use Session;
 
class ControladorCategoria extends Controller{
   public function nuevo(){
       $titulo = "Hola";
 
      return view('categoria.categoriaNuevo', compact('titulo'));   
   }
 
}
