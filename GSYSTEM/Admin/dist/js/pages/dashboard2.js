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

});

var unidadNegocio ={
  ListarSelect:function(){
    $.ajax({
        url: url+'/GSYSTEM/api/selectUnidadNegocioActivas',
        type: 'POST',
        dataType:'json',
        processData: false,
        contentType: false
      }).done(function(response){

        $("#ddlUnidad").empty();

        $("#ddlUnidad").append(
              String.format("<option value='{0}'>{1}</option>", 
                "", 
                "Seleccionar"
        ));

        $.each(response, function(index, item){

            var template =  "<option value='{0}'>{1}</option>";
            $("#ddlUnidad").append(
              String.format(template, 
                item.id_unidad_negocio, 
                item.nombre
            ));
        });

      }).fail(function(response){

        console.log(response);

      });
  }
}

