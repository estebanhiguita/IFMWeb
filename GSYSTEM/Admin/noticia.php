<?php
require '_layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Noticia
            <small>Version 1.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Nosotros</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-2 col-sm-3"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 id="title-form" class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
                        <form id="frmNoticia" method="post" enctype="multipart/form-data">
                            <input type="hidden" readonly="true" name="txtIdNoticia" id="txtIdNoticia">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Titulo</label>
                                        <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" placeholder="Ejm:">
                                    </div>

                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" rows="5" style="resize:none" name="txtDescripcion" id="txtDescripcion" placeholder="Ejm:"></textarea> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input type="file" class="form-control" name="file" id="file" placeholder="Ejm:" required>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="text" class="form-control" name="txtUrl" id="txtUrl" placeholder="Ejm: ">
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
                        <h3 id="title-list" class="panel-title">Listado</h3>
                    </div>

                    <!-- Table -->
                    <table id="tblNoticia" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Imagen</th>
                                <th>Url (Link)</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody id="tblBodyNoticia">

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

<script type="text/javascript" src="dist/js/pages/noticia.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function($) {
        noticia.Listar();
    });

</script>