<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class ComboDetalle
{
    protected $table = 'combo_detalle';
    public $timestamps = false;

    protected $fillable = [
        'fk_idcombo', 'fk_idproducto'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->fk_idcombo = $request->input('id')!="0" ? $request->input('id') : $this->fk_idcombo;
        $this->fk_idproducto = $request->input('txtIdProducto');
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
           0 => 'A.nombre',
           1 => 'B.nombre',
           2 => 'A.url',
           3 => 'A.activo'
            );
        $sql = "SELECT DISTINCT
                    A.idmenu,
                    A.nombre,
                    B.nombre as padre,
                    A.url,
                    A.activo
                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idmenu
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql.=" OR A.url LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos() {
        $sql = "SELECT 
                  A.fk_idcombo,
                  A.fk_idproducto
                FROM combo_detalle A ORDER BY A.fk_idproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

       public function obtenerMenuPadre() {
        $sql = "SELECT DISTINCT
                  A.idmenu,
                  A.nombre
                FROM sistema_menues A
                WHERE A.id_padre = 0";

        $sql .= " ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerSubMenu($idmenu=null){
        if($idmenu){
            $sql = "SELECT DISTINCT
                      A.idmenu,
                      A.nombre
                    FROM sistema_menues A
                    WHERE A.idmenu <> '$idmenu'";

            $sql .= " ORDER BY A.nombre";
            $resultado = DB::select($sql);
        } else {
            $resultado = $this->obtenerTodos();
        }
        return $resultado;
    }

    public function obtenerPorId($fk_idcombo) {
        $sql = "SELECT
                fk_idcombo,
                fk_idproducto
                FROM combo_detalle WHERE fk_idcombo = '$fk_idcombo'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->fk_idcombo = $lstRetorno[0]->fk_idcombo;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE combo_detalle SET
            fk_idcombo='$this->fk_idcombo',
            fk_idproducto='$this->fk_idproducto'
            WHERE fk_idcombo=?";
        $affected = DB::update($sql, [$this->fk_idcombo]);
    }

    public  function eliminar() {
        $sql = "DELETE FROM combo_detalle WHERE 
            fk_idcombo=?";
        $affected = DB::delete($sql, [$this->fk_idcombo]);
    }

    public function insertar() {
        $sql = "INSERT INTO combo_detalle (
                fk_idcombo,
                fk_idproducto
            ) VALUES (?, ?);";
       $result = DB::insert($sql, [
            $this->fk_idcombo,
            $this->fk_idproducto
        ]);
       return $this->fk_idcombo = DB::getPdo()->lastInsertId();
    }

    public function obtenerMenuDelGrupo($idGrupo){
        $sql = "SELECT DISTINCT
        A.idmenu,
        A.nombre,
        A.id_padre,
        A.orden,
        A.url,
        A.css
        FROM sistema_menues A
        INNER JOIN sistema_menu_area B ON A.idmenu = B.fk_idmenu
        WHERE A.activo = '1' AND B.fk_idarea = $idGrupo ORDER BY A.orden";
        $resultado = DB::select($sql);
        return $resultado;
    }

}
