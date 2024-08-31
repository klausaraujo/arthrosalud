					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Nueva Orden de Servicio</h4></div>
						</div>
						<div class="iq-card-body">
							<div class="row justify-content-center">
							<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 msg fade show" role="alert">
								<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>
								</div><?}?>
							</div>
							<form method="post" id="form_empresa" action="<?=base_url()?>logistica/regos" enctype="multipart/form-data"
									class="needs-validation form-horizontal" novalidate="">
								<input type="hidden" name="tiporegistro" value="registrar" />
								<input type="hidden" id="tabla" name="tabla" value="orden_servicio_detalle" />
								<input type="hidden" id="idorden" name="idorden" value="" />
								<input type="hidden" id="json" name="json" value="" />
								<div class="form-row">
									<div class="col-12 my-1">
										<div class="row">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0" for="anio">A&ntilde;o Ejecuci&oacute;n:</label>
											<div class="col-md-2 col-lg-2">
												<div class="row">
													<select class="form-control form-control-sm" name="anio" id="anio" required="" >
													<?
														foreach($anio as $row):	?>
															<option value="<?=$row->anio?>" <?=$row->anio===date('Y')? 'selected':''?>><?=$row->anio?></option>
													<?	endforeach;	?>
													</select>
												</div>
											</div>
											<label class="control-label col-md-3 col-lg-2 align-self-center mb-0">N&uacute;mero de Orden:</label>
											<div class="col-md-2 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm num" name="orden" id="orden" />
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0">Fecha Emisi&oacute;n:</label>
											<div class="col-md-4 col-lg-4">
												<div class="row">
													<input type="date" name="fecha" id="fecha" value="<?=date('Y-m-d')?>" class="form-control form-control-sm">
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0">Establecimiento:</label>
											<div class="col-md-4 col-lg-4">
												<div class="row">
													<select class="form-control form-control-sm idestab" name="idempresa" id="idempresa" required="" >
														<option value="" >-- Seleccione --</option>
													<?
														foreach($emp as $row):	?>
															<option value="<?=$row->idempresa;?>"><?=$row->nombre_comercial;?></option>
													<?	endforeach;	?>
													</select>
													<label class="invalid-feedback">Campo requerido</label>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0" for="centro">Centro de Costos:</label>
											<div class="col-md-4 col-lg-4">
												<div class="row">
													<select class="form-control form-control-sm centro" name="centro" id="centro" required="" >
														<option value="" >-- Seleccione --</option>
													</select>
													<label class="invalid-feedback">Campo requerido</label>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0">Proveedor:</label>
											<div class="col-md-6 col-lg-4">
												<div class="row">
													<input type="hidden" id="idproveedor" name="idproveedor" />
													<input type="text" class="form-control form-control-sm mayusc col-10 disabled" id="proveedor" required />
													<a href="#" data-target="#modalProveedores" data-toggle="modal" title="Buscar">
														<i class="fa fa-search col-2 mt-2" aria-hidden="true" style="font-size:1.3em"></i>
													</a>
													<label class="invalid-feedback">Campo requerido</label>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0" for="tpago">Tipo de Pago:</label>
											<div class="col-md-2 col-lg-2">
												<div class="row">
													<select class="form-control form-control-sm" name="tpago" id="tpago" required="" >
													<?
														foreach($tipo as $row):	?>
															<option value="<?=$row->idtipopago?>" ><?=$row->tipo_pago?></option>
													<?	endforeach;	?>
													</select>
												</div>
											</div>
											<label class="control-label col-md-3 col-lg-2 align-self-center mb-0" for="mpago">Medio de Pago:</label>
											<div class="col-md-2 col-lg-2">
												<div class="row">
													<select class="form-control form-control-sm" name="mpago" id="mpago" required="" >
													<?
														foreach($medio as $row):	?>
															<option value="<?=$row->idmediopago?>" ><?=$row->medio_pago?></option>
													<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0" for="tmon">Tipo de Moneda:</label>
											<div class="col-md-2 col-lg-2">
												<div class="row">
													<select class="form-control form-control-sm" name="tmon" id="tmon" required="" >
													<?
														foreach($mon as $row):	?>
															<option value="<?=$row->idtipomoneda?>" ><?=$row->tipo_moneda?></option>
													<?	endforeach;	?>
													</select>
												</div>
											</div>
											<label class="control-label col-md-3 col-lg-2 align-self-center mb-0" for="tcambio">Tipo de Cambio:</label>
											<div class="col-md-2 col-lg-2">
												<div class="row">
													<input type="text" class="form-control form-control-sm moneda" name="tcambio" id="tcambio" />
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="importe">Importe:</label>
											<div class="col-md-1 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm moneda" name="importe" id="importe" />
												</div>
											</div>
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="impuesto">Impuesto:</label>
											<div class="col-md-1 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm moneda" name="impuesto" id="impuesto" />
												</div>
											</div>
											<label class="control-label col-md-2 col-lg-2 align-self-center mb-0" for="total">Total:</label>
											<div class="col-md-1 col-lg-1">
												<div class="row">
													<input type="text" class="form-control form-control-sm moneda" name="total" id="total" />
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-3 col-lg-3 align-self-center mb-0" for="obs">Observaciones:</label>
											<div class="col-md-6 col-lg-5">
												<div class="row">
													<input type="text" class="form-control form-control-sm mayusc" name="obs" id="obs" />
												</div>
											</div>
										</div>
										<div class="container-fluid row"><hr class="col-sm-12 mb-1"></div>
										<div class="row iq-bg-primary rounded mx-1 mb-3">
											<div class="col-12"><h5 class="text-primary">Art&iacute;culos</h5></div>
										</div>
										<div class="container-fluid">
											<div class="row mb-3">
												<div class="col-md-7 col-lg-6">
													<div class="row">
														<label class="control-label col-md-4 align-self-center mb-0" for="articulo">Art&iacute;culo:</label>
														<div class="col-md-8">
															<div class="row">
																<input type="hidden" id="idarticulo" />
																<input type="text" class="form-control form-control-sm col-10 mayusc" name="articulo" 
																	id="articulo" placeholder="Artículo" readonly />
																<a href="#" class="col-2" data-target="#modalArticulos" data-toggle="modal" title="Buscar">
																	<i class="fa fa-search mt-2" aria-hidden="true" style="font-size:1.3em"></i>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-5 col-lg-3">
													<div class="row">
														<label class="control-label col-md-6 align-self-center mb-0 pl-md-5" for="cantidad">Cantidad:</label>
														<div class="col-md-6">
															<div class="row">
																<input class="form-control form-control-sm num" id="cantidad" name="cantidad" placeholder="Cantidad" />
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-lg-3 mt-md-3 mt-lg-0">
													<div class="row">
														<label class="control-label col-md-5 align-self-center mb-0 pl-lg-5" for="costo">Costo:</label>
														<div class="col-md-7">
															<div class="row">
																<input class="form-control form-control-sm moneda" id="costo" name="costo" placeholder="Costo" />
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-lg-2 mt-sm-2 mt-md-3">
													<a href="javascript:void(0)" class="btn btn-sabogal" id="agregar">Agregar</a>
												</div>
											</div>
										</div>
										<div class="container-fluid">
											<div class="row">
												<div class="col-12 mx-auto" style="overflow-x:auto">
													<table id="tablaArtOcOs" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container-fluid row"><hr class="col-sm-12"></div>
								<div class="col-12 mx-auto pb-2">
									<button type="submit" class="btn btn-sabogal ml-1 mr-4 disabled" id="btnEnviar">Guardar Registro</button>
									<button type="reset" class="btn btn-light btn-cancelar">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
					
					<div class="modal fade" id="modalProveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Elegir Proveedor</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body" style="overflow: hidden;">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12" style="overflow-x:auto">
												<table id="tablaProveedores" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
													<thead>
														<tr><th>RUC</th><th>Nombre Comercial</th><th>Domicilio</th><th>Ubigeo</th><th>item</th>
															<th>Contacto</th><th>Correo</th><th>Status</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modalArticulos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Elegir Art&iacute;culo</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body" style="overflow: hidden;">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 mx-auto" style="overflow-x:auto">
												<table id="tablaArtServer" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
													<thead>
														<tr><th>C&oacute;digo</th><th>Descripci&oacute;n</th><th>Fotograf&iacute;a</th><th>Status</th>
															<th>item</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>