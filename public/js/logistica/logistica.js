let grillappal = null, tablaProveedores = null;

$(document).ready(function (){
	if(segmento2 === 'proveedores' || segmento2 == ''){
		grillappal = $('#tablaProveedores').DataTable({
			ajax: {
				url: base_url + 'logistica/proveedores/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/proveedores/editar?id='+data.idproveedor+'"';
						let hrefAnular = 'href="'+base_url+'logistica/proveedores/anular?id='+data.idproveedor+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Proveedor" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton anular proveedor */
						'<a title="Anular Proveedor" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero_ruc' },{ data: 'nombre_comercial' },{ data: 'domicilio' },{ data: 'ubigeo' },{ data: 'contacto' },{ data: 'correo' },
				{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'RUC',targets: 1},{title:'Nombre Comercial',targets: 2},{title:'Domicilio',targets: 3},{title:'Ubigeo',targets: 4},
				{title:'Contacto',targets: 5},{title:'Correo',targets: 6},{title:'Status',targets: 7},
			], order: [],
		});
	}else if(segmento2 === 'bienes' && segmento3 == ''){
		grillappal = $('#tablaBienes').DataTable({
			ajax: {
				url: base_url + 'logistica/bienes/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/bienes/editar?id='+data.idarticulo+'"';
						let hrefArt = 'href="'+base_url+'logistica/bienes/codigos?id='+data.idarticulo+'"';
						let hrefAnular = 'href="'+base_url+'logistica/bienes/anular?id='+data.idarticulo+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Artículo" '+(data.activo === '1' && btnEditArt? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditArt)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton codigos articulos */
						'<a title="Códigos Artículos" '+(data.activo === '1' && btnArt? hrefArt:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnArt)
							?'disabled':'')+' articulos" '+style+'><img src="'+base_url+'public/images/iconos/result_ico.png" width="20"></a>'+
						/* Boton anular articulos */
						'<a title="Anular Artículo" '+(data.activo === '1' && btnAnularArt? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnularArt)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'tipo_articulo' },{ data: 'correlativo' },{ data: 'descripcion' },{ data: 'unidad_medida' },
				{ 
					data: 'fotografia',
					createdCell: function(td,cellData,rowData,row,col){
						$(td).addClass('p-1');
					},
					render: function(data){
						return '<img src="'+base_url+'public/images/articulos/'+data+'" style="display:block;margin:auto;width:40px;height:40px" class="img img-fluid" >';
					}
				},
				{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Tipo',targets: 1},{title:'C&oacute;digo',targets: 2},{title:'Descripci&oacute;n',targets: 3},
				{title:'U.M',targets: 4},{title:'Fotograf&iacute;a',targets: 5},{title:'Status',targets: 6},
			], order: [],
		});
	}else if(segmento2 === 'servicios' && segmento3 == ''){
		grillappal = $('#tablaServicios').DataTable({
			ajax: {
				url: base_url + 'logistica/servicios/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/servicios/editar?id='+data.idservicio+'"';
						let hrefServ = 'href="'+base_url+'logistica/servicios/codigos?id='+data.idservicio+'"';
						let hrefAnular = 'href="'+base_url+'logistica/servicios/anular?id='+data.idservicio+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar" '+(data.activo === '1' && btnEditServ? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditServ)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton codigos servicios */
						'<a title="Códigos Servicios" '+(data.activo === '1' && btnServ? hrefServ:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnServ)
							?'disabled':'')+' servicios" '+style+'><img src="'+base_url+'public/images/iconos/result_ico.png" width="20"></a>'+
						/* Boton anular servicios */
						'<a title="Anular Servicio" '+(data.activo === '1' && btnAnularServ? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnularServ)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'descripcion' },{ data: 'unidad_medida' },
				{
					data: 'activo',
					render: function(data){
						let var_status = '';
						switch(data){
							case '1': var_status = '<span class="text-success">Activo</span>'; break;
							case '0': var_status = '<span class="text-danger">Inactivo</span>'; break;
						}
						return var_status;
					}
				},
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Descripci&oacute;n',targets: 1},{title:'U.M',targets: 2},{title:'Status',targets: 3},
			], order: [],
		});
	}else if(segmento2 === 'gentrada' && segmento3 == ''){
		grillappal = $('#tablaIngresos').DataTable({
			ajax: {
				url: base_url + 'logistica/gentrada/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/gentrada/editar?id='+data.idguia+'"';
						let hrefVer = 'href="'+base_url+'logistica/gentrada/ver?id='+data.idguia+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar" '+(data.activo === '1' && btnEditGI? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditGI)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton ver guia */
						'<a title="Ver Guia" '+(data.activo === '1' && btnVerGI? hrefVer:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnVerGI)
							?'disabled':'')+' ver" '+style+' target="_blank"><img src="'+base_url+'public/images/iconos/result_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero',render: function(data){ return ceros(data,7); } },
				{
					data: 'fecha',
					render: function(data){
						return formatoFecha(new Date(data), 'dd/mm/YYYY');
					}
				},{ data: 'tipo_movimiento' },{ data: 'razon_social' },{ data: 'tipo_comprobante' },{ data: 'numero_comprobante' },
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Nro. Gu&iacute;a',targets: 1},{title:'Fecha Gu&iacute;a',targets: 2},
				{title:'Movimiento',targets: 3},{title:'Proveedor',targets: 4},{title:'Tipo Comprob.',targets: 5},{title:'Nro. Comprob.',targets: 6},
			], order: [],
		});
	}else if(segmento2 === 'gsalida' && segmento3 == ''){
		grillappal = $('#tablaSalidas').DataTable({
			ajax: {
				url: base_url + 'logistica/gsalida/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/gsalida/editar?id='+data.idguia+'"';
						let hrefVer = 'href="'+base_url+'logistica/gsalida/ver?id='+data.idguia+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar" '+(data.activo === '1' && btnEditGS? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditGS)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton ver guia */
						'<a title="Ver Guia" '+(data.activo === '1' && btnVerGS? hrefVer:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnVerGS)
							?'disabled':'')+' ver" '+style+' target="_blank"><img src="'+base_url+'public/images/iconos/result_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero',render: function(data){ return ceros(data,7); } },
				{
					data: 'fecha',
					render: function(data){
						return formatoFecha(new Date(data), 'dd/mm/YYYY');
					}
				},
				{ data: 'tipo_movimiento' },{ data: 'razon_social' },{ data: 'tipo_comprobante' },{ data: 'numero_comprobante' },
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Nro. Gu&iacute;a',targets: 1},{title:'Fecha Gu&iacute;a',targets: 2},
				{title:'Movimiento',targets: 3},{title:'Proveedor',targets: 4},{title:'Tipo Comprob.',targets: 5},{title:'Nro. Comprob.',targets: 6},
			], order: [],
		});
	}else if(segmento2 === 'ocompra' && segmento3 == ''){
		grillappal = $('#tablaOC').DataTable({
			ajax: {
				url: base_url + 'logistica/ocompra/lista',
				type: 'POST',
				data: function(d){
					d.empresa = $('#idest').val();
				}
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/ocompra/editar?id='+data.idorden+'"';
						let hrefAnular = 'href="'+base_url+'logistica/ocompra/anular?id='+data.idorden+'"';
						let hrefVer = 'href="'+base_url+'logistica/ocompra/veroc?id='+data.idorden+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar OC" '+(data.activo === '1' && btnEditOC? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditOC)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton codigos servicios */
						'<a title="Anular OC" '+(data.activo === '1' && btnAnulaOC? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnulaOC)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a>'+
						/* Boton anular servicios */
						'<a title="Ver OC" '+(data.activo === '1' && btnVerOC? hrefVer:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnVerOC)
							?'disabled':'')+' verpdf" target="_blank" '+style+'><img src="'+base_url+'public/images/iconos/pdf_ico.png" width="18"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero',render: function(data){ return ceros(data,7); } },
				{
					data: 'fecha',
					render: function(data){ return formatoFecha(new Date(data), 'dd/mm/YYYY'); }
				},
				{ data: 'razon_social' },{ data: 'centro_costos' },{ data: 'provnombre' },{ data: 'tipo_pago' },
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Nro. Orden',targets: 1},{title:'Fecha Orden',targets: 2},
				{title:'Empresa',targets: 3},{title:'C. Costos',targets: 4},{title:'Proveedor.',targets: 5},{title:'Tipo Pago',targets: 6},
			], order: [],
		});
	}else if(segmento2 === 'oservicio' && segmento3 == ''){
		grillappal = $('#tablaOS').DataTable({
			ajax: {
				url: base_url + 'logistica/oservicio/lista',
				type: 'POST',
				data: function(d){
					d.empresa = $('#idest').val();
				}
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'logistica/oservicio/editar?id='+data.idorden+'"';
						let hrefAnular = 'href="'+base_url+'logistica/oservicio/anular?id='+data.idorden+'"';
						let hrefVer = 'href="'+base_url+'logistica/oservicio/ospdf?id='+data.idorden+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar OS" '+(data.activo === '1' && btnEditOS? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEditOS)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton codigos servicios */
						'<a title="Anular OS" '+(data.activo === '1' && btnAnulaOS? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnulaOS)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a>'+
						/* Boton anular servicios */
						'<a title="Ver OS" '+(data.activo === '1' && btnVerOS? hrefVer:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnVerOS)
							?'disabled':'')+' verpdf" target="_blank" '+style+'><img src="'+base_url+'public/images/iconos/pdf_ico.png" width="18"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'numero', render: function(data){ return ceros(data,7); } },
				{
					data: 'fecha',
					render: function(data){ return formatoFecha(new Date(data), 'dd/mm/YYYY'); }
				},
				{ data: 'razon_social' },{ data: 'centro_costos' },{ data: 'provnombre' },{ data: 'tipo_pago' },
			],
			columnDefs:[
				{title:'Acciones',targets: 0},{title:'Nro. Orden',targets: 1},{title:'Fecha Orden',targets: 2},
				{title:'Empresa',targets: 3},{title:'C. Costos',targets: 4},{title:'Proveedor.',targets: 5},{title:'Tipo Pago',targets: 6},
			], order: [],
		});
	}
	
	if(segmento === 'logistica' && (segmento2 === 'gentrada' || segmento2 === 'gsalida' || segmento2 === 'ocompra' || segmento2 === 'oservicio') && 
		(segmento3 === 'nuevo' || segmento3 === 'editar')){
		/*Datatable serverside de proveedores*/
		$('#tablaProveedores').DataTable({
			pageLength: 5,
			processing: true,
			serverSide: true,
			lengthMenu:[[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
			ajax:{
				url: base_url + 'logistica/buscaproveedor',
			type: 'GET',
				error: function(){
					$("#post_list_processing").css('display','none');
				}
			},
			columns:[
				{ data: 0 },{ data: 1 },{ data: 2 },{ data: 3 },{ data: 4, visible: false },{ data: 5 },{ data: 6 },
				{
					data: 7,
					render: function(data){
						let a = {'1':'Activo','0':'Anulado'};
						let valor = '-';
						for(let k in a){ if(data === k) valor = a[k]; }
						return valor; 
					}
				},
			],
			dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
			colReorder: { order: [ 8, 7, 6, 5, 4, 3, 2, 1, 0 ] }, language: lngDataTable,
		});
		
		/*Datatable de articulos elegidos*/
		grillappal = $('#tablaArticulos').DataTable({
			ajax: {
				url: base_url + 'logistica/articulosguias',
				type: 'POST',
				data: function(d){
					d.tabla = $('#tabla').val();
					d.idguia = $('#idguia').val();
				}
			},
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
				{ data: 'idarticulo' },{ data: 'descripcion' },
				{ data: 'cantidad', render: function(data){ return formatMoneda(data); } },
				{ data: 'costo', render: function(data){ return formatMoneda(data); } },
				{ data: 'fecha_vencimiento', render: function(data){ return formatoFecha(new Date(data), 'dd/mm/YYYY'); } },
				{ data: 'numero_lote' },{ data: 'activo' }
			],
			columnDefs:[
				{ title: 'Acciones', targets: 0 },{ title: 'idarticulo', targets: 1, visible: false },
				{ title: 'Art&iacute;culo', targets: 2 },{ title: 'Cantidad', targets: 3 },{ title: 'Costo', targets: 4 },
				{ title: 'Fecha Venc.', targets: 5 },{ title: 'Nro. Lote', targets: 6 },{ title: 'Status', targets: 7, visible: false }
			],order: [],dom: 'tp',
		});
		if(segmento2 === 'ocompra'){
			/*Datatable de articulos elegidos*/
			grillappal = $('#tablaArtOcOs').DataTable({
				ajax: {
					url: base_url + 'logistica/ocompra/articulosocos',
					type: 'POST',
					data: function(d){
						d.tabla = $('#tabla').val();
						d.idorden = $('#idorden').val();
					}
				},
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
					{ data: 'idarticulo' },{ data: 'descripcion' },
					{ data: 'tipo_articulo' },{ data: 'presentacion' },
					{ data: 'cantidad', render: function(data){ return formatMoneda(data); } },
					{ data: 'costo', render: function(data){ return formatMoneda(data); } },{ data: 'activo' },
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'idarticulo', targets: 1, visible: false },
					{ title: 'Art&iacute;culo', targets: 2 },{ title: 'Tipo Art&iacute;culo', targets: 3 },{ title: 'Presentaci&oacute;n', targets: 4 },
					{ title: 'Cantidad', targets: 5 },{ title: 'Costo', targets: 6 },{ title: 'Status', targets: 7, visible: false }
				],order: [],dom: 'tp',
			});
		}else if(segmento2 === 'oservicio'){
			/*Datatable de articulos elegidos*/
			grillappal = $('#tablaArtOcOs').DataTable({
				ajax: {
					url: base_url + 'logistica/oservicio/articulosocos',
					type: 'POST',
					data: function(d){
						d.tabla = $('#tabla').val();
						d.idorden = $('#idorden').val();
					}
				},
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
					{ data: 'idservicio' },{ data: 'descripcion' },
					{ data: 'tiposervicio' },{ data: 'cantidad', render: function(data){ return formatMoneda(data); } },
					{ data: 'costo', render: function(data){ return formatMoneda(data); } },{ data: 'activo' },
				],
				columnDefs:[
					{ title: 'Acciones', targets: 0 },{ title: 'idservicio', targets: 1, visible: false },
					{ title: 'Servicio', targets: 2 },{ title: 'Tipo Servicio', targets: 3 },
					{ title: 'Cantidad', targets: 4 },{ title: 'Costo', targets: 5 },{ title: 'Status', targets: 6, visible: false }
				],order: [],dom: 'tp',
			});
		}
		
		/*Datatable serverside de articulos*/
		$('#tablaArtServer').DataTable({
			pageLength: 5,
			processing: true,
			serverSide: true,
			lengthMenu:[[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
			ajax:{
				url: base_url + 'logistica/buscaarticulos',
			type: 'GET',
				error: function(){
					$("#post_list_processing").css('display','none');
				}
			},
			columns:[
				{ data: 0 },{ data: 1 },{ data: 2 },
				{
					data: 3,
					render: function(data){
						let a = {'1':'Activo','0':'Anulado'};
						let valor = '-';
						for(let k in a){ if(data === k) valor = a[k]; }
						return valor; 
					}
				},
				{ data: 4, visible: false }
			],
			dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
			colReorder: { order: [ 4, 3, 2, 1, 0 ] }, language: lngDataTable,
		});
		/*Datatable serverside de servicios*/
		$('#tablaServServer').DataTable({
			pageLength: 5,
			processing: true,
			serverSide: true,
			lengthMenu:[[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todas']],
			ajax:{
				url: base_url + 'logistica/buscaservicios',
			type: 'GET',
				error: function(){
					$("#post_list_processing").css('display','none');
				}
			},
			columns:[
				{ data: 0 },{ data: 1 },
				{
					data: 2,
					render: function(data){
						let a = {'1':'Servicio'};
						let valor = '-';
						for(let k in a){ if(data === k) valor = a[k]; }
						return valor; 
					}
				},
				{
					data: 3,
					render: function(data){
						let a = {'1':'Activo','0':'Anulado'};
						let valor = '-';
						for(let k in a){ if(data === k) valor = a[k]; }
						return valor; 
					}
				}
			],
			dom: '<"row"<"mx-auto"l><"mx-auto"f>>rtp',
			colReorder: { order: [ 4, 3, 2, 1, 0 ] }, language: lngDataTable,
		});
	}	
});

$('.upload-button').bind('click',function(e){ $('.file-upload').trigger('click'); });
$('.file-upload').bind('change',function(){
	var e = e || window.event;
	let file = e.target.files;
	let img = URL.createObjectURL(file[0]);
	let reader = new FileReader();
	reader.readAsDataURL(file[0]);
	reader.onload = function () {
		$('#imagen').val(reader.result);
	};
	//let formData = new FormData($('.uploadFileAjax')[0]);
	$('.profile-pic').attr( 'src', img );
	/*$.ajax({
        url: base_url + 'main/upload',
        type: 'post',
        dataType: 'html',
        data: formData,
        cache: false,
        contentType: false,
	    processData: false
	}).done(function(data){
		//console.log(data);
		imgperfil.attr( 'src', img );
		perfiltop.attr( 'src', img );
	});*/	
});

/*Eliminar las validaciones de los formularios*/
$('select').bind('change',function(){ $('.was-validated').removeClass('was-validated'); });
$('input').bind('blur',function(){ $('.was-validated').removeClass('was-validated'); });

/*Cambio de Empresa y almacen*/
$('.idempresa').bind('change', function(){
	$.ajax({
		data: { idempresa: this.value },
		url: base_url + 'logistica/findalmacenes',
		method: 'POST',
		dataType: 'JSON',
		beforeSend: function(){ $('.almacen').html('<option> Cargando...</option>'); },
		success: function (data) {
			let html = '';
			if(segmento3 !== 'editar') html = '<option value="">-- Seleccione --</option>';
			if((segmento2 === 'gentrada' || segmento2 === 'gsalida') && segmento3 == '') grillappal.ajax.reload();
			
			$.each(data, function (i, e){ html += '<option value="' + e.idalmacen + '">' + e.nombre_almacen + '</option>'; });
			$('.almacen').html(html);
		}
	});
});
$('.idestab').bind('change', function(){
	$.ajax({
		data: { idempresa: this.value },
		url: base_url + 'logistica/findcc',
		method: 'POST',
		dataType: 'JSON',
		beforeSend: function(){ $('.centro').html('<option> Cargando...</option>'); },
		success: function (data) {
			let html = '<option value="">-- Seleccione --</option>';
			/*if(segmento3 !== 'editar') html = '<option value="">-- Seleccione --</option>';
			if((segmento2 === 'gentrada' || segmento2 === 'gsalida') && segmento3 == '') grillappal.ajax.reload();*/
			
			$.each(data, function (i, e){ html += '<option value="' + e.idcentro + '">' + e.centro_costos + '</option>'; });
			$('.centro').html(html);
			$('#tablaOC').DataTable().ajax.reload();
			$('#tablaOS').DataTable().ajax.reload();
		}
	});
});

/*Accion del click en la tabla proveedores*/
$('#tablaProveedores').on('click','tr',function(){
	let data = $('#tablaProveedores').DataTable().row( this ).data();
	$('#idproveedor').val(data[4]);
	$('#proveedor').val(data[1]);
	//$('#tablaProveedores').DataTable().ajax.reload();
	$('#modalProveedores').modal('hide');
});

/*Eliminar fila de la tabla al hacer click*/
$('#tablaArticulos').bind('click','a',function(e){
	let t = e.target, a = $(t).parents('a');
	if(a.hasClass('remover')){
		event.preventDefault();
		$('#tablaArticulos').DataTable().row($(a).parents('tr')).remove().draw();
		if(!$('#tablaArticulos').DataTable().rows().count()) $('[type="submit"]').addClass('disabled');
		else{
			let d = $('#tablaArticulos').DataTable().data().toArray();
			$('#json').val(JSON.stringify(d));
		}
	}
});
$('#tablaArtOcOs').bind('click','a',function(e){
	let t = e.target, a = $(t).parents('a');
	event.preventDefault();
	$('#tablaArtOcOs').DataTable().row($(a).parents('tr')).remove().draw();
	if(!$('#tablaArtOcOs').DataTable().rows().count()) $('[type="submit"]').addClass('disabled');
	else{
		let d = $('#tablaArtOcOs').DataTable().data().toArray();
		$('#json').val(JSON.stringify(d));
	}
});

/*Accion del click en la tabla Articulos del servidor*/
$('#tablaArtServer').on('click','tr',function(){
	let data = $('#tablaArtServer').DataTable().row( this ).data();
	$('#idarticulo').val(data[4]);
	$('#articulo').val(data[1]);
	//$('#tablaArtServer').DataTable().ajax.reload();
	$('#modalArticulos').modal('hide');
});
/*Accion del click en la tabla Servicios del servidor*/
$('#tablaServServer').on('click','tr',function(){
	let data = $('#tablaServServer').DataTable().row( this ).data();
	$('#idservicio').val(data[0]);
	$('#servicio').val(data[1]);
	//$('#tablaArtServer').DataTable().ajax.reload();
	$('#modalServicios').modal('hide');
});

/*Click agregar articulo*/
$('#agregararticulo').bind('click', function(){
	if($('#idarticulo').val() !== '' && $('#cantidad').val() !== '' && $('#costo').val() !== '' && $('#nrolote').val() !== ''){
		let json = [{idarticulo: $('#idarticulo').val(),descripcion: $('#articulo').val(),cantidad: $('#cantidad').val(),
			costo: $('#costo').val(),fecha_vencimiento: $('#fechaven').val(),numero_lote: $('#nrolote').val(),activo: 1}];
		$('#tablaArticulos').DataTable().rows.add(json).draw();
		let d = $('#tablaArticulos').DataTable().data().toArray();
		$('#json').val(JSON.stringify(d));
		$('[type="submit"]').removeClass('disabled');
	}
});

/*Click agregar articulo oc*/
$('#agregar').bind('click', function(){
	if($('#idarticulo').val() !== '' && $('#cantidad').val() !== '' && $('#costo').val()){
		let json = [{idarticulo: $('#idarticulo').val(),descripcion: $('#articulo').val(),cantidad: $('#cantidad').val(),
			costo: $('#costo').val(),tipo_articulo: 'FARMACOS',presentacion: 'NO ESPECIFICA',activo: 1}];
		$('#tablaArtOcOs').DataTable().rows.add(json).draw();
		let d = $('#tablaArtOcOs').DataTable().data().toArray();
		$('#json').val(JSON.stringify(d));
		$('[type="submit"]').removeClass('disabled');
	}
});
/*Click agregar servicio os*/
$('#agregarserv').bind('click', function(){
	if($('#idservicio').val() !== '' && $('#cantidad').val() !== '' && $('#costo').val()){
		let json = [{idservicio: $('#idservicio').val(),descripcion: $('#servicio').val(),cantidad: $('#cantidad').val(),
			costo: $('#costo').val(),tiposervicio: 'Servicio',activo: 1}];
		$('#tablaArtOcOs').DataTable().rows.add(json).draw();
		let d = $('#tablaArtOcOs').DataTable().data().toArray();
		$('#json').val(JSON.stringify(d));
		$('[type="submit"]').removeClass('disabled');
	}
});

/*Accion al cerrar los modales*/
$('.modal').on('hidden.bs.modal',function(e){
	if(this.id === 'modalArticulos') $('#tablaArtServer').DataTable().ajax.reload();
	if(this.id === 'modalProveedores') $('#tablaProveedores').DataTable().ajax.reload();
});