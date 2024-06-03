						<div class="col-12 card px-0 my-3 pt-0">
							<div class="card-body pb-0">
								<h4 class="">Consultorios</h4>
								<hr>
								<div class="float-right"><a href="<?=base_url()?>citas/consultorios/nuevo" class="btn btn-sabogal">Nuevo Consultorio</a></div>
							</div>
							<div class="row justify-content-center py-2">								<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 fade show" role="alert">									<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>								</div><?}?>
								<div class="msg"></div>							</div>							<div class="container-fluid">
								<div class="row mb-3">
									<div class="col-md-7 col-lg-6">
										<div class="row">
											<label class="control-label col-md-6 col-lg-4 align-self-center mb-0" for="idest">Establecimiento:</label>
											<div class="col-md-6 col-lg-6">
												<div class="row">
													<select class="form-control form-control-sm iddep" name="idest" id="idest" required="" >
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
								<div class="container-fluid row"><hr class="col-sm-12 mt-0"></div>								<div class="row"> <!--class="table-responsive" -->									<div class="col-12 mx-auto" style="overflow-x:auto">									<!--<div class="col-sm-12 mx-auto" style="overflow-x:scroll"><!--align-items-center text-center-->										<!--<table id="tablaProveedores" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-auto"></table>-->										<!--<table id="tablaProveedores" class="table table-striped table-hover table-bordered mx-auto"></table>-->										<table id="tablaConsultorios" class="table table-striped table-hover table-bordered mb-0 mx-auto" style="width:100%"></table>									</div>								</div>							</div>						</div>