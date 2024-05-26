						<div class="col-12 card px-0 my-3">
							<div class="card-body" style="overflow-auto">
								<div class="row justify-content-center pb-1 mensaje">&nbsp;</div>
								<form id="form-detalle" method="post" action="">
									<div class="container-fluid" style="">
										<div class="row">
											<div class="col-md-8 mx-auto">
												<div class="card text-white bg-light mb-3 mx-auto">
													<div class="card-header" style="color:#000"><h5>Asignaci&oacute;n de horarios</h5></div>
													<div class="card-body">
														<span style="color:#000"><b>Departamento:</b> <?=$turno->departamento?></span><br>
														<span style="color:#000"><b>Consultorio:</b> <?=$turno->consultorio?></span><br>
														<span style="color:#000"><b>M&eacute;dico:</b> <?=$turno->nombres.' '.$turno->apellidos;?></span><br>
														<span style="color:#000"><b>A&ntilde;o:</b> <?=$turno->anio;?></span><br>
														<span style="color:#000"><b>Mes:</b> <?=$turno->mes;?></span><br>
														<span style="color:#000"><b>Duraci&oacute;n de las consultas:</b> <?=$turno->duracion_consulta;?> minutos</span>
														<input type="hidden" id="duracion" value="<?=$turno->duracion_consulta;?>" />
														<input type="hidden" id="idturno" value="<?=$turno->idturno;?>" />
														<input type="hidden" id="idcons" value="<?=$turno->idconsultorio;?>" />
														<input type="hidden" id="iddep" value="<?=$turno->iddepartamento;?>" />
														<input type="hidden" id="idprof" value="<?=$turno->idprofesional;?>" />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-8 mx-auto">
												<table id="tablaDias" class="table table-hover table-bordered mb-0 mx-auto table-sm text-center" style="width:100%">
													<thead>
														<td colspan="2"></td>
														<td colspan="2" class="bg-success">Ma&ntilde;ana</td>
														<td colspan="2" class="bg-dark text-white">Tarde</td>
														<td colspan="2" class="bg-warning">Noche</td>
													</thead>
													<thead class="bg-light">
														<td>Dia</td><td>Fecha</td><td>Entrada</td><td>Salida</td><td>Entrada</td><td>Salida</td><td>Entrada</td><td>Salida</td>
													</thead>
													<tbody>
												
											<?
												$n = cal_days_in_month(CAL_GREGORIAN, $turno->idmes, $turno->anio);
												for($i = 1;$i <= $n;$i++){
													$d = date('N',strtotime($turno->anio.'-'.$turno->idmes.'-'.$i));
													$dia = '';
													switch($d){
														case 1: $dia = 'Lunes'; break; case 2: $dia = 'Martes'; break; case 3: $dia = 'Mi&eacute;rcoles'; break;
														case 4: $dia = 'Jueves'; break; case 5: $dia = 'Viernes'; break; case 6: $dia = 'S&aacute;bado'; break;
														case 7: $dia = 'Domingo'; break;
													}
											?>
														<tr class="f-horas">
															<td style="background-color: rgba(0, 0, 0, 0.06);">
																<input type="hidden" name="fecha" class="fecha" value="<?=date('Y-m-d',
																	strtotime($turno->anio.'-'.$turno->idmes.'-'.$i))?>" /><?=$dia;?></td>
															<td style="background-color: rgba(0, 0, 0, 0.06);"><?=$i;?></td>
															<td><input type="time" class="hora e" value="00:00"/></td><td><input type="time" class="hora s" value="00:00"/></td>
															<td><input type="time" class="hora e1" value="00:00"/></td><td><input type="time" class="hora s1" value="00:00"/></td>
															<td><input type="time" class="hora e2" value="00:00"/></td><td><input type="time" class="hora s2" value="00:00"/></td>
														</tr>
											<?	}	?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="row"><hr class="col-md-8 mx-auto"></div>
										<div class="col-md-8 mx-auto pb-2">
											<button type="submit" class="btn btn-sabogal ml-1 mr-4" id="guardar-horarios">Guardar</button>
											<button type="reset" class="btn btn-light btn-cancelar">Cancelar</button>
										</div>
									</div>
								</form>
							</div>						</div>