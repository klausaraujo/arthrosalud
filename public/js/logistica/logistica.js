let grillappal = null;

$(document).ready(function (){
	if(segmento2 == ''){
	}else if(segmento2 === 'proveedores'){
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
						let style = 'style="padding:1px 4px"';
						let hrefEdit = 'href="'+base_url+'usuarios/editar?id='+data.idusuario+'"';
						let hrefCan = 'href="'+base_url+'usuarios/permisos?id='+data.idusuario+'"';
						let hrefEval = 'href="'+base_url+'usuarios/reset?id='+data.idusuario+'&doc='+data.numero_documento+'&stat='+data.activo+'"';
						let hrefPub = 'href="'+base_url+'usuarios/habilitar?id='+data.idusuario+'&stat='+data.activo+'"';
						let btnAccion =
						/* Boton de edicion */
						'<div class="btn-group">' +
						'<a title="Editar" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-warning btnTable '+
							((data.activo === '0' || !btnEdit)?'disabled':'')+' editar" '+style+'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
						/* Boton de permisos */
						'<a title="Cancelar" '+(data.activo === '1' && btnCan? hrefCan:'')+' class="bg-warning btnTable '+
							((data.activo === '0' || !btnCan)?'disabled':'')+' cancelar" '+style+'><i class="fa fa-cogs" aria-hidden="true"></i></a>'+
						/* Boton de Reset Clave */
						'<a title="Evaluar" '+((data.activo === '1' && btnEval)? hrefEval:'')+' class="bg-info btnTable '+
							((data.activo === '0' || !btnEval)?'disabled':'')+' evaluar" '+style+'><i class="fa fa-key" aria-hidden="true"></i></a>'+
						/* Boton de activacion */
						'<a title="Evaluar" '+((data.activo === '1' && btnPub)? hrefPub:'')+' class="bg-info btnTable '+
							((data.activo === '0' || !btnPub)?'disabled':'')+' publicar" '+style+'><i class="fa fa-lock" aria-hidden="true"></i></a></div>';
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
	}else if(segmento2 === 'bienes'){
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
						let style = 'style="padding:1px 4px"';
						let hrefEdit = 'href="'+base_url+'logistica/bienes/editar?id='+data.idarticulo+'"';
						let hrefServ = 'href="'+base_url+'logistica/bienes/servicios?id='+data.idarticulo+'"';
						let btnAccion =
						/* Boton de edicion */
						'<div class="btn-group">' +
						'<a title="Editar" '+(data.activo === '1' && btnEditArt? hrefEdit:'')+' class="bg-warning btnTable '+
							((data.activo === '0' || !btnEditArt)?'disabled':'')+' editar" '+style+'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
						/* Boton de permisos */
						'<a title="Servicios" '+(data.activo === '1' && btnServ? hrefServ:'')+' class="bg-warning btnTable '+
							((data.activo === '0' || !btnServ)?'disabled':'')+' servicios" '+style+'><i class="fa fa-cogs" aria-hidden="true"></i></a></div>';
						return btnAccion;
					}
				},
				{ data: 'tipo_articulo' },{ data: 'laboratorio' },{ data: 'unidad_medida' },{ data: 'presentacion' },
				{ 
					data: 'fotografia',
					createdCell: function(td,cellData,rowData,row,col){
						$(td).addClass('p-1');
					},
					render: function(data){
						return '<img src="'+base_url+'public/images/articulos/'+data+'" style="display:block;margin:auto;width:40px" class="img img-fluid" >';
					}
				},
				{ data: 'disponible_compra', render: function(data){ return (data === '1'? 'SI':'NO'); } },
				{ data: 'disponible_venta', render: function(data){ return (data === '1'? 'SI':'NO'); } },{ data: 'porcentaje_utilidad' },
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
				{title:'Acciones',targets: 0},{title:'Art&iacute;culo',targets: 1},{title:'Laboratorio',targets: 2},{title:'U.M',targets: 3},
				{title:'Presentaci&oacute;n',targets: 4},{title:'Fotograf&iacute;a',targets: 5},{title:'Disp. Compra',targets: 6},{title:'Disp. Vta',targets: 7},
				{title:'%',targets: 8},{title:'Status',targets: 9},
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