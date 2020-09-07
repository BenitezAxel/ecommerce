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
       $mediodepago = new Medio_pago();
        $array_mediodepago = $mediodepago->obtenerTodos();   
       return view('mercadopago.mercadopago', compact('titulo'));   
   }
   public function guardar(request $request){
    try{   
    $titulo = "Mercado Pago";
       $entidadMediopago = new Medio_pago();
       $entidadMediopago->cargarDesdeRequest($request);

       if ($entidadMediopago->idmediopago){
           $msg["ESTADO"] = MSG_ERROR;
       }else{
        if($_POST["id"] > 0){
            $entidadMediopago->guardar();
        }else{
            $entidadMediopago->insertar();
        }
       }
    } catch(Exception $e){
        
    }
   }

}
