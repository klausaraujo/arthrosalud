					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Atenci&oacute;n</h4></div>
						</div>
						<div class="iq-card-body">
							<form method="post" id="form_turnos" action="<?=base_url()?>citas/historia/regatencion" class="needs-validation form-horizontal" novalidate="">
								<input type="hidden" name="tiporegistro" value="registrar" />
								<div class="form-row">
									<div class="col-12">
										<div class="row">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="paciente">Paciente:</label>
											<div class="col-md-3 col-lg-2">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="paciente" id="paciente" readonly />
												</div>
											</div>
											<label class="control-label col-md-1 col-lg-1 align-self-center mb-0 pl-lg-5" for="sexo">Sexo:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="sexo" id="sexo" readonly />
												</div>
											</div>
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0 pl-lg-5" for="nro">Nro. Historia:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="nro" id="nro" readonly />
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="fechanac">Fecha Nac.:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="fechanac" id="fechanac" readonly />
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 my-3">
										<div class="row">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="idest">Establecimiento:</label>
											<div class="col-md-3 col-lg-2">
												<div class="row">
													<select class="form-control form-control-sm" name="idest" id="idest" >
												<?
													foreach($estab as $row):	?>
														<option value="<?=$row->idempresa;?>"><?=$row->nombre_comercial;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
											<label class="control-label col-md-3 col-lg-2 align-self-center mb-0 pl-md-5" for="iddep">Departamento:</label>
											<div class="col-md-4 col-lg-3">
												<div class="row">
													<select class="form-control form-control-sm" name="iddep" id="iddep" >
												<?
													foreach($dep as $row):	?>
														<option value="<?=$row->iddepartamento;?>"><?=$row->departamento;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
										<div class="row mt-md-3">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="prof">Profesional:</label>
											<div class="col-md-3 col-lg-2">
												<div class="row">
													<select class="form-control form-control-sm" name="prof" id="prof" >
												<?
													foreach($prof as $row):	?>
														<option value="<?=$row->idprofesional;?>"><?=$row->apellidos.' '.$row->nombres;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
											<label class="control-label col-md-2 col-lg-1 align-self-center mb-0 pl-md-5" for="fecha">Fecha:</label>
											<div class="col-md-2 col-lg-2">
												<div class="row">
													<input type="date" class="form-control form-control-sm pl-md-3" name="fecha" id="fecha" value="<?=date('Y-m-d')?>" >
												</div>
											</div>
											<label class="control-label col-md-1 col-lg-1 align-self-center mb-0 pl-md-3" for="hora">Hora:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="time" class="form-control form-control-sm" name="hora" id="hora" value="<?=date('H:i')?>" >
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row my-1">
									<ul class="nav nav-tabs" id="myTab-1" role="tablist">
									  <li class="nav-item">
										 <a class="nav-link active" id="atenciones-tab" data-toggle="tab" href="#atenciones" role="tab" aria-controls="atenciones" 
												aria-selected="true">Atenciones</a>
									  </li>
									  <li class="nav-item">
										 <a class="nav-link" id="diagnosticos-tab" data-toggle="tab" href="#diagnosticos" role="tab" aria-controls="diagnosticos" 
												aria-selected="false">Diagn&oacute;sticos</a>
									  </li>
									  <li class="nav-item">
										 <a class="nav-link" id="procedimientos-tab" data-toggle="tab" href="#procedimientos" role="tab" aria-controls="procedimientos" 
												aria-selected="false">Procedimientos</a>
									  </li>
									  <li class="nav-item">
										 <a class="nav-link" id="indicaciones-tab" data-toggle="tab" href="#indicaciones" role="tab" aria-controls="indicaciones" 
												aria-selected="false">Indicaciones</a>
									  </li>
									</ul>
									<div class="tab-content container-fluid" id="myTabContent-2">
										<div class="tab-pane fade show active" id="atenciones" role="tabpanel" aria-labelledby="atenciones-tab">
											<div class="row mt-2">
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="atencion">Tipo de Atenci&oacute;n:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="atencion" id="atencion" />
															<option>-- Seleccione --</option>
														</select>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0" for="prioridad">Prioridad:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="prioridad" id="prioridad" />
															<option>-- Seleccione --</option>
														</select>
													</div>
												</div>
												<div class="col-md-1 col-lg-2">
													<div class="row">
														<div class="custom-control custom-switch col-12 ml-3 pl-md-5">
															<label class="custom-control-label" for="gestante">Gestante:</label>
														<input type="checkbox" class="custom-control-input" name="gestante">
														</div>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0 pl-md-5 pl-lg-0" for="semanas">
														&nbsp;&nbsp;&nbsp;Semanas:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="semanas" id="semanas" />
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="atencion">Presi&oacute;n Arterial:</label>
												<div class="col-md-2 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm col-5"/>&nbsp;/&nbsp;
														<input type="text" class="form-control form-control-sm col-5"/>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0 pl-lg-5" for="prioridad">Presi&oacute;n Venosa:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0" for="prioridad">Saturaci&oacute;n:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-2 align-self-center mb-0 pl-lg-5" for="prioridad">Temperatura:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0" for="atencion">F. Card&iacute;aca:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="prioridad">F. Respiratoria:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="prioridad">Peso:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="prioridad">Talla:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="prioridad">IMC:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="atencion">AO:</label>
												<div class="col-md-2 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="prioridad">RV:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="prioridad">RM:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0 mayusc" for="prioridad">Glasgow:</label>
												<div class="col-md-3 col-lg-4">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-3 col-lg-2 align-self-center mb-0" for="atencion">Observaciones:</label>
												<div class="col-md-9 col-lg-9">
													<div class="row">
														<input type="text" class="form-control form-control-sm"/>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="diagnosticos" role="tabpanel" aria-labelledby="diagnosticos-tab">
											<div class="row mt-3">
												<input type="hidden" id="idcie" />
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="cie10">CIE10:</label>
												<div class="col-md-4 col-lg-3">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="cie10" id="cie10" readonly />
													</div>
												</div>
												<div class="col-md-1 col-lg-1">
													<a href="<?=base_url()?>citas/historia/buscarcie" class="btn btn-primary" data-target="#modalCie10" 
														data-toggle="modal">Buscar</a>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0 ml-md-4" for="atencion">Tipo:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="prioridad" id="prioridad" />
															<option>-- Seleccione --</option>
														</select>
													</div>
												</div>
												<div class="col-md-1 col-lg-1"><a class="btn btn-sabogal">Agregar</a></div>
											</div>
											<div class="container-fluid">
												<div class="row mt-3">
													<div class="col-12" style="overflow-x:auto">
														<table id="tablacie" class="table table-striped table-hover table-bordered mb-0 mx-auto" style="width:100%"></table>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="procedimientos" role="tabpanel" aria-labelledby="procedimientos-tab">
											<div class="row mt-3">
												<label class="control-label col-md-3 col-lg-2 align-self-center mb-0" for="idprocedimiento">Procedimientos:</label>
												<div class="col-md-4 col-lg-3">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="idprocedimiento" id="idprocedimiento" />
															<option>-- Seleccione --</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-3 col-lg-2 align-self-center mb-0" for="atencion">Observaciones:</label>
												<div class="col-md-5 col-lg-5">
													<div class="row">
														<input type="text" class="form-control form-control-sm mayusc"/>
													</div>
												</div>
												<div class="col-md-1 col-lg-1"><a class="btn btn-sabogal">Agregar</a></div>
											</div>
											<div class="container-fluid">
												<div class="row mt-3">
													<div class="col-12" style="overflow-x:auto">
														<table id="tablaproc" class="table table-striped table-hover table-bordered mb-0 mx-auto" style="width:100%"></table>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="indicaciones" role="tabpanel" aria-labelledby="indicaciones-tab">
											
										</div>
									</div>
								</div>
								<div class="container-fluid row"><hr class="col-sm-12"></div>
								<div class="col-12 mx-auto pb-2">
									<button type="submit" class="btn btn-sabogal ml-1 mr-4" id="btnEnviar">Guardar</button>
									<button type="reset" class="btn btn-light btn-cancelar">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
					
					<div class="modal fade" id="modalCie10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Elegir CIE10</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body" style="overflow: hidden;">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 mx-auto" style="overflow-x:auto">
												<table id="tablaCIE10" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
													<thead><tr><th>CIE10</th><th>Descripci&oacute;n</th><th>item</th></tr></thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>