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
	private $options;
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Lima');
		$this->absolutePath = $_SERVER['DOCUMENT_ROOT'].'/arthrosalud/';
		if($this->session->userdata('user')) $this->usuario = json_decode($this->session->userdata('user'));
		else header('location:' .base_url());
		
		//Setear las opciones
		$this->options = new Options();
		$this->options->set('defaultFont', 'helvetica');
		$this->options->set('isPhpEnabled', 'true');
		$this->options->set('defaultPaperOrientation', 'portrait');
		$this->options->set('defaultPaperSize', 'A4');
	}

    public function index(){}
	
	public function verhistoria()
	{
		$this->load->model('Citas_model');
		$diag = []; $proc = []; $exam = []; $indic = []; $d = null;
		$historia = $this->Citas_model->historia(['idhistoria' => $this->input->get('id')]);
		$atencion = $this->Citas_model->atenciones(['idhistoria' => $this->input->get('id')]);
		foreach($atencion as $row):
			$d = $this->Citas_model->diagnosticos(['idatencion' => $row->idatencion]);
			if(count($d)) $diag[] = $d;
			$p = $this->Citas_model->proc(['idatencion' => $row->idatencion]);
			if(count($p)) $proc[] = $p;
			$e = $this->Citas_model->examenes(['idatencion' => $row->idatencion]);
			if(count($e)) $exam[] = $e;
			$in = $this->Citas_model->indic(['idatencion' => $row->idatencion]);
			if(count($in)) $indic[] = $in;
		endforeach;
		
		$data = array(
			'historia' => $historia,
			'atencion' => $atencion,
			'diagnostico' => count($diag)? $diag : array(),
			'procedimiento' =>  count($proc)? $proc : array(),
			'examenes' =>  count($exam)? $exam : array(),
			'indicaciones' =>  count($indic)? $indic : array(),
		);
		
		$html = $this->load->view('citas/historia-pdf', $data, true);
		$this->viewpdf($html, 0);
		//$html = $this->load->view('citas/nuevo-pdf');
	}
	public function recetapdf()
	{
		$this->load->model('Citas_model');
		$html = $this->load->view('citas/receta-pdf', null, true);
		$this->options->set('defaultPaperOrientation', 'landscape');
		$this->viewpdf($html, 0);
	}
	private function viewpdf($page, $attach)
	{
		//Inicializar la clase
		$this->pdf = $pdf = new Dompdf($this->options);
		$this->pdf->loadHtml($page);
		// Render the HTML as PDF
		$this->pdf->render();
		
		// Output the generated PDF to Browser
		$this->pdf->stream('PDF', array('Attachment' => $attach));
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