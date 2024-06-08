						<div class="col-12 card px-0 my-3">
							<div class="card-body" style="overflow-auto">
								<div class="row justify-content-center pb-1 mensaje">&nbsp;</div>
								<form id="form-adicional" method="post" action="<?=base_url()?>citas/regadicional"
									class="needs-validation form-horizontal" novalidate="">
									<div class="container-fluid" style="">
										<div class="row">
											<div class="col-md-8 mx-auto">
												<div class="card text-white bg-light mb-3 mx-auto">
													<div class="card-header" style="color:#000"><h5>Cita Adicional</h5></div>
													<div class="card-body">
														<span style="color:#000"><b>Departamento:&nbsp;&nbsp;</b> <?=$data->departamento?></span><br>
														<span style="color:#000"><b>Consultorio:&nbsp;&nbsp;</b> <?=$data->consultorio?></span><br>
														<span style="color:#000"><b>M&eacute;dico:&nbsp;&nbsp;</b> <?=$data->nprof;?></span><br>
														<span style="color:#000"><b>Duraci&oacute;n de la consulta:&nbsp;&nbsp;</b> <?=$data->duracion?>  minutos</span><br>
														<span style="color:#000"><b>Fecha:&nbsp;&nbsp;</b> <?=date('d/m/Y',strtotime($data->fecha));?></span><br>
														<span style="color:#000"><b>Entrada:&nbsp;&nbsp;</b> <?=$data->entrada?></span>&nbsp;&nbsp;&nbsp;
														<span style="color:#000"><b>Salida:&nbsp;&nbsp;</b> <?=$data->salida?></span>
														
														<!-- Campos hidden -->
														<input type="hidden" name="idcons" value="<?=$data->idconsultorio;?>" />
														<input type="hidden" name="iddep" value="<?=$data->iddepartamento;?>" />
														<input type="hidden" name="idprof" value="<?=$data->idprofesional;?>" />
														<input type="hidden" id="idpaciente" name="idpaciente" />
														<input type="hidden" name="idturno" value="<?=$data->idturno;?>" />
														<input type="hidden" name="fecha" value="<?=$data->fecha;?>" />
														<input type="hidden" name="entrada" value="<?=$data->entrada?>" />
														<input type="hidden" name="salida" value="<?=$data->salida?>" />
													</div>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<div class="col-md-8 mx-auto">
												<div class="row">
													<label class="control-label col-md-3 col-lg-2 align-self-center mb-0" for="paciente">Paciente:</label>
													<div class="col-md-9 col-lg-10">
														<div class="row">
															<input type="text" id="paciente" name="paciente" class="form-control form-control-sm mayusc col-10"
																	style="pointer-events:none" required=""/>
															<a href="<?=base_url()?>/citas/historia/buscarpaciente" data-target="#modalAsigna" data-toggle="modal" title="Buscar">
																<i class="fa fa-search col-2 mt-2" aria-hidden="true" style="font-size:1.3em"></i>
															</a>
															<div class="invalid-feedback">Debe elegir el Paciente</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<div class="col-md-8 mx-auto">
												<div class="row">
													<label class="control-label col-md-3 col-lg-3 align-self-center mb-0 pr-0" for="obs">Observaciones:</label>
													<div class="col-md-8 col-lg-9">
														<div class="row">
															<input type="text" name="obs" class="form-control form-control-sm mayusc col-md-9" />
															<div class="col-md-2 mt-sm-2 mt-md-0"><button type="submit" class="btn btn-sabogal">Guardar</button></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						<div class="modal fade" id="modalAsigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Elegir Paciente</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body" style="overflow: hidden;">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 mx-auto" style="overflow-x:auto">
												<table id="tablaPacientes" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
													<thead><tr><th>Nombres</th><th>Apellidos y Nombres</th><th>Nro. Doc</th><th>Correo</th></tr></thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>