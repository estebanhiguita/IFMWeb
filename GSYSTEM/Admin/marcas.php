<?php
require '_layout/header.php';
?>

<style>
  .table-img-marca {
    width: 70px;
    height: auto;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Marcas
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Marcas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Crear Marcas</h3>
          </div>
          <div class="panel-body">
            <form id="frmMarcas">
              <div class="form-group">
                <input type="hidden" class="form-control" id="idMarca" name="idMarca" placeholder="Ejm: Lenovo" required>
                <label for="nombreMarca">Nombre marca</label>
                <input type="text" class="form-control" id="nombreMarca" name="nombreMarca" placeholder="Ejm: Lenovo" minlength="1" maxlength="30" required>
              </div>
              <div class="form-group">
              <label for="urlMarca">Imagen marca</label>
                <input type="file" class="form-control" id="urlMarca" name="urlMarca" required>
              </div>
              <div class="form-group">
              <input type="submit" id="btnGuardarMarca" class="btn btn-success btn-block" value="Guardar" />
                <input type="submit" id="btnModificarMarca" class="btn btn-warning btn-block" value="Modificar" />
                <button type="button" id="btnLimpiarMarca" class="btn btn-default btn-block" onclick="marcas.Limpiar();">
                  Limpiar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">

        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 id="title-list" class="panel-title">Listado de marcas</h3>
          </div>

          <!-- Table -->
          <table id="tblMarcas" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Foto</th>
                <th>Estado</th>
                <th>Modificar Estado</th>
                <th>Opciones</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="tbodyMarcas">

            </tbody>
          </table>
          
          <div class="panel-footer">
          </div>

        </div>

      </div>
    </div>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php
require '_layout/footer.php';
?>

<script type="text/x-tmpl" id="tmpl-data-marcas">
  <tr>
    <td>
      <b>{%=o.id_marca%}</b>
    </td>
    <td>{%=o.nombre%}</td>
    <td><img src="dist/upload/Marcas/{%=o.url%}" class="table-img-marca" alt="{%=o.nombre%}"></td>
    <td>
      {%=o.nombreEstado%}
    </td>
    <td>
      <button class="btn btn-block {%=o.estado == '1' ? "btn-danger": "btn-success" %}" id="btnEstadoMarca" onclick='marcas.ModificarEstado({%=o.id_marca%}, {%=o.estado == '1' ? 0 : 1%})'>{%=o.estado == '1' ? "Inactivar" : "Activar" %}</button>
    </td>
    <td>
      <button class="btn btn-block btn-primary" id="btnEditarMarca" onclick='marcas.Edit({%=o.id_marca%}, "{%=o.nombre%}", "{%=o.url%}")'>Editar</button>
    </td>
    <td>
      <button class="btn btn-block btn-danger" id="btnEliminar" onclick='marcas.Eliminar({%=o.id_marca%})'>Eliminar</button>
    </td>
  </tr>
</script>

<script src="dist/js/pages/marcas.js"></script>

<script>
  jQuery(document).ready(function($) {
  });
  
</script>

