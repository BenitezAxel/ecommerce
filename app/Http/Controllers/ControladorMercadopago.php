<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Medio_pago;
use Exception;

require app_path().'/start/constants.php';
use Session;
 
class ControladorMercadopago extends Controller{

   public function nuevo(){

       $titulo = "Metodo Mercado Pago";  
       $mercadopago = new Medio_pago();
    $array_mediodepago= $mercadopago->obtenerTodos(); 
       return view('mercadopago.mercadopago', compact('titulo'));   
   }
 }

