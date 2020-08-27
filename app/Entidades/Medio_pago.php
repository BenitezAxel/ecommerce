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
        'idmediopago', 'medio_de_pago'
    ];

    protected $hidden = [

    ];
    function cargarDesdeRequest($request) {
        $this->idmediopago = $request->input('id')!="0" ? $request->input('id') : $this->idmedio;
        $this->medio_de_pago = $request->input('txtMedio');        
    }
    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idmediopago,
                  A.medio_de_pago
                FROM medios_pago A ORDER BY A.medio_de_pago";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerPorId ($idmediopago){
        $sql="SELECT 
            idmediopago,
            medio_de_pago
            FROM medios_pago WHERE idmediopago=?";
        $lstRetorno = DB::select($sql,[$this->idmediopago]);

    }
    public function guardar(){
        $sql="UPDATE medios_pago SET 
        medio_de_pago='$this->medio_de_pago'
        WHERE idmediopago=?";
        $affected = DB::update($sql,[$this->idmediopago]);
        
    }
    public function eliminar(){
        $sql="DELETE FROM medios_pago WHERE idmediopago=?";
        $affected = DB::delete($sql,[$this->idmediopago]);
    }
    public function insertar(){
        $sql="INSERT INTO medios_pago(
            medio_de_pago)
            VALUES(?);";
        $result=DB::insert($sql,[$this->medio_de_pago]);

    }
    
}
