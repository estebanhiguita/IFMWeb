<?php
require '_layout/header.php';
?>

<link rel="stylesheet" type="text/css" href="dist/js/DataTableTools/css/dataTables.tableTools.min.css">
<style>
  .table-img-marca {
    width: 70px;
    height: auto;
  }
  div.dataTables_filter {
  text-align: left !important;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Suscripciones
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Suscripciones</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 id="title-list" class="panel-title">Listado de suscripciones</h3>
          </div>

          <!-- Table -->
          <table id="tblSuscripciones" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Email</th>
                <th>Fecha suscripción</th>
              </tr>
            </thead>
            <tbody id="tbodySuscripciones">

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

<script type="text/x-tmpl" id="tmpl-data-suscripcion">
  <tr>
    <td><b>{%=o.id_suscripcion%}</b></td>
    <td>{%=o.email%}</td>
    <td>{%=o.fecha%}</td>
     
  </tr>
</script>

<script src="dist/js/DataTableTools/js/dataTables.tableTools.min.js"></script>
<script src="dist/js/pages/suscripcion.js"></script>


