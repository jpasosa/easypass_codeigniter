function get_localidades_by_provincia(id,action,id_localidad) {
	if(!id_localidad) {
		id_localidad = '';
	}
	$.ajax({
		url : _public_folder + 'admin/localizaciones/get_localidades_by_provincia',
		type : 'post',
		dataType : 'html',
		data : {
			 id_provincia : id
			,action: action
			,id_localidad: id_localidad
		},
		success : function(localidades) {
			$('#codigo_postal').attr('placeholder','Ingrese el código postal');
			$('#id_localidad').html(localidades);
		},
		error : function(e) {
			alert('Error: no se pueden obtener las localidades');
			//console.log(e);
		}
	});
}

function get_localidad_by_id(id_localidad) {
	$.ajax({
		url: _public_folder + 'admin/localizaciones/get_localidad_by_id',
		dataType: 'json',
		type: 'post',
		data: {id_localidad: id_localidad},
		success: function(localidad) {
			if(localidad.localidad && localidad.codigo_postal) {
				$('#codigo_postal').attr('placeholder',localidad.localidad + ", código postal: " + localidad.codigo_postal);
			} else {
				$('#codigo_postal').attr('placeholder','Ingrese el código postal');
			}
			//console.log(localidad);
		},
		error: function(e) {
			alert('Error: no se pudo obtener el código postal');
			//console.log(e);
		}
	});
}