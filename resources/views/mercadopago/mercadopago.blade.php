@extends('plantilla')
@section('titulo', "$titulo")

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/sistema/menu">Medios de pago</a></li>
    <li class="breadcrumb-item active">Mercado Pago</li>
</ol>
<ol class="toolbar">
   
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-save" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-trash" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    <li class="btn-item"><a title="Salir" href="#" class="fas fa-sign-out-alt" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir(){
    location.href ="/sistema/menu";
}
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="panel-body">
        <div id = "msg"></div>
        <?php
        if (isset($msg)) {
            echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
        }
        ?>
        <form id="form1" method="POST">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>

                <div class="form-group col-lg-6">
                    <label>Nombre:</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $menu->nombre or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>CVU:</label>
                    <input type="number" id="txtCVU" name="txtCVU" class="form-control" value="{{ $menu->nombre or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Alias:</label>
                    <input type="text" id="txtAlias" name="txtAlias" class="form-control" value="{{ $menu->nombre or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>DNI:</label>
                    <input type="number" id="txtDNI" name="txtDNI" class="form-control" value="{{ $menu->nombre or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Correo:</label>
                    <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" value="{{ $menu->nombre or '' }}" required>
                </div>
            </div>
		
            </div>
        </form>
</div>
<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar registro?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">¿Deseas eliminar el registro actual?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" onclick="eliminar();">Sí</button>
          </div>
        </div>
      </div>
    </div>

@endsection