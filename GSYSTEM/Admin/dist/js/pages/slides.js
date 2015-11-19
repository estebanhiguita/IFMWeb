'use strict';

var url = '';


$(function () {
  
  if (!String.format) {
    String.format = function(format) {
          var args = Array.prototype.slice.call(arguments, 1);
          return format.replace(/{(\d+)}/g, function(match, number) { 
            return typeof args[number] != 'undefined'
            ? args[number] 
            : match
            ;
          });
      }
  }

  slides.Init();
});



var slides = {
  Init:function(){
    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });

    var form = $( "#my-dropzone" );
    form.validate({
      messages: {
        ddlUnidad: "La unidad de negocio es obligatoria",
        "txtUrl[]": {
          url:"La url no tiene un formato correcto",
          required:"La url es requerida"
        }
      }
    });

    slides.Listar();
  },
  Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteSlide',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente. ");
        slides.Listar();
      }else{
        alertify.error("No se elimino correctamente. ");
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
  Listar:function(){
      $.ajax({
        url: url+'/GSYSTEM/api/listarSlides',
        type: 'POST',
        processData: false,
        dataType:'json',
        contentType: false
      }).done(function(response){


        var tblSlides = $("#tblSlides").dataTable();
        tblSlides.fnClearTable();
        tblSlides.fnDestroy();

        $.each(response, function(index, item){

            var boton = "";
            if(item.estado == 0){
              boton = "<a style='cursor:pointer' class='btn btn-success' onclick='slides.ModificarEstado({4}, 1)'>Activar</a>";
            }else if(item.estado == 1){
              boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='slides.ModificarEstado({4}, 0)'>Inactivar</a>";
            }

            var boton2 = "<a style='cursor:pointer' class='btn btn-danger' onclick='slides.Eliminar({5})'>Eliminar</a>";

           
            var template =  "<tr><td><img src='dist/upload/Slides{0}' width='30px'/> </td><td>{1}</td></td><td>{2}</td><td>{3}</td><td>"+boton+"</td><td>"+boton2+"</td></tr>";

            $("#tblBodySlides").append(
              String.format(template, 
                item.url_imagen,
                item.negocio,
                item.url,
                item.estado==1?'Activo':'Inactivo',
                item.id_slide,
                item.id_slide
              ));
        });

         tblSlides = $('#tblSlides').dataTable({
            "language": {
              "url": "dist/js/Spanish.json"
            }
          });
      }).fail(function(response){

        console.log(response);

      });
  },
  ModificarEstado:function(id, estado){

    $.ajax({
      url: url+'/GSYSTEM/api/updateEstadoSlides',
      type: 'POST',
      data: {'id':id, 'estado':estado},
      dataType:'json'
    }).done(function(response){

      alertify.success(response.msj);
      slides.Listar();

    }).fail(function(response){

      console.log(response);

    });
  }

}