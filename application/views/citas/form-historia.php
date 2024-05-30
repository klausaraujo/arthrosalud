					<div class="col-12 iq-card my-3">
						<div class="iq-card-header d-flex justify-content-between">
							<div class="iq-header-title"><h4>Registro de Historia Cl&iacute;nica</h4></div>
						</div>
						<div class="iq-card-body">
							<form method="post" id="form_historia" action="<?=base_url()?>citas/historia/reghistoria" enctype="multipart/form-data"
									class="needs-validation form-horizontal" novalidate="">
								<input type="hidden" name="tiporegistro" value="registrar" />
								<div class="row justify-content-center">
									<?php 
										$message = $this->session->flashdata('adv');
										if($message){ ?>
										<p style="color:#dc8b89;margin:auto;text-align:center;" class="fade show msg"><?=$message;?></p>
									<?php } ?>
								</div>
								<div class="form-row">
									<div class="col-12 my-1">
										<div class="row">
											<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="nrofisico">Nro. F&iacute;sico:</label>
											<div class="col-md-6 col-lg-3">
												<div class="row">
													<input type="text" class="form-control form-control-sm mayusc" name="nrofisico" placeholder="Nro. Físico" />
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-6 col-lg-3 align-self-center mb-0">Paciente:</label>
											<div class="col-md-6 col-lg-4">
												<div class="row">
													<input type="hidden" id="idpaciente" name="idpaciente" />
													<input type="text" class="form-control form-control-sm mayusc col-10" id="paciente" required="" readonly />
													<div class="invalid-feedback" id="error-doc">Documento opcional</div>
													<a href="<?=base_url()?>/citas/historia/buscarpaciente" data-target="#modalAsigna" data-toggle="modal" title="Buscar">
														<i class="fa fa-search col-2 mt-2" aria-hidden="true" style="font-size:1.3em"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<label class="control-label col-md-6 col-lg-3 align-self-center mb-0" for="avatar">Avatar:</label>
											<div class="col-md-6 col-lg-4">
												<div class="row">
													<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
													<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Elegir Archivo&hellip;</span></label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container-fluid row"><hr class="col-sm-12"></div>
								<div class="col-12 mx-auto pb-2">
									<button type="submit" class="btn btn-sabogal ml-1 mr-4">Guardar</button>
									<button type="reset" class="btn btn-light btn-cancelar">Cancelar</button>
								</div>
							</form>
						</div>
					</div>
					
					<div class="modal fade" id="modalAsigna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">Elegir Paciente</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body" style="overflow: hidden;">
									<div class="container-fluid">
										<div class="row">
											<div class="col-12 mx-auto" style="overflow-x:auto">
												<table id="tablaPacientes" class="table table-striped dt-responsive table-bordered display nowrap table-hover mb-0 mx-0" style="width:100%">
													<thead><tr><th>Nombres</th><th>Apellidos</th><th>Nro. Doc</th><th>Correo</th></tr></thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>