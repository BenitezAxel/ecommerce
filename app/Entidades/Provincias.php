<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Provincia extends Model
{
    protected $table = 'provincias';
    public $timestamps = false;

    protected $fillable = [
        'idprovincia', 'nombre'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idprovincia = $request->input('id')!="0" ? $request->input('id') : $this->idprovincia;
        $this->nombre = $request->input('txtNombre');
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idprovincia,
                  A.nombre
                FROM provincias A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idprovincia) {
        $sql = "SELECT
                idprovincia,
                nombre
                FROM provincias WHERE idprovincia = '$idprovincia'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idprovincia = $lstRetorno[0]->idprovincia;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE provincias SET
            nombre='$this->nombre'
            WHERE idprovincia=?";
        $affected = DB::update($sql, [$this->idprovincia]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM provincias WHERE 
            idprovincia=?";
        $affected = DB::delete($sql, [$this->idprovincia]);
    }

    public function insertar() {
        $sql = "INSERT INTO provincias (
                nombre
            ) VALUES (?);";
       $result = DB::insert($sql, [
            $this->nombre
        ]);
       return $this->idprovincia = DB::getPdo()->lastInsertId();
    }


}
