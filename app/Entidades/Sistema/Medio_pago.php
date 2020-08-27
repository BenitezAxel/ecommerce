<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Medio_pago extends Model
{
    protected $table = 'medios_pago';
    public $timestamps = false;

    protected $fillable = [
        'idmedio', 'medio_de_pago'
    ];

    protected $hidden = [

    ];
    function cargarDesdeRequest($request) {
        $this->idmedio = $request->input('id')!="0" ? $request->input('id') : $this->idmedio;
        $this->medio_de_pago = $request->input('txtMedio');        
    }
    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idmedio,
                  A.medio_de_pago
                FROM medios_pago A ORDER BY A.medio_de_pago";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerPorId ($idmedio){
        $sql="SELECT 
            idmedio,
            medio_de_pago
            FROM medios_pago WHERE idmedio=?";
        $lstRetorno = DB::select($sql,[$this->idmedio]);

    }
    public function guardar(){
        $sql="UPDATE medios_pago SET 
        medio_de_pago='$this->medio_de_pago'
        WHERE idmedio=?";
        $affected = DB::update($sql,[$this->idmedio]);
        
    }
    public function eliminar(){
        $sql="DELETE FROM medios_pago WHERE idmedio=?";
        $affected = DB::delete($sql,[$this->idmedio]);
    }
    public function insertar(){
        $sql="INSERT INTO medios_pago(
            medio_de_pago)
            VALUES(?);";
        $result=DB::insert($sql,[$this->medio_de_pago]);

    }
    
}
