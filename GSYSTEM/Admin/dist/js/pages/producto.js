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
  producto.Init();
});


var producto = {
  Init:function(){



    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });


    var form2 = $( "#frmProducto" );
    form2.validate({
      rules: {
        txtNombre: {
          required: true,
          minlength: 5
        },
        txtDescripcion: {
          required: true,
          minlength: 1
        },
        txtPorcentaje: {
          required: true,
          max: 100,
          min:0,
          number:true
        },
        txtPrecio: {
          required: true,
          min: 0,
          number:true
        },
        ddlOferta: {
          required: true
        },
        ddlDestacado: {
          required: true
        },
        ddlMarca: {
          required: true
        }
      },
      messages: {
        txtNombre: {
          required: "El nombre del producto es requerido.",
          minlength: "Se requieren mínimo 5 caracteres"
        },
        txtDescripcion: {
          required: "La descripción es requerida.",
          minlength: "Se requieren mínimo 5 caracteres"
        },
        txtPorcentaje: {
          required: "El porcetanje de la oferta es requerido.",
          min:"El valor minimo es 0",
          max:"El valor maximo es 100",
          number:"El porcentaje debe ser numerico"
        },
        txtPrecio: {
          required: "El precio es requerido.",
          minlength: "Se requieren mínimo 5 caracteres",
          min:"El valor minimo es 0",
          number:"El precio debe ser numerico"
        },
        ddlOferta: {
          required: "La oferta es requerida."
        },
        ddlDestacado: {
          required: "Destacado es requerido."
        },
        ddlMarca: {
          required: "La marca es requerida."
        },
        file: "La imagen del producto es requerida",
        ddlTipoProducto: "El tipo de producto es requerido."
      }
    });

$( "#btnGuardar" ).click(function() {
  if (form2.valid()) {
    producto.Guardar();
  };
});

