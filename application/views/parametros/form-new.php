					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Empresas</h4></div>
						</div>
						<div class="iq-card-body">
						<div class="row justify-content-center">
						<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
							<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
							</div><?}?>
						</div>
						<form method="post" id="form_empresa" action="<?=base_url()?>parametros/regempresa" class="needs-validation form-horizontal" novalidate="">
							<input type="hidden" name="tiporegistro" value="registrar" />
							<div class="form-row">
								<div class="col-12 my-1">
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="ruc">RUC:</label>
										<div class="col-md-4 col-lg-2">
											<div class="row">
												<input type="text" class="form-control form-control-sm ruc borra num" name="ruc" id="ruc" placeholder="RUC" 
													value="" minlength="11" maxlength="11"/>
												<div class="invalid-feedback" id="error-doc">Documento opcional</div>
											</div>
										</div>
										<div class="col-md-2 col-lg-1 px-0 pl-md-3 pl-lg-4 mt-3 mt-md-0 mt-lg-0 align-self-center">
											<!--<button type="button" class="btn btn-info btn-small col-12 align-self-center btn_ruc" id="busca_ruc">-->
											<a href="#" class="btn_ruc h5" id="busca_ruc"><i class="fa fa-search" aria-hidden="true"></i></a>
											<!--</button>-->
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="nombres">Raz&oacute;n Social / Nombre Completo</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra nombres mayusc" name="nombres" id="nombres" 
													placeholder="Raz&oacute;n Social / Nombre Completo" value="" required="" />
												<div class="invalid-feedback" id="error-razon">Debe indicar una Raz&oacute;n social / Nombre Completo</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="direccion">Domicilio:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra direccion mayusc" name="direccion" id="direccion" 	
													placeholder="Domicilio" value="" required="" />
												<div class="invalid-feedback">Campo requerido</div>
											</div>
										</div>
									</div>
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
									<div class="row ajaxMap mt-3 d-none">
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
											<input type="hidden" name="lat" id="lat" /><input type="hidden" name="lng" id="lng" />
											<div id="map" style="min-height:350px;width:100%;margin:auto"></div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="logotipo">Logotipo Empresa:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra logotipo mayusc" name="logotipo" 
													placeholder="Logotipo" value="" required="" />
												<label class="invalid-feedback">Campo requerido</label>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="renipress">Renipress:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra renipress mayusc" name="renipress"
													placeholder="Renipress" value="" required="" />
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