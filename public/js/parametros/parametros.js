let tablaEmpresas = null;

$(document).ready(function (){
	if(segmento2 == ''){
	}else if(segmento2 === 'empresas'){
		tablaEmpresas = $('#tablaEmpresas').DataTable({
			ajax: {
				url: base_url + 'parametros/empresas/lista',
			},
			bAutoWidth:false, bDestroy:true, responsive:true, select:false, lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todas']], language: lngDataTable,
			columns:[
				{ data: 'ruc' },{ data: 'nombre_comercial' },{ data: 'domicilio' },{ data: 'ubigeo' },{ data: 'renipress' },
				{ 
					data: 'logotipo',
					createdCell: function(td,cellData,rowData,row,col){
						$(td).addClass('p-1');
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
				{title:'RUC',targets: 0},{title:'Nombre Comercial',targets: 1},{title:'Domicilio',targets: 2},{title:'Ubigeo',targets: 3},
				{title:'Renipress',targets: 4},{title:'Logotipo',targets: 5},{title:'Status',targets: 6},
			], order: [],
		});
	}
});
$('.atach').bind('change', function(){
	let file = this.files[0], arr = (this.files[0]!==undefined?file.name.split('.'):[]), ext = $(arr).get(-1);
	
	if(ext === 'pdf' || ext === 'docx' || ext === 'doc'){
		if(this.id === 'customfile'){
			$('.tdr').html(file.name);
			$('.sptdr').html('<span class="text-primary">Archivo Correcto</span>');
			$('#file1').val(file.name);
		}else if(this.id === 'customfile1'){
			$('.anexo').html(file.name);
			$('.spanexo').html('<span class="text-primary">Archivo Correcto</span>');
			$('#file2').val(file.name);
		}
	}else{
		$(file).val('');
		if(this.id === 'customfile'){
			$('.sptdr').html('<span class="text-danger">Archivo inv&aacute;lido</span>');
			$('#file1').val(''), $('.tdr').html('');
		}else if(this.id === 'customfile1'){
			$('.spanexo').html('<span class="text-danger">Archivo inv&aacute;lido</span>');
			$('#file2').val(''), $('.anexo').html('');
		}
	}
});
$('.form').validate({
	errorClass: 'form_error',
	validClass: 'success',
	rules: { 
		finicio: { required: function () { if ($('#finicio').css('display') != 'none') return true; else return false; } },
	},
	messages: {
		finicio: { required: '' },
	},
	errorPlacement: function(error, element){},
	submitHandler: function (form, event){
		if($('#file1').val() !== '' && $('#file2').val() !== ''){
			let boton = $('#btnEnviar');
			$(boton).html('<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;Cargando...');
			$(boton).addClass('disabled'); $('.btn-cancelar').addClass('disabled');
			return true;
		}else{
			event.preventDefault();
			if($('#file1').val() === '') $('.sptdr').html('<span class="text-danger">Debe cargar un archivo</span>');
			if($('#file2').val() === '') $('.spanexo').html('<span class="text-danger">Debe cargar un archivo</span>');
		}
	}
});

function formatoFecha(fecha, formato) {
	let m = (fecha.getMonth()+1).toString();
	m = m.length < 2? '0'+m : m;
    const map = {
        Y: fecha.getFullYear(),
		m: m,
		d: fecha.getDate(),
        h: fecha.getHours()+':'+fecha.getMinutes(),
    }
    return formato.replace(/Y|m|d|h/gi, matched => map[matched])
}

$('.blur').on('blur',function(){
	let id = $(this).attr('id');
	if(!isNaN(this)){
		alert('Formato de fecha errado');
		let fecha = formatoFecha(new Date(),'Y-m-d h'); $('#finicio').val(fecha), $('#ffin').val(fecha);
	}else{
		let f2 = new Date($('#ffin').val()), f1 = new Date($('#finicio').val());
		if((f2.getTime()-f1.getTime()) < 0){
			alert('La fecha/hora inicial no puede ser mayor que la fecha/hora final');
			let fecha = formatoFecha(new Date(),'Y-m-d h'); $('#finicio').val(fecha), $('#ffin').val(fecha);
		}
	}
});

$('#tablaLocadores').bind('click','a',function(e){
	let el = e.target, a = $(el).closest('a'), mensaje = '';
	let data = tablaLocadores.row(a).child.isShown()? tablaLocadores.row(a).data() : tablaLocadores.row($(el).parents('tr')).data();
	if($(a).hasClass('cancelar')){
		e.preventDefault();
		mensaje = 'Seguro que desea Cancelar la convocatoria?';
		let confirmacion = confirm(mensaje);
		if(confirmacion){
			$.ajax({
				data: {},
				url: $(a).attr('href'),
				method: 'GET',
				dataType: 'JSON',
				error: function(xhr){},
				beforeSend: function(){},
				success: function(data){
					if(parseInt(data.status) === 200){
						tablaLocadores.ajax.reload();
					}
					$('.resp').html(data.msg);
					setTimeout(function () { $('.resp').html(''); }, 2500);
				}
			});
		}
	}
});

$('#tablaEval').bind('input',function(e){
	let el = e.target;
	if($(el).attr('type') === 'text'){
		jQuery(el).val(jQuery(el).val().replace(/([^0-9\.]+)/g, ''));
		jQuery(el).val(jQuery(el).val().replace(/^[\.]/,''));
		jQuery(el).val(jQuery(el).val().replace(/[\.][\.]/g,''));
		jQuery(el).val(jQuery(el).val().replace(/\.(\d)(\d)(\d)/g,'.$1$2'));
		jQuery(el).val(jQuery(el).val().replace(/\.(\d{1,2})\./g,'.$1'));
	}
});
$('#tablaEval').bind('click',function(e){
	let el = e.target;
	if($(el).attr('type') === 'text') $(el).select();
});
$('#evaluar').bind('click',function(e){
	//let arr = tablaEval.rows().data().toArray();
	let data = [], row = null, dni = '', valor = '', ganador = '', id = '', idpost = '';
	
	$('#tablaEval tbody tr').each(function(i, e){
		dni = $(e).children(':first').html();
		$('#tablaEval tbody input').each(function(ind, el){
			row = tablaEval.row($(el).parents('tr')).data();
			if(dni === row.numero_documento){
				id = row.idpostulacion, idpost = row.idconvocatoria;
				if(el.type === 'text'){
					valor = el.value;
				}else if(el.type === 'checkbox' && $(el).prop('checked')){
					ganador = 1;
				}if(el.type === 'checkbox' && !$(el).prop('checked')){
					ganador = 0;
				}
			}
		});
		data.push({
			'idconvocatoria' : idpost,
			'idpostulacion' : id,
			'puntaje' : valor,
			'ganador' : ganador
		});
	});
	$(location).attr('href',base_url+segmento+'/evaluado?json='+JSON.stringify(data));
	//console.log(JSON.stringify(data));
});