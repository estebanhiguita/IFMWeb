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
      Servicios
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Servicios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Modificar Servicios</h3>
          </div>
          <div class="panel-body">
            <form id="frmUnidades">
              <div class="form-group">
                <input type="hidden" class="form-control" id="idUnidad" name="idUnidad" placeholder="Ejm: 1" required>
                <label for="nombreUnidad">Nombre Servicio</label>
                <input  readonly="true" type="text" class="form-control" id="nombreUnidad" name="nombreUnidad" placeholder="Ejm: GPS Desarrollo" minlength="1" maxlength="30" required>
              </div>
              <div class="form-group">
                <label for="urlUnidad">Icono</label>
                <input type="file" class="form-control" id="urlUnidad2" name="urlUnidad2">
              </div>
              <div class="form-group">
                <label for="urlUnidad">Imagen</label>
                <input type="file" class="form-control" id="urlUnidad" name="urlUnidad">
              </div>

              <div class="form-group">
                <label for="urlVideo">Descripción</label>
                <input type="text" class="form-control" id="urlVideo" name="urlVideo" minlength="1" maxlength="80" required>
              </div>

              <div class="form-group">
                <!-- <input type="submit" id="" class="btn btn-success btn-block" value="Guardar" /> -->
                <input type="submit" id="btnModificarUnidad" class="btn btn-warning btn-block" value="Modificar" />
                <button type="button" id="btnLimpiarUnidad" class="btn btn-default btn-block" onclick="unidades.Limpiar();">
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
            <h3 id="title-list" class="panel-title">Listado de Servicios</h3>
          </div>

          <!-- Table -->
          <table id="tblUnidades" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Icono</th>
                <th>Imágen</th>
                <th>Descripción</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody id="tbodyUnidades">

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

<script type="text/x-tmpl" id="tmpl-data-unidades">
  <tr>
    <td>
      <b>{%=o.id_unidad_negocio%}</b>
    </td>
    <td>{%=o.nombre%}</td>
    <td><img src="dist/upload/Unidades/{%=o.url_logo%}" class="table-img" alt="{%=o.nombre%}"></td>
    <td><img src="dist/upload/Unidades/{%=o.url_imagen%}" class="table-img" alt="{%=o.nombre%}"></td>
    <td>{%=o.descripcion%}</td>
    <td>
      <button class="btn btn-block btn-primary" id="btnEditarUnidad" onclick='unidades.Edit({%=o.id_unidad_negocio%}, "{%=o.nombre%}", "{%=o.url_logo%}", "{%=o.url_imagen%}","{%=o.descripcion%}")'>Editar</button>
    </td>
  </tr>
</script>

<script src="dist/js/pages/unidades.js"></script>

<script>
  jQuery(document).ready(function($) {
  });
  
</script>

