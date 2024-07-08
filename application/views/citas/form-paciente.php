					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Pacientes</h4></div>
						</div>
						<div class="iq-card-body">
						<div class="row justify-content-center">
						<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
							<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
							</div><?}?>
						</div>
						<form method="post" id="form_paciente" action="<?=base_url()?>citas/pacientes/regpaciente" enctype="multipart/form-data"
								class="needs-validation form-horizontal" novalidate="">
							<input type="hidden" name="tiporegistro" value="registrar" />
							<div class="form-row">
								<div class="col-12 my-1">
									<div class="row">
										<div class="col-lg-6">
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="tipo">Tipo Documento:</label>
												<div class="col-md-4 col-lg-4">
													<div class="row">
														<select class="form-control form-control-sm tpdoc" name="tipo" id="tipo" required="" >
													<?
														foreach($tipo as $row):	?>
															<option value="<?=$row->idtipodocumento;?>"><?=$row->tipo_documento;?></option>
													<?	endforeach;	?>
														</select>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="doc">N&uacute;mero Documento:</label>
												<div class="col-md-4 col-lg-5">
													<div class="row">
														<input type="text" class="form-control form-control-sm col-md-8 num numerodoc" name="doc" id="doc" 
															placeholder="Número Doc." minlength="8" maxlength="8" required="" />
														<a href="<?=base_url()?>parametros/curlajax" class="col-md-2 buscadni" style="font-size:1.3em"><i class="fa fa-search"></i></a>
														<div class="invalid-feedback" id="error-doc">Campo Requerido</div>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="apellidos">Apellidos:</label>
												<div class="col-md-4 col-lg-4">
													<div class="row">
														<input type="text" class="form-control form-control-sm mayusc desha" name="apellidos" id="apellidos" 
															placeholder="Apellidos" value="" required="" />
														<div class="invalid-feedback" id="error-razon">Campo Requerido</div>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<label class="control-label col-md-6 col-lg-6 align-self-center mb-0" for="nombres">Nombres:</label>
												<div class="col-md-4 col-lg-4">
													<div class="row">
														<input type="text" class="form-control form-control-sm borra mayusc desha" name="nombres" id="nombres" 
															placeholder="Nombres" value="" required="" />
														<div class="invalid-feedback" id="error-razon">Campo Requerido</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="row ml-md-3">
												<div class="profile-img-edit">
													<img class="profile-pic" alt="Fotografía" style="border:1px solid #CDCDCD;border-radius:10%;height:150px"
														src="<?=base_url()?>public/images/articulos/img_default.png">
													<div class="p-image bg-sabogal">
														<i class="ri-pencil-line upload-button"></i>
														<input name="img" class="file-upload" type="file" accept="image/*">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="nombres">Fecha de Nacimiento:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<input type="date" class="form-control form-control-sm" name="fechanac" id="fechanac" 
													placeholder="Nombres" value="<?=date('Y-m-d');?>" required="" />
												<div class="invalid-feedback" id="error-razon">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="sexo">Sexo:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="sexo" id="sexo" required="" >
													<option value="2">Masculino</option>
													<option value="1">Femenino</option>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="edo">Estado Civil:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="edo" id="edo" required="" >
											<?
												foreach($edo as $row):	?>
													<option value="<?=$row->idestadocivil;?>"><?=$row->estado_civil;?></option>
											<?	endforeach;	?>
												</select>
												<div class="invalid-feedback">Campo Requerido</div>
											</div>
										</div>
									</div>
									<div class="container-fluid row"><hr class="col-sm-12"></div>
									<div class="row my-1"><h6 style="font-weight:bold">Ubigeo de Nacimiento</h6></div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="dep">Departamento:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm dep" name="dep" id="dep" required="" >
													<option value="">-- Seleccione --</option>
												<?
														foreach($dep as $row):	?>
															<option value="<?=$row->cod_dep;?>"><?=$row->departamento;?></option>
												<?		endforeach;	?>
												</select>
												<div class="invalid-feedback">Debe elegir un Departamento</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="pro">Provincia:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm pro" name="pro" id="pro" required="" >
													<option value="">-- Seleccione --</option>
												</select>
												<div class="invalid-feedback">Debe elegir una Provincia</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="dis">Distrito:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm dis" name="dis" id="dis" required="">
													<option value="">-- Seleccione --</option>
												</select>
												<div class="invalid-feedback">Debe elegir un Distrito</div>
											</div>
										</div>
									</div>
									<div class="container-fluid row"><hr class="col-sm-12"></div>
									<div class="row my-1"><h6 style="font-weight:bold">Ubigeo Actual</h6></div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="dep1">Departamento:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm dep1" name="dep1" id="dep1" required="" >
													<option value="">-- Seleccione --</option>
												<?
														foreach($dep as $row):	?>
															<option value="<?=$row->cod_dep;?>"><?=$row->departamento;?></option>
												<?		endforeach;	?>
												</select>
												<div class="invalid-feedback">Debe elegir un Departamento</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="pro1">Provincia:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm pro1" name="pro1" id="pro1" required="" >
													<option value="">-- Seleccione --</option>
												</select>
												<div class="invalid-feedback">Debe elegir una Provincia</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="dis1">Distrito:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm dis1" name="dis1" id="dis1" required="">
													<option value="">-- Seleccione --</option>
												</select>
												<div class="invalid-feedback">Debe elegir un Distrito</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="direccion">Domicilio:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm mayusc" name="direccion" id="direccion" 	
													placeholder="Domicilio" value="" required="" />
												<div class="invalid-feedback">Campo requerido</div>
											</div>
										</div>
									</div>
									<div class="container-fluid row"><hr class="col-sm-12"></div>
									<!--<div class="row ajaxMap mt-3 d-none">
										<div class="col-12 px-0">
											<!--<div class="pac-card" id="pac-card">
											  <div id="pac-container" class="place-map">
												<input id="pac-input" type="text" placeholder="Enter a location" />
											  </div>
											</div>
											<div id="infowindow-content">
											  <div id="place-name" class="title"></div>
											  <div id="place-address"></div>
											</div>-->
											<!--<input type="hidden" name="lat" id="lat" /><input type="hidden" name="lng" id="lng" />
											<div id="map" style="min-height:350px;width:100%;margin:auto"></div>
										</div>
									</div>
									<!--<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="logotipo">Logotipo Empresa:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
												<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Elegir Archivo&hellip;</span></label>
											</div>
										</div>
									</div>-->
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="celular">Celular:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm num" name="celular"
													placeholder="Celular" value="" />
												<label class="invalid-feedback">Campo requerido</label>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="correo">Correo:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra" name="correo"
													placeholder="Correo" value="" />
												<label class="invalid-feedback">Campo requerido</label>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="obs">Observaciones:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra mayusc" name="obs"
													placeholder="Observaciones" value="" />
												<label class="invalid-feedback">Campo requerido</label>
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