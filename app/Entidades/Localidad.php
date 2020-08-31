<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Localidad extends Model
{
    protected $table = 'localidades';
    public $timestamps = false;

    protected $fillable = [
        'idlocalidad', 'nombre', 'fk_idprovincia'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idlocalidad = $request->input('id')!="0" ? $request->input('id') : $this->idmenu;
        $this->nombre = $request->input('txtNombre');
        $this->fk_idprovincia = $request->input('fk_idprovincia');       
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idlocalidad,
                  A.nombre,
                  A.fk_idprovincia,
                  
                FROM localidades A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idlocalidad) {
        $sql = "SELECT
                idlocalidad,
                nombre,
                fk_idprovincia       
                FROM localidades WHERE idlocalidad = '$idlocalidad'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idlocalidad = $lstRetorno[0]->idlocalidad;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->fk_idprovincia = $lstRetorno[0]->fk_idprovincia;                     
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE localidades SET
            nombre='$this->nombre',
            fk_idprovincia='$this->fk_idprovincia'
           
            WHERE idlocalidad=?";
        $affected = DB::update($sql, [$this->idincidente]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM localidades WHERE 
            idlocalidad=?";
        $affected = DB::delete($sql, [$this->idlocalidad]);
    }

    public function insertar() {
        $sql = "INSERT INTO localidades (
                nombre,
                fk_idprovincia          
           ) VALUES (?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->fk_idprovincia, 
            
        ]);
       return $this->idincidente = DB::getPdo()->lastInsertId();
    }
}

?>



    
    





