<?ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Receta M&eacute;dica Nro. <?=sprintf("%'07s",$receta->numero);?></title>
	<style>
		@page { margin:0.25in; font-size:12px }
		body { margin-top: 5.7cm; margin-bottom:1in }
		.header1, .header2, .footer1, .footer2{ font-size: 0.9em }
		.header1{ position:fixed; width: 5.35in; margin-right: 0.5in }
		.header2{ position:fixed; width: 5.35in; right: 0.5in; left: 5.85in; }
		.footer1{ position:fixed; width: 5.35in; margin-right: 0.5in; bottom:1in }
		.footer2{ position:fixed; width: 5.35in; right: 0.5in; left: 5.85in; bottom:1in }
		#content1{ position:absolute; width: 5.35in; font-size: 0.8em; margin-right: 0.5in; }
		#content2{ width: 5.35in; font-size: 0.8em; right: 0.5in; margin-left: 5.85in; }
		
		.odd_row td { background-color: transparent; border-bottom: 0.9px solid #ddd; }
		.even_row td { background-color: #f6f6f6; border-bottom: 0.9px solid #ddd; }
		
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
		.atenciones td{ padding:0.4em 0 0.4em 0.6em; vertical-align:middle; }
		hr {
		  page-break-after: always;
		  border: 0;
		  margin: 0;
		  padding: 0;
		}
	</style>
</head>

<body>
	<?
		date_default_timezone_set('America/Lima');
		$fArray = explode('/',substr($paciente->fecnac,0,10));
		$fec = new DateTime($fArray[2].'-'.$fArray[1].'-'.$fArray[0]);
		$hoy = new DateTime();
		$edad = $hoy->diff($fec);
		
		for($i = 1;$i < 3;$i++){
	?>
		<header class="header<?=$i?>">
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
			<div style="text-align:center">RECETA MEDICA NRO. <?=sprintf("%'07s",$receta->numero);?></div>
			<div style="margin-left:0.6cm;margin-top:0.4cm;font-size:0.9em">1. DATOS GENERALES</div>
			<table align="center" class="datos">
				<tbody>
					<tr>
						<td colspan="7" style="color:#808080">Nombre Paciente: &nbsp;&nbsp;<span style="font-weight:bold;color:#000">
							<?=$paciente->nombres.' '.$paciente->apellidos?></span></td>
					</tr>
					<tr>
						<td style="color:#808080">Direcci&oacute;n: </td>
						<td colspan="5" style="font-weight:bold;"><?=$paciente->domicilio?></td>
					</tr>
					<tr>
						<td style="width:1.7cm;color:#808080">Tipo Doc.: </td>
						<td style="width:2.5cm;font-weight:bold"><?=$paciente->tipo_documento?></td>
						<td style="width:0.7cm;color:#808080">Nro.: </td>
						<td style="width:2cm;font-weight:bold"><?=$paciente->numero_documento?></td>
						<td style="width:1cm;color:#808080">Edad: </td>
						<td style="width:3cm;font-weight:bold"><?=$edad->y.' a&ntilde;os, '.$edad->m.' mes(es)'?></td>
					</tr>
					<tr>
						<td colspan="7" style="color:#808080">Diagn&oacute;stico: &nbsp;&nbsp;<span style="font-weight:bold;color:#000">
							<?=$receta->observaciones?></span></td>
					</tr>
				</tbody>
			</table>
		</header>
		<footer class="footer<?=$i?>">
			<div style="position:absolute;bottom:2.5cm;border-bottom:1px solid #cfcfcf;width:3cm;left:0.25in;text-align:center"><?=date('d-m-Y')?></div>
			<div style="position:absolute;bottom:2cm; width:3cm;left:0.25in;text-align:center">FECHA</div>
			<div style="position:absolute;bottom:2.5cm;border-bottom:1px solid #cfcfcf;width:3cm;right:0.25in"></div>
			<div style="position:absolute;bottom:2cm; width:3cm;right:0.25in;text-align:center">FIRMA</div>
		</footer>
	<?	}
		for($i = 1;$i < 3;$i++){
	?>
		<main id="content<?=$i?>">
			<div style="margin-top:0.2cm; margin-left:0.6cm">2. DIAGN&Oacute;STICOS</div>
			<table align="center" class="atenciones" cellspacing="0">
				<tbody>
					<tr><th style="width:1cm;text-align:center">CIE10</th><th style="width:6cm;text-align:center">DIAGN&Oacute;STICO</th>
						<th style="width:2cm;text-align:center">TIPO</th></tr>
				<?
					foreach($diagnostico as $row):
				?>
					<tr class="odd_row"><td><?=$row->cie10?></td><td><?=$row->descripcion_cie10?></td>
						<td style="text-align:justify"><?=$row->tipo==='1'?'1 - Presuntivo':'2 - Definitivo'?></td></tr>
				<?
					endforeach;
				?>
				</tbody>
			</table>
			<div style="margin-top:0.4cm;margin-left:0.6cm">3. DETALLE DE LA RECETA</div>
			<table align="center" class="atenciones" cellspacing="0">
				<tbody>
					<tr><th style="width:3cm;text-align:center">ART&Iacute;CULO</th><th style="width:0.5cm;text-align:center">CANTIDAD</th>
						<th style="width:3cm;text-align:center">INDICACIONES</th></tr>
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
		</main>
	<?	}?>
</body>