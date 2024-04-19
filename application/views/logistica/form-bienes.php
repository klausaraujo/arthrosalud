					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Art&iacute;culos</h4></div>
						</div>
						<div class="iq-card-body">
						<div class="row justify-content-center">
						<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
							<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
							</div><?}?>
						</div>
						<form method="post" id="form_bienes" action="<?=base_url()?>logistica/regbienes" enctype="multipart/form-data"
								class="needs-validation form-horizontal" novalidate="">
							<input type="hidden" name="tiporegistro" value="registrar" />
							<div class="form-row">
								<div class="col-12 my-1">
									<div class="row">
										<div class="col-lg-6">
											<div class="row">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="tipoart">Tipo Art&iacute;culo:</label>
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<select class="form-control form-control-sm" name="tipoart" id="tipoart" required="" >
														<?
																foreach($tipoart as $row):	?>
																	<option value="<?=$row->idtipoarticulo;?>"><?=$row->tipo_articulo;?></option>
														<?		endforeach;	?>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="laboratorio">Laboratorio:</label>
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<select class="form-control form-control-sm" name="laboratorio" id="laboratorio" required="" >
														<?
																foreach($laboratorio as $row):	?>
																	<option value="<?=$row->idlaboratorio;?>"><?=$row->laboratorio;?></option>
														<?		endforeach;	?>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="um">U.M:</label>
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<select class="form-control form-control-sm" name="um" id="um" required="" >
														<?
																foreach($um as $row):	?>
																	<option value="<?=$row->idunidadmedida;?>"><?=$row->unidad_medida;?></option>
														<?		endforeach;	?>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="presentacion">Presentacion:</label>
												<div class="col-md-6 col-lg-6">
													<div class="row">
														<select class="form-control form-control-sm" name="presentacion" id="presentacion" required="" >
														<?
																foreach($presentacion as $row):	?>
																	<option value="<?=$row->idpresentacion;?>"><?=$row->presentacion;?></option>
														<?		endforeach;	?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row ml-md-3">
												<div class="profile-img-edit">
													<img class="profile-pic" src="" alt="Fotografía" style="border:1px solid #CDCDCD;border-radius:10%;height:150px">
													<div class="p-image bg-sabogal">
														<i class="ri-pencil-line upload-button"></i>
														<input name="img" class="file-upload" type="file" accept="image/*">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="descripcion">Descripci&oacute;n:</label>
										<div class="col-md-6">
											<div class="row">
												<textarea class="form-control form-control-sm mayusc" name="descripcion" placeholder="Descripción"></textarea>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="custom-control custom-switch col-md-5 ml-3">
											<input type="checkbox" class="custom-control-input menus" name="compra" id="compra">
											<label class="custom-control-label" for="compra">&nbsp;&nbsp;Disponible para Compra</label>
										</div>
										<div class="custom-control custom-switch col-md-5 ml-3">
											<input type="checkbox" class="custom-control-input menus" name="venta" id="venta">
											<label class="custom-control-label" for="venta">&nbsp;&nbsp;Disponible para Venta</label>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="porcentaje">Porcentaje Utilidad:</label>
										<div class="col-md-2 col-lg-1">
											<div class="row">
												<input type="text" class="form-control form-control-sm moneda" name="porcentaje" id="porcentaje" />
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="obs">Observaciones:</label>
										<div class="col-md-6">
											<div class="row">
												<textarea class="form-control form-control-sm mayusc" name="obs" placeholder="Observaciones"></textarea>
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