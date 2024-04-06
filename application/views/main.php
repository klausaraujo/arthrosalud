<!doctype html>
<html lang="es">
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
						elseif($this->uri->segment(1) === 'parametros' && $this->uri->segment(2) === 'empresas') $this->load->view('parametros/form-new');
						elseif($this->uri->segment(1) === 'logistica' && $this->uri->segment(2) === 'proveedores') $this->load->view('logistica/form-new');
					?>
					</div>
				</div>
				<!-- Footer -->
				<?php $this->load->view('inc/footer-template'); ?>
				<!-- Footer END -->
			</div>
			<!-- Page Content END -->
		</div>
		<!-- Wrapper END -->
		<?php	require_once('inc/footer.php');	?>
	</body>
</html>
