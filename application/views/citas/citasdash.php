						<div class="col-12 card px-0 my-3">
							<div class="card-body">
								<div class="container-fluid px-0 mx-0">
									<h4 class="float-left my-0">Profesionales</h4>
								</div>
								<hr class="row mt-5 mx-1">
								<div class="row">
								<?
									foreach($prof as $row):
								?>
									<div class="col-sm-6 col-md-3 dashboard__card">
										<a href="<?=base_url()?>citas/citasprof?r=<?=$row->apellidos.' '.$row->nombres?>&i=<?=$row->idprofesional?>" class="card_button">
											<div class="iq-card">
											<div class="iq-card-prof-elements">
												<div class="dashboard__title">
													<h6><?=$row->apellidos.' '.$row->nombres?></h6>
												</div>
												<footer class="blockquote-footer text-white font-size-12">Especialidad: 
													<cite title="Source Title" class="text-white"><?=$row->especialidad?></cite>
												</footer>
											</div>
											</div>
										</a>
									</div>
								<?
									endforeach;
								?>
								</div>
							</div>
						</div>