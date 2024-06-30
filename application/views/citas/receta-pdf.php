<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Receta M&eacute;dica Nro. <?=sprintf("%'07s",$receta->numero);?></title>
	<style>
		@page { margin: 0.25in }
		.odd_row td { background-color: transparent; border-bottom: 0.9px solid #ddd; }
		.even_row td { background-color: #f6f6f6; border-bottom: 0.9px solid #ddd; }
		table td{ font-size: 12px }
		table.datos{
			border-collapse:separate;
			border-spacing:1;
			border:solid #094293 1px;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			margin-top: 1em;
			width:5in;
		}
		table.datos td{ padding:0.4em 0 0.4em 0.6em; vertical-align:middle; }
		table.atenciones{
			border-collapse:separate;
			border-spacing:3;
			border:solid #094293 1px;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			margin-top: 1em;
			overflow: hidden;
			width:5in;
		}
		.atenciones td{ font-size: 1.1em; padding:0.4em 0 0.4em 0.6em; vertical-align:middle; }
		.header1{ position:fixed; width: 5.35in; margin-right: 0.5in }
		.header2{ left: 5.85in; position:fixed; width: 5.35in; margin-right: 0.5in }
	</style>
</head>

<body>
	<?
		date_default_timezone_set('America/Lima');
		$fArray = explode('/',substr($paciente->fecnac,0,10));
		$fec = new DateTime($fArray[2].'-'.$fArray[1].'-'.$fArray[0]);
		$hoy = new DateTime();
		$edad = $hoy->diff($fec);
	?>
	<div>
		<div>
		<?
			for($i = 1; $i < 3; $i++){
				$clase = 'header'.$i;
		?>
			<div style="font-size: 7pt" class="<?=$clase?>">
				<table style="width:100%;padding-bottom:3mm;line-height:0.5em">
					<tr>
						<td style="width:1.2in"><div style="text-align:left"><img src="<?=$_SERVER['DOCUMENT_ROOT']?>/arthrosalud/public/images/logo-white.png" style="width:100%" /></div></td>
						<td align="right" style="width:3in">
							<div style="text-align:right">
								<h2 style="color:#094293">Dr. <?=$profesional->nombres.' '.$profesional->apellidos?></h2>
								<cite style="color:#808080;font-size:1.2em"><?=$profesional->especialidad?></cite>
							</div>
						</td>
					</tr>
				</table>
				<div style="text-align:center;font-size:1.3em">RECETA MEDICA NRO. <?=sprintf("%'07s",$receta->numero);?></div>
				<div style="margin-left:0.7cm;margin-top:0.4cm">1. DATOS GENERALES</div>
				<table align="center" class="datos">
					<tbody>
						<tr>
							<td colspan="2" style="color:#808080">Nombre Paciente: </td>
							<td colspan="5" style="font-weight:bold;"><?=$paciente->nombres.' '.$paciente->apellidos?></td>
						</tr>
						<tr>
							<td style="color:#808080">Direcci&oacute;n: </td>
							<td colspan="5" style="font-weight:bold;"><?=$paciente->domicilio?></td>
						</tr>
						<tr>
							<td style="width:2cm;color:#808080">Tipo Doc.: </td>
							<td style="width:1.5cm;font-weight:bold"><?=$paciente->tipo_documento?></td>
							<td style="width:0.7cm;color:#808080">Nro.: </td>
							<td style="width:2cm;font-weight:bold"><?=$paciente->numero_documento?></td>
							<td style="width:1cm;color:#808080">Edad: </td>
							<td style="width:3cm;font-weight:bold"><?=$edad->y.' a&ntilde;os, '.$edad->m.' mes(es)'?></td>
						</tr>
						<tr>
							<td colspan="2" style="color:#808080">Diagn&oacute;stico: </td>
							<td colspan="5" style="font-weight:bold;"><?=$receta->observaciones?></td>
						</tr>
					</tbody>
				</table>
				<div style="margin-top:0.4cm;margin-left:0.7cm">2. DIAGN&Oacute;STICOS</div>
				<table align="center" class="atenciones" cellspacing="0">
					<tbody>
						<tr><th style="width:1cm;font-size:1.3em;text-align:center">CIE10</th><th style="width:6cm;font-size:1.3em;text-align:center">Diagn&oacute;stico</th>
							<th style="width:2cm;font-size:1.3em;text-align:center">Tipo</th></tr>
					<?
						foreach($diagnostico as $row):
					?>
						<tr class="odd_row"><td><?=$row->cie10?></td><td style="text-align:center"><?=$row->descripcion_cie10?></td>
							<td style="text-align:justify"><?=$row->tipo==='1'?'1 - Presuntivo':'2 - Definitivo'?></td></tr>
					<?
						endforeach;
					?>
					</tbody>
				</table>
				<div style="margin-top:0.4cm;margin-left:0.7cm">3. DETALLE DE LA RECETA</div>
				<table align="center" class="atenciones" cellspacing="0">
					<tbody>
						<tr><th style="width:3cm;font-size:1.3em;text-align:center">Art&iacute;culo</th><th style="width:0.5cm;font-size:1.3em;text-align:center">Cantidad</th>
							<th style="width:3cm;font-size:1.3em;text-align:center">Indicaciones</th></tr>
					<?
						foreach($detalle as $row):
					?>
						<tr class="odd_row"><td><?=$row->descripcion?></td><td style="text-align:center"><?=$row->cantidad?></td>
							<td style="text-align:justify"><?=$row->indicaciones?></td></tr>
					<?
						endforeach;
					?>
					</tbody>
				</table>
				<div style="position:absolute;bottom:2.5cm;border-bottom:1px solid #cfcfcf;width:3cm;left:0.25in;font-size:1.3em;text-align:center"><?=date('d-m-Y')?></div>
				<div style="position:absolute;bottom:2cm; width:3cm;left:0.25in;text-align:center;font-size:1.3em">FECHA</div>
				<div style="position:absolute;bottom:2.5cm;border-bottom:1px solid #cfcfcf;width:3cm;right:0.25in"></div>
				<div style="position:absolute;bottom:2cm; width:3cm;right:0.25in;text-align:center;font-size:1.3em">FIRMA</div>
			</div>
			<!--<table class="atenciones" style="margin-top:5mm" cellspacing="0" align="center">
				<tr style="background:#d8d5d5;">
					<td colspan="12"><strong style="margin-right:9cm">REGISTRO DE ATENCIONES DEL PACIENTE</strong>
					<span style="text-align:right;padding:0"><strong>Fecha de Atenci&oacute;n:&nbsp;&nbsp;</strong>Fecha</span></td>
				</tr>
				<tbody>
				</tbody>
			</table>-->
		<?
			}
		?>
		</div>
	</div>
</body>