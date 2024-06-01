let grillappal = null, tablaPacientes = null, cie = null, tablaCIE = null, proc = null;

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
					d.mes = $('.m').val();
					d.dia = $('.d').val();
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
						let hrefConfirmar = 'href="'+base_url+'citas/citas/cerrar?id='+data.idcita+'"';
						let hrefAnular = 'href="'+base_url+'citas/citas/desasignar?id='+data.idcita+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Asignar Paciente" '+(data.atendido === '0' && data.idpaciente === '1' && btnAsignaCita? hrefEdit:'')+' class="bg-light btnTable '+
							((data.idpaciente !== '1' || !btnAsignaCita || data.atendido === '1')?
							'disabled':'')+' asigna" '+style+' data-target="#modalAsigna" data-toggle="modal"><img src="'+base_url+'public/images/iconos/edit_ico.png"'+
							' width="20"></a>'+
						/* Boton de confirmacion */
						'<a title="Confirmación de Cita" '+(data.atendido === '0' && data.idpaciente !== '1' && btnConfirmaCita? hrefConfirmar:'')+
							' class="bg-light btnTable '+((data.idpaciente === '1' || !btnConfirmaCita || data.atendido === '1')? 'disabled':'')+
							' cerrar" '+style+'><img src="'+base_url+'public/images/iconos/evaluar_ico.png" width="18" style="max-height:23px"></a>'+
						/* Boton anular cita */
						'<a title="Desasignar" '+(data.atendido === '0' || data.idpaciente !== '1' && btnAnulaCita? hrefAnular:'')+' class="bg-light btnTable '+
							((data.idpaciente === '1' || !btnAnulaCita || data.atendido === '1')
							?'disabled':'')+' desasignar" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'consultorio' },{ data: 'departamento' },{ data: 'nprof' },{ data: 'npac' },{ data: 'entrada' },{ data: 'salida' },
				{
					data: 'idpaciente',
					render: function(data,meta,row){
						let var_status = '';
						if(row.atendido === '1') var_status = '<span class="text-success">Atendido</span>';
						else if(data === '1') var_status = '<span class="text-danger">Por Asignar</span>';
						else var_status = '<span class="text-primary">Asignado</span>';
						
						return var_status;
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Consultorio',targets: 1},{title:'Area',targets: 2},{title:'Profesional',targets: 3},{title:'Paciente',targets: 4},
				{title:'H.Entrada',targets: 5},{title:'H.Salida',targets: 6},{title:'Status',targets: 7},//{title:'Status',targets: 8},
			], order: [],
		});
		tablaPacientes = $('#tablaPacientes').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: base_url + 'citas/citas/buscarpacientes',
				type: 'GET',
				error: function(){
					$("#post_list_processing").css('display','none');
				}
			},
			columns:[
				{ data: 0 },{ data: 1 },{ data: 2 },{ data: 3 },{ data: 4, visible: false },
			],
			dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
			colReorder: { order: [ 4, 3, 2, 1, 0 ] }, language: lngDataTable,
		});
	}else if(segmento2 === 'historia'){
		grillappal = $('#tablaHistoria').DataTable({
			ajax: {
				url: base_url + 'citas/historia/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefAtencion = 'href="'+base_url+'citas/historia/regdetalle?id='+data.idhistoria+'"';
						let hrefVer = 'href="'+base_url+'citas/historia/ver?id='+data.idhistoria+'"';
						let hrefAnular = 'href="'+base_url+'citas/historia/anular?id='+data.idhistoria+'"';
						let btnAccion =
						'<div class="btn-group">'+
						/* Boton de Registro de detalle */
						'<a title="Registrar Atención" '+(btnRegAtencion? hrefAtencion:'')+' class="bg-light btnTable '+(!btnRegAtencion?'disabled':'')+
							' atencion" '+style+'><img src="'+base_url+'public/images/iconos/result_ico.png" width="18" style="max-height:20px"></a>'+
						/* Boton Ver Historia */
						'<a title="Ver Historia" '+(btnVerHistoria? hrefVer:'')+' class="bg-light btnTable '+(!btnVerHistoria?'disabled':'')+' verhistoria" '+
							style+' data-target="#modalAsigna" data-toggle="modal"><img src="'+base_url+'public/images/iconos/evaluar_ico.png" width="18" '+
							'style="max-height:23px"></a>'+
						/* Boton anular Historia */
						'<a title="Desasignar" '+(btnAnulaHistoria? hrefAnular:'')+' class="bg-light btnTable '+(!btnAnulaHistoria?'disabled':'')+
							' desasignar" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero', render: function(data){ return ceros(data,6); } },{ data: 'numerofisico' },{ data: 'nombres' },{ data: 'tipo_documento' },
				{ data: 'numero_documento' },{ data: 'estado_civil' },{ data: 'fecha_registro' },
				{
					data: 'avatar',
					render: function(data){
						return '<img src="'+base_url+'public/images/iconos/pdf_ico.png" style="display:block;margin:auto;width:25px" class="img img-fluid" >';
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'N&uacute;mero',targets: 1},{title:'H.F&iacute;sica',targets: 2},{title:'Paciente',targets: 3},
				{title:'Tipo Doc',targets: 4},{title:'Nro. Doc.',targets: 5},{title:'Edo.Civil',targets: 6},{title:'Fecha Registro',targets: 7},{title:'Avatar',targets: 8},
			], order: [],
		});
		tablaPacientes = $('#tablaPacientes').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: base_url + 'citas/citas/buscarpacientes',
				type: 'GET',
				error: function(){
					$("#post_list_processing").css('display','none');
				}
			},
			columns:[
				{ data: 0 },{ data: 1 },{ data: 2 },{ data: 3 },{ data: 4, visible: false },
			],
			dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
			colReorder: { order: [ 4, 3, 2, 1, 0 ] }, language: lngDataTable,
		});
		if(segmento3 === 'regdetalle'){
			cie = $('#tablacie').DataTable({
				data : [],
				bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
				columns:[
				{
					data: null, orderable: false,
					render: function(data){
						let btnAccion =
						'<div class="btn-group">'+
							'<a title="Remover" href="#" class="bg-danger btnTable remover">'+
								'<i class="fa fa-trash-o" aria-hidden="true" style="padding:5px"></i></a>'+
						'</div>';
						return btnAccion;
					}
				},
				{ data: 'idcie' },{ data: 'cie10' },{ data: 'diagnostico' },{ data: 'tipo' }
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'ID', targets: 1, visible: false },{ title: 'CIE10', targets: 2 },
					{ title: 'Diagn&oacute;stico', targets: 3 },{ title: 'Tipo', targets: 4 }
				],order: [],dom: 'tp',
				
			});
			tablaCIE = $('#tablaCIE10').DataTable({
				processing: true,
				serverSide: true,
				ajax:{
					url: base_url + 'citas/historia/listacie',
					type: 'GET',
					error: function(){
						$("#post_list_processing").css('display','none');
					}
				},
				columns:[
					{ data: 0 },{ data: 1 },{ data: 2, visible: false }
				],
				dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
				colReorder: { order: [ 2, 1, 0 ] }, language: lngDataTable,
			});
			proc = $('#tablaproc').DataTable({
				data : [],
				bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
				columns:[
				{
					data: null, orderable: false,
					render: function(data){
						let btnAccion =
						'<div class="btn-group">'+
							'<a title="Anular" href="#" class="bg-danger btnTable remover"><i class="fa fa-trash-o" aria-hidden="true"></i></a>'+
						'</div>';
						return btnAccion;
					}
				},
				{ data: 'articulo' },{ data: 'cantidad' },{ data: 'indicaciones' }
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'Art&iacute;culo', targets: 1 },{ title: 'Cantidad', targets: 2 },{ title: 'Indicaciones', targets: 3 }
				],order: [],dom: 'tp',
				
			});
		}
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
$('.wrapper-c').bind('click',function(e){
	let evt = e.target;
	if($(evt).prop('class') === 'regular' || $(evt).prop('class') === 'inactive' || $(evt).prop('class') === 'active'){
		$(this).find('.active').removeClass('active');
		$(evt).addClass('active');
		$('.d').val($(evt).text());
		$('.m').val($('.mes').val());
		grillappal.ajax.reload();
	}
});
$('#tablaCitas').on('click', function(e){
	let img = e.target, tr = img.closest('tr'), a = img.closest('a');
	let fila = grillappal.row($(tr)).data();
	
	if($(a).hasClass('asigna')) $('#idcita').val(fila.idcita);
	else if($(a).hasClass('desasignar')){
		event.preventDefault();
		let c = confirm('Desea eliminar la asignación?');
		
		if(c){
			$.ajax({
				data: {},
				url: $(a).attr('href'),
				method: 'GET',
				dataType: 'JSON',
				beforeSend: function(){},
				success: function(data){
					grillappal.ajax.reload();
					$('.msg').html(data.msg);
					setTimeout(function(){ $('.msg').hide('slow'); }, 3000);
				}
			});
		}
	}else if($(a).hasClass('cerrar')){
		event.preventDefault();
		let c = confirm('Desea confirmar la cita?');
		
		if(c){
			$.ajax({
				data: {},
				url: $(a).attr('href'),
				method: 'GET',
				dataType: 'JSON',
				beforeSend: function(){},
				success: function(data){
					grillappal.ajax.reload();
					$('.msg').html(data.msg);
					setTimeout(function(){ $('.msg').hide('slow'); }, 3000);
				}
			});
		}
	}
});
$('#tablaPacientes').on('dblclick','tr',function(){
	let data = tablaPacientes.row( this ).data();
	$('#idpaciente').val(data[4]);
	$('#paciente').val(data[0] + ' ' + data[1]);
	if(segmento2 === 'historia'){
		$('#modalAsigna').modal('hide');
		$('.msg').html('');
	}
});
$('#modalAsigna').on('hidden.bs.modal',function(e){
	tablaPacientes.ajax.reload();
	grillappal.ajax.reload();
	if(segmento2 !== 'historia')
		$('#paciente').val('');
	$('#obs').val('');
});
$('#asigna').bind('click',function(){
	if($('#paciente').val() !== ''){
		$.ajax({
			data: { idpaciente: $('#idpaciente').val(), idcita: $('#idcita').val(), obs: $('#obs').val() },
			url: base_url + 'citas/citas/asignapaciente',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				//$('html, body').animate({ scrollTop: 0 }, 'fast');
				$('#asigna').html('<span class="spinner-border spinner-border-sm"></span> Cargando...');
			},
			success: function(data){
				$('#asigna').html('Asignar');
				$('.msg').html(data.msg);
				$('#modalAsigna').modal('hide');
				setTimeout(function(){ $('.msg').addClass('fade'); }, 1500);
			}
		});
	}
});
$('#tablaCIE10').on('dblclick','tr',function(){
	let data = tablaCIE.row( this ).data();
	$('#idcie').val(data[2]);
	$('#cie10').val(data[1]);
	$('#codcie').val(data[0]);
	$('#modalCie10').modal('hide');
});
$('#addtipo').bind('click',function(){
	if($('#tpdiag').val() && $('#cie10').val()){
		let json = [{'idcie':$('#idcie').val(),'cie10':$('#codcie').val(),'diagnostico':$('#cie10').val(),
					'idtipo':$('#tpdiag').val(),'tipo':$('#tpdiag :selected').text()}];
		
		if(cie.rows().count()){
			cie.rows().data().each(function(e){
				if($('#idcie').val() === e['idcie']) alert('El item ya está agregado');
				else cie.rows.add(json).draw();
			});
		}else cie.rows.add(json).draw();
	}
});
$('#tablacie').bind('click','a',function(e){
	let a = e.target;
	cie.row($(a).parents('tr')).remove().draw();
});