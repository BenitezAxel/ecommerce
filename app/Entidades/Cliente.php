<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamp = false;

    protected $fillable = [
        'idcliente', 'telefono', 'fecha_nac', 'fk_idusuario'
    ];

    function cargarDesdeRequest($request){
        $this->idcliente = $request->input('id')!= 0 ? $request->input('id') : $this->idcliente;
        $this->telefono = $request->input('txtTelefono');
        $this->fecha_nac = $request->input('txtFechaNac');
        $this->fk_idusuario = $request->input('lstUsuario');
    }

    public function obtenerTodos(){
        $sql = "SELECT
                    A.idcliente,
                    A.telefono,
                    A.fecha_nac,
                    A.fk_idusuario
                FROM clientes ORDER BY A.idcliente;";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcliente){
        $sql = "SELECT
                    A.telefono,
                    A.fecha_nac,
                    A.fk_idusuario
                FROM clientes WHERE idcliente = '$idcliente';";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno) > 0){
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->fecha_nac = $lstRetorno[0]->fecha_nac;
            $this->fk_idusuario = $lstRetorno[0]->fk_idusuario;
            return $this;
        }
        return null;
    }

    public function guardar(){
        $sql = "UPDATE clientes SET
                    telefono='$this->telefono',
                    fecha_nac='$this->fecha_nac',
                    fk_idusuario=$this->fk_idusuario
                WHERE idcliente = ?;";
        $affected = DB::update($sql, [$this->idcliente]);
    }

    public function insertar(){
        $sql = "INSERT INTO clientes (
                            telefono,
                            fecha_nac,
                            fj_idusuario)
                VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->telefono,
            $this->fecha_nac,
            $this->fk_idusuario
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function eliminar(){
        $sql = "DELETE FROM clientes WHERE idcliente = ?;";
        $affected = DB::delete($sql, [$this->idcliente]);
    }
}

?>