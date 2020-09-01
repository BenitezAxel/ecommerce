<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Menu;
 
require app_path().'/start/constants.php';
use Session;
 
class ControladorCategoria extends Controller{
    public function index(){
        $titulo="Listado de Categorías";
        return view('categoria.listado-categorias',compact('titulo'));
    }
   public function nuevo(){
       $titulo = "Nueva Categoria";
 
      return view('categoria.categoria-nuevo', compact('titulo'));   
   }
 
}
