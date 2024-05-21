let btnCancelar = $('.btn-cancelar'), inputs = document.querySelectorAll( '.inputfile' );

$(document).ready(function (){
	setTimeout(function () { $('.alert').hide('slow'); }, 2500);
	$('html, body').animate({ scrollTop: 0 }, 'fast');
	//setTimeout(function(){ $('.msg').hide('slow'); }, 3000);
});

Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;
		input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( '\\' ).pop();
			if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
		// Firefox bug fix
	input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
	input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
});

function formatMoneda(v){
	let n = parseFloat(v).toFixed(2);
	n = (n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	return n;
}
function ceros( number, width ){
	width -= number.toString().length;
	if ( width > 0 ){
		return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
	}
	return number + ""; // siempre devuelve tipo cadena
}

$('.tipodoc').bind('change',function(e){
	if(this.value === '1') $('.numcurl').prop('maxlength',8);
	else if(this.value === '2') $('.numcurl').prop('maxlength',9);
	
	if(this.value === '1' || this.value === '2'){
		$('.ruc').removeAttr('readonly'), $('.numcurl').removeAttr('readonly');/*, $('.nombres').attr('readonly', true), $('.apellidos').attr('readonly', true);*/
		$('.btn_curl').removeClass('disabled'), $('.btn_ruc').removeClass('disabled');/*, $('.usuario').attr('readonly', true);*/
	}
	
	$('.borra').val('');
	$('.perfil').val('2');
	$('.numcurl').focus();
	
	if(this.value === '3'){
		$('.numcurl').prop('maxlength',8), $('.numcurl').val('00000000'), $('.ruc').val('00000000000'), $('.usuario').removeAttr('readonly'), $('.apellidos').removeAttr('readonly');
		$('.nombres').removeAttr('readonly'), $('.nombres').focus(), $('.btn_curl').addClass('disabled'), $('.btn_ruc').addClass('disabled'), $('.ruc').attr('readonly', true);
		$('.numcurl').attr('readonly', true);
	}
});

$('.moneda').bind('input',function(e){
	//return mascara(this,cpf);
	jQuery(this).val(jQuery(this).val().replace(/([^0-9\.]+)/g, ''));
	jQuery(this).val(jQuery(this).val().replace(/^[\.]/,''));
	jQuery(this).val(jQuery(this).val().replace(/[\.][\.]/g,''));
	jQuery(this).val(jQuery(this).val().replace(/\.(\d)(\d)(\d)/g,'.$1$2'));
	jQuery(this).val(jQuery(this).val().replace(/\.(\d{1,2})\./g,'.$1'));
});

$('.num').bind('input',function(e){
	jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
});

$('.mayusc').bind('input',function(e){
	jQuery(this).val(jQuery(this).val().toUpperCase());
});
btnCancelar.bind('click', function(){
	let path = '';
	if(segmento3) path = base_url+segmento+'/'+segmento2;
	else if(segmento2) path = base_url+segmento;
	$(location).attr('href',path);
});

$('#formPassword').validate({
	errorClass: 'form_error',
	rules: {
		old_password: { required: true },
		password: { required: true, minlength: 6 },
		re_password: { required: true, equalTo: "#password" }
	},
	messages: {
		old_password: { required: '&nbsp;&nbsp;Ingrese la contrase\xf1a actual' },
		password: { required: '&nbsp;&nbsp;Ingrese la nueva contrase\xf1a', minlength: '&nbsp;&nbsp;Por lo menos 6 caracteres' },
		re_password: { required: '&nbsp;&nbsp;Ingrese nuevamente la contrase\xf1a', equalTo: '&nbsp;&nbsp;Las contrase\xf1as deben ser iguales' }
	},
	errorPlacement: function(error, element) {
		error.insertAfter(element);
	},
	submitHandler: function (form, event) {
		event.preventDefault();
		$.ajax({
			data: $('#formPassword').serialize(),
			url: base_url + 'main/cambiapass',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function () {
				//$('.resp').html('<i class="fas fa-spinner fa-pulse fa-2x"></i>');
				$('#formPassword button[type=submit]').html('<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;Cargando...');
				$('#formPassword button[type=submit]').addClass('disabled');
			},
			success: function (data) {
				//$('.resp').html('');
				$('#formPassword button[type=submit]').html('Realizar Cambio');
				$('#formPassword button[type=submit]').removeClass('disabled');
				//console.log(data);
				if (parseInt(data.status) === 200) {
					$('.resp').html(data.message);
					setTimeout(function () { $('.resp').html('&nbsp;'); }, 1500);
					$('#formPassword input').val('');
				}else {
					$('.resp').html(data.message);
					setTimeout(function () { $('.resp').html('&nbsp;'); }, 1500);
				}
			}
		});
	}
});
/* Seleccionar texto al posicionarse sobre el campo */
$('.blur').focus(function(){ this.select(); });

$('table').on('click','tr,a',function(event){
	let tabla = $(this).closest('table');
	if(tabla.hasClass('t-sel')){
		let bot = $(this).find('.btnTable');
		if($(this).hasClass('selected')) {
			//$(this).removeClass('selected');
		}else{
			$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
		$.each(bot,function(i,e){
			//console.log(e);
			if(!$(e).hasClass('disabled')){ $(e).css('color','#fff'); }
			if($(e).hasClass('btnActivar')){ $(e).css('color','red'); }
			if($(e).hasClass('btnDesactivar')){ $(e).css('color','green'); }
		});
	}
	if($(this).hasClass('anular')){
		event.preventDefault();
		let c = confirm('Desea anular el registro?');
		
		if(c){
			$.ajax({
				data: {},
				url: $(this).attr('href'),
				method: 'GET',
				dataType: 'JSON',
				beforeSend: function(){},
				success: function(data){
					if(segmento2 === 'empresas') $('#tablaEmpresas').DataTable().ajax.reload();
					else if(segmento2 === 'proveedores') $('#tablaProveedores').DataTable().ajax.reload();
					else if(segmento2 === 'bienes') $('#tablaBienes').DataTable().ajax.reload();
					else if(segmento2 === 'servicios') $('#tablaServicios').DataTable().ajax.reload();
					
					$('.msg').html(data.msg);
					setTimeout(function(){ $('.msg').hide('slow'); }, 3000);
				}
			});
		}
	}
});
$('.dep').bind('change', function(){
	let cod = this.value, html = '<option value="">-- Seleccione --</option>';
	$.ajax({
		data: { cod_dep: cod },
		url: base_url + 'main/provincias',
		method: 'POST',
		dataType: 'JSON',
		beforeSend: function () {
			$('.dis').html('<option>-- Seleccione --</option>'); $('.pro').html('<option> Cargando...</option>');
		},
		success: function (data) {
			$.each(data, function (i, e){ html += '<option value="' + e.cod_pro + '">' + e.provincia + '</option>'; });
			$('.pro').html(html);
			//console.log(data);
		}
	});
});
$('.pro').bind('change', function(){
	let cod = this.value, html = '<option value="">-- Seleccione --</option>';
	$.ajax({
		data: { cod_dep: $('.dep').val(),cod_pro: cod },
		url: base_url + 'main/distritos',
		method: 'POST',
		dataType: 'JSON',
		beforeSend: function () {
			$('.dis').html('<option> Cargando...</option>');
		},
		success: function (data) {
			$.each(data, function (i, e){ html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>'; });
			$('.dis').html(html);
			//console.log(data);
		}
	});
});
$('.dis').change(function(){
	let id = this.value, dpto = $('.dep').val(), prov = $('.pro').val();
    if (id.length > 0) {
		$.ajax({
			data: { cod_dep: dpto, cod_pro: prov, cod_dis: id },
			url: base_url + 'main/cargarLatLng',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){},
			success: function (data) {
				var opt = {lat: parseFloat(data[0].latitud), lng: parseFloat(data[0].longitud), zoom: 16};
				map.setCenter(opt);
				$('.ajaxMap').removeClass('d-none');
			}
		});
	}
});
$('#busca_ruc').on('click',function(){
	let ruc = $('#ruc').val(), val = true, bot = $(this); $('#nombres').val(''), $('#direccion').val('');
	if(ruc.length == ''){ alert('Debe indicar un número de RUC'); val = false; $('#ruc').val(''); $('#ruc').focus(); return false; }
	if(ruc.length < 11){ alert('El RUC debe tener 11 dígitos'); val = false; $('#ruc').val(''); $('#ruc').focus(); return false; }
	
	if(val){
		$.ajax({
			data: { ruc: ruc },
			url: base_url + 'main/ruccurl',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){ bot.addClass('pt-0'), bot.html('<span class="spinner-border spinner-border-sm"></span>'); },
			success: function (data) {
				bot.removeClass('pt-0'), bot.html('<i class="fa fa-search aria-hidden="true"></i>');
				if(data.data.estado === 'ACTIVO'){
					$('#btnEnviar').removeClass('disabled');
					if(data.status === 200){
						$('#nombres').val((data.data.nombre).toLocaleUpperCase()), $('#doc').val('00000000'); $('#tipodoc').prop('selectedIndex',0);
						$('.direccion').val((data.data.direccion).toLocaleUpperCase());
					}else{ alert(data.data.error); $('#ruc').val(''); $('#ruc').focus(); }
				}else{
					$('#btnEnviar').addClass('disabled');
				}
			}
		});
	}
});