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
                <label>Descripción:</label>
                <input class="form-control" type="text" name="txtDescripción" id="txtDescripción" cols="30" rows="10">
            </div>

            <div class="form-group col-lg-6">
                <label>Foto</label>
                <input type="file" id="archivo" name="archivo" class="form-control" value="{{$menu->url or ''}}" multiple>
            </div>
            <div class="form-group col-lg-6">
                <label>Vídeo</label>
                <input type="file" id="archivoV" name="archivoV" class="form-control" value="{{$menu->url or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Stock</label>
                <input type="number" id="txtStock" name="txtStock" class="form-control" value="{{$menu->url or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Precio</label>
                <input type="number" id="txtPrecio" name="txtPrecio" class="form-control" value="{{$menu->url or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Precio con descuento</label>
                <input type="number" id="txtPrecioDesc" name="txtPrecioDesc" class="form-control" value="{{$menu->url or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Etiqueta</label>
                <input type="text" id="txtEtiqueta" name="txtEtiqueta" class="form-control" value="{{$menu->url or ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label>Sucursal</label>
                <select name="lstSucursal" id="lstSucursal" class="form-control">
                    <option selected disabled value="">Seleccionar</option>
                    @for ($i = 0; $i < count($array_sucursal); $i++)
                     @if (isset($sucursal) and $array_sucursal[$i]->idsucursal == $producto->fk_idsucursal)
                        <option selected value="{{ $array_sucursal[$i]->idsucursal}}">{{ $array_sucursal[$i]->direccion}}</option>
                        @else
                        <option value="{{ $array_sucursal[$i]->idsucursal }}">{{ $array_sucursal[$i]->direccion}}</option>
                     @endif
                   @endfor
                </select>            
            </div>
        </div>

</div>
</div>
</form>
</div>



@endsection