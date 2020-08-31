@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/sistema/menu">Men&uacute;</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/sistema/menu/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
    function fsalir() {
        location.href = "/sistema/menu";
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
    <div id="msg"></div>
    <?php
    if (isset($msg)) {
        echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
    }
    ?>
    <form id="form1" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="" required>
            <div class="form-group col-lg-6">
                <label>Nombre: *</label>
                <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $menu->nombre or '' }}" required>
            </div>

            <div class="form-group col-lg-6">
                <label>Orden:</label>
                <input type="number" id="txtOrden" name="txtOrden" class="form-control" value="{{$menu->orden or ''}}">
            </div>

            <div class="form-group col-lg-6">
                <label>URL:</label>
                <input type="text" id="txtUrl" name="txtUrl" class="form-control" value="{{$menu->url or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>CSS:</label>
                <input type="text" id="txtCss" name="txtCss" class="form-control" value="{{$menu->css or ''}}">
                <a href="https://fontawesome.com/icons?d=gallery" target="blank">Catálogo de íconos</a>
            </div>
        </div>

</div>
</div>
</form>
</div>



@endsection