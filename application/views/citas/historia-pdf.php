<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<style>
		@page { margin: 0.25in; }
		#content {
		  padding: 0.2em 1% 0.2em 1%;
		  min-height: 15em;
		}
		.odd_row td {
		  background-color: transparent;
		  border-bottom: 0.9px solid #ddd; /* 0.9 so table borders take precedence */
		}
		.even_row td {
		  background-color: #f6f6f6;
		  border-bottom: 0.9px solid #ddd;
		}
		table.datos{ width:100%;font-size:8pt;border-collapse:collapse;border-bottom:1px solid #878282;border-top:1px solid #878282; }
		table.datos td{ padding:0.4em 0 0.4em 0.6em; vertical-align:middle; }
		.atenciones{ width:100%; font-size: 10px }
		.atenciones td {border:1px solid #878282; border-collapse: collapse; padding:0.4em 0 0.4em 0.6em; vertical-align:middle;}
	</style>
</head>

<body>

	<div id="body">
		<div id="content">
			<div class="page" style="font-size: 7pt">
				<table style="width: 100%;padding-bottom:3mm" class="header">
					<tr>
						<td style="width:7cm"><div style="text-align:left"><img src="<?=$_SERVER['DOCUMENT_ROOT']?>/arthrosalud/public/images/logo-white.png" style="width:5cm" /></div></td>
						<td><div style="width:7cm"><h1>HISTORIA CL&Iacute;NICA DIGITAL</h1></div></td>
						<td align="right" style="width:1cm"><div style="text-align:right;padding:1cm;border:1px solid #000">Foto</div></td>
					</tr>
				</table>

				<table class="datos">
					<tr class="even_row"><td><strong>N&uacute;mero:</strong></td><td><?=sprintf("%'07s",$historia->numero);?></td><td><strong>H. F&iacute;sica:</strong></td>
						<td><?=$historia->numerofisico?></td><td><strong>Fecha Registro:</strong></td><td><?=$historia->fecha?></td>
					</tr>
					<tr class="odd_row"><td><strong>Paciente:</strong></td><td colspan="3"><?=$historia->apellidos.' '.$historia->nombres?></td><td><strong>Tipo Documento:</strong></td>
						<td><?=$historia->tipo_documento?></td>
					</tr>
					<tr class="even_row"><td><strong>Documento Nro.:</strong></td><td><?=$historia->numero_documento?></td><td><strong>Sexo:</strong></td>
						<td><?=$historia->sexo === '1'? 'Femenino' : 'Masculino';?></td><td><strong>Fecha de Nacimiento:</strong></td><td><?=$historia->fecnac?></td>
					</tr>
					<?
						$fec = new DateTime(strtotime($historia->fecnac));
						$hoy = new DateTime();
						$edad = $hoy->diff($fec);
						//$edad->y.' a&ntilde;os, '.$edad->m.' mes(es), '.$edad->d.' d&iacute;a(s)'
						//echo $edad->y.'  '.$edad->m.'  '.$edad->d;
					?>
					<tr class="odd_row"><td><strong>Edad:</strong></td><td style="width:4cm"><?='Edad'?></td>
						<td><strong>Estado Civil:</strong></td><td><?=$historia->estado_civil?></td><td><strong>Lugar de Nacimiento:</strong></td><td></td>
					</tr>
					<tr class="even_row"><td><strong>Domicilio:</strong></td><td colspan="2"></td><td><strong>Lugar de Domicilio:</strong></td>
						<td colspan="2"></td>
					</tr>
				</table>
				<?	foreach($atencion as $row):
						$tp = $row->tipo_atencion==='1'? '1 - M&eacute;dica':'2 - No M&eacute;dica';
						$prioridad = '';
						if($row->prioridad === '1') $prioridad = 'Prioridad I';
						elseif($row->prioridad === '2') $prioridad = 'Prioridad II';
						elseif($row->prioridad === '3') $prioridad = 'Prioridad III';
						elseif($row->prioridad === '4') $prioridad = 'Prioridad IV';
						
						$gestante = null;
						if($historia->sexo === '1'){ if($row->gestante === '1') $gestante = 'SI'; else $gestante = 'NO'; }
						else $gestante = 'N/A';
						
						$ao = '';
						if($row->AO === '1') $ao = '1 - No Responde';
						elseif($row->AO === '2') $ao = '2 - Ante el Dolor';
						elseif($row->AO === '3') $ao = '3 - Ante una Orden Verbal';
						elseif($row->AO === '4') $ao = '4 - Espont&aacute;neamente';
						$rv = '';
						if($row->RV === '1') $rv = '1 - Ninguna Respuesta';
						elseif($row->RV === '2') $rv = '2 - Sonidos Incomprensibles';
						elseif($row->RV === '3') $rv = '3 - Palabras Inapropiadas';
						elseif($row->RV === '4') $rv = '4 - Confusa y desorientada';
						elseif($row->RV === '5') $rv = '5 - Orientada y Conversando';
						$rm = '';
						if($row->RM === '1') $rm = '1 - Ninguna Respuesta';
						elseif($row->RM === '2') $rm = '2 - Extensi&oacute;n Hipertonica (Postura en extensi&oacute;n) Descerebraci&oacute;n';
						elseif($row->RM === '3') $rm = '3 - Flexi&oacute;n Hipertonica (Postura de flexi&oacute;n) / Decorticaci&oacute;n';
						elseif($row->RM === '4') $rm = '4 - Movimiento de Retirada (Flexi&oacute;n inespec&iacute;fico)';
						elseif($row->RM === '5') $rm = '5 - Localiza el Dolor';
						elseif($row->RM === '6') $rm = '6 - Obedece Comandos';
						$glas = '';
						if(intval($row->glasgow) > 12 && intval($row->glasgow) < 16) $glas = 'TRAUMA LEVE';
						elseif(intval($row->glasgow) > 8 && intval($row->glasgow) < 9) $glas = 'TRAUMA MODERADO';
						else $glas = 'TRAUMA GRAVE';
				?>
				<table class="atenciones" style="margin-top:5mm" cellspacing="0">
					<tr style="background:#d8d5d5;">
						<td colspan="12"><strong style="margin-right:9cm">REGISTRO DE ATENCIONES DEL PACIENTE</strong>
						<span style="text-align:right;padding:0"><strong>Fecha de Atenci&oacute;n:&nbsp;&nbsp;</strong> <?=$row->fecha?></span></td>
					</tr>
					<tbody>
						<tr>
							<td colspan="2"><strong>M&eacute;dico Tratante</strong></td><td colspan="4"><?=$row->nombres?></td>
							<td><strong>Establecimiento</strong></td><td colspan="5"><?=$row->razon_social?></td>
						</tr>
						<tr>
							<td><strong>Tipo Atenci&oacute;n</strong></td><td colspan="2"><?=$tp?></td><td><strong>Prioridad</strong></td><td colspan="2"><?=$prioridad?></td>
							<td><strong>Gestante</strong></td><td><?=$gestante?></td><td><strong>Semanas</strong></td>
							<td><?=$row->gestante? $row->tiempo_gestacion : '';?></td><td><strong>IMC</strong></td><td><?=$row->imc?></td>
						</tr>
						<tr>
							
							<td style="width:3cm"><strong>Presi&oacute;n Arterial</strong></td><td><?=$row->presion01?></td><td><?=$row->presion02?></td>
							<td colspan="2"><strong>Presi&oacute;n Venosa</strong></td><td><?=$row->presion_venosa?></td><td><strong>Saturaci&oacute;n</strong></td>
							<td><?=$row->saturacion?></td><td colspan="2"><strong>Temperatura</strong></td><td colspan="2"><?=$row->temperatura?></td>
						</tr>
						<tr>
							<td><strong>F. Card&iacute;aca</strong></td><td><?=$row->frecuencia_cardiaca?></td><td colspan="2"><strong>F. Respiratoria</strong></td>
							<td><?=$row->frecuencia_respiratoria?></td><td><strong>Peso</strong></td><td><?=$row->peso?></td><td><strong>Talla</strong></td><td><?=$row->talla?></td>
							<td><strong>AO</strong></td><td colspan="2"><?=$ao?></td>
						</tr>
						<tr>
							<td><strong>RV</strong></td><td colspan="3"><?=$rv?></td><td><strong>RM</strong></td><td colspan="3"><?=$rm?></td>
							<td colspan="2"><strong>Glasgow</strong></td><td colspan="2"><?=$glas?></td>
						</tr>
					</tbody>
				</table>
				<!-- Diagnosticos -->
					<?
						$d = [];
						foreach($diagnostico as $fil):
							foreach($fil as $diag):
								if($diag->idatencion === $row->idatencion) $d[] = $diag;
							endforeach;
						endforeach;
						if(count($d)){
					?>
				<table class="atenciones" cellspacing="0">
					<tr style="text-align:center">
						<td colspan="3"><strong>REGISTRO DE DIAGN&Oacute;STICOS DEL PACIENTE</strong></td>
					</tr>
					<tbody>
						<tr class="even_row" style="text-align:center;font-weight:bold;line-height:1">
							<td>CIE10</td><td>Diagn&oacute;stico</td><td>Tipo</td>
						</tr>
						<?
							foreach($d as $col):
									$tp = $col->tipo === '1'? '1 - Presuntivo' : '2 - Definitivo';
						?>
						<tr><td><?=$col->cie10?></td><td><?=$col->descripcion_cie10?></td><td><?=$tp?></td></tr>
						<?
							endforeach;
						}
						?>
					</tbody>
				</table>
				<!-- Procedimientos -->
					<?
						$p = [];
						foreach($procedimiento as $fil):
							foreach($fil as $proc):
								if($proc->idatencion === $row->idatencion) $p[] = $proc;
							endforeach;
						endforeach;
						if(count($p)){
					?>
				<table class="atenciones" cellspacing="0">
					<tr style="text-align:center">
						<td colspan="3"><strong>REGISTRO DE PROCEDIMIENTOS RECOMENDADOS (EVALUADOS)</strong></td>
					</tr>
					<tbody>
						<tr class="even_row" style="text-align:center;font-weight:bold;line-height:1">
							<td>C&oacute;digo</td><td>Procedimiento</td><td>Observaciones</td>
						</tr>
						<?
							foreach($p as $proc):
						?>
						<tr><td><?=$proc->correlativo?></td><td><?=$proc->procedimiento?></td><td><?=$proc->indicaciones?></td></tr>
						<?
							endforeach;
						}
						?>
					</tbody>
				</table>
				<!-- Indicaciones -->
					<?
						$in = [];
						foreach($indicaciones as $fil):
							foreach($fil as $indic):
								if($indic->idatencion === $row->idatencion) $in[] = $indic;
							endforeach;
						endforeach;
						if(count($in)){
					?>
				<table class="atenciones" cellspacing="0">
					<tr style="text-align:center">
						<td colspan="3"><strong>REGISTRO DE PRODUCTOS Y/O MEDICAMENTOS RECETADOS</strong></td>
					</tr>
					<tbody>
						<tr class="even_row" style="text-align:center;font-weight:bold;line-height:1">
							<td>C&oacute;digo</td><td>Art&iacute;culo</td><td>Cantidad</td><td>Indicaciones</td>
						</tr>
						<?
							foreach($in as $indic):
						?>
						<tr>
							<td><?=$indic->correlativo?></td><td><?=$indic->descripcion?></td><td><?=number_format($indic->cantidad,2,'.',',')?></td><td><?=$indic->indicaciones?></td>
						</tr>
						<?
							endforeach;
						}
						?>
					</tbody>
				</table>
				<?	endforeach; ?>
			</div>
		</div>
	</div>
</body>