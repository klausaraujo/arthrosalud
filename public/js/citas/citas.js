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
						'<div class="btn-group">'+
						/* Boton de Agregar detalle */
						'<a title="Agregar detalle del Turno" '+(data.activo === '1' && btnAsignaTurno? hrefAgregar:'')+' class="bg-light btnTable '+ 
							((data.activo === '0' || !btnAsignaTurno)? 'disabled':'')+' agregar" '+style+'>'+
							'<img src="'+base_url+'public/images/iconos/agregar.png" width="20"></a>'+
						/* Boton de edicion */
						'<a title="Editar Turno" '+(data.activo === '1' && btnEditTurno? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditTurno)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton anular proveedor */
						'<a title="Anular Turno" '+(data.activo === '1' && btnAnulaTurno? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnulaTurno)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'consultorio' },{ data: 'departamento' },{ data: 'nprof' },{ data: 'anio' },{ data: 'mes' },
				{ data: 'duracion_consulta' },
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Consultorio',targets: 1},{title:'Area',targets: 2},{title:'Profesional',targets: 3},
				{title:'A&ntilde;o',targets: 4},{title:'Mes',targets: 5},{title:'Duraci&oacute;n',targets: 6},//{title:'Status',targets: 8},
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
				{title:'Acciones',targets: 0},{title:'Establecimiento',targets: 1},{title:'Consultorio',targets: 2},
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
				type: 'POST',
				data: function(d){
					d.idconsultorio = $('.cons').val();
					d.iddepartamento = $('.cdep').val();
					d.idprofesional = $('.cprof').val();
					d.anio = $('.canio').val();
					d.activo = 1;
				}
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/citas/editar?id='+data.idcita+'"';
						let hrefConfirmar = 'href="'+base_url+'citas/citas/confirmar?id='+data.idcita+'"';
						let hrefAnular = 'href="'+base_url+'citas/citas/anular?id='+data.idcita+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Asignar Paciente" '+(data.activo === '1' && btnAsignaCita? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAsignaCita)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton de confirmacion */
						'<a title="Confirmación de Cita" '+(data.activo === '1' && btnConfirmaCita? hrefConfirmar:'')+' class="bg-light btnTable '+((data.activo === '0' || 
							!btnConfirmaCita)? 'disabled':'')+' confirma" '+style+'><img src="'+base_url+'public/images/iconos/evaluar_ico.png" '+
							'width="18" style="max-height:20px"></a>'+
						/* Boton anular cita */
						'<a title="Anular Cita" '+(data.activo === '1' && btnAnulaCita? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnulaCita)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'consultorio' },{ data: 'departamento' },{ data: 'nprof' },{ data: 'npac' },{ data: 'entrada' },{ data: 'salida' },
				{
					data: 'idpaciente',
					render: function(data){
						let var_status = '';
						switch(data){
							case '>1': var_status = '<span class="text-success">Asignado</span>'; break;
							case '1': var_status = '<span class="text-danger">Por Asignar</span>'; break;
						}
						return var_status;
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Consultorio',targets: 1},{title:'Area',targets: 2},{title:'Profesional',targets: 3},{title:'Paciente',targets: 4},
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
			let html = '';
			if((segmento === 'citas' && segmento2 == '') || segmento2 == 'citas')
				html = '';
			else html = '<option value="">-- Seleccione --</option>';
			$.each(data, function (i, e){ html += '<option value="' + e.idconsultorio + '">' + e.consultorio + '</option>'; });
			$('.cons').html(html);
			if((segmento === 'citas' && segmento2 == '') || segmento2 == 'citas')
				grillappal.ajax.reload();
		}
	});
});
$('.cdep').bind('change', function(){
	grillappal.ajax.reload();
});
$('.cprof').bind('change', function(){
	grillappal.ajax.reload();
});
$('.anio').bind('change', function(){
	grillappal.ajax.reload();
});
$('.cons').bind('change', function(){
	grillappal.ajax.reload();
});
$('#guardar-horarios').bind('click', function(event){
	event.preventDefault();
	let tr = document.querySelectorAll('.f-horas'), idturno = $('#idturno').val(), json = {}, valida = false, data = [];
	
	$.each($(tr),function(i,e){
		let f = $(e).find('.fecha'), e0 = $(e).find('.e'), e1 = $(e).find('.e1'), e2 = $(e).find('.e2');
		let s = $(e).find('.s'), s1 = $(e).find('.s1'), s2 = $(e).find('.s2');
		let sep0 = e0.val().split(':'), sep1 = s.val().split(':');
		let en = '', en2 = '', en3 = '', sa = '', sa2 = '', sa3 = '';
		if(parseInt(sep1[0]) > parseInt(sep0[0]) && parseInt(sep1[1]) >= parseInt(sep0[1]) && parseInt(sep0[0]) > 0){
			en = e0.val(), sa = s.val(), valida = true;
		}
		sep0 = e1.val().split(':'), sep1 = s1.val().split(':');
		if(parseInt(sep1[0]) > parseInt(sep0[0]) && parseInt(sep1[1]) >= parseInt(sep0[1]) && parseInt(sep0[0]) > 0){
			en2 = e0.val(), sa2 = s.val(), valida = true;
		}
		sep0 = e2.val().split(':'), sep1 = s2.val().split(':');
		if(parseInt(sep1[0]) > parseInt(sep0[0]) && parseInt(sep1[1]) >= parseInt(sep0[1]) && parseInt(sep0[0]) > 0){
			en3 = e0.val(), sa3 = s.val(), valida = true;
		}
		if(valida)
			data.push({idturno:idturno,fecha:f.val(),entrada1:en,salida1:sa,entrada2:en2,salida2:sa2,entrada3:en3,salida3:sa3});
			
		valida = false;
	});
	json.data = data;
	json.detalle = { duracion: $('#duracion').val(), dep: $('#iddep').val(), cons: $('#idcons').val(), prof: $('#idprof').val() }
	
	if(json.data.length > 0){
		$.ajax({
			data: JSON.stringify(json),
			url: base_url + 'citas/turnos/regdetalle',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				//$('.mensaje').removeClass('d-none');
				$('.mensaje').html('<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;Cargando...');
			},
			success: function (data) {
				//console.log(data);
				$('.mensaje').html(data.msg);
				setTimeout(function(){
					$('.mensaje').addClass('fade');
					window.location.href = base_url + 'citas/turnos/detalle?id=' + data.id;
				}, 1000);
				
			}
		});
	}
});