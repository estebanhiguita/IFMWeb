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

  expertos.Init();
});


var expertos = {
  Init:function(){
    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });

    var form = $( "#frmExpertos" );
    form.validate({
      rules: {
        txtNombre: {
          required: true,
          minlength: 5
        },
        txtSkype: {
          required: true,
          minlength: 2
        }
      },
      messages: {
        txtNombre: {
          required: "El nombre del experto es requerido.",
          minlength: "Se requieren mínimo 5 caracteres"
        },
        txtSkype: {
          required: "El email es requerido.",
          minlength: "Se requieren mínimo 2 caracteres"
        },
        txtEmail: {
          required: "El skype es requerido.",
          minlength: "Se requieren mínimo 2 caracteres",
          email: "Debe ser un email correcto"
        },
        txtTelefono: {
          required: "El telefono es requerido.",
          minlength: "Se requieren mínimo 7 caracteres"
        },
        file: "La imagen del experto es requerida"
      }
    });

    $( "#btnGuardar" ).click(function() {
      if (form.valid()) {
        expertos.Guardar();
      };
    });

    $( "#btnModificar" ).click(function() {
      if (form.valid()) {
        expertos.Modificar();
      };
    });
  },
  Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteExpertos',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente.");
        expertos.Listar();
      }else{
        alertify.error("No fue posible eliminar.");
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
  Guardar:function(){
    $.ajax({
      url: url+'/GSYSTEM/api/createExpertos',
      type: 'POST',
      data: new FormData( document.getElementById("frmExpertos") ),
      processData: false,
      dataType:'json',
      contentType: false
    }).done(function(response){

      alertify.success(response.msj);
      expertos.Listar();

    }).fail(function(response){

      console.log(response);

    });

  },
  Modificar:function(){
    $.ajax({
      url: url+'/GSYSTEM/api/updateExpertos',
      type: 'POST',
      data: new FormData( document.getElementById("frmExpertos") ),
      processData: false,
      dataType:'json',
      contentType: false
    }).done(function(response){

      alertify.success(response.msj);
      expertos.Listar();

    }).fail(function(response){

      console.log(response);

    });
  },
  ModificarEstado:function(id, estado){
    $.ajax({
      url: url+'/GSYSTEM/api/updateEstadoExpertos',
      type: 'POST',
      data: {'id':id, 'estado':estado},
      dataType:'json'
    }).done(function(response){

      alertify.success(response.msj);
      expertos.Listar();

    }).fail(function(response){

      console.log(response);

    });
  },
  Listar:function(){
    $.ajax({
      url: '../api/listarExpertos',
      type: 'POST',
      processData: false,
      dataType:'json',
      contentType: false
    }).done(function(response){
        console.log(response);


      var tableExpertos = $("#tblExpertos").dataTable();
      tableExpertos.fnClearTable();
      tableExpertos.fnDestroy();

      $.each(response, function(index, item){

        var boton = "";
        if(item.estado == 0){
          boton = "<a style='cursor:pointer' class='btn btn-success' onclick='expertos.ModificarEstado({6}, 1)'>Activar</a>";
        }else if(item.nombre != null){
          boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='expertos.ModificarEstado({6}, 0)'>Inactivar</a>";
        }
        var boton2 = "<a href='#' class='btn btn-primary' onclick='expertos.Edit({7}, {8}, {9}, {10}, {11}, {12})'>Editar</a>";
        
        var boton3 = "<a href='#' class='btn btn-danger' onclick='expertos.Eliminar({13})'>Eliminar</a>";

        var template =  "<tr><td>{0}</td><td>{1}</td><td>{2}</td><td>{3}</td><td><img src='dist/upload/Expertos/{4}' width='30px'/> </td><td>{5}</td><td>"+boton+"</td><td>"+boton2+"</td><td>"+boton3+"</td></tr>";
        $("#tblBodyExpertos").append(
          String.format(template, 
            item.nombre, 
            item.profesion,
            item.cargo,
            item.url,  
            item.id_expertos, 
            '"'+item.id_expertos+'"', 
            '"'+item.nombre+'"', 
            '"'+item.profesion+'"', 
            '"'+item.cargo+'"',
            item.id_expertos
            ));
      });

tableExpertos = $('#tblExpertos').dataTable({
  "language": {
    "url": "Spanish.json"
  }
});
expertos.Limpiar();
}).fail(function(response){

  console.log('respuesta del servidor con listar',response);

});
},
Edit:function(id, nombre, skype, email, telefono, unidad){

  $("#txtIdExpertos").val(id);
  $("#txtNombre").val(nombre);
  $("#txtSkype").val(skype);
  $("#txtEmail").val(email);
  $("#txtTelefono").val(telefono);
  $("#ddlUnidad").val(unidad);

  $("#file").removeAttr("required");

  $("#btnGuardar").css("display","none");
  $("#btnModificar").css("display","block");
},
Limpiar:function(){

  $("#txtIdExpertos").val("");
  $("#txtNombre").val("");
  $("#txtSkype").val("");
  $("#txtEmail").val("");
  $("#txtTelefono").val("");
  $("#ddlUnidad").val("");
  $("#file").val("");

  $("#file").attr("required","true");


  $("#btnGuardar").css("display","block");
  $("#btnModificar").css("display","none");
}
}
