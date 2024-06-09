						<div class="col-12 card px-0 my-3">
							<div class="card-body">
								<div class="container-fluid px-0 mx-0">
									<h4 class="float-left my-0">Citas</h4>
									<form id="form_adicional" action="<?=base_url()?>citas/adicional" method="POST" >
										<input type="hidden" id="json" name="json"  />
									</form>
									<a href="adicional" class="btn btn-sabogal float-right adicional">Nueva Cita Adicional</a>
								</div>
								<hr class="row mt-5 mx-1">
								<div class="row justify-content-center py-2">
									<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 fade show" role="alert">
										<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
									</div><?}?>
									<div class="msg"></div>
								</div>
								<div class="row">
									<div class="float-left col-md-5 col-lg-4 mt-sm-2">
										<div class="wrapper-c">
											<header>
												<input type="hidden" class="mes" />
												<p class="current-date"></p>
												<div class="icons" style="font-size:0.6em">
													<span id="prev"><i class="fas fa-less-than"></i></span>
													&nbsp;&nbsp;&nbsp;&nbsp;<span id="next"><i class="fas fa-greater-than"></i></span>
												</div>
											</header>
											<hr class="c-hr">
											<div class="calendar">
												<ul class="weeks">
													<li>Dom</li>
													<li>Lun</li>
													<li>Mar</li>
													<li>Mie</li>
													<li>Jue</li>
													<li>Vie</li>
													<li>Sab</li>
												</ul>
												<ul class="days"></ul>
											</div>
										</div>
									</div>
									<div class="float-right col-md-7 col-lg-6 mt-md-5">
										<input type="hidden" class="m" value="<?=date('n')?>" />
										<input type="hidden" class="d" value="<?=date('j')?>" />
										<div class="row">
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="idestablecimiento">Establecimiento:</label>
											<div class="col-md-6 col-lg-6">
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
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="iddepartamento">Departamento:</label>
											<div class="col-md-6 col-lg-6">
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
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="idconsultorio">Consultorio:</label>
											<div class="col-md-6 col-lg-6">
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
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="idprofesional">Profesional:</label>
											<div class="col-md-6 col-lg-6">
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
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="anio">A&ntilde;o:</label>
											<div class="col-md-6 col-lg-2">
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
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="msg">&nbsp;</div>
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
						
						<div class="modal fade" id="modalAsigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel">Asignar Paciente</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body" style="overflow: hidden;">
										<input type="hidden" id="idcita" />
										<input type="hidden" id="idpaciente" />
										<div class="container-fluid">
											<div class="row mb-4">
												<label class="control-label col-lg-2 align-self-center mb-0" for="paciente">Paciente:</label>
												<div class="col-lg-3">
													<input type="text" id="paciente" class="form-control form-control-sm paciente" readonly />
												</div>
												<label class="control-label col-lg-2 align-self-center mb-0" for="obs">Observaciones:</label>
												<div class="col-lg-3">
													<input type="text" id="obs" class="form-control form-control-sm mayusc" />
												</div>
												<div class="col-lg-2">
													<button class="btn btn-sabogal mt-2 mt-lg-0" id="asigna">Asignar</button>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-12 mx-auto" style="overflow-x:auto">
													<table id="tablaPacientes" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
														<thead>
															<tr><th>Tipo Doc.</th><th>Nro. Doc.</th><th>Apellidos</th><th>Nombres</th><th>item</th>
																<th>Fecha Nac.</th><th>Edo. Civil</th><th>Celular</th><th>Correo</th>
															</tr>
														</thead>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<div class="row">
											<div class="col-md-12">
												<button class="btn btn-light mr-3" data-dismiss="modal">Cancelar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>