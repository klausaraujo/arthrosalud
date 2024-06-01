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
											<div class="col-md-3 col-lg-3">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="paciente" id="paciente" 
															value="<?=$pac->nombres.' '.$pac->apellidos?>" readonly />
												</div>
											</div>
											<label class="control-label col-md-1 col-lg-1 align-self-center mb-0 pl-lg-5" for="sexo">Sexo:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="sexo" id="sexo" 
															value="<?=$pac->sexo === 'm'? 'Masculino':'Femenino'?>" readonly />
												</div>
											</div>
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0 pl-lg-5" for="nro">Nro. Historia:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="nro" id="nro" 
															value="<?=sprintf("%06s",$hist->numero)?>" readonly />
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="fechanac">Fecha Nac.:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm" name="fechanac" id="fechanac" value="<?=$pac->fecha?>" readonly />
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 my-3">
										<div class="row">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="idest">Establecimiento:</label>
											<div class="col-md-3 col-lg-3">
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
											<div class="col-md-3 col-lg-3">
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
								<div class="container-fluid row"><hr class="col-sm-12"></div>
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
															<option value="1">1 - M&eacute;dica</option>
															<option value="2">2 - No M&eacute;dica</option>
														</select>
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0" for="prioridad">Prioridad:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="prioridad" id="prioridad" />
															<option>-- Seleccione --</option>
															<option value="1">Prioridad I</option>
															<option value="2">Prioridad II</option>
															<option value="3">Prioridad III</option>
															<option value="4">Prioridad IV</option>
														</select>
													</div>
												</div>
												<div class="col-md-1 col-lg-2">
													<div class="row">
														<div class="custom-control custom-switch col-12 ml-3 pl-md-5">
															<input type="checkbox" class="custom-control-input" name="gestante" id="gestante" />
															<label class="custom-control-label" for="gestante">Gestante:</label>
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
											<div class="row mt-md-4">
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="parterial">Presi&oacute;n Arterial:</label>
												<div class="col-md-2 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm col-5" name="parterial1" id="parterial1" />&nbsp;/&nbsp;
														<input type="text" class="form-control form-control-sm col-5" name="parterial2" id="parterial2" />
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0 pl-lg-5" for="pvenosa">Presi&oacute;n Venosa:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="pvenosa" id="pvenosa" />
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0" for="saturacion">Saturaci&oacute;n:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="saturacion" id="saturacion" />
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-2 align-self-center mb-0 pl-lg-5" for="temp">Temperatura:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="temp" id="temp" />
													</div>
												</div>
											</div>
											<div class="row mt-md-4">
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="fcardiaca">F. Card&iacute;aca:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="fcardiaca" id="fcardiaca" />
													</div>
												</div>
												<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="frespiratoria">F. Respiratoria:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="frespiratoria" id="frespiratoria" />
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="peso">Peso:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="peso" id="peso" />
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="talla">Talla:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="" id="talla" />
													</div>
												</div>
											</div>
											<div class="row mt-md-4">
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="imc">IMC:</label>
												<div class="col-md-1 col-lg-1">
													<div class="row">
														<input type="text" class="form-control form-control-sm" name="imc" id="imc" />
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="ao">AO:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="ao" id="ao" />
															<option>-- Seleccione --</option>
															<option value="1">1 - No Responde</option>
															<option value="2">2 - Ante el Dolor</option>
															<option value="3">3 - Ante una Orden Verbal</option>
															<option value="4">4 - Espont&aacute;neamente</option>
														</select>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="rv">RV:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="rv" id="rv" />
															<option>-- Seleccione --</option>
															<option value="1">1 - Ninguna Respuesta</option>
															<option value="2">2 - Sonidos Incomprensibles</option>
															<option value="3">3 - Palabras Inapropiadas</option>
															<option value="4">4 - Confusa y desorientada</option>
															<option value="5">5 - Orientada y Conversando</option>
														</select>
													</div>
												</div>
												<label class="control-label col-md-1 col-lg-1 align-self-center mb-0" for="rm">RM:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="rm" id="rm" />
															<option>-- Seleccione --</option>
															<option value="1">1 - Ninguna Respuesta</option>
															<option value="2">2 - Extensi&oacute;n Hipertonica (Postura en extensi&oacute;n) Descerebraci&oacute;n</option>
															<option value="3">3 - Flexi&oacute;n Hipertonica (Postura de flexi&oacute;n) / Decorticaci&oacute;n</option>
															<option value="4">4 - Movimiento de Retirada (Flexi&oacute;n inespec&iacute;fico)</option>
															<option value="5">5 - Localiza el Dolor</option>
															<option value="6">6 - Obedece Comandos</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-md-4">
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0" for="glasgow">Glasgow:</label>
												<div class="col-md-3 col-lg-3">
													<div class="row">
														<input type="text" class="form-control form-control-sm mayusc" name="glasgow" id="glasgow" />
													</div>
												</div>
												<label class="control-label col-md-3 col-lg-2 align-self-center mb-0 pl-md-5" for="atencion">Observaciones:</label>
												<div class="col-md-4 col-lg-5">
													<div class="row">
														<input type="text" class="form-control form-control-sm mayusc" name="obs" />
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="diagnosticos" role="tabpanel" aria-labelledby="diagnosticos-tab">
											<div class="row mt-3">
												<input type="hidden" id="idcie" />
												<input type="hidden" id="codcie" />
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
												<label class="control-label col-md-2 col-lg-1 align-self-center mb-0 ml-md-5" for="tpdiag">Tipo:</label>
												<div class="col-md-2 col-lg-2">
													<div class="row">
														<select type="text" class="form-control form-control-sm" name="tpdiag" id="tpdiag" />
															<option value="">-- Seleccione --</option>
															<option value="1">1 - Presuntivo</option>
															<option value="2">2 - Definitivo</option>
														</select>
													</div>
												</div>
												<div class="col-md-1 col-lg-1"><a class="btn btn-sabogal" id="addtipo">Agregar</a></div>
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