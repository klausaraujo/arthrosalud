let grillappal = null;

$(document).ready(function (){
	if(segmento2 === 'turnos'){
		grillappal = $('#tablaTurnos').DataTable({
			ajax: {
				url: base_url + 'citas/turnos/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/turnos/editar?id='+data.idturno+'"';
						let hrefAnular = 'href="'+base_url+'citas/turnos/anular?id='+data.idturno+'"';
						let hrefAgregar = 'href="'+base_url+'citas/turnos/detalle?id='+data.idturno+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Turno" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton de Agregar detalle */
						'<a title="Agregar detalle del Turno" '+(data.activo === '1' && btnAgregar? hrefAgregar:'')+' class="bg-light btnTable '+((data.activo === '0' 
							|| !btnAgregar)? 'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/agregar.png" width="20"></a>'+
						/* Boton anular proveedor */
						'<a title="Anular Turno" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'consultorio' },{ data: 'departamento' },{ data: 'nombres' },{ data: 'apellidos' },{ data: 'anio' },{ data: 'mes' },
				{ data: 'duracion_consulta' },
				/*{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},*/
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Consultorio',targets: 1},{title:'Area',targets: 2},{title:'Nombres',targets: 3},{title:'Apellidos',targets: 4},
				{title:'A&ntilde;o',targets: 5},{title:'Mes',targets: 6},{title:'Duraci&oacute;n',targets: 7},//{title:'Status',targets: 8},
			], order: [],
		});
	}else if(segmento2 === 'medicos'){
		grillappal = $('#tablaMedicos').DataTable({
			ajax: {
				url: base_url + 'citas/medicos/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/medicos/editar?id='+data.idprofesional+'"';
						let hrefAnular = 'href="'+base_url+'citas/medicos/anular?id='+data.idprofesional+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Medico" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton anular proveedor */
						'<a title="Anular Medico" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'tipo_documento' },{ data: 'numero_documento' },{ data: 'nombres' },{ data: 'apellidos' },{ data: 'tipo_profesional' },{ data: 'especialidad' },
				{ data: 'celular' },{ data: 'correo' },
				/*{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},*/
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Tipo.Doc',targets: 1},{title:'Doc.',targets: 2},{title:'Nombres',targets: 3},{title:'Apellidos',targets: 4},
				{title:'Profesi&oacute;n',targets: 5},{title:'Especialidad',targets: 6},{title:'Celular',targets: 7},{title:'Correo',targets: 8},
			], order: [],
		});
	}else if(segmento2 === 'consultorios'){
		grillappal = $('#tablaConsultorios').DataTable({
			ajax: {
				url: base_url + 'citas/consultorios/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/consultorios/editar?id='+data.idconsultorio+'"';
						let hrefAnular = 'href="'+base_url+'citas/consultorios/anular?id='+data.idconsultorio+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Consultorio" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton anular proveedor */
						'<a title="Anular Consultorio" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'nombre_comercial' },{ data: 'consultorio' },
				/*{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},*/
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Nombre Establecimiento',targets: 1},{title:'Consultorio',targets: 2},
			], order: [],
		});
	}else if(segmento2 === 'pacientes'){
		grillappal = $('#tablaPacientes').DataTable({
			ajax: {
				url: base_url + 'citas/pacientes/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/pacientes/editar?id='+data.idprofesional+'"';
						let hrefAnular = 'href="'+base_url+'citas/pacientes/anular?id='+data.idprofesional+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Medico" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton anular proveedor */
						'<a title="Anular Medico" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'tipo_documento' },{ data: 'numero_documento' },{ data: 'nombres' },{ data: 'apellidos' },{ data: 'fechanac' },{ data: 'estado_civil' },
				{ data: 'celular' },{ data: 'correo' },
				/*{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},*/
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Tipo.Doc',targets: 1},{title:'Doc.',targets: 2},{title:'Nombres',targets: 3},{title:'Apellidos',targets: 4},
				{title:'Fecha Nac.',targets: 5},{title:'Estado Civil',targets: 6},{title:'Celular',targets: 7},{title:'Correo',targets: 8},
			], order: [],
		});
	}else if((segmento === 'citas' && segmento2 == '') || segmento2 === 'citas'){
		grillappal = $('#tablaCitas').DataTable({
			ajax: {
				url: base_url + 'citas/citas/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/citas/editar?id='+data.idcita+'"';
						let hrefAnular = 'href="'+base_url+'citas/citas/anular?id='+data.idcita+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Cita" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton de Agregar detalle */
						'<a title="Agregar detalle del Turno" '+(data.activo === '1' && btnAgregar? hrefAgregar:'')+' class="bg-light btnTable '+((data.activo === '0' 
							|| !btnAgregar)? 'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/agregar.png" width="20"></a>'+
						/* Boton anular cita */
						'<a title="Anular Cita" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'consultorio' },{ data: 'departamento' },{ data: 'nombres' },{ data: 'apellidos' },{ data: 'entrada' },{ data: 'salida' },
				{
					data: 'atendido',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Atendido</span>'; break;
							case '0': var_status = '<span class="text-danger">Pendiente</span>'; break;
						}
						return var_status;
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Consultorio',targets: 1},{title:'Area',targets: 2},{title:'M&eacute;dico',targets: 3},{title:'Paciente',targets: 4},
				{title:'H.Entrada',targets: 5},{title:'H.Salida',targets: 6},{title:'Status',targets: 7},//{title:'Status',targets: 8},
			], order: [],
		});
	}
});
$('.iddep').bind('change', function(){
	$.ajax({
		data: { idempresa: this.value },
		url: base_url + 'citas/turnos/consultorios',
		method: 'POST',
		dataType: 'JSON',
		beforeSend: function(){ $('.cons').html('<option> Cargando...</option>'); },
		success: function (data) {
			let html = '<option value="">-- Seleccione --</option>';
			console.log(data);
			$.each(data, function (i, e){ html += '<option value="' + e.idconsultorio + '">' + e.consultorio + '</option>'; });
			$('.cons').html(html);
			//console.log(data);
		}
	});
});
