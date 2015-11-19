<?php
require '_layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Listado de precios
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Listado de precios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Crear listado de precios</h3>
          </div>
          <div class="panel-body">
            <form id="frmListaPrecio">
              <div class="form-group">
                <label for="imagen">Imagen Lista Precio</label>
                <input type="file" class="form-control" id="imagen" name="imagen" required>
              </div>
              <div class="form-group">
                <label for="pdf">Documento pdf</label>
                <input type="file" class="form-control" id="pdf" name="pdf" required>
              </div>
              <div class="form-group">
                <input type="submit" id="btnGuardar" class="btn btn-success btn-block" value="Guardar" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">

        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 id="title-list" class="panel-title">Listado de precios</h3>
          </div>

          <!-- Table -->
          <table id="tblListaPrecio" class="table table-hover">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Documento pdf</th>
                <th>Estado</th>
                <th>Modificar Estado</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="tbodyListaPrecio">

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

<script src="dist/js/pages/listaprecio.js"></script>