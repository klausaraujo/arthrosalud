let grillappal = null;

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