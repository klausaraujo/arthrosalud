					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Procedimientos</h4></div>
						</div>
						<div class="iq-card-body">
								<form method="post" id="form_procedimiento" action="<?=base_url()?>citas/procedimientos/regprocedimiento"
										class="needs-validation form-horizontal" novalidate="">
									<input type="hidden" name="tiporegistro" value="registrar" />
									<div class="container-fluid">
											<div class="row">
												<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="tipo">Tipo Procedimiento:</label>
												<div class="col-md-6 col-lg-3">
													<div class="row">
														<select class="form-control form-control-sm" name="tipo" id="tipo" required="" >
													<?
														foreach($tipo as $row):	?>
															<option value="<?=$row->idtipoprocedimiento;?>"><?=$row->tipo_procedimiento;?></option>
													<?	endforeach;	?>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="procedimiento">Procedimiento:</label>
												<div class="col-md-6 col-lg-4">
													<div class="row">
														<input type="text" class="form-control form-control-sm mayusc" name="procedimiento" id="procedimiento" 	
															placeholder="Procedimiento" required="" />
														<div class="invalid-feedback">Procedimiento Requerido</div>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="tarifa">Tarifa Base:</label>
												<div class="col-md-6 col-lg-2">
													<div class="row">
														<input type="text" class="form-control form-control-sm moneda" id="tarifa" name="tarifa" placeholder="Tarifa Base" />
													</div>
												</div>
											</div>
									</div>
									<div class="container-fluid row"><hr class="col-sm-12"></div>
									<div class="col-12 mx-auto pb-2">
										<button type="submit" class="btn btn-sabogal ml-1 mr-4" id="btnEnviar">Guardar Registro</button>
										<button type="reset" class="btn btn-light btn-cancelar">Cancelar</button>
									</div>
								</form>
						</div>
					</div>