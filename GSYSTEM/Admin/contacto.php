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
      Contacto
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Contacto</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 id="title-list" class="panel-title">Listado de contactos</h3>
          </div>

          <!-- Table -->
          <table id="tblContacto" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Descripción</th>
                <th>Fecha contacto</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody id="tbodyContacto">

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

<script type="text/x-tmpl" id="tmpl-data-contacto">
  <tr>
    <td><b>{%=o.id_contacto%}</b></td>
    <td>{%=o.nombre%}</td>
    <td>{%=o.email%}</td>
    <td>{%=o.telefono%}</td>
    <td>{%=o.descripcion%}</td>
    <td>{%=o.fecha%}</td>
    <td>
      {% if(o.estado==1){ %}
        <button class="btn btn-block btn-success" id="btnEstadoContacto" 
        onclick='contacto.ModificarEstado({%=o.id_contacto%}, 0)'>
        Contactar</button>
      {% }else{ %}
        <p>Contactado</p>
      {% } %}
    </td>
  </tr>
</script>

<script src="dist/js/DataTableTools/js/dataTables.tableTools.min.js"></script>
<script src="dist/js/pages/contacto.js"></script>


