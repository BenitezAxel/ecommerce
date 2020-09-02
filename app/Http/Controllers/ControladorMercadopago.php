<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Medio_pago;

 
require app_path().'/start/constants.php';
use Session;
 
class ControladorMercadopago extends Controller{

   public function nuevo(){

       $titulo = "Mercado Pago";
       return view('mercadopago.mercadopago', compact('titulo'));   
   }

}
