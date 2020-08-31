<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'descripcion', 'foto', 'video', 'stock', 'precio', 'precio_con_descuento', 'etiqueta', 'fk_idsucursal'
    ];

    protected $hidden = [

    ];

    function cargarDesdeRequest($request) {
        $this->idproducto = $request->input('id')!="0" ? $request->input('id') : $this->idproducto;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');
        $this->foto = $request->input('txtFoto');
        $this->video = $request->input('txtVideo');
        $this->stock = $request->input('txtStock');
        $this->precio = $request->input('txtPrecio');
        $this->precio_con_descuento = $request->input('txtPrecioConDescuento');
        $this->etiqueta = $request->input('txtEtiqueta');
        $this->fk_idsucursal = $request->input('fkIdSucursal');
    }


    public function obtenerTodos() {
        $sql = "SELECT 
                  A.idproducto,
                  A.nombre,
                  A.descripcion,
                  A.foto,
                  A.video,
                  A.stock,
                  A.precio,
                  A.precio_con_descuento,
                  A.etiqueta,
                  A.fk_idsucursal
                FROM productos A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    

    public function obtenerPorId($idproducto) {
        $sql = "SELECT
                idproducto,
                nombre,
                descripcion,
                foto,
                video,
                stock,
                precio,
                precio_con_descuento,
                etiqueta,
                fk_idsucursal
                FROM productos WHERE idproducto = '$idproducto'";
        $lstRetorno = DB::select($sql);

        if(count($lstRetorno)>0){
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->foto = $lstRetorno[0]->foto;
            $this->video = $lstRetorno[0]->video;
            $this->precio = $lstRetorno[0]->precio;
            $this->precio_con_descuento = $lstRetorno[0]->precio_con_descuento;
            $this->etiqueta = $lstRetorno[0]->etiqueta;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            return $this;
        }
        return null;
    }

   

    public  function eliminar() {
        $sql = "DELETE FROM productos WHERE 
            idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar() {
        $sql = "INSERT INTO productos (
                nombre,
                descripcion,
                foto,
                video,
                stock,
                precio,
                precio_con_descuento,
                etiqueta,
                fk_idsucursal
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
       $result = DB::insert($sql, [
            $this->nombre, 
            $this->descripcion, 
            $this->foto, 
            $this->video, 
            $this->precio,
            $this->precio_con_descuento,
            $this->etiqueta,
            $this->fk_idsucursal
        ]);
       return $this->idproducto = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE productos SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            foto=$this->foto,
            video='$this->video',
            precio='$this->precio',
            precio_con_descuento='$this->precio_con_descuento',
            etiqueta='$this->etiqueta',
            fk_idsucursal='$this->fk_idsucursal'
            WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idproducto]);
    }

   

}





?>