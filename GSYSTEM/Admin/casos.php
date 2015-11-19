<?php
require '_layout/header.php';
?>

<style>
  .table-img {
    width: 70px;
    height: auto;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Casos
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Casos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Crear Casos de Éxito</h3>
          </div>
          <div class="panel-body">
            <form id="frmCasos">
              <div class="form-group">
                <input type="hidden" class="form-control" id="idCaso" name="idCaso" placeholder="Ejm: 1" required>
                <label for="nombreCaso">Nombre caso de éxito</label>
                <input type="text" class="form-control" id="nombreCaso" name="nombreCaso" placeholder="Ejm: Laura" minlength="1" maxlength="30" required>
              </div>
              <div class="form-group">
              <label for="urlCaso">Imagen caso de éxito</label>
                <input type="file" class="form-control" id="urlCaso" name="urlCaso" required>
              </div>
              <div class="form-group">
              <input type="submit" id="btnGuardarCaso" class="btn btn-success btn-block" value="Guardar" />
                <input type="submit" id="btnModificarCaso" class="btn btn-warning btn-block" value="Modificar" />
                <button type="button" id="btnLimpiarCaso" class="btn btn-default btn-block" onclick="casos.Limpiar();">
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
            <h3 id="title-list" class="panel-title">Listado de Casos de Éxito</h3>
          </div>

          <!-- Table -->
          <table id="tblCasos" class="table table-hover">
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
            <tbody id="tbodyCasos">

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

<script type="text/x-tmpl" id="tmpl-data-casos">
  <tr>
    <td>
      <b>{%=o.id_caso_exito%}</b>
    </td>
    <td>{%=o.nombre%}</td>
    <td><img src="dist/upload/Casos/{%=o.url_imagen%}" class="table-img" alt="{%=o.nombre%}"></td>
    <td>
      {%=o.nombreEstado%}
    </td>
    <td>
      <button class="btn btn-block {%=o.estado == '1' ? "btn-danger": "btn-success" %}" id="btnEstadoCaso" onclick='casos.ModificarEstado({%=o.id_caso_exito%}, {%=o.estado == '1' ? 0 : 1%})'>{%=o.estado == '1' ? "Inactivar" : "Activar" %}</button>
    </td>
    <td>
      <button class="btn btn-block btn-primary" id="btnEditarCaso" onclick='casos.Edit({%=o.id_caso_exito%}, "{%=o.nombre%}", "{%=o.url_imagen%}")'>Editar</button>
    </td>
    <td>
      <button class="btn btn-block btn-danger" id="btneliminarCaso" onclick='casos.Eliminar({%=o.id_caso_exito%})'>Eliminar</button>
    </td>
  </tr>
</script>

<script src="dist/js/pages/casos.js"></script>

<script>
  jQuery(document).ready(function($) {
  });
  
</script>

