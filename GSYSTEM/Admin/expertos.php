<?php
require '_layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Equipo
            <small>Version 1.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Equipo</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 id="title-form" class="panel-title">Crear Equipo</h3>
                    </div>
                    <div class="panel-body">
                        <form id="frmExpertos" method="post" enctype="multipart/form-data">
                            <input type="hidden" readonly="true" name="txtIdExpertos" id="txtIdExpertos">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Ejm: Andres Felipe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profesion</label>
                                        <input type="text" class="form-control" name="txtSkype" id="txtSkype" placeholder="Ejm: AndresF" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Director comercial" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input type="file" class="form-control" name="file" id="file" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block" id="btnGuardar">
                                    Guardar
                                </button>

                                <button type="button" class="btn btn-warning btn-block" id="btnModificar" style="display:none">
                                    Modificar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h3 id="title-list" class="panel-title">Listado de expertos</h3>
                    </div>

                    <!-- Table -->
                    <table id="tblExpertos" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Profesion</th>
                                <th>Cargo</th>
                                <th>Imagen</th>
                                <th>Modificar      Estado</th>
                                <th>Seleccionar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tblBodyExpertos">

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

<script type="text/javascript" src="dist/js/pages/expertos.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function($) {
        expertos.Listar();
    });

</script>