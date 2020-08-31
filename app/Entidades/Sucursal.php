<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
require app_path().'/start/constants.php';

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'fk_iddireccion',
        'fk_idlocalidad', 
        'fk_idprovincia'
    ];

    function cargarDesdeRequest($request) {
        $this->idsucursal = $request->input('id')!="0" ? $request->input('id') : $this->idsucursal;
        $this->fk_iddireccion = $request->input('lstDireccion');
        $this->fk_idlocalidad = $request->input('lstLocalidad');
        $this->fk_idprovincia = $request->input('lstProvincia');

    }


    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idsucursal,
                  A.fk_iddireccion,
                  A.fk_idlocalidad,
                  A.fk_idprovincia
                FROM sucursales A ORDER BY idsucursal";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idsucursal) {
        $sql = "SELECT
                idsucursal,
                fk_iddireccion,
                fk_idlocalidad,
                fk_idprovincia
                FROM sucursales WHERE idsucursal = '$idsucursal'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->fk_iddireccion = $lstRetorno[0]->fk_iddireccion;
            $this->fk_idlocalidad = $lstRetorno[0]->fk_idlocalidad;
            $this->fk_idprovincia = $lstRetorno[0]->fk_idprovincia;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE sucursales SET
            fk_iddireccion='$this->fk_iddireccion',
            fk_idlocalidad='$this->fk_idlocalidad',
            fk_idprovincia='$this->fk_idprovincia',
            WHERE idsucursal=?";
        $affected = DB::update($sql, [$this->idsucursal]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM sucursales WHERE 
            idsucursal=?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }

    public function insertar() {
        $sql = "INSERT INTO sucursales (
                    fk_iddireccion,
                    fk_idlocalidad,
                    fk_idprovincia
                    ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [$this->fk_iddireccion, $this->fk_idlocalidad, $this->fk_idprovincia]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }


}

?>