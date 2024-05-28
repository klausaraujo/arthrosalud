						<div class="col-12 card px-0 my-3">
							<div class="card-body">
								<h4 class="">Citas</h4>
								<hr>
								<div class="float-left col-md-9">
									<div class="row">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idestablecimiento">Establecimiento:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm iddep" name="idestablecimiento" id="idestablecimiento" required="" >
											<?
												foreach($estab as $row):	?>
													<option value="<?=$row->idempresa;?>"><?=$row->nombre_comercial;?></option>
											<?	endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="iddepartamento">Departamento:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm cdep" name="iddepartamento" id="iddepartamento" required="" >
											<?
												foreach($dep as $row):	?>
													<option value="<?=$row->iddepartamento;?>"><?=$row->departamento;?></option>
											<?	endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idconsultorio">Consultorio:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm cons" name="idconsultorio" id="idconsultorio" required="" >
											<?
												foreach($cons as $row):	?>
													<option value="<?=$row->idconsultorio;?>"><?=$row->consultorio;?></option>
											<?	endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idprofesional">Profesional:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm cprof" name="idprofesional" id="idprofesional" required="" >
											<?
												foreach($prof as $row):	?>
													<option value="<?=$row->idprofesional;?>"><?=$row->apellidos.' '.$row->nombres;?></option>
											<?	endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="anio">A&ntilde;o:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm canio" name="anio" id="anio" required="" >
											<?
												foreach($anio as $row):
													if(intval($row->anio) >= date('Y')){
											?>
													<option value="<?=$row->anio;?>"><?=$row->anio;?></option>
											<?	
													}
												endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
								</div>
								<div class="float-right"><a href="<?=base_url()?>citas/citas/nuevo" class="btn btn-sabogal">Nueva Cita</a></div>
							</div>
							<div class="row justify-content-center py-2">
								<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 fade show" role="alert">
									<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
								</div><?}?>
								<div class="msg"></div>
							</div>
							<div class="container-fluid">
								<div class="row"> <!--class="table-responsive" -->
									<div class="col-12 mx-auto" style="overflow-x:auto">
									<!--<div class="col-sm-12 mx-auto" style="overflow-x:scroll"><!--align-items-center text-center-->
										<!--<table id="tablaProveedores" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-auto"></table>-->
										<!--<table id="tablaProveedores" class="table table-striped table-hover table-bordered mx-auto"></table>-->
										<table id="tablaCitas" class="table table-striped table-hover table-bordered mb-0 mx-auto" style="width:100%"></table>
									</div>
								</div>
							</div>
						</div>