<?php
require '_layout/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Slides
      <small>Version 1.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Slides</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 id="title-form" class="panel-title">Crear Slides</h3>
          </div>
          <div class="panel-body">
            <form action="/target" class="dropzone" id="my-dropzone">
                <div class="form-group">
                  <label for="">Unidad Negocio</label>
                  <select class="form-control" id="ddlUnidad" name="ddlUnidad" required>
                  </select>
                </div>
            </form>
            <br>
            <button class="btn btn-primary pull-right" id="submit-all">Guardar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 id="title-list" class="panel-title">Listado de imagenes</h3>
          </div>

          <!-- Table -->
          <table id="tblSlides" class="table table-hover">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Unidad de negocio</th>
                <th>Url</th>
                <th>Estado</th>
                <th>Modificar estado</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="tblBodySlides">
              
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

<script type="text/javascript" src="dist/js/pages/slides.js"></script>
<script type="text/javascript">

  jQuery(document).ready(function($) {

    unidadNegocio.ListarSelect();


    Dropzone.options.myDropzone = {
      url: '/GSYSTEM/api/createSlides',
      autoProcessQueue: false,
      addRemoveLinks: true,
      uploadMultiple:true,
      parallelUploads: 50,
      init: function() {
            var submitButton = document.querySelector("#submit-all")
            myDropzone = this; // closure
            

            submitButton.addEventListener("click", function() {
                var form = $( "#my-dropzone" );
                if (form.valid()) {
                      myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                };
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

            this.on("addedfile", function(file) { 
              $(".dz-preview input").remove();
              $(".dz-preview").append("<input type='url' name='txtUrl[]' name='txtUrl[]' placeholder='Url' required/>"); 
            });

            this.on("completemultiple", function(){
              slides.Listar();
            });
            
      }
    };
  });

</script>