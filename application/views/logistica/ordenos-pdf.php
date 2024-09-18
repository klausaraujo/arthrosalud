<?
	ob_start();
	$titulo = '';
	if($this->uri->segment(2)==='oservicio') $titulo = 'ORDEN DE SERVICIO';
	elseif($this->uri->segment(2)==='ocompra') $titulo = 'ORDEN DE COMPRA';
	elseif($this->uri->segment(2)==='gentrada') $titulo = 'GU&Iacute;A DE INGRESO';
	elseif($this->uri->segment(2)==='gsalida') $titulo = 'GU&Iacute;A DE SALIDA';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Orden Nro. <?=sprintf("%'07s",$orden->numero);?></title>
	<style>
		@page { margin:0.25in; font-size:10px }
		body { margin: .2in .5in }
		table.atenciones{
			border-collapse:collapse;
			border:solid #000 1px;
			margin-top: .7em;
		}
		table.atenciones td { border-collapse: collapse; border:dotted #000 1px; padding:0.2em 0.2em 0.2em 0.2em; vertical-align:middle; }
		table.atenciones th {
			background-color: #eaeded; text-align:center; padding:0.2em 0.2em 0.2em 0.2em; vertical-align:middle;
			border-collapse: collapse; border:dotted #000 1px;
		}
		hr {
		  page-break-after: always;
		  border: 0;
		  margin: 0;
		  padding: 0;
		}
	</style>
</head>

<body>
	<header>
		<table style="width:100%;padding-bottom:3mm;line-height:0.5em">
			<tr>
				<td style="width:2in"><div style="text-align:left"><img src="<?=$_SERVER['DOCUMENT_ROOT']?>/arthrosalud/public/images/logo-white.png" style="width:100%" /></div></td>
				<td align="center">
					<div style="">
						<h2 style="color:#094293"><?=$titulo?></h2>
					</div>
				</td>
			</tr>
		</table>
	</header>
	<main>
		<table class="atenciones">
			<tr><th colspan="2" align="center">PROVEEDOR</th></tr>
			<tr><td align="right" style="width:2cm;font-size:9px;font-weight:bold">EMPRESA:</td><td style="width:5cm"><?=$orden->razon_social?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">RUC:</td><td><?=$orden->numero_ruc?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">DIR. FISCAL:</td><td><?=$orden->dom?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">TELÉFONO:</td><td><?=$orden->celular?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">CORREO:</td><td><?=$orden->correo?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">BANCO:</td><td><?=!empty($detprov)?$orden->banco:'&nbsp;'?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">CC/CCI:</td><td><?=!empty($detprov)?$orden->cci_cuenta:'&nbsp;'?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">CUENTA:</td><td><?=!empty($detprov)?$orden->numero_cuenta:'&nbsp;'?></td></tr>
		</table>
		<table class="atenciones" style="position:absolute;left:9.8cm;top:1.05in">
			<tr><th colspan="2" align="center">ENVIAR A:</th></tr>
			<tr><td align="right" style="width:2cm;font-size:9px;font-weight:bold">EMPRESA:</td><td style="width:5cm"><?=$orden->nombre_comercial?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">RUC:</td><td><?=$orden->ruc?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">DIR. FISCAL:</td><td><?=$orden->domicilio?></td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">TELÉFONO:</td><td>&nbsp;</td></tr>
			<tr><td align="right" style="font-size:9px;font-weight:bold">CORREO:</td><td>&nbsp;</td></tr>
		</table>
		<table class="atenciones" width="100%">
			<tr><th>OC</th><th>FECHA</th><th>SOLICITANTE</th><th>ÁREA</th><th>ENVÍO</th><th>DSCT</th></tr>
			<tr style="text-align:center">
				<td style="width:1.8cm">&nbsp;</td><td style="width:1.8cm">&nbsp;</td>
				<td style="width:5.5cm">&nbsp;</td><td style="width:1.8cm">&nbsp;</td><td style="width:1.8cm">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table class="atenciones" width="100%" style="margin-top:1.5em">
			<tr><th>DESCRIPCIÓN DEL SERVICIO</th><th>CANT.</th><th>U.M</th><th>P.U</th><th>P.T</th></tr>
		<?
			$sumacosto = 0; $total = 0;
			foreach($detalle as $row):
				$sumacosto += intval($row->cantidad) * floatval($row->costo);
				$total += $sumacosto;
		?>
			<tr>
				<td style="width:7cm"><?=$row->descripcion?></td><td style="width:1.8cm;text-align:center"><?=intval($row->cantidad)?></td>
				<td style="width:1.8cm;text-align:center"><?=$row->unidad_medida?></td>
				<td style="width:1.8cm;text-align:right"><?=number_format(floatval($row->costo),2,'.',',')?></td>
				<td style="text-align:right"><?=number_format(floatval($sumacosto),2,'.',',')?></td>
			</tr>
		<?
			endforeach;
			$subt = $total / 1.18;
			for($i = count($detalle);$i <= 20;$i++):
		?>
			<tr>
				<td style="width:7cm">&nbsp;</td><td style="width:1.8cm;text-align:center">&nbsp;</td>
				<td style="width:1.8cm;text-align:center">&nbsp;</td><td style="width:1.8cm;text-align:right">&nbsp;</td>
				<td style="text-align:right">&nbsp;</td>
			</tr>
		<?
			endfor;
		?>
		</table>
		<table class="atenciones" style="margin-top:3em;float:left">
			<tr><th>OBSERVACIÓN</th></tr>
			<tr><td style="width:8.8cm">&nbsp;</td></tr>
			<tr><td style="width:8.8cm">&nbsp;</td></tr>
			<tr><td style="width:8.8cm">&nbsp;</td></tr>
			<tr><td style="width:8.8cm">&nbsp;</td></tr>
		</table>
		<div style="width:5.8cm;margin-left:auto;padding-right:3mm">
			<table class="atenciones" style="margin:0">
				<tr><td style="width:1.8cm;background-color:#eaeded;font-weight:bold" align="right">SUBTOTAL:</td>
					<td style="width:4cm" align="right"><?=number_format($subt,2,'.',',')?></td></tr>
				<tr><td style="background-color:#eaeded;font-weight:bold" align="right">I.G.V:</td>
					<td align="right"><?=number_format($subt * 0.18,2,'.',',')?></td></tr>
				<tr><td style="background-color:#eaeded;font-weight:bold" align="right">ENVÍO:</td><td>&nbsp;</td></tr>
				<tr><td style="background-color:#eaeded;font-weight:bold" align="right">&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td style="background-color:#eaeded;font-weight:bold" align="right">TOTAL:</td>
					<td align="right"><?=number_format($total,2,'.',',')?></td></tr>
			</table>
		</div>
	</main>
</body>