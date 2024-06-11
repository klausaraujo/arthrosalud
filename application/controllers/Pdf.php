<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");
require_once $_SERVER['DOCUMENT_ROOT'].'/arthrosalud/application/libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;

class Pdf extends CI_Controller
{
	private $usuario;
	private $pdf;
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Lima');
		$this->absolutePath = $_SERVER['DOCUMENT_ROOT'].'/arthrosalud/';
		if($this->session->userdata('user')) $this->usuario = json_decode($this->session->userdata('user'));
		else header('location:' .base_url());
		
		//Setear las opciones
		$options = new Options();
		$options->set('defaultFont', 'helvetica');
		$options->set('isPhpEnabled', 'true');
		$options->set('defaultPaperOrientation', 'portrait');
		$options->set('defaultPaperSize', 'A4');
		//Inicializar la clase
		$this->pdf = $pdf = new Dompdf($options);
	}

    public function index(){}
	
	public function verhistoria()
	{
		$this->load->model('Citas_model');
		$historia = $this->Citas_model->historia(['idhistoria' => $this->input->get('id')]);
		$atencion = $this->Citas_model->atenciones(['idhistoria' => $this->input->get('id')]);
		
		/*$html = $this->load->view('citas/nuevo-pdf', null, true);
		$this->viewbrowser($html);*/
		//$html = $this->load->view('citas/nuevo-pdf');
	}
	private function viewbrowser($page)
	{
		$this->pdf->loadHtml($page);
		// Render the HTML as PDF
		$this->pdf->render();
		
		// Output the generated PDF to Browser
		$this->pdf->stream('PDF', array('Attachment' => 0));
	}
	private function attach($page)
	{
		$this->pdf->loadHtml($page);
		// Render the HTML as PDF
		$this->pdf->render();
		
		// Output the generated PDF to Browser
		$this->pdf->stream('PDF', array('Attachment' => 1));
	}
	public function marcadeagua($pdf,$options)
	{
		$canvas = $pdf->getCanvas();
		$size = 6;
		if(class_exists('Font_Metrics')){
			$font = Font_Metrics::get_font('helvetica');
			$font_bold = Font_Metrics::get_font('helvetica', 'bold');
			$text_height = Font_Metrics::get_font_height($font, $size);
		}elseif (class_exists('Dompdf\\FontMetrics')){
			$fontMetrics = new FontMetrics($canvas, $options);
			$font = $fontMetrics->getFont('helvetica');
			$font_bold = $fontMetrics->getFont('helvetica','bold');
			$text_height = $fontMetrics->getFontHeight($font, $size);
		}
		
		$w = $canvas->get_width();
		$h = $canvas->get_height();
		$font = $fontMetrics->getFont('courier');
		
		$text = "CONFIDENTIAL";
 
		$txtHeight = $fontMetrics->getFontHeight($font, 75);
		$textWidth = $fontMetrics->getTextWidth($text, $font, 75);
		 
		$canvas->set_opacity(.2);
		 
		$x = (($w-$textWidth)/2);
		$y = (($h-$txtHeight)/2);
		
		$canvas->text($x, $y, $text, $font, 75);
	}
}