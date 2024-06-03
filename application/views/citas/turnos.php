						<div class="col-12 card px-0 my-3">
							<div class="card-body pb-0">
								<h4 class="">Turnos</h4>
								<hr>
								<div class="float-right"><a href="<?=base_url()?>citas/turnos/nuevo" class="btn btn-sabogal">Nuevo Turno</a></div>
							</div>
							<div class="row justify-content-center py-2">								<?if($this->session->flashdata('claseMsg')){?><div class="alert <?=$this->session->flashdata('claseMsg')?> py-1 px-5 fade show" role="alert">									<div class="iq-alert-text"><?=$this->session->flashdata('flashMessage')?></div>								</div><?}?>
								<div class="msg"></div>							</div>							<div class="container-fluid">
								<div class="row mb-3">
									<div class="col-md-6 col-lg-4">
										<div class="row">
											<label class="control-label col-md-5 col-lg-5 align-self-center mb-0" for="idest">Establecimiento:</label>
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<select class="form-control form-control-sm iddep mx-sm-3 iddep" name="idest" id="idest" required="" >
												<?
													foreach($estab as $row):	?>
														<option value="<?=$row->idempresa;?>"><?=$row->nombre_comercial;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-4">
										<div class="row">
											<label class="control-label col-md-5 col-lg-5 align-self-center mb-0 pl-md-5" for="depart">Departamento:</label>
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<select class="form-control form-control-sm mr-md-3 mx-sm-3 cdep" name="depart" id="depart" required="" >
												<?
													foreach($dep as $row):	?>
														<option value="<?=$row->iddepartamento;?>"><?=$row->departamento;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-4">
										<div class="row">
											<label class="control-label col-md-5 col-lg-5 align-self-center mb-0 pl-md-4" for="consult">Consultorio:</label>
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<select class="form-control form-control-sm mx-sm-3 mt-md-3 mt-lg-0 cons" name="consult" id="consult" required="" >
														<option value="" >-- Todos --</option>
												<?
													foreach($cons as $row):	?>
														<option value="<?=$row->idconsultorio;?>"><?=$row->consultorio;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-4">
										<div class="row">
											<label class="control-label col-md-5 col-lg-5 align-self-center mb-0 pl-md-5" for="prof">Profesional:</label>
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<select class="form-control form-control-sm mr-md-3 mt-md-3 mx-sm-3 cprof" name="prof" id="prof" required="" >
														<option value="" >-- Todos --</option>
												<?
													foreach($prof as $row):	?>
														<option value="<?=$row->idprofesional;?>"><?=$row->apellidos.' '.$row->nombres;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-4">
										<div class="row">
											<label class="control-label col-md-5 col-lg-5 align-self-center mb-0 pl-md-5" for="anio">A&ntilde;o:</label>
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<select class="form-control form-control-sm mr-md-3 mt-md-3 mx-sm-3 canio" name="anio" id="anio" required="" >
												<?
													foreach($anio as $row):	?>
														<option value="<?=$row->anio;?>"><?=$row->anio;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-4">
										<div class="row">
											<label class="control-label col-md-5 col-lg-5 align-self-center mb-0 pl-md-5" for="mes">Mes:</label>
											<div class="col-md-7 col-lg-7">
												<div class="row">
													<select class="form-control form-control-sm mx-sm-3 mt-md-3 tmes" name="mes" id="mes" required="" >
												<?
													foreach($mes as $row):	?>
														<option value="<?=$row->idmes;?>" <?=$row->idmes === date('n')? 'selected':'';?>><?=$row->mes;?></option>
												<?	endforeach;	?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container-fluid row"><hr class="col-sm-12 mt-0"></div>								<div class="row"> <!--class="table-responsive" -->									<div class="col-12 mx-auto" style="overflow-x:auto">									<!--<div class="col-sm-12 mx-auto" style="overflow-x:scroll"><!--align-items-center text-center-->										<!--<table id="tablaProveedores" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-auto"></table>-->										<!--<table id="tablaProveedores" class="table table-striped table-hover table-bordered mx-auto"></table>-->										<table id="tablaTurnos" class="table table-striped table-hover table-bordered mb-0 mx-auto" style="width:100%"></table>									</div>								</div>							</div>						</div>