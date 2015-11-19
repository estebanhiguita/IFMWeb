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

	niff.Init();
});

var niff = {
	Init:function(){
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#frmNiff" );
		form.validate({
			messages: {
				imagen: "La imagen del NIFF es requerida."
			}
		});

		$( "#btnGuardar" ).click(function() {
			if (form.valid()) {
				niff.Guardar();
			};
		});

		niff.Listar();
	},
		Eliminar:function(id){
    $.ajax({
      url: url+'/GSYSTEM/api/deleteNiff',
      type: 'POST',
      data: {"id":id},
      dataType:'json'
    }).done(function(response){

      if(response==true){
        alertify.success("Se elimino correctamente.");
        niff.Listar();
      }else{
        alertify.error(response);
      }
      
    }).fail(function(response){

      console.log(response);

    });
  },
	Guardar:function(){

		$.ajax({
			url: url+'/GSYSTEM/api/createNiff',
			type: 'POST',
			data: new FormData( document.getElementById("frmNiff") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			alertify.success(response.msj);
			niff.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	ModificarEstado:function(id, estado){

		$.ajax({
			url: url+'/GSYSTEM/api/updateEstadoNiff',
			type: 'POST',
			data: {'id':id, 'estado':estado},
			dataType:'json'
		}).done(function(response){

			alertify.success(response.msj);
			niff.Listar();

		}).fail(function(response){

			console.log(response);

		});
	},
	Listar:function(){
  		$.ajax({
		    url: url+'/GSYSTEM/api/listarNiff',
		    type: 'POST',
		    processData: false,
		    dataType:'json',
		    contentType: false
		  }).done(function(response){

		    var tableNiff = $("#tblNiff").dataTable();
		    tableNiff.fnClearTable();
		    tableNiff.fnDestroy();


		    $.each(response, function(index, item){

		      var boton = "";
		      if(item.estado == 0){
		        boton = "<a style='cursor:pointer' class='btn btn-success' onclick='niff.ModificarEstado({2}, 1)'>Activar</a>";
		      }else if(item.estado == 1){
		        boton = "<a style='cursor:pointer' class='btn btn-danger' onclick='niff.ModificarEstado({2}, 0)'>Inactivar</a>";
		      }

		       var boton2 = "<a style='cursor:pointer' class='btn btn-danger' onclick='niff.Eliminar({3})'>Eliminar</a>";


		      var template =  "<tr> <td><img src='dist/upload/Niff/{0}' width='30px'/></td> <td> {1} </td> <td>"+boton+"</td>  <td>"+boton2+"</td> </tr>";
		      $("#tbodyNiff").append(
		        String.format(template, 
			          item.url_imagen, 
			          item.estado == 1?'Activo':'Inactivo',
			          item.id_niff,
			          item.id_niff
		          ));
		    });

		    tableNiff = $('#tblNiff').dataTable({
		      "language": {
		        "url": "dist/js/Spanish.json"
		      }
		    });

		    niff.Limpiar();
		  }).fail(function(response){

		    console.log(response);

		  });
	},
	Limpiar:function(){
		$("#imagen").val("");
	}
}