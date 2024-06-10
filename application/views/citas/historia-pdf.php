<!doctype html><html lang="es">    <head>	<title>Historia Clínica</title>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>        <style>            /** Margenes de la pagina en 0 **/            @page { margin: 0cm 0cm }			/** Márgenes reales de cada página en el PDF **/			//body{ width:21cm; font-family: Helvetica;margin-top:3.8cm;margin-bottom:1.5cm }			body{ width:20cm; font-family: Helvetica;margin-top:5mm;margin-bottom:1.5cm }			/** Reglas del encabezado **/			/** Reglas del contenido **/			.acciones{ width:20cm; /*text-align:center;*/ }			.acciones td {border:1px solid #4B4B4B; border-collapse: collapse; padding-left: 5px}			* { font-size:0.8rem }        </style>    </head>    <body>        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->        <header>			<img src="<?=base_url()?>public/images/logo-white.png" style="position:absolute;left:5mm;top:5mm;width:5cm;height:3cm" />			<div style="position:absolute;top:5mm;right:5mm;width:3cm;height:3cm;border:1px solid #000;">Foto</div>			<div style="position:absolute;left:8cm;font-size:1.5em;top:1.8cm">HISTORIA CL&Iacute;NICA DIGITAL</div>        </header>        <!--<footer>			<table class="footer" style="width:100%;solid #0000ff;background-color:#BEBEBE"  >				<tr>					<td style="aling:center;color:#600000;text-align:center;" >						<span style="display:flex;font-size:10;font-weight:bold;padding-top:3mm"> Copyright © 2022 - NARSA S.A. </span>					</td>				</tr>				<tr>					<td style="aling:center;color:#600000;text-align:center;font-weight:bold" >					<span style="font-size:10;font-weight:bold;">Usuario: <? if($usuario = json_decode($this->session->userdata('user'))); echo $usuario->usuario;?></td>				</tr>			</table>        </footer>-->		        <!-- Etiqueta principal del pdf -->        <main style="position:absolute;overflow-y:hidden;top:4cm;left:5mm;right:5mm">			<table cellspacing="0" cellpadding="1" align="center" class="acciones">				<tr>					<td style="font-weight:bold;" colspan="3">N&uacute;mero</td><td colspan="4"><?=sprintf("%'07s",$historia->numero)?></td>					<td style="font-weight:bold;" colspan="3">H. F&iacute;sica</td><td colspan="4"><?=$historia->numerofisico?></td>					<td style="font-weight:bold;" colspan="4">Fecha Registro</td><td colspan="3"><?=$historia->fecha?></td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">Paciente</td><td colspan="18"><?=$historia->apellidos.' '.$historia->nombres?></td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">Tipo Documento</td><td colspan="4"><?=$historia->tipo_documento?></td>					<td style="font-weight:bold;" colspan="3">N&uacute;mero Doc.</td><td colspan="4"><?=$historia->numero_documento?></td>					<td style="font-weight:bold;" colspan="4">Sexo</td><td colspan="3"><?=$historia->sexo === '1'? 'Masculino' : 'Femenino';?></td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">F. Nacimiento</td><td colspan="4"><?=$historia->fecnac?></td>					<td style="font-weight:bold;" colspan="3">Edad</td><td colspan="11">&nbsp;</td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">Estado Civil</td><td colspan="4"><?=$historia->estado_civil?></td>					<td style="font-weight:bold;" colspan="3">Lugar Nacimiento</td><td colspan="11">&nbsp;</td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">Domicilio</td><td colspan="18">&nbsp;</td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">Lugar Domicilio</td><td colspan="18">&nbsp;</td>				</tr>			</table>			<?				foreach($atencion as $row):			?>			<table cellspacing="0" cellpadding="1" align="center" class="acciones" style="margin-top:5mm;margin-bottom:3mm;background-color:#BEBEBE">				<tr>					<td style="font-weight:bold;text-align:center;border:0;" colspan="21">REGISTRO DE ATENCIONES DEL PACIENTE</td>				</tr>			</table>			<table cellspacing="0" cellpadding="1" align="center" class="acciones">				<tr>					<td style="font-weight:bold;" colspan="3">Fecha Atenci&oacute;n</td><td colspan="4"><?=$row->fecha?></td>					<td style="font-weight:bold;" colspan="4">M&eacute;dico Tratante</td><td colspan="10"><?=$row->nombres?></td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">Establecimiento</td><td colspan="6"><?=$row->razon_social?></td>					<td style="font-weight:bold;" colspan="3">Tipo Atenci&oacute;n</td><td colspan="3">							<?=$row->tipo_atencion==='1'? '1 - M&eacute;dica':'2 - No M&eacute;dica';?></td>					<?						$prioridad = '';						if($row->prioridad === '1') $prioridad = 'Prioridad I';						elseif($row->prioridad === '2') $prioridad = 'Prioridad II';						elseif($row->prioridad === '3') $prioridad = 'Prioridad III';						elseif($row->prioridad === '4') $prioridad = 'Prioridad IV';												$ao = '';						if($row->AO === '1') $ao = '1 - No Responde';						elseif($row->AO === '2') $ao = '2 - Ante el Dolor';						elseif($row->AO === '3') $ao = '3 - Ante una Orden Verbal';						elseif($row->AO === '4') $ao = '4 - Espont&aacute;neamente';						$rv = '';						if($row->RV === '1') $rv = '1 - Ninguna Respuesta';						elseif($row->RV === '2') $rv = '2 - Sonidos Incomprensibles';						elseif($row->RV === '3') $rv = '3 - Palabras Inapropiadas';						elseif($row->RV === '4') $rv = '4 - Confusa y desorientada';						elseif($row->RV === '5') $rv = '5 - Orientada y Conversando';						$rm = '';						if($row->RM === '1') $rm = '1 - Ninguna Respuesta';						elseif($row->RM === '2') $rm = '2 - Extensi&oacute;n Hipertonica (Postura en extensi&oacute;n) Descerebraci&oacute;n';						elseif($row->RM === '3') $rm = '3 - Flexi&oacute;n Hipertonica (Postura de flexi&oacute;n) / Decorticaci&oacute;n';						elseif($row->RM === '4') $rm = '4 - Movimiento de Retirada (Flexi&oacute;n inespec&iacute;fico)';						elseif($row->RM === '5') $rm = '5 - Localiza el Dolor';						elseif($row->RM === '6') $rm = '6 - Obedece Comandos';						$glas = '';						if(intval($row->glasgow) > 12 && intval($row->glasgow) < 16) $glas = 'TRAUMA LEVE';						elseif(intval($row->glasgow) > 8 && intval($row->glasgow) < 9) $glas = 'TRAUMA MODERADO';						else $glas = 'TRAUMA GRAVE';					?>					<td style="font-weight:bold;" colspan="2">Prioridad</td><td colspan="4"><?=$prioridad?></td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="2">Gestante</td><td><?=$row->gestante === '1'? 'SI':'NO';?></td>					<td style="font-weight:bold;" colspan="2">Semanas</td><td><?=$row->gestante? $row->tiempo_gestacion:0;?></td>					<td style="font-weight:bold;" colspan="3">Presi&oacute;n Arterial</td><td><?=$row->presion01?></td><td><?=$row->presion02?></td>					<td style="font-weight:bold;" colspan="3">Presi&oacute;n Venosa</td><td><?=$row->presion_venosa?></td>					<td style="font-weight:bold;" colspan="2">Saturaci&oacute;n</td><td><?=$row->saturacion?></td>					<td style="font-weight:bold;" colspan="2">Temp.</td><td><?=$row->temperatura?></td>				</tr>				<tr>					<td style="font-weight:bold;" colspan="3">F. Card&iacute;aca</td><td><?=$row->frecuencia_cardiaca?></td>					<td style="font-weight:bold;" colspan="3">F. Respiratoria</td><td><?=$row->frecuencia_respiratoria?></td>					<td style="font-weight:bold;" colspan="2">Peso</td><td><?=$row->peso?></td>					<td style="font-weight:bold;" colspan="2">Talla</td><td><?=$row->talla?></td>					<td style="font-weight:bold;" colspan="2">IMC</td><td colspan="5"><?=$row->imc?></td>				</tr>				<tr>					<td style="font-weight:bold;">AO</td><td colspan="3"><?=$ao?></td>					<td style="font-weight:bold;">RV</td><td colspan="3"><?=$rv?></td>					<td style="font-weight:bold;">RM</td><td colspan="3"><?=$rm?></td>					<td style="font-weight:bold;" colspan="2">Glasgow</td><td colspan="7"><?=$glas?></td>				</tr>			</table>			<!-- Diagnosticos -->			<?				$i = 0; $d = false;				foreach($diagnostico as $diag):					if($diag->idatencion === $row->idatencion) $d = true;				endforeach;				if($d){			?>			<table cellspacing="0" cellpadding="1" align="center" class="acciones" style="margin-top:5mm">				<tr>					<td style="font-weight:bold;text-align:center" colspan="21">REGISTRO DE DIAGN&Oacute;STICOS DEL PACIENTE</td>				</tr>				<tr style="text-align:center;font-weight:bold">					<td colspan="2">CIE10</td><td colspan="14">Diagn&oacute;stico</td><td colspan="5">Tipo</td>				</tr>			<?				foreach($diagnostico as $diag):					if($diag->idatencion === $row->idatencion){						$tp = $diag->tipo === '1'? '1 - Presuntivo' : '2 - Definitivo';			?>				<tr><td colspan="2"><?=$diag->cie10?></td><td colspan="14"><?=$diag->descripcion_cie10?></td><td colspan="5"><?=$tp?></td></tr>			<?					}				endforeach;			?>			</table>			<?	}?>			<!-- Procedimientos -->			<?				$i = 0; $p = false;				foreach($procedimiento as $proc):					if($proc->idatencion === $row->idatencion) $p = true;				endforeach;				if($p){			?>			<table cellspacing="0" cellpadding="1" align="center" class="acciones" style="margin-top:5mm">				<tr>					<td style="font-weight:bold;text-align:center" colspan="21">REGISTRO DE PROCEDIMIENTOS RECOMENDADOS (EVALUADOS)</td>				</tr>				<tr style="text-align:center;font-weight:bold">					<td colspan="2">C&oacute;digo</td><td colspan="14">Procedimiento</td><td colspan="5">Observaciones</td>				</tr>			<?				foreach($procedimiento as $proc):					if($proc->idatencion === $row->idatencion){			?>				<tr><td colspan="2"><?=$proc->correlativo?></td><td colspan="14"><?=$proc->procedimiento?></td><td colspan="5"><?=$proc->indicaciones?></td></tr>			<?					}				endforeach;			?>			</table>			<?	}?>			<!-- Indicaciones -->			<?				$i = 0; $in = false;				foreach($indicaciones as $indic):					if($indic->idatencion === $row->idatencion) $in = true;				endforeach;				if($in){			?>			<table cellspacing="0" cellpadding="1" align="center" class="acciones" style="margin-top:5mm">				<tr>					<td style="font-weight:bold;text-align:center" colspan="21">REGISTRO DE PRODUCTOS Y/O MEDICAMENTOS RECETADOS</td>				</tr>				<tr style="text-align:center;font-weight:bold">					<td colspan="2">C&oacute;digo</td><td colspan="9">Art&iacute;culo</td><td colspan="2">Cantidad</td><td colspan="8">Indicaciones</td>				</tr>			<?				foreach($indicaciones as $indic):					if($indic->idatencion === $row->idatencion){			?>				<tr>					<td colspan="2">C&oacute;digo</td><td colspan="9"><?=$indic->descripcion?></td>					<td colspan="2"><?=number_format($indic->cantidad,2,'.',',')?></td><td colspan="8"><?=$indic->indicaciones?></td>				</tr>			<?					}				endforeach;			?>			</table>			<?	}?>			<table align="right" style="margin-top:2cm;margin-bottom:5mm;padding:0">				<tr>					<td style="border-top:1.5px solid #4B4B4B;text-align:center;width:6cm">Firma del M&eacute;dico</td>				</tr>			</table>			<!--<div style="page-break-after:always"></div>-->			<?	endforeach;	?>        </main>    </body></html>