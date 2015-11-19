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
  noticia.Init();
});


var noticia = {
  Init:function(){

    $('#txtFechaFin').attr("readonly","true");

    $('#txtFechaInicio').pickadate({
      format: 'yyyy-mm-dd',
      selectYears: true, 
      selectMonths: true,
      onClose: function() {
        //alert($('#txtFechaInicio').val());

        if($('#txtFechaInicio').val() != ""){
          $('#txtFechaFin').val("");
          $('#txtFechaFin').pickadate({
            format: 'yyyy-mm-dd',
            selectYears: true, 
            selectMonths: true,
            disable: [
            { from: -1000000, to:  new Date($('#txtFechaInicio').val()) }
            ]
          });

        }

        
      }
    });
    



    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });


    var form2 = $( "#frmNoticia" );
    form2.validate({
      rules: {
        txtTitulo: {
          required: true,
          minlength: 5
        },
        txtDescripcion: {
          required: true,
          minlength: 1
        },
        txtFechaInicio: {
          required: true,
          dateISO: true
        },
        txtFechaFin: {
          required: true,
          dateISO: true
        },
        txtUrl:{
          url: true,
          required: true,
          minlength: 1
        }
      },
      messages: {
        txtTitulo: {
          required: "El nombre de la noticia es requerido.",
          minlength: "Se requieren mínimo 5 caracteres"
        },
        txtDescripcion: {
          required: "La descripcion de la noticia es requerida.",
          minlength: "Se requieren mínimo 5 caracteres"
        },
        txtFechaInicio: {
          required: "La fecha inicial de la noticia es requerida.",
          dateISO: "La fecha inicial debe tener formato yyyy-mm-dd."
        },
        txtFechaFin: {
          required: "La fecha final de la noticia es requerida.",
          dateISO: "La fecha final debe tener formato yyyy-mm-dd."
        },
        txtUrl: {
          url: "Debe ser una url correcta.",
          required: "La Url de la noticia es requerida.",
          minlength: "Se requiere mínimo 1 caracter"
        },
        file: "La imagen del noticia es requerida"
      }
    });

$( "#btnGuardar" ).click(function() {
  if (form2.valid()) {
    noticia.Guardar();
  };
});

$( "#btnModificar" ).click(function() {
  if (form2.valid()) {
    noticia.Modificar();
  };
});
},
Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteNoticia',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente. ");
        noticia.Listar();
      }else{
        alertify.error("No se elimino correctamente. ");
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
Guardar:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/createNoticia',
    type: 'POST',
    data: new FormData( document.getElementById("frmNoticia") ),
    processData: false,
    dataType:'json',
    contentType: false
  }).done(function(response){

    alertify.success(response.msj);
    noticia.Listar();

  }).fail(function(response){

    console.log(response);

  });

},
Modificar:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/updateNoticia',
    type: 'POST',
    data: new FormData( document.getElementById("frmNoticia") ),
    processData: false,
    dataType:'json',
    contentType: false
  }).done(function(response){

    alertify.success(response.msj);
    noticia.Listar();

  }).fail(function(response){

    console.log(response);

  });
},
Listar:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/listarNoticia',
    type: 'POST',
    processData: false,
    dataType:'json',
    contentType: false
  }).done(function(response){

    var tableNoticia = $("#tblNoticia").dataTable();
    tableNoticia.fnClearTable();
    tableNoticia.fnDestroy();


    $.each(response, function(index, item){

      var boton = "";
      if(item.estado == 0){
        boton = "<a style='cursor:pointer' class='btn btn-success' onclick='noticia.ModificarEstado({10}, 1)'>Activar</a>";
      }else if(item.estado == 1){
        boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='noticia.ModificarEstado({10}, 0)'>Inactivar</a>";
      }

      var boton2 = "<a href='#' class='btn btn-primary' onclick='noticia.Edit({5}, {6}, {7}, {8}, {9}, {12})'>Editar</a>";

      var boton3 = "<a href='#' class='btn btn-danger' onclick='noticia.Eliminar({11})'>Eliminar</a>";

      var template =  "<tr> <td>{0}</td> <td>{1}</td> <td><img src='dist/upload/Noticias/{2}' width='30px'/></td> <td>{3}</td> <td>{4}</td> <td>{13}</td> <td>"+boton2+"</td><td>"+boton+"</td><td>"+boton3+"</td></tr>";
      $("#tblBodyNoticia").append(
        String.format(template, 
          item.titulo, 
          item.descripcion,
          item.url_imagen, 
          item.fecha_inicio, 
          item.fecha_fin, 
          '"'+item.id_noticia+'"', 
          '"'+item.titulo+'"', 
          '"'+item.descripcion+'"', 
          '"'+item.fecha_inicio+'"',
          '"'+item.fecha_fin+'"',
          item.id_noticia,
          item.id_noticia,
          '"'+item.url+'"',
          item.url

          ));
    });

    tableNoticia = $('#tblNoticia').dataTable({
      "language": {
        "url": "dist/js/Spanish.json"
      }
    });

    noticia.Limpiar();
  }).fail(function(response){

    console.log(response);

  });
},
ModificarEstado:function(id, estado){

    $.ajax({
      url: url+'/GSYSTEM/api/updateEstadoNoticia',
      type: 'POST',
      data: {'id':id, 'estado':estado},
      dataType:'json'
    }).done(function(response){

      alertify.success(response.msj);
      noticia.Listar();

    }).fail(function(response){

      console.log(response);

    });
  },
Edit:function(id, titulo, descripcion, fecha_inicio, fecha_final, url){

  $("#txtIdNoticia").val(id);
  $("#txtTitulo").val(titulo);
  $("#txtDescripcion").val(descripcion);
  $("#txtFechaInicio").val(fecha_inicio);
  $("#txtFechaFin").val(fecha_final);
  $("#txtUrl").val(url);

  $("#file").removeAttr("required");

  $("#btnGuardar").css("display","none");
  $("#btnModificar").css("display","block");
},
Limpiar:function(){

  $("#txtIdNoticia").val("");
  $("#txtTitulo").val("");
  $("#txtDescripcion").val("");
  $("#txtFechaInicio").val("");
  $("#txtFechaFin").val("");
  $("#txtUrl").val("");

  $("#file").attr("required","true");

  $("#btnGuardar").css("display","block");
  $("#btnModificar").css("display","none");
}
}