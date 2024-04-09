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
				{title:'Contacto',targets: 5},{title:'Status',targets: 6},
			], order: [],
		});
	}
});