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
      Partners
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Partners</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Crear Partners</h3>
          </div>
          <div class="panel-body">
            <form id="frmPartners">
              <div class="form-group">
                <input type="hidden" class="form-control" id="idPartner" name="idPartner" placeholder="Ejm: Lenovo" required>
                <label for="nombrePartner">Nombre partner</label>
                <input type="text" class="form-control" id="nombrePartner" name="nombrePartner" placeholder="Ejm: Lenovo" minlength="1" maxlength="30" required>
              </div>
              <div class="form-group">
              <label for="urlPartner">Imagen partner</label>
                <input type="file" class="form-control" id="urlPartner" name="urlPartner" required>
              </div>
              <div class="form-group">
              <input type="submit" id="btnGuardarPartner" class="btn btn-success btn-block" value="Guardar" />
                <input type="submit" id="btnModificarPartner" class="btn btn-warning btn-block" value="Modificar" />
                <button type="button" id="btnLimpiarPartner" class="btn btn-default btn-block" onclick="partners.Limpiar();">
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
            <h3 id="title-list" class="panel-title">Listado de Partners</h3>
          </div>

          <!-- Table -->
          <table id="tblPartners" class="table table-hover">
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
            <tbody id="tbodyPartners">

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

<script type="text/x-tmpl" id="tmpl-data-partners">
  <tr>
    <td>
      <b>{%=o.id_partner%}</b>
    </td>
    <td>{%=o.nombre%}</td>
    <td><img src="dist/upload/Partners/{%=o.url_imagen%}" class="table-img" alt="{%=o.nombre%}"></td>
    <td>
      {%=o.nombreEstado%}
    </td>
    <td>
      <button class="btn btn-block {%=o.estado == '1' ? "btn-danger": "btn-success" %}" id="btnEstadoPartner" onclick='partners.ModificarEstado({%=o.id_partner%}, {%=o.estado == '1' ? 0 : 1%})'>{%=o.estado == '1' ? "Inactivar" : "Activar" %}</button>
    </td>
    <td>
      <button class="btn btn-block btn-primary" id="btnEditarPartner" onclick='partners.Edit({%=o.id_partner%}, "{%=o.nombre%}", "{%=o.url_imagen%}")'>Editar</button>
    </td>
        <td>
      <button class="btn btn-block btn-danger" id="btneliminarPartner" onclick='partners.Eliminar({%=o.id_partner%})'>Eliminar</button>
    </td>
  </tr>
</script>

<script src="dist/js/pages/partners.js"></script>

<script>
  jQuery(document).ready(function($) {
  });
  
</script>

