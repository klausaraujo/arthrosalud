					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Centro de Costos</h4></div>
						</div>
						<div class="iq-card-body">
						<div class="row justify-content-center resp">
						<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
							<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
							</div><?}?>
						</div>
						<form method="post" id="form_costos" action="<?=base_url()?>parametros/centros" class="needs-validation form-horizontal" novalidate="">
							<input type="hidden" name="tiporegistro" value="registrar" />
							<div class="form-row">
								<div class="col-12 my-1">
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="idempresa">Empresa:</label>
										<div class="col-md-6 col-lg-3">
											<div class="row">
												<select class="form-control form-control-sm" name="idempresa" id="idempresa" required="" >
													<option value="">-- Seleccione --</option>
												<?
														foreach($empresas as $row):	?>
															<option value="<?=$row->idempresa;?>"><?=$row->razon_social;?></option>
												<?		endforeach;	?>
												</select>
												<div class="invalid-feedback">Debe elegir una Empresa</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="ccostos">Centro de Costos:</label>
										<div class="col-md-6 col-lg-4">
											<div class="row">
												<input type="text" class="form-control form-control-sm borra mayusc" name="ccostos"
													placeholder="Centro de Costos" required="" />
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