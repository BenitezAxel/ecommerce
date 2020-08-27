<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Carrito_Compra extends Model
{
    protected $table = 'carrito_compras';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito', 'fk_idproducto', 'fk_idcliente'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idcarrito = $request->input('id')!="0" ? $request->input('id') : $this->idcarrito;
        $this->fk_idproducto = $request->input('lstProducto');
        $this->fk_idcliente = $request->input('lstCliente');
        
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idcarrito,
                  A.fk_idproducto,
                  A.fk_idcliente
                FROM carrito_compras A";

        $sql .= " ORDER BY A.idcarrito";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

     public function obtenerPorId($idcarrito) {
        $sql = "SELECT
                idcarrito,
                fk_idproducto,
                fk_idcliente,
                FROM carrito_compras WHERE idcarrito = '$idcarrito'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            return $this;
        }
        return null;
    }

       public function guardar() {
        $sql = "UPDATE carrito_compras SET
            fk_idproducto='$this->fk_idproducto',
            fk_idcliente='$this->fk_idcliente'
            WHERE idcarrito=?";
        $affected = DB::update($sql, [$this->idcarrito]);
    }


      public  function eliminar() {
        $sql = "DELETE FROM carrito_compras WHERE 
            idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
    }


 public function insertar() {
        $sql = "INSERT INTO carrito_compras (
                fk_idproducto,
                fk_idcliente
            ) VALUES (?, ?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [
            $this->fk_idproducto, 
            $this->fk_idcliente
        ]);
       return $this->idcarrito = DB::getPdo()->lastInsertId();
    }


}

?>