$( "#btnModificar" ).click(function() {
  if (form2.valid()) {
    producto.Modificar();
  };
});


},
EliminarProducto:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteProductos',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente. ");
        producto.Listar();
      }else{
        alertify.error(response);
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },

  EliminarGaleria:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteGaleria',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente. ");
        producto.ListarGaleria($("#idProductoGaleria").val());
      }else{
        alertify.error("No se elimino correctamente");
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
Guardar:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/createProducto',
    type: 'POST',
    data: new FormData( document.getElementById("frmProducto") ),
    processData: false,
    dataType:'json',
    contentType: false
  }).done(function(response){

    alertify.success(response.msj);
    producto.Listar();
    producto.Galeria(response.id);

  }).fail(function(response){

    console.log(response);

  });

},
Modificar:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/updateProducto',
    type: 'POST',
    data: new FormData( document.getElementById("frmProducto") ),
    processData: false,
    dataType:'json',
    contentType: false
  }).done(function(response){

    alertify.success(response.msj);
    producto.Listar();

  }).fail(function(response){

    console.log(response);

  });
},
ModificarEstado:function(id, estado){

  $.ajax({
    url: url+'/GSYSTEM/api/updateEstadoProducto',
    type: 'POST',
    data: {'id':id, 'estado':estado},
    dataType:'json'
  }).done(function(response){

    alertify.success(response.msj);
    producto.Listar();

  }).fail(function(response){

    console.log(response);

  });
},
Listar:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/listarProducto',
    type: 'POST',
    processData: false,
    dataType:'json',
    contentType: false
  }).done(function(response){

    var tableProducto = $("#tblProducto").dataTable();
    tableProducto.fnClearTable();
    tableProducto.fnDestroy();


    $.each(response, function(index, item){

      var boton = "";
      if(item.estado == 0){
        boton = "<a style='cursor:pointer' class='btn btn-success' onclick='producto.ModificarEstado({9}, 1)'>Activar</a>";
      }else if(item.estado == 1){
        boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='producto.ModificarEstado({9}, 0)'>Inactivar</a>";
      }
      var boton2 = "<a href='#' class='btn btn-primary' onclick='producto.Edit({10}, {11}, {12}, {13}, {14}, {15}, {16}, {17}, {18})'>Editar</a>";

      var boton3 = "<a style='cursor:pointer' class='btn btn-info' onclick='producto.Galeria({19})'>Ver galeria</a>";

      var boton5 = "<a style='cursor:pointer' class='btn btn-danger' onclick='producto.EliminarProducto({20})'>Eliminar</a>";

      var boton4 = "<a style='cursor:pointer' class='btn btn-info' onclick='producto.verMas({4}, {5}, {6}, {7}, {8})'>Ver mas</a>";

      var template =  "<tr> <td>{0}</td> <td>{1}</td> <td><img src='dist/upload/Productos/{2}' width='30px'/></td> <td>{3}</td> <td>"+boton4+"</td> <td>"+boton+"</td>  <td>"+boton2+"</td>  <td>"+boton3+"</td> <td>"+boton5+"</td>  </tr>";
      
      var of = item.oferta=='1'?'Si':'No';
      var dt = item.destacado=='1'?'Si':'No' ;

      $("#tblBodyProducto").append(
        String.format(template, 
          item.nombre, 
          item.descripcion,
          item.url, 
          item.marca, 

          '"'+of+ '"',
          '"'+item.porcentaje_oferta+'"',
          '"'+dt+'"', 
          '"'+item.precio+'"',
          item.tipo_producto,

          item.id_producto, 
          '"'+item.id_producto+'"', 
          '"'+item.nombre+'"', 
          '"'+item.descripcion+'"', 
          '"'+item.oferta+'"',
          '"'+item.destacado+'"',
          '"'+item.id_marca+'"',
          '"'+item.precio+'"',
          '"'+item.porcentaje_oferta+'"',
          '"'+item.tipo_producto+'"',
          '"'+item.id_producto+'"',
          '"'+item.id_producto+'"'
          ));
    });

tableProducto = $('#tblProducto').dataTable({
  "language": {
    "url": "dist/js/Spanish.json"
  }
});
producto.Limpiar();
}).fail(function(response){

  console.log(response);

});
},
verMas:function(oferta, porOferta, destacado, precio, tipoProducto){

    var tp = "";

    if(tipoProducto == 1){
      tp = "General";
    }else if(tipoProducto == 2){
      tp = "Servidor pequeño";
    }else if(tipoProducto == 3){
      tp = "Servidor mediano";
    }else if(tipoProducto == 4){
      tp = "Servidor grande";
    }

    var tabla = "<tr><td>"+oferta+"</td><td>"+porOferta+"</td><td>"+destacado+"</td><td>"+precio+"</td><td>"+tp+"</td></tr>";

    $("#tblBodyMasInfo").empty();

    $("#tblBodyMasInfo").append(tabla);

    $("#masProducto").modal();

},
Edit:function(id, nombre, descripcion, oferta, destacado, marca, precio, porcentaje, tipoProducto){
  
  $("#txtIdProducto").val(id);
  $("#txtNombre").val(nombre);
  $("#txtDescripcion").val(descripcion);
  $("#ddlOferta").val(oferta);
  $("#ddlDestacado").val(destacado);
  $("#ddlMarca").val(marca);
  $("#txtPrecio").val(precio);
  $("#txtPorcentaje").val(porcentaje);
  $("#ddlTipoProducto").val(tipoProducto);

  $("#file").removeAttr("required");

  $("#btnGuardar").css("display","none");
  $("#btnModificar").css("display","block");
},
Limpiar:function(){
  
  $("#txtIdProducto").val("");
  $("#txtNombre").val("");
  $("#txtDescripcion").val("");
  $("#ddlOferta").val("");
  $("#ddlDestacado").val("");
  $("#ddlMarca").val("");
  $("#file").val("");
  $("#txtPrecio").val("");
  $("#txtPorcentaje").val("");
  $("#ddlTipoProducto").val("");

  $("#file").attr("required","true");

  $("#btnGuardar").css("display","block");
  $("#btnModificar").css("display","none");
},
ListarSelectMarca:function(){
  $.ajax({
    url: url+'/GSYSTEM/api/listarMarcasActivas',
    type: 'GET',
    dataType:'json'
  }).done(function(response){

    $("#ddlMarca").empty();

    $("#ddlMarca").append(
      String.format("<option value='{0}'>{1}</option>", 
        "", 
        "Seleccionar"
        ));

    $.each(response, function(index, item){

      var template =  "<option value='{0}'>{1}</option>";
      $("#ddlMarca").append(
        String.format(template, 
          item.id_marca, 
          item.nombre
          ));
    });

  }).fail(function(response){

    alertify.success(response);

  });
},
Galeria:function(id){
  $("#idProductoGaleria").val(id);
  $("#idProductoGaleriaSmall").html(id);

  producto.ListarGaleria(id);

  $("#galeria").modal();
},
ListarGaleria:function(id){
  $.ajax({
    url: url+'/GSYSTEM/api/listarGaleriaProducto',
    type: 'POST', 
    data:{'id':id},
    dataType:'json'
  }).done(function(response){

    var tableProducto = $("#tblGaleriaProducto").dataTable();
    tableProducto.fnClearTable();
    tableProducto.fnDestroy();


    $.each(response, function(index, item){

      var boton = "";
      if(item.estado == 0){
        boton = "<a style='cursor:pointer' class='btn btn-success' onclick='producto.ModificarGaleriaEstado({2}, 1)'>Activar</a>";
      }else if(item.estado == 1){
        boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='producto.ModificarGaleriaEstado({2}, 0)'>Inactivar</a>";
      }

      var boton5 = "<a style='cursor:pointer' class='btn btn-danger' onclick='producto.EliminarGaleria({3})'>Eliminar</a>";

      var template =  "<tr><td><img src='dist/upload/Productos{0}' width='30px'/> </td><td>{1}</td><td>"+boton+"</td><td>"+boton5+"</td></tr>";
      $("#tblBodyGaleriaProducto").append(
        String.format(template, 
          item.url_imagen, 
          item.estado==1?'Activo':'Inactivo', 
          item.id_galeria,
          item.id_galeria
          ));
    });

    tableProducto = $('#tblGaleriaProducto').dataTable({
      "language": {
        "url": "dist/js/Spanish.json"
      }
    });
    producto.Limpiar();
  }).fail(function(response){

    console.log(response);

  });
},
ModificarGaleriaEstado:function(id, estado){

  $.ajax({
    url: url+'/GSYSTEM/api/updateEstadoGaleriaProducto',
    type: 'POST',
    data: {'id':id, 'estado':estado},
    dataType:'json'
  }).done(function(response){

    alertify.success(response.msj);
    producto.ListarGaleria($("#idProductoGaleria").val());

  }).fail(function(response){

    console.log(response);

  });
}
}