					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Turnos</h4></div>
						</div>
						<div class="iq-card-body">
						<div class="row justify-content-center">
						<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
							<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
							</div><?}?>
						</div>
						<form method="post" id="form_turnos" action="<?=base_url()?>citas/turnos/regturno" class="needs-validation form-horizontal" novalidate="">
							<input type="hidden" name="tiporegistro" value="editar" />
							<input type="text" name="idturno" value="<?=$this->input->get('id')?>" />
							<div class="form-row">
								<div class="col-12 my-1">
									<div class="row">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idestablecimiento">Establecimiento:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm iddep" name="idestablecimiento" id="idestablecimiento" required="" >
													<option value="">-- Seleccione --</option>
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
												<select class="form-control form-control-sm" name="iddepartamento" id="iddepartamento" required="" >
													<option value="">-- Seleccione --</option>
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
													<option value="">-- Seleccione --</option>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idprofesional">Profesional:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="idprofesional" id="idprofesional" required="" >
													<option value="">-- Seleccione --</option>
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
												<select class="form-control form-control-sm" name="anio" id="anio" required="" >
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
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idmes">Mes:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="idmes" id="idmes" required="" >
											<?
												foreach($mes as $row):
													if(intval($row->idmes) >= date('m')){
											?>
													<option value="<?=$row->idmes;?>"><?=$row->mes;?></option>
											<?	
													}
												endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="duracion">Duraci&oacute;n de la Consulta:</label>
										<div class="col-sm-3 col-md-3 col-lg-2">
											<div class="row">
												<div class="input-group">
													<input type="text" maxlength="3" class="form-control form-control-sm num" name="duracion" />&nbsp;&nbsp;&nbsp;
													minutos
												</div>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="obs">Observaciones:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm mayusc" name="obs"
													placeholder="Observaciones" value="" />
												<label class="invalid-feedback">Campo requerido</label>
											</div>
										</div>
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