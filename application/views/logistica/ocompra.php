						<div class="col-12 card px-0 my-3">
							<div class="card-body">
								<h4 class="">Ordenes de Compra</h4>
								<hr>
								<div class="float-right"><a href="<?=base_url()?>logistica/ocompra/nuevo" class="btn btn-sabogal">Nueva Orden de Compra</a></div>
							</div>
							<div class="row justify-content-center py-2">
								<div class="msg"></div>
								<div class="row mb-3">
									<div class="col-md-7 col-lg-6">
										<div class="row">
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="idest">Establecimiento:</label>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<select class="form-control form-control-sm idestab" name="idest" id="idest" required="" >
												<?
													foreach($empresa as $row):	?>
														<option value="<?=$row->idempresa;?>"><?=$row->nombre_comercial;?></option>
												<?	endforeach;	?>
													</select>
													<div class="invalid-feedback">Campo Requerido</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container-fluid row"><hr class="col-sm-12 mt-0"></div>