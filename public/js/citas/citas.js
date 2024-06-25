let grillappal = null, tablaPacientes = null, cie = null, tablaCIE = null, proc = null, examen = null, indic = null, tablaPROC = null, tablaART = null, tablaEXAMEN = null;

$(document).ready(function (){
	if(segmento2 === 'turnos'){
		grillappal = $('#tablaTurnos').DataTable({
			ajax: {
				url: base_url + 'citas/turnos/lista',
				type: 'POST',
				data: function(d){
					d.idconsultorio = $('.cons').val();
					d.iddepartamento = $('.cdep').val();
					d.idprofesional = $('.cprof').val();
					d.anio = $('.canio').val();
					d.mes = $('.tmes').val();
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
				type: 'POST',
				data: function(d){
					d.idempresa = $('.iddep').val();
				}
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
	}else if(segmento2 === 'citasprof'){
		grillappal = $('#tablaCitas').DataTable({
			ajax: {
				url: base_url + 'citas/citas/lista',
				type: 'POST',
				data: function(d){
					d.idconsultorio = $('.cons').val();
					d.iddepartamento = $('.cdep').val();
					d.idprofesional = $('.cprof').val();
					d.anio = $('.anio').val();
					d.mes = $('.mes').val();
					d.dia = $('.dia').val();
					d.activo = 1;
				}
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data,m,r){
						/* Obtener la fecha en milisegundos y compararla con la fecha traida de la bd */
						let f = new Date(data.fecha), hoy = new Date(Date.now()), activar = false, hoydia = '', hoymes = '', hoyanio = '';
						hoymes = String(hoy.getMonth()).length < 2? '0'+(hoy.getMonth()+1) : (hoy.getMonth()+1);
						hoydia = String(hoy.getDate()).length < 2? '0'+hoy.getDate() : hoy.getDate();
						hoyanio = hoy.getFullYear();
						activar =  data.fecha >= hoyanio+'-'+hoymes+'-'+hoydia;
						
						
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'citas/citas/editar?id='+data.idcita+'"';
						let hrefConfirmar = 'href="'+base_url+'citas/citas/cerrar?id='+data.idcita+'"';
						let hrefAnular = 'href="'+base_url+'citas/citas/desasignar?id='+data.idcita+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Asignar Paciente" '+(data.atendido === '0' && data.idpaciente === '1' && btnAsignaCita? hrefEdit:'')+' class="bg-light btnTable '+
							((data.idpaciente !== '1' || !btnAsignaCita || data.atendido === '1' || !activar)?
							'disabled':'')+' asigna" '+style+' data-target="#modalAsigna" data-toggle="modal"><img src="'+base_url+'public/images/iconos/edit_ico.png"'+
							' width="20"></a>'+
						/* Boton de confirmacion */
						'<a title="Confirmación de Cita" '+(data.atendido === '0' && data.idpaciente !== '1' && btnConfirmaCita? hrefConfirmar:'')+
							' class="bg-light btnTable '+((data.idpaciente === '1' || !btnConfirmaCita || data.atendido === '1' || !activar)? 'disabled':'')+
							' cerrar" '+style+'><img src="'+base_url+'public/images/iconos/evaluar_ico.png" width="18" style="max-height:23px"></a>'+
						/* Boton anular cita */
						'<a title="Desasignar" '+(data.atendido === '0' || data.idpaciente !== '1' && btnAnulaCita? hrefAnular:'')+' class="bg-light btnTable '+
							((data.idpaciente === '1' || !btnAnulaCita || data.atendido === '1' || !activar)
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
			createdRow: function (row, data, dataIndex) {
				if(data.tipo === '1') $(row).css('background','RGB(240 222 141)');
			},
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Consultorio',targets: 1},{title:'Area',targets: 2},{title:'Profesional',targets: 3},{title:'Paciente',targets: 4},
				{title:'H.Entrada',targets: 5},{title:'H.Salida',targets: 6},{title:'Status',targets: 7},//{title:'Status',targets: 8},
			], order: [],
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
							style+' target="_blank" ><img src="'+base_url+'public/images/iconos/evaluar_ico.png" width="18" style="max-height:23px"></a>'+
						/* Boton anular Historia */
						'<a title="Desasignar" '+(btnAnulaHistoria? hrefAnular:'')+' class="bg-light btnTable '+(!btnAnulaHistoria?'disabled':'')+
							' desasignar" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero', render: function(data){ return ceros(data,6); } },{ data: 'numerofisico' },{ data: 'nombres' },{ data: 'tipo_documento' },
				{ data: 'numero_documento' },{ data: 'estado_civil' },{ data: 'freg' },
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
		if(segmento3 === 'regdetalle'){
			cie = $('#tablacie').DataTable({
				data: [],
				bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
				columns:[
					{
						data: null, orderable: false,
						render: function(data){
							let btnAccion =
							'<div class="btn-group">'+
								'<a title="Remover" href="borrar" class="bg-danger btnTable remover">'+
									'<i class="fa fa-trash-o" aria-hidden="true" style="padding:5px"></i></a>'+
							'</div>';
							return btnAccion;
						}
					},
					{ data: 'idcie10' },{ data: 'cie10' },{ data: 'descripcion_cie10' },
					{ 
						data: null,
						render: function(d,m,r){ return r.tipo === '1'? '1 - Presuntivo' : '2 - Definitivo'; } 
					},{ data: 'tipo' }
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'ID', targets: 1, visible: false },{ title: 'CIE10', targets: 2 },
					{ title: 'Diagn&oacute;stico', targets: 3 },{ title: 'Tipo', targets: 4 },{ title: 'ID Tipo', targets: 5, visible: false }
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
				data: [],
				bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
				columns:[
				{
					data: null, orderable: false,
					render: function(data){
						let btnAccion =
						'<div class="btn-group">'+
							'<a title="Remover" href="borrar" class="bg-danger btnTable remover">'+
							'<i class="fa fa-trash-o" aria-hidden="true" style="padding:5px"></i></a>'+
						'</div>';
						return btnAccion;
					}
				},
				{ data: 'idprocedimiento' },{ data: 'tipo_procedimiento' },{ data: 'procedimiento' },{ data: 'indicaciones' }
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'ID', targets: 1, visible: false },{ title: 'Tipo Procedimiento', targets: 2 },
					{ title: 'Procedimiento', targets: 3 },{ title: 'Indicaciones', targets: 4 }
				],order: [],dom: 'tp',
				
			});
			tablaPROC = $('#tablaPROC').DataTable({
				processing: true,
				serverSide: true,
				ajax:{
					url: base_url + 'citas/historia/listaproc',
					data: function(d){
						d.idtipo = $('#tipoproc').val();
					},
					type: 'GET',
					error: function(){
						$("#post_list_processing").css('display','none');
					}
				},
				columns:[
					{ data: 0 },{ data: 1 },{ data: 2 }
				],
				dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
				colReorder: { order: [ 0, 1, 2 ] }, language: lngDataTable,
			});
			examen = $('#tablaexamen').DataTable({
				data: [],
				bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
				columns:[
				{
					data: null, orderable: false,
					render: function(data){
						let btnAccion =
						'<div class="btn-group">'+
							'<a title="Remover" href="borrar" class="bg-danger btnTable remover">'+
							'<i class="fa fa-trash-o" aria-hidden="true" style="padding:5px"></i></a>'+
						'</div>';
						return btnAccion;
					}
				},
				{ data: 'idexamenauxiliar' },{ data: 'examen' },{ data: 'indicaciones' }
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'ID', targets: 1, visible: false },{ title: 'Ex&aacute;men Auxiliar', targets: 2 },
					{ title: 'Indicaciones', targets: 3 }
				],order: [],dom: 'tp',
				
			});
			tablaEXAMEN = $('#tablaEXAMEN').DataTable({
				processing: true,
				serverSide: true,
				ajax:{
					url: base_url + 'citas/historia/listaauxiliares',
					error: function(){
						$("#post_list_processing").css('display','none');
					}
				},
				columns:[
					{ data: 0 },{ data: 1 },{ data: 2 },{ data: 3 }
				],
				dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
				colReorder: { order: [ 0, 1, 2, 3 ] }, language: lngDataTable,
			});
			indic = $('#tablaindicaciones').DataTable({
				data: [],
				bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
				columns:[
				{
					data: null, orderable: false,
					render: function(data){
						let btnAccion =
						'<div class="btn-group">'+
							'<a title="Remover" href="borrar" class="bg-danger btnTable remover">'+
							'<i class="fa fa-trash-o" aria-hidden="true" style="padding:5px"></i></a>'+
						'</div>';
						return btnAccion;
					}
				},
				{ data: 'idarticulo' },{ data: 'descripcion' },{ data: 'cantidad' },{ data: 'indicaciones' },
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'ID', targets: 1, visible: false },{ title: 'Art&iacute;culo', targets: 2 },
					{ title: 'Cantidad', targets: 3 },{ title: 'Indicaciones', targets: 4 }
				],order: [],dom: 'tp',
				
			});
			tablaART = $('#tablaART').DataTable({
				processing: true,
				serverSide: true,
				ajax:{
					url: base_url + 'citas/historia/listaart',
					data: function(d){
						d.idtipo = $('#tipoproc').val();
					},
					type: 'GET',
					error: function(){
						$("#post_list_processing").css('display','none');
					}
				},
				columns:[
					{ data: 0 },{ data: 1 }
				],
				dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
				colReorder: { order: [ 0, 1 ] }, language: lngDataTable,
			});
		}
	}else if(segmento2 === 'procedimientos'){
		grillappal = $('#tablaProcedimientos').DataTable({
			ajax: {
				url: base_url + 'citas/procedimientos/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefAtencion = 'href="'+base_url+'citas/procedimientos/regdetalle?id='+data.idprocedimiento+'"';
						let hrefAnular = 'href="'+base_url+'citas/procedimientos/anular?id='+data.idprocedimiento+'"';
						let btnAccion =
						'<div class="btn-group">'+
						/* Boton de Registro de detalle */
						'<a title="Registrar Atención" '+(btnRegAtencion? hrefAtencion:'')+' class="bg-light btnTable '+(!btnRegAtencion?'disabled':'')+
							' atencion" '+style+'><img src="'+base_url+'public/images/iconos/result_ico.png" width="18" style="max-height:20px"></a>'+
						/* Boton anular Historia */
						'<a title="Desasignar" '+(btnAnulaHistoria? hrefAnular:'')+' class="bg-light btnTable '+(!btnAnulaHistoria?'disabled':'')+
							' desasignar" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'tipo_procedimiento' },{ data: 'correlativo' },{ data: 'procedimiento' },{ data: 'tarifa_base' },
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Tipo Procedimiento',targets: 1},{title:'Correlativo',targets: 2},{title:'Procedimiento',targets: 3},
				{title:'Precio Base',targets: 4},
			], order: [],
		});
	}
	if(segmento === 'citas' && (segmento2 == '' || segmento2 === 'citasprof' || segmento2 === 'historia' || segmento2 === 'adicional')){
		tablaPacientes = $('#tablaPacientes').DataTable({
			pageLength: 5,
			processing: true,
			serverSide: true,
			lengthMenu:[[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
			ajax:{
				url: base_url + 'citas/citas/buscarpacientes',
			type: 'GET',
				error: function(){
					$("#post_list_processing").css('display','none');
				}
			},
			columns:[
				{
					data: 0,
					render: function(data){
						let a = {'1':'D.N.I.','2':'CARNET ETX.','3':'R.U.C.','4':'PASAPORTE','5':'OTROS'};
						let valor = '-';
						for(let k in a){ if(data === k) valor = a[k]; }
						return valor; 
					}
				},{ data: 1 },{ data: 2 },{ data: 3 },{ data: 4, visible: false },{ data: 5 },
				{
					data: 6,
					render: function(data){
						let a = {'1':'Soltero(a)','2':'Casado(a)','3':'Conviviente','4':'Viudo(a)','5':'Divorciado(a)','6':'No especifica'};
						let valor = '-';
						for(let k in a){ if(data === k) valor = a[k]; }
						return valor; 
					}
				},
				{ data: 7 },{ data: 8 },
			],
			dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
			colReorder: { order: [ 8, 7, 6, 5, 4, 3, 2, 1, 0 ] }, language: lngDataTable,
		});
	}
});
$('.iddep').bind('change', function(){
	if(segmento2 === 'consultorios'){
		grillappal.ajax.reload();
	}else{
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
	}
	
});
$('.cdep').bind('change', function(){
	grillappal.ajax.reload();
});
$('.cprof').bind('change', function(){
	grillappal.ajax.reload();
});
$('.canio').bind('change', function(){
	grillappal.ajax.reload();
});
$('.cons').bind('change', function(){
	grillappal.ajax.reload();
});
$('.tmes').bind('change', function(){
	grillappal.ajax.reload();
});
$('#guardar-horarios').bind('click', function(event){
	event.preventDefault();
	let tr = document.querySelectorAll('.f-horas'), idturno = $('#idturno').val(), json = {}, data = [], valida = false;
	
	$.each($(tr),function(i,e){
		let f = $(e).find('.fecha'), e0 = $(e).find('.e'), e1 = $(e).find('.e1'), e2 = $(e).find('.e2');
		
		let s = $(e).find('.s'), s1 = $(e).find('.s1'), s2 = $(e).find('.s2');
		let en = '', en2 = '', en3 = '', sa = '', sa2 = '', sa3 = '';
		
		let sep0 = e0.val().split(':'), sep1 = s.val().split(':');
		if(parseInt(sep1[0]) > parseInt(sep0[0]) && parseInt(sep1[1]) >= parseInt(sep0[1]) && parseInt(sep0[0]) > 0){
			en = e0.val(), sa = s.val(), valida = true;
		}
		let sep2 = e1.val().split(':'), sep3 = s1.val().split(':');
		if(parseInt(sep3[0]) > parseInt(sep2[0]) && parseInt(sep3[1]) >= parseInt(sep2[1]) && parseInt(sep2[0]) > 0){
			en2 = e1.val(), sa2 = s1.val(), valida = true;
		}
		let sep4 = e2.val().split(':'), sep5 = s2.val().split(':');
		if(parseInt(sep5[0]) > parseInt(sep4[0]) && parseInt(sep5[1]) >= parseInt(sep4[1]) && parseInt(sep4[0]) > 0){
			en3 = e2.val(), sa3 = s2.val(), valida = true;
		}
		if(valida){
			data.push({idturno:idturno,fecha:f.val(),entrada1:en,salida1:sa,entrada2:en2,salida2:sa2,entrada3:en3,salida3:sa3});
		}
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
		$('.dia').val($(evt).text());
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
$('#tablaPacientes').on('click','tr',function(){
	let data = tablaPacientes.row( this ).data();
	$('#idpaciente').val(data[4]);
	$('#paciente').val(data[2]+' '+data[3]);
	if(segmento2 === 'historia' || segmento2 === 'adicional'){
		$('#modalAsigna').modal('hide');
		$('.msg').html('');
	}
});
$('#modalAsigna').on('hidden.bs.modal',function(e){
	tablaPacientes.ajax.reload();
	grillappal.ajax.reload();
	$('.paciente').val('');
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
$('#tablaCIE10').on('click','tr',function(){
	let data = tablaCIE.row( this ).data();
	$('#idcie').val(data[2]);
	$('#cie10').val(data[1]);
	$('#codcie').val(data[0]);
	$('#modalCie10').modal('hide');
});
$('#tablaPROC').on('click','tr',function(){
	let data = tablaPROC.row( this ).data();
	$('#idproc').val(data[0]);
	$('#procedimiento').val(data[1]);
	$('#tarifa').val(data[2]);
	$('#modalProcedimiento').modal('hide');
});
$('#tablaEXAMEN').on('click','tr',function(){
	let data = tablaEXAMEN.row( this ).data();
	$('#idexamen').val(data[0]);
	$('#examen').val(data[2]);
	$('#tarifaexamen').val(data[3]);
	$('#modalExamenes').modal('hide');
});
$('#tablaART').on('click','tr',function(){
	let data = tablaART.row( this ).data();
	$('#idarticulo').val(data[0]);
	$('#articulo').val(data[1]);
	$('#modalArticulo').modal('hide');
});
$('#addtipo').bind('click',function(){
	let valida = false;
	if($('#tpdiag').val() && $('#cie10').val()){
		let json = [{'idcie10':$('#idcie').val(),'cie10':$('#codcie').val(),'descripcion_cie10':$('#cie10').val(),
					'tipo':$('#tpdiag').val()}];
		
		if(cie.rows().count()){
			cie.rows().data().each(function(e){
				if($('#idcie').val() === e['idcie10']){
					alert('El item ya está agregado');
					valida = true;
				}
			});
		}
		if(!valida) cie.rows.add(json).draw();
	}
});
$('#addproc').bind('click',function(){
	let valida = false;
	if($('#tipoproc').val() && $('#procedimiento').val()){
		let json = [{'idprocedimiento':$('#idproc').val(),'tipo_procedimiento':$('#tipoproc :selected').text(),'procedimiento':$('#procedimiento').val(),
					'indicaciones':$('#observaciones').val()}];
		
		if(proc.rows().count()){
			proc.rows().data().each(function(e){
				if($('#idproc').val() === e['idprocedimiento']){
					alert('El item ya está agregado');
					valida = true;
				}
			});
		}
		if(!valida) proc.rows.add(json).draw();
	}
});
$('#addexamen').bind('click',function(){
	let valida = false;
	if($('#examen').val()){
		let json = [{'idexamenauxiliar':$('#idexamen').val(),'examen':$('#examen').val(),'indicaciones':$('#indicaexamen').val()}];
		console.log(json);
		if(examen.rows().count()){
			examen.rows().data().each(function(e){
				if($('#idexamen').val() === e['idexamenauxiliar']){
					alert('El item ya está agregado');
					valida = true;
				}
			});
		}
		if(!valida) examen.rows.add(json).draw();
	}
});
$('#addindic').bind('click',function(){
	let valida = false;
	if($('#articulo').val() && $('#cantidad').val()){
		let json = [{'idarticulo':$('#idarticulo').val(),'descripcion':$('#articulo').val(),'cantidad':$('#cantidad').val(),
					'indicaciones':$('#indica').val()}];
		
		if(indic.rows().count()){
			indic.rows().data().each(function(e){
				if($('#idarticulo').val() === e['idarticulo']){
					alert('El item ya está agregado');
					valida = true;
				}
			});
		}
		if(!valida) indic.rows.add(json).draw();
	}
});
$('#tablacie').bind('click','a',function(e){
	let t = e.target, a = $(t).parents('a');
	if(a.hasClass('remover')){
		event.preventDefault();
		cie.row($(a).parents('tr')).remove().draw();
	}
});
$('#tablaproc').bind('click','a',function(e){
	let t = e.target, a = $(t).parents('a');
	if(a.hasClass('remover')){
		event.preventDefault();
		proc.row($(a).parents('tr')).remove().draw();
	}
});
$('#tablaexamen').bind('click','a',function(e){
	let t = e.target, a = $(t).parents('a');
	if(a.hasClass('remover')){
		event.preventDefault();
		examen.row($(a).parents('tr')).remove().draw();
	}
});
$('#tablaindicaciones').bind('click','a',function(e){
	let t = e.target, a = $(t).parents('a');
	if(a.hasClass('remover')){
		event.preventDefault();
		indic.row($(a).parents('tr')).remove().draw();
	}
});
$('#gestante').bind('change', function(){
	if(this.checked) $('#semanas').prop('disabled', false);
	else $('#semanas').prop('disabled', true);
});
$('#btnRegistrar').bind('click', function(){
	let id = $('div.active').prop('id'), url = '', data = null, valida = true, json = {};
	
	if(id === 'atenciones'){
		let f = document.getElementById('form_atenciones'), formData = new FormData(f);
		url = $(f).prop('action');
		//formData.set('idatencion',$('#idatencion').find(':selected').text());
		formData.set('idatencion',$('#idatencion').val());
		formData.set('idcons',$('#idcons').val());
		formData.set('iddep',$('#iddep').val());
		formData.set('idprof',$('#prof').val());
		formData.set('idhistoria',$('#idhistoria').val());
		formData.set('hora',$('#hora').val());
		data = new URLSearchParams(formData).toString();
	}else if(id === 'diagnosticos'){
		url = base_url + 'citas/historia/regdiagnostico';
		let rs = cie.rows().data().toArray(), filas = [];
		if(rs.length){
			$.each(rs, function(i,e){
				filas[i] = { idatencion: $('#idatencion').val(),idcie10: e.idcie10,tipo: e.tipo };
			});
		}else valida = false;
		data = JSON.stringify(filas);
	}else if(id === 'procedimientos'){
		url = base_url + 'citas/historia/regprocedimiento';
		let rs = proc.rows().data().toArray(), filas = [];
		if(rs.length){
			$.each(rs, function(i,e){
				filas[i] = { idatencion: $('#idatencion').val(),idprocedimiento: e.idprocedimiento,indicaciones: e.indicaciones };
			});
		}else valida = false;
		data = JSON.stringify(filas);
	}else if(id === 'examenes'){
		url = base_url + 'citas/historia/regexamenes';
		let rs = examen.rows().data().toArray(), filas = [];
		if(rs.length){
			$.each(rs, function(i,e){
				filas[i] = { idatencion: $('#idatencion').val(),idexamenauxiliar: e.idexamenauxiliar,indicaciones: e.indicaciones };
			});
		}else valida = false;
		data = JSON.stringify(filas);
	}else if(id === 'indicaciones'){
		url = base_url + 'citas/historia/regindicaciones';
		let rs = indic.rows().data().toArray(), filas = [];
		if(rs.length){
			$.each(rs, function(i,e){
				filas[i] = { idatencion: $('#idatencion').val(),idarticulo: e.idarticulo,cantidad: e.cantidad,indicaciones: e.indicaciones };
			});
		}else valida = false;
		data = JSON.stringify(filas);
	}
	
	/* Envío de datos por ajax de cada uno de los tab */
	if(valida){
		$.ajax({
			data: data,
			url: url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('.rspatencion').html('<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;Cargando...');
				$('.rspatencion').addClass('pt-2');
				$('.rspatencion').show();
			},
			success: function(data){
				$('.rspatencion').html(data.msg);
				if(id === 'atenciones'){
					if(parseInt(data.status) === 200){ $('.nav-link.disabled').removeClass('disabled'); $('#idatencion').val(data.idatencion); }
				}else if(id === 'indicaciones'){
					if(parseInt(data.status) === 200){ $('#receta').removeClass('d-none'); }
				}else if(id === 'diagnosticos'){
					if(parseInt(data.status) === 200){ $('#receta').removeClass('d-none'); }
				}
				setTimeout(function(){ $('.rspatencion').hide('slow'); }, 1500);
			}
		});
	}
});
$('#tipoproc').bind('change', function(){ tablaPROC.ajax.reload(); $('#procedimiento').val('') });
/*$('.citaadicional').bind('click', function(){
	event.preventDefault();
	
});*/
$('.adicional').bind('click', function(event){
	event.preventDefault();
	if(grillappal.data().length){
		let d = grillappal.data().toArray(), ultimo = [], hay = false;//, t1 = new Date(), t2 = new Date();
		/*console.log(d);*/
		$.each(d, function(i,e){
			/*if(i === 1){
				let hora1 = e.salida.split(":"), hora2 = e.entrada.split(":");
				t1.setHours(hora1[0], hora1[1], '00');
				t2.setHours(hora2[0], hora2[1], '00');
				t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());
			}*/
			ultimo = e;
			if(e.idpaciente === '1'){ hay = true; return 0;}
		});
		//ultimo.duracion = t1.getMinutes();
		ultimo.cons = $('.cons :selected').text();
		ultimo.dep = $('.cdep :selected').text();
		
		$('#json').val(JSON.stringify(ultimo));
		if(hay) alert('Todavía quedan citas disponibles');
		else $('#form_adicional').submit();
	}
});
$('.selectblur').on('change', function(){
	let g = 0, val = false, glasgow;
	$.each($('.selectblur'),function(i,e){
		g += $(e).val() !== ''? parseInt($(e).val()) : 0;
		if($(e).val() === '') val = true;
	});
	if(!val){
		if(parseInt(g) > 12 && parseInt(g) < 16) glasgow = 'TRAUMA LEVE';
		else if(parseInt(g) > 8 && parseInt(g) < 9) glasgow = 'TRAUMA MODERADO';
		else glasgow = 'TRAUMA GRAVE';
		$('#glasgow').val(g);
		$('#gl').val(glasgow);
	}
});
$('#receta').bind('click', function(){
	if(indic.rows().count() && cie.rows().count()){
		let indicaciones = indic.rows().data().toArray(), opt = '';
		let diagnosticos = cie.rows().data().toArray();
		$('#indicreceta').val(JSON.stringify(indicaciones));
		$('#diagreceta').val(JSON.stringify(diagnosticos));
		$.ajax({
			data: { iddep: $('.iddep').val(),idatencion: $('#idatencion').val() },
			url: base_url + 'citas/historia/datosreceta',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){},
			success: function(data){
				if(parseInt(data.status) === 200){
					$.each(data.almacen, function(i,e){
						opt += '<option value="'+e.idalmacen+'">'+e.nombre_almacen+'</option>';
					});
					$('#idalmacen').html(opt);
					$('#modalReceta').modal('show');
				}else{
					$('.rspatencion').addClass('pt-2');
					$('.rspatencion').show();
					$('.rspatencion').html(data.msg);
					setTimeout(function(){ $('.rspatencion').hide('slow'); }, 1500);
				}
			}
		});
	}
});
$('#regreceta').bind('click', function(){
	event.preventDefault();
	let i = $('#indicreceta').val(), d = $('#diagreceta').val(), c = null;
	if($('#idalmacen').val()){
		c = {'idalmacen': $('#idalmacen').val(),'idatencion': $('#idatencion').val(),'fecha': $('#fecha').val(),
		'idprofesional': $('#prof').val(),'idpaciente': $('#paciente').val(),'observaciones': $('#obsreceta').val()};
		$.ajax({
			data: { indic: i,diag: d,cab: JSON.stringify(c),idreceta: $('#idrecetamedica').val() },
			url: base_url + 'citas/historia/regreceta',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('.rspatencion').html('<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;Cargando...');
				$('.rspatencion').addClass('pt-2');
				$('.rspatencion').show();
			},
			success: function(data){
				$('#modalReceta').modal('hide');
				$('#idrecetamedica').val(data.idreceta);
				$('.rspatencion').html(data.msg);
				if(parseInt(data.status) === 200){ $('#pdfreceta').removeClass('d-none'); }
				setTimeout(function(){ $('.rspatencion').hide('slow'); }, 1500);
			}
		});
	}
});