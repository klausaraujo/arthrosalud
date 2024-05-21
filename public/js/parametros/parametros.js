let grillappal = null;

$(document).ready(function (){	
	if(segmento2 === 'empresas' || segmento2 == ''){
		grillappal = $('#tablaEmpresas').DataTable({
			ajax: {
				url: base_url + 'parametros/empresas/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{
					data: null,
					orderable: false,
					render: function(data){
						let style = 'style="padding:1px 3px;border:1px solid #bcbcbc"';
						let hrefEdit = 'href="'+base_url+'parametros/empresas/editar?id='+data.idempresa+'"';
						let hrefAnular = 'href="'+base_url+'parametros/empresas/anular?id='+data.idempresa+'"';
						let btnAccion =
						'<div class="btn-group">' +
						/* Boton de edicion */
						'<a title="Editar Empresa" '+(data.activo === '1' && btnEdit? hrefEdit:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnEdit)?
							'disabled':'')+' editar" '+style+'><img src="'+base_url+'public/images/iconos/edit_ico.png" width="20"></a>'+
						/* Boton anular Empresa */
						'<a title="Anular Empresa" '+(data.activo === '1' && btnAnular? hrefAnular:'')+' class="bg-light btnTable '+((data.activo === '0' || !btnAnular)
							?'disabled':'')+' anular" '+style+'><img src="'+base_url+'public/images/iconos/cancel_ico.png" width="20"></a></div>';
						return btnAccion;
					}
				},
				{ data: 'ruc' },{ data: 'nombre_comercial' },{ data: 'domicilio' },{ data: 'ubigeo' },{ data: 'renipress' },
				{ 
					data: 'logotipo',
					createdCell: function(td,cellData,rowData,row,col){
						$(td).addClass('p-0');
					},
					render: function(data){
						return '<img src="'+base_url+'public/images/logos/'+data+'" style="display:block;margin:auto;width:40px" class="img img-fluid" >';
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
				{title:'Acciones',targets: 0},{title:'RUC',targets: 1},{title:'Nombre Comercial',targets: 2},{title:'Domicilio',targets: 3},{title:'Ubigeo',targets: 4},
				{title:'Renipress',targets: 5},{title:'Logotipo',targets: 6},{title:'Status',targets: 7},
			], order: [],
		});
	}
});