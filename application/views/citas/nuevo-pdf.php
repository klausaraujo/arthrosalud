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
		/*.page table.header {
			padding-bottom: 3mm;
			border-bottom: 1px solid #878282;
		}*/
		.odd_row td {
		/*  background-color: #EDF2F7;
		  border-top: 2px solid #FFFFff;*/
		  background-color: transparent;
		  border-bottom: 0.9px solid #ddd; /* 0.9 so table borders take precedence */
		}
		.even_row td {
		/*  background-color: #F8EEE4;
		  border-top: 3px solid #FFFFff;*/
		  background-color: #f6f6f6;
		  border-bottom: 0.9px solid #ddd;
		}
		table.change_order_items { 
		  font-size: 8pt;
		  width: 100%;
		  border-collapse: collapse;
		  margin-top: 2em;
		  margin-bottom: 2em;
		}

		table.change_order_items>tbody { 
		  border: 1px solid black;
		}

		table.change_order_items>tbody>tr>th { 
		  border-bottom: 1px solid black;
		}

		table.change_order_items>tbody>tr>td { 
		  border-right: 1px solid black;
		  padding: 0.5em;
		}
		.acciones td {border:1px solid #4B4B4B; border-collapse: collapse; padding-left: 5px}
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

<table cellspacing="0" cellpadding="1" class="acciones" style="width: 100%">
	<tr><td><strong>N&uacute;mero:</strong></td><td>123456</td><td><strong>H. F&iacute;sica:</strong></td>
		<td>123456</td><td><strong>Fecha Registro:</strong></td><td>123456</td>
	</tr>
	<tr><td><strong>Paciente:</strong></td><td colspan="3">123456</td><td><strong>Tipo Documento:</strong></td>
		<td>123456</td>
	</tr>
	<tr><td><strong>Documento Nro.:</strong></td><td>123456</td><td><strong>Sexo:</strong></td>
		<td>123456</td><td><strong>Fecha de Nacimiento:</strong></td><td>123456</td>
	</tr>
	<tr><td><strong>Edad:</strong></td><td>123456</td><td><strong>Estado Civil:</strong></td>
		<td>123456</td><td><strong>Lugar de Nacimiento:</strong></td><td>123456</td>
	</tr>
	<tr><td><strong>Domicilio:</strong></td><td colspan="2">123456</td><td><strong>Lugar de Domicilio:</strong></td>
		<td colspan="2">123456</td>
	</tr>
</table>
<!--
<table class="change_order_items"><tr><td colspan="6"><h2>Standard Items:</h2></td></tr><tbody><tr><th>Item</th><th>Description</th><th>Quantity</th><th colspan="2">Unit Cost</th><th>Total</th></tr><tr class="even_row"><td style="text-align: center">1</td><td>Sprockets (13 tooth)</td><td style="text-align: center">50</td><td style="text-align: right; border-right-style: none;">$10.00</td><td class="change_order_unit_col" style="border-left-style: none;">Ea.</td><td class="change_order_total_col">$5,000.00</td></tr><tr class="odd_row"><td style="text-align: center">2</td><td>Cogs (Cylindrical)</td><td style="text-align: center">45</td><td style="text-align: right; border-right-style: none;">$25.00</td><td class="change_order_unit_col" style="border-left-style: none;">Ea.</td><td class="change_order_total_col">$1125.00</td></tr><tr class="even_row"><td style="text-align: center">3</td><td>Gears (15 tooth)</td><td style="text-align: center">32</td><td style="text-align: right; border-right-style: none;">$19.00</td><td class="change_order_unit_col" style="border-left-style: none;">Ea.</td><td class="change_order_total_col">$608.00</td></tr><tr class="odd_row"><td style="text-align: center">4</td><td>Leaf springs (13 N/m)</td><td style="text-align: center">6</td><td style="text-align: right; border-right-style: none;">$125.00</td><td class="change_order_unit_col" style="border-left-style: none;">Ea.</td><td class="change_order_total_col">$750.00</td></tr><tr class="even_row"><td style="text-align: center">5</td><td>Coil springs (6 N/deg)</td><td style="text-align: center">7</td><td style="text-align: right; border-right-style: none;">$11.00</td><td class="change_order_unit_col" style="border-left-style: none;">Ea.</td><td class="change_order_total_col">$77.00</td></tr></tbody><tr><td colspan="3" style="text-align: right;">(Tax is not included; it will be collected on closing.)</td><td colspan="2" style="text-align: right;"><strong>GRAND TOTAL:</strong></td><td class="change_order_total_col"><strong>$7560.00</strong></td></tr></table>

-->
</div>

</div>
</div>
</body>