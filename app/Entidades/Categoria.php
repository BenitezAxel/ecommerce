<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;
    
    protected $fillable = [
        'idcategoria', 'nombre', 'fk_idpadre'
    ];

    public function cargarDesdeRequest($request){
        $this->idcategoria = $request->input('id')!= "0" ? $request->input('id') : $this->idcategoria;
        $this->nombre = $request->input('txtNombre');
        $this->fk_idpadre = $request->input('lstPadre');
    }

    public function obtenerTodos(){
        $sql = "SELECT
                    A.idcategoria,
                    A.nombre,
                    A.fk_idpadre
                FROM categorias A ORDER by A.idcategoria";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcategoria){
        $sql = "SELECT
                    idcategoria,
                    nombre,
                    fk_idpadre
                FROM categorias WHERE idcategoria = '$idcategoria'";
        $listRetorno = DB::select($sql);

        if(count($lstRetorno) > 0){
            $this->idcategoria = $lstRetorno[0]->idcategoria;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->fk_idpadre = $lstRetorno[0]->fk_idpadre;
            return $this;
        }
        return null;
    }

    public function guardar(){
        $sql = "UPDATE categorias SET
                        nombre = '$this->nombre',
                        fk_idpadre = $this->fk_idpadre
                WHERE idcategoria = ?";
        $affected = DB::update($sql, [$this->idcategoria]);
    }

    public function insertar(){
        $sql = "INSERT INTO categorias (
                            nombre,
                            fk_idpadre)
                VALUES (?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->fk_idpadre
        ]);
        return $this->idcategoria = DB::getPdo()->lastInsertId();
    }

    public function eliminar(){
        $sql = "DELETE FROM categorias WHERE idcategoria = ?";
        $affected = DB::delete($sql, [$this->idcategoria]);
    }
}

?>