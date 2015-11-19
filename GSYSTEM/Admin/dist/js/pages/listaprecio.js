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

	listaPrecio.Init();
});

var listaPrecio = {
	Init:function(){
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#frmListaPrecio" );
		form.validate({
			messages: {
				imagen: "La imagen de la lista de precios es requerida.",
				pdf: "El pdf de la lista de precios es requerido."
			}
		});

		$( "#btnGuardar" ).click(function() {
			if (form.valid()) {
				listaPrecio.Guardar();
			};
		});

		listaPrecio.Listar();
	},
	Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteListaPrecio',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente.");
        listaPrecio.Listar();
      }else{
        alertify.error(response);
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
	Guardar:function(){

		$.ajax({
			url: url+'/GSYSTEM/api/createListaPrecio',
			type: 'POST',
			data: new FormData( document.getElementById("frmListaPrecio") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			listaPrecio.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	ModificarEstado:function(id, estado){

		$.ajax({
			url: url+'/GSYSTEM/api/updateEstadoListaPrecio',
			type: 'POST',
			data: {'id':id, 'estado':estado},
			dataType:'json'
		}).done(function(response){

			alertify.success(response.msj);
			listaPrecio.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){
  		$.ajax({
		    url: url+'/GSYSTEM/api/listarListaPrecio',
		    type: 'POST',
		    processData: false,
		    dataType:'json',
		    contentType: false
		  }).done(function(response){

		    var tblListaPrecio = $("#tblListaPrecio").dataTable();
		    tblListaPrecio.fnClearTable();
		    tblListaPrecio.fnDestroy();


		    $.each(response, function(index, item){

		      var boton = "";
		      if(item.estado == 0){
		        boton = "<a style='cursor:pointer' class='btn btn-success' onclick='listaPrecio.ModificarEstado({3}, 1)'>Activar</a>";
		      }else if(item.estado == 1){
		        boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='listaPrecio.ModificarEstado({3}, 0)'>Inactivar</a>";
		      }

		       var boton2 = "<a style='cursor:pointer' class='btn btn-danger' onclick='listaPrecio.Eliminar({4})'>Eliminar</a>";

		      var template =  "<tr> <td><img src='dist/upload/ListaPrecio/{0}' width='30px'/></td> <td> <a href='dist/upload/ListaPrecio/{1}' target='_blank' class='btn btn-info'>Abrir documento</a> </td> <td> {2} </td> <td>"+boton+"</td> <td>"+boton2+"</td> </tr>";
		      $("#tbodyListaPrecio").append(
		        String.format(template, 
			          item.url_imagen, 
			          item.url_pdf,
			          item.estado == 1?'Activo':'Inactivo',
			          item.id_lista_precio,
			          item.id_lista_precio
		          ));
		    });

		    tblListaPrecio = $('#tblListaPrecio').dataTable({
		      "language": {
		        "url": "dist/js/Spanish.json"
		      }
		    });

		    listaPrecio.Limpiar();
		  }).fail(function(response){

		    console.log(response);

		  });
	},
	Limpiar:function(){
		$("#imagen").val("");
		$("#pdf").val("");
	}
}