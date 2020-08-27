<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Venta extends Model
{
    protected $table = "ventas";
    public $timestamp = false;

    protected $fillable = [
        'idventa', 'cantidad', 'preciounitario', 'total', 'fecha', 'fk_idmediopago', 'fk_idcliente', 'fk_idproducto'
    ];

    function cargarDesdeRequest($request){
        $this->idventa = $request->input('id')!= 0 ? $request->input('id') : $this->idventa;
        $this->cantidad = $request->input('txtCantidad');
        $this->preciounitario = $request->input('txtPrecioUnitario');
        $this->total = $request->input('txtTotal');
        $this->fecha = $request->input('txtFecha');
        $this->fk_idmediopago = $request->input('lstMedioPago');
        $this->fk_idcliente = $request->input('lstCliente');
        $this->fk_idproducto = $request->input('lstProducto');
    }

    public function obtenerTodos(){
        $sql = "SELECT
                    A.idventa,
                    A.cantidad,
                    A.preciounitario,
                    A.total,
                    A.fecha,
                    A.fk_idmediopago,
                    A.fk_idcliente,
                    A.fk_idproducto
                FROM ventas A ORDER BY A.idventa;";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idventa){
        $sql = "SELECT
                    A.cantidad,
                    A.preciounitario,
                    A.total,
                    A.fecha,
                    A.fk_idmediopago,
                    A.fk_idcliente,
                    A.fk_idproducto
                FROM ventas WHERE idventa = $idventa;";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0){
            $this->idventa = $lstRetorno[0]->idventa;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->preciounitario = $lstRetorno[0]->preciounitario;
            $this->total = $lstRetorno[0]->total;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->fk_mediopago = $lstRetorno[0]->fk_mediopago;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            return $this;
        }
        return null;
    }

    public function guardar(){
        $sql = "UPDATE ventas SET
                cantidad=$this->cantidad,
                preciounitario=$this->preciounitario,
                total=$this->total,
                fecha=$this->fecha,
                fk_idmediopago=$this->fk_idmediopago,
                fk_idcliente=$this->fk_idcliente,
                fk_idproducto=$this->fk_idproducto
                WHERE idventa = ?;";
        $affected = DB::update($sql, [$this->idventa]);
    }

    public function insertar(){
        $sql = "INSERT INTO ventas (
                            cantidad,
                            preciounitario,
                            total,
                            fecha,
                            fk_idmediopago,
                            fk_idcliente,
                            fk_idproducto)
                VALUES (?, ?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->cantidad,
            $this->preciounitario,
            $this->total,
            $this->fecha,
            $this->fk_idmediopago,
            $this->fk_idcliente,
            $this->fk_idproducto
        ]);
        return $this->idventa = DB::getPdo()->lastInsertId();
    }

    public function eliminar(){
        $sql = "DELETE FROM ventas WHERE idventa = ?;";
        $affected = DB::delete($sql, [$this->idventa]);
    }
}

?>