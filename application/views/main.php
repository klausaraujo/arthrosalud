<?ini_set('date.timezone','America/Lima');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Loader Header -->
		<?php	require_once('inc/header.php'); date_default_timezone_set('America/Lima');?>
		<title>Arthrosalud</title>
	</head>
	<body>
		<!-- loader Start -->
		<!--<div id="loading">
			<div id="loading-center">

			</div>
		</div>-->
		<!-- loader END -->
		<!-- Wrapper Start -->
		<div class="wrapper bg-narsa">
			<!-- Sidebar  -->
			<?php $this->load->view('inc/nav-template'); ?>
			<!-- Sidebar END -->
			<!-- Page Content  -->
			<div id="content-page" class="content-page">
				<!-- TOP Nav Bar -->
				<?php $this->load->view('inc/nav-top-template'); ?>
				<!-- TOP Nav Bar END -->
				<div class="container-fluid">
					<div class="row mx-1">
					<?php 
						//echo date_default_timezone_get();
						if($this->uri->segment(1) == '') $this->load->view('modulos');
						elseif($this->uri->segment(1) === 'usuarios' && ($this->uri->segment(2) == '' || $this->uri->segment(2) === 'usuarios'))
							$this->load->view('usuarios/usuarios');
						elseif($this->uri->segment(1) === 'usuarios' && $this->uri->segment(2) === 'nuevo') $this->load->view('usuarios/form-new');
						elseif($this->uri->segment(1) === 'usuarios' && $this->uri->segment(2) === 'editar') $this->load->view('usuarios/form-editar');
						elseif($this->uri->segment(2) === 'perfil') $this->load->view('usuario/perfil');
						elseif($this->uri->segment(1) === 'parametros'){
							if($this->uri->segment(2) == '')
								$this->load->view('parametros/empresas');
							elseif($this->uri->segment(2) === 'empresas'){
								if($this->uri->segment(3) == '') $this->load->view('parametros/empresas');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('parametros/form-new');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('parametros/form-edit');
							}elseif($this->uri->segment(2) === 'centros') $this->load->view('parametros/centro-costos');
						}elseif($this->uri->segment(1) === 'logistica'){
							if($this->uri->segment(2) == '') $this->load->view('logistica/proveedores');
							elseif($this->uri->segment(2) === 'proveedores'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/proveedores');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-new');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/form-edit');
							}elseif($this->uri->segment(2) === 'bienes'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/bienes');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-bienes');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/bienes-edit');
							}elseif($this->uri->segment(2) === 'servicios'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/servicios');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-servicios');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/servicios-edit');
							}elseif($this->uri->segment(2) === 'gentrada'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/ingresos');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-ingresos');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/form-ingresos-edit');
							}elseif($this->uri->segment(2) === 'gsalida'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/salidas');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-salidas');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/form-salidas-edit');
							}elseif($this->uri->segment(2) === 'ocompra'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/ocompra');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-oc');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/form-oc-edit');
							}elseif($this->uri->segment(2) === 'oservicio'){
								if($this->uri->segment(3) == '') $this->load->view('logistica/oservicio');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('logistica/form-os');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('logistica/form-os-edit');								
							}else $this->load->view('mantenimiento');
						}elseif($this->uri->segment(1) === 'citas'){
							if(!strlen($this->uri->segment(2))) $this->load->view('citas/citasdash');
							elseif($this->uri->segment(2) === 'citasprof') $this->load->view('citas/citas');
							elseif($this->uri->segment(2) === 'pacientes'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/pacientes');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/form-paciente');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('citas/form-paciente-editar');
							}elseif($this->uri->segment(2) === 'consultorios'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/consultorios');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/form-consultorio');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('citas/form-consultorio-editar');
							}elseif($this->uri->segment(2) === 'citas'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/citasdash');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/calendario');
							}elseif($this->uri->segment(2) === 'medicos'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/medicos');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/form-medico');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('citas/form-medico-editar');
							}elseif($this->uri->segment(2) === 'turnos'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/turnos');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/form-turnos');
								elseif($this->uri->segment(3) === 'detalle') $this->load->view('citas/detalle_turno');
								else $this->load->view('mantenimiento');
							}elseif($this->uri->segment(2) === 'historia'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/historia');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/form-historia');
								elseif($this->uri->segment(3) === 'regdetalle') $this->load->view('citas/form-detalle-historia');
								else $this->load->view('mantenimiento');
							}elseif($this->uri->segment(2) === 'adicional'){
								$this->load->view('citas/form-adicional');
							}elseif($this->uri->segment(2) === 'procedimientos'){
								if(!strlen($this->uri->segment(3))) $this->load->view('citas/procedimientos');
								elseif($this->uri->segment(3) === 'nuevo') $this->load->view('citas/form-procedimientos');
								elseif($this->uri->segment(3) === 'editar') $this->load->view('citas/form-procedimientos-editar');
								else $this->load->view('mantenimiento');
							}
						}else $this->load->view('mantenimiento');
					?>
					</div>
					<!-- Footer -->
					<?php $this->load->view('inc/footer-template'); ?>
				</div>
				
				<!-- Footer END -->
			</div>
			<!-- Page Content END -->
		</div>
		<!-- Wrapper END -->
		<?php	require_once('inc/footer.php');	?>
	</body>
</html>
