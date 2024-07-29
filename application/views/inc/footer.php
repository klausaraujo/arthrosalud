		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="<?=base_url()?>public/js/jquery.min.js"></script>
		<!--<script src="<?=base_url()?>/public/js/jquery-3.5.1.js"></script>-->
		<script src="<?=base_url()?>public/js/popper.min.js"></script>
		<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
		  <!-- Appear JavaScript -->
		  <!--<script src="js/jquery.appear.js"></script>
		  <!-- Countdown JavaScript -->
		  <!--<script src="js/countdown.min.js"></script>
		<!-- Counterup JavaScript -->
		<script src="<?=base_url()?>public/js/waypoints.min.js"></script>
		<script src="<?=base_url()?>public/js/jquery.counterup.min.js"></script>
		<!-- Wow JavaScript -->
		<script src="<?=base_url()?>public/js/wow.min.js"></script>
		<!-- Apexcharts JavaScript -->
		<script src="<?=base_url()?>public/js/apexcharts.js"></script>
		  <!-- Slick JavaScript -->
		<script src="<?=base_url()?>public/js/slick.min.js"></script>
		<!-- Select2 JavaScript -->
		<script src="<?=base_url()?>public/js/select2.min.js"></script>
		  <!-- Owl Carousel JavaScript -->
		  <!--<script src="js/owl.carousel.min.js"></script>
		<!-- Magnific Popup JavaScript -->
		<script src="<?=base_url()?>public/js/jquery.magnific-popup.min.js"></script>
		<!-- Smooth Scrollbar JavaScript -->
		<script src="<?=base_url()?>public/js/smooth-scrollbar.js"></script>
		  <!-- lottie JavaScript -->
		  <!--<script src="js/lottie.js"></script>
		<!-- am core JavaScript -->
		<script src="<?=base_url()?>public/js/core.js"></script>
		  <!-- am charts JavaScript -->
		<script src="<?=base_url()?>public/js/charts.js"></script>
		  <!-- am animated JavaScript -->
		<script src="<?=base_url()?>public/js/animated.js"></script>
		  <!-- am kelly JavaScript -->
		  <!--<script src="js/kelly.js"></script>
		  <!-- Flatpicker Js -->
		  <!--<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<!-- Chart Custom JavaScript -->
		<script src="<?=base_url()?>public/js/chart-custom.js"></script>
		<!-- Custom JavaScript -->
		<script src="<?=base_url()?>public/js/custom.js"></script>
		<!--<script src="<?=base_url()?>/public/datatable/datatables.min.js"></script>
		<script src="<?=base_url()?>/public/datatable/dataTables.responsive.min.js"></script>-->
		<script src="<?=base_url()?>public/datatable/jquery.dataTables.min.js"></script>
		<script src="<?=base_url()?>public/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
		<script src="<?=base_url()?>public/js/general.js"></script>
		<script>
			let botones = '<"row"<"col-sm-12 mt-2 mb-4"B><"col-sm-6 float-left my-2"l><"col-sm-6 float-right my-2"f>rt>ip', map = null;
			const base_url = '<?=base_url()?>', segmento = '<?=$this->uri->segment(1)?>', segmento2 = '<?=$this->uri->segment(2)?>';
			const segmento3 = '<?=$this->uri->segment(3)?>';
			const opt = { style:'decimal', minimumFractionDigits: 2 };
			const lngDataTable = {
				"decimal": "",
				"emptyTable": "No se encontraron registros",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "No hay resultados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
			function mayus(e){e.value = e.value.toUpperCase();}
		</script>
		<!-- Rutinas Javascript por cada uno de los segmentos 1 -->
		<?php if($this->uri->segment(1) === 'usuarios'){ ?>
		<script src="<?=base_url()?>public/js/usuarios/usuarios.js"></script>
		<script>
			let botonesUser = JSON.parse('<?=$this->session->userdata('perUser')?>');
			<?if($this->uri->segment(2) == '' || $this->uri->segment(2) === 'usuarios'){?>
			let btnEditUser = false, btnPermisos = false, btnClave = false, btnActiva = false;
			
			$.each(botonesUser,function(i,e){
				if(e.idboton === '1') btnEditUser = true;
				else if(e.idboton === '2') btnPermisos = true;
				else if(e.idboton === '3') btnClave = true;
				else if(e.idboton === '4') btnActiva = true;
			});
			<?}?>
		</script>
		<?}elseif($this->uri->segment(1) === 'parametros'){ ?>
		<script src="<?=base_url()?>public/js/parametros/parametros.js"></script>
		<script>
			let botonesPar = JSON.parse('<?=$this->session->userdata('perParametros')?>');
			let btnEdit = false, btnAnular = false, btnAnularCentro = false, btnEditCentro = false;
			
			$.each(botonesPar,function(i,e){
				if(e.idboton === '5') btnEdit = true;
				else if(e.idboton === '6') btnAnular = true;
				else if(e.idboton === '7') btnEditCentro = true;
				else if(e.idboton === '8') btnAnularCentro = true;
			});
		</script>
			<?	if($this->uri->segment(2) === 'empresas'){?>
			<script src="<?=base_url()?>public/js/mapa/map.js"></script>
			<script>
			<?	if($this->uri->segment(3) === 'nuevo' || $this->uri->segment(3) === 'editar'){?>
					window.onload = function(){
						var opt = {lat: parseFloat(<?=$lat?>), lng: parseFloat(<?=$lng?>),zoom: 16};
						map = mapa(opt);
					}
			<?}?>
			</script>
			<?}?>
		<?}elseif($this->uri->segment(1) === 'logistica'){ ?>
		<script src="<?=base_url()?>public/js/logistica/logistica.js"></script>
		<script>
			let botonesLog = JSON.parse('<?=$this->session->userdata('perLogistica')?>');
			let btnEdit = false, btnAnular = false, btnEditArt = false, btnArt = false, btnAnularArt = false, btnEditServ = false, btnServ = false, btnAnularServ = false;
			
			$.each(botonesLog,function(i,e){
				if(e.idboton === '9') btnEdit = true;
				else if(e.idboton === '10') btnAnular = true;
				else if(e.idboton === '11') btnEditArt = true;
				else if(e.idboton === '12') btnArt = true;
				else if(e.idboton === '13') btnAnularArt = true;
				else if(e.idboton === '14') btnEditServ = true;
				else if(e.idboton === '15') btnServ = true;
				else if(e.idboton === '16') btnAnularServ = true;
			});
			<?
				$d = '';
				if(($this->uri->segment(2)==='gentrada' || $this->uri->segment(2)==='gsalida') && $this->uri->segment(3)==='editar')
					$d = $detalle;
			?>
			$('#json').val(JSON.stringify(<?=$d?>));
		</script>
			<?	if($this->uri->segment(2) === 'proveedores'){?>
			<script src="<?=base_url()?>public/js/mapa/map.js"></script>
			<script>
			<?	if($this->uri->segment(3) === 'nuevo'|| $this->uri->segment(3) === 'editar'){?>
					window.onload = function(){
						var opt = {lat: parseFloat(<?=$lat?>), lng: parseFloat(<?=$lng?>),zoom: 16};
						map = mapa(opt);
					}
			<?}?>
			</script>
			<?}?>
		<?}elseif($this->uri->segment(1) === 'citas'){ ?>
		<script src="<?=base_url()?>public/js/citas/citas.js"></script>
		<script>
			let botonesLog = JSON.parse('<?=$this->session->userdata('perCitas')?>');
			let btnAsignaCita = false, btnConfirmaCita = false, btnAnulaCita = false; btnEditTurno = false, btnAsignaTurno = false, btnAnulaTurno = false;
			let btnEdit = false, btnAnular = false, btnRegAtencion = false, btnVerHistoria = false, btnAnulaHistoria = false, btnEditPaciente = false;
			let btnAsignarSeguro = false, btnAnularPaciente = false, btnEditarMedico = false, btnAnularMedico = false, btnEditarCons = false, btnAnularCons = false;
			let btnEditaProc = null, btnGeneraForm = false, btnAnulaProc = false;
			
			$.each(botonesLog,function(i,e){
				if(e.idboton === '20') btnEditPaciente = true;
				else if(e.idboton === '21') btnAsignarSeguro = true;
				else if(e.idboton === '22') btnAnularPaciente = true;
				else if(e.idboton === '23') btnEditarMedico = true;
				else if(e.idboton === '24') btnAnularMedico = true;
				else if(e.idboton === '25') btnEditarCons = true;
				else if(e.idboton === '26') btnAnularCons = true;
				else if(e.idboton === '27') btnEditTurno = true;
				else if(e.idboton === '28') btnAsignaTurno = true;
				else if(e.idboton === '29') btnAnulaTurno = true;
				else if(e.idboton === '30') btnAsignaCita = true;
				else if(e.idboton === '31') btnConfirmaCita = true;
				else if(e.idboton === '32') btnAnulaCita = true;
				else if(e.idboton === '33') btnEditaProc = true;
				else if(e.idboton === '34') btnGeneraForm = true;
				else if(e.idboton === '35') btnAnulaProc = true;
				else if(e.idboton === '36') btnRegAtencion = true;
				else if(e.idboton === '37') btnVerHistoria = true;
				else if(e.idboton === '38') btnAnulaHistoria = true;
			});
		</script>
		<?}
		if($this->uri->segment(1) === 'usuarios' && ($this->uri->segment(2) == '' || $this->uri->segment(2) === 'usuarios')){ ?>
		<script>
			const headers = JSON.parse('<?=json_encode($headers)?>');
		</script>
		<?}?>