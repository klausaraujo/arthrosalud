<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="STYLESHEET" href="css/print_static.css" type="text/css">
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
	<tr class="odd_row"><td><strong>Edad:</strong></td><td></td><td><strong>Estado Civil:</strong></td>
		<td><?=$historia->estado_civil?></td><td><strong>Lugar de Nacimiento:</strong></td><td></td>
	</tr>
	<tr class="even_row"><td><strong>Domicilio:</strong></td><td colspan="2"></td><td><strong>Lugar de Domicilio:</strong></td>
		<td colspan="2"></td>
	</tr>
</table>

<table class="atenciones" style="margin-top:5mm" cellspacing="0">
	<tr class="even_row"><td colspan="12"><strong>REGISTRO DE ATENCIONES DEL PACIENTE</strong></td></tr>
	<tbody>
		<tr><td><strong>Fecha Atenci&oacute;n</strong></td><td colspan="2"></td><td colspan="2"><strong>M&eacute;dico Tratante</strong></td><td colspan="7"></td></tr>
		<tr>
			<td><strong>Establecimiento</strong></td><td colspan="4"></td><td><strong>Tipo Atenci&oacute;n</strong></td>
			<td colspan="3"></td><td><strong>Prioridad</strong></td><td colspan="2"></td>
		</tr>
		<tr>
			<td><strong>Gestante</strong></td><td></td><td><strong>Semanas</strong></td><td></td><td><strong>Presi&oacute;n Arterial</strong></td><td></td><td></td>
			<td colspan="2"><strong>Presi&oacute;n Venosa</strong></td><td></td><td><strong>Saturaci&oacute;n</strong></td><td></td>
		</tr>
		<tr>
			<td><strong>Temperatura</strong></td><td></td><td><strong>F. Card&iacute;aca</strong></td><td></td><td colspan="2"><strong>F. Respiratoria</strong></td>
			<td></td><td><strong>Peso</strong></td><td></td><td></td><td><strong>Talla</strong></td><td></td>
		</tr>
		<tr>
			<td><strong>IMC</strong></td><td></td><td><strong>AO</strong></td><td colspan="2"></td><td><strong>RV</strong></td><td></td>
			<td><strong>RM</strong></td><td></td><td></td><td><strong>Glasgow</strong></td><td></td>
		</tr>
	</tbody>
</table>


</div>

</div>
</div>
</body>