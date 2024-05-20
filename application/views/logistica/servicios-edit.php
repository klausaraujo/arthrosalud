					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Editar Servicio</h4></div>
						</div>
						<div class="iq-card-body">
						<div class="row justify-content-center">
						<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
							<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
							</div><?}?>
						</div>
						<?	$servicio = $servicio[0]; ?>
						<form method="post" id="form_servicios" action="<?=base_url()?>logistica/regservicios" class="needs-validation form-horizontal" novalidate="">
							<input type="hidden" name="tiporegistro" value="editar" />
							<input type="hidden" name="id" value="<?=$servicio->idservicio?>" />
							<div class="form-row">
								<div class="col-12 my-1">
									<div class="row">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="tiposerv">Tipo Servicio:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="tiposerv" id="tiposerv" required="" >
												<?
													foreach($tserv as $row):	?>
														<option value="<?=$row->idtiposervicio;?>" <?=$row->idtiposervicio===$servicio->idtiposervicio? 'selected':'';?>>
														<?=$row->descripcion;?></option>
												<?	endforeach;	?>
												</select>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="um">U.M:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="um" id="um" required="" >
												<?
												foreach($um as $row):	?>
													<option value="<?=$row->idunidadmedida;?>" <?=$row->idunidadmedida ===$servicio->idunidadmedida? 'selected':'';?>>
															<?=$row->unidad_medida;?></option>
											<?	endforeach;	?>
												</select>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="descripcion">Descripci&oacute;n:</label>
										<div class="col-md-6">
											<div class="row">
												<textarea class="form-control form-control-sm mayusc blur" name="descripcion" placeholder="Descripción"
													required="" ><?=trim($servicio->descripcion);?></textarea>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="custom-control custom-switch col-md-5 ml-3">
											<input type="checkbox" class="custom-control-input menus" name="compra" id="compra"
												<?=$servicio->disponible_compra? 'checked':'';?>>
											<label class="custom-control-label" for="compra">&nbsp;&nbsp;Disponible para Compra</label>
										</div>
										<div class="custom-control custom-switch col-md-5 ml-3">
											<input type="checkbox" class="custom-control-input menus" name="venta" id="venta" 
												<?=$servicio->disponible_venta? 'checked':'';?>>
											<label class="custom-control-label" for="venta">&nbsp;&nbsp;Disponible para Venta</label>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="porcentaje">Porcentaje Utilidad:</label>
										<div class="col-md-2 col-lg-1">
											<div class="row">
												<input type="text" class="form-control form-control-sm moneda blur" name="porcentaje" id="porcentaje"
													value="<?=$servicio->porcentaje_utilidad;?>"/>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="obs">Observaciones:</label>
										<div class="col-md-6">
											<div class="row">
												<textarea class="form-control form-control-sm mayusc blur" name="obs" 
													placeholder="Observaciones"><?=trim($servicio->observaciones);?></textarea>
											</div>
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