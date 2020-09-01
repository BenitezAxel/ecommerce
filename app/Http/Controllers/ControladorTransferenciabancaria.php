<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Medio_pago;

 
require app_path().'/start/constants.php';
use Session;
 
class ControladorTransferenciabancaria extends Controller{

   public function nuevo(){

       $titulo = "Nueva tranferencia bancaria";
       return view('transferenciabancaria.tranferenciabancaria', compact('titulo'));   
   }

}
