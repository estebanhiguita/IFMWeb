<?php
require '_layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Producto
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Producto</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Crear Productos</h3>
          </div>
          <div class="panel-body">
            <form id="frmProducto" method="post" enctype="multipart/form-data">
             <input type="hidden" readonly="true" name="txtIdProducto" id="txtIdProducto">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Ejm:">
                    </div>

                    <div class="form-group">
                      <label>Descripción</label>
                      <textarea class="form-control" rows="9" style="resize:none" name="txtDescripcion" id="txtDescripcion" placeholder="Ejm:"></textarea> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <label>Imagen</label>
                      <input type="file" class="form-control" name="file" id="file" placeholder="Ejm:" required>
                    </div>
                    <div class="form-group">
                      <label>Oferta</label>
                      <select class="form-control" name="ddlOferta" id="ddlOferta">
                        <option value="">Seleccionar</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Porcentaje oferta</label>
                      <input type="text" class="form-control" name="txtPorcentaje" id="txtPorcentaje" placeholder="Ejm:">
                    </div>
                    <div class="form-group">
                      <label>Destacado</label>
                      <select class="form-control" name="ddlDestacado" id="ddlDestacado">
                        <option value="">Seleccionar</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <label>Tipo producto</label>
                      <select class="form-control" name="ddlTipoProducto" id="ddlTipoProducto" required>
                        <option value="">Seleccionar</option>
                        <option value="1">General</option>
                        <option value="2">Servidor pequeño</option>
                        <option value="3">Servidor mediano</option>
                        <option value="4">Servidor grande</option>
                      </select>
                    </div>                 

                    <div class="form-group">
                      <label>Marca</label>
                      <select class="form-control" name="ddlMarca" id="ddlMarca">
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Precio</label>
                      <input type="text" class="form-control" name="txtPrecio" id="txtPrecio" placeholder="Ejm:">
                    </div>


                    <div class="form-group">
                      <label></label>
                      <button type="button" class="btn btn-success btn-block" id="btnGuardar">
                        Guardar
                      </button>

                      <button type="button" class="btn btn-warning btn-block" id="btnModificar" style="display:none">
                        Modificar
                      </button>
                    </div>
                </div>
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
            <h3 id="title-list" class="panel-title">Listado de productos</h3>
          </div>

          <!-- Table -->
          <table id="tblProducto" class="table table-hover">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>+ Infrmación</th>
                <th>Modificar Estado</th>
                <th>Seleccionar</th>
                <th>Galeria</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="tblBodyProducto">
              
            </tbody>
          </table>
          
          <div class="panel-footer">
          </div>

        </div>

      </div>
    </div>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="galeria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Galeria del producto #<span id="idProductoGaleriaSmall"></span></h4>
      </div>
      <div class="modal-body">

        <form action="/target" class="dropzone" id="my-dropzone">
            <div class="form-group" id="my-dropzone2">
              <input type="hidden" readOnly="true" id="idProductoGaleria" name="idProductoGaleria"/>
            </div>
        </form>
        <br>
                <button class="btn btn-success pull-right" id="submit-all2">Guardar</button>
        <br>
            <table id="tblGaleriaProducto" class="table table-hover">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Modificar estado</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="tblBodyGaleriaProducto">
              
            </tbody>
          </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="masProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Información adicional del producto</h4>
      </div>
      <div class="modal-body">

            <table id="tblMasInfo" class="table table-hover">
            <thead>
              <tr>
                <th>Oferta</th>
                <th>Porcentaje oferta</th>
                <th>Destacado</th>
                <th>Precio</th>
                <th>Tipo producto</th>
              </tr>
            </thead>
            <tbody id="tblBodyMasInfo">
              
            </tbody>
          </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>






<?php
require '_layout/footer.php';
?>

<script type="text/javascript" src="dist/js/pages/producto.js"></script>
<script type="text/javascript">

  jQuery(document).ready(function($) {
    producto.Listar();
    producto.ListarSelectMarca();

    Dropzone.options.myDropzone = {
      url: '/GSYSTEM/api/subirGaleria',
      autoProcessQueue: false,
      addRemoveLinks: true,
      uploadMultiple:true,
      parallelUploads: 50,
      init: function() {
        var submitButton = document.querySelector("#submit-all2")
            myDropzone = this; // closure

            submitButton.addEventListener("click", function() {
              myDropzone.processQueue(); // Tell Dropzone to process all queued files.
            });

            this.on("complete", function(data, response) {
              // If all files have been uploaded
              alertify.success("Se subio "+data.name);

              if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                var _this = this;
                // Remove all files
                _this.removeAllFiles();
              }
            });
            this.on("completemultiple", function(){
              producto.ListarGaleria($("#idProductoGaleria").val());
            });
            
      }
    };


  });

</script>