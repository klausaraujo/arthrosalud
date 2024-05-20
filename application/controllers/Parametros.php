<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Parametros extends CI_Controller
{
	private $usuario;
	
    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Lima');
		if($this->session->userdata('user')) $this->usuario = json_decode($this->session->userdata('user'));
		else header('location:' .base_url());
	}

    public function index(){}
	
	public function listaempresas()
	{
		$this->load->model('Parametros_model');
		$empresas = $this->Parametros_model->querysqlwhere('*','empresa',['activo' => 1]);
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $empresas]);
	}
	public function empresas()
	{
		return $this->load->view('main');
	}
	public function centros()
	{
		$this->load->model('Parametros_model');
		$empresas = $this->Parametros_model->querysqlwhere('idempresa,razon_social','empresa',['activo' => 1]);
		//return $this->load->view('main', ['empresas' => $empresas]);
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->session->set_flashdata('claseMsg', 'alert-danger');
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Centro de Costo</b>');
			
			$data = array(
				'idempresa' => $this->input->post('idempresa'),
				'centro_costos' => $this->input->post('ccostos'),
			);
			if($this->Parametros_model->registrar('centro_costos', $data)){
				$this->session->set_flashdata('flashMessage', '<b>Centro de Costo</b> Registrado');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}else unset($_SESSION['claseMsg']);
		return $this->load->view('main', ['empresas' => $empresas]);
	}
	public function nuevo()
	{
		$this->load->model('Parametros_model');
		$this->load->model('General_model');
		$data = [];
		//$itiempo = date_format(date_create($this->input->post('finicio')),'Y-m-d H:i');
		//header('location:'.base_url().'parametros');
		$doc = $this->Parametros_model->querysql('*','tipo_documento');
		$dep = $this->General_model->departamentos();
		
		$data['lat'] = -12.0811;
		$data['lng'] = -77.0306;
		$data['tipodoc'] = $doc;
		$data['dep'] = $dep;
		
		return $this->load->view('main',$data);
	}
	public function regempresa()
	{
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$nombre = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true)))); $file = null; $ext = ''; $data = null;
		$this->load->model('Parametros_model');
		$path = './public/images/logos/';
		
		if($_FILES['file-2']['name'] !== ''){
			if($file = $this->fileupload($_FILES['file-2'], $nombre)){
				imagedestroy($file);
				$ext = pathinfo($_FILES['file-2']['name'],PATHINFO_EXTENSION);
				$nombre .= '.'.$ext;
				if($this->input->post('foto') && $this->input->post('foto') !== 'img_default.png'){
					if(is_writable($path.$this->input->post('foto'))) unlink($path.$this->input->post('foto'));
				}
			}
		}
		$ubigeo = $this->input->post('dep').$this->input->post('pro').$this->input->post('dis');
		$data = array(
			'ruc' => $this->input->post('ruc'),
			'razon_social' => $this->input->post('nombres'),
			'nombre_comercial' => $this->input->post('nombres'),
			'domicilio' => $this->input->post('direccion'),
			'ubigeo' => $ubigeo,
			'latitud' => $this->input->post('lat'),
			'longitud' => $this->input->post('lng'),
			'renipress' => $this->input->post('renipress'),
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			if(!$this->Parametros_model->validar('*','empresa',['ruc' => $this->input->post('ruc')])){
				$this->session->set_flashdata('flashMessage', 'No se pudo registrar la <b>Empresa</b>');
				$data['logotipo'] = $ext? $nombre : 'img_default.jpg';
				if($this->Parametros_model->registrar('empresa', $data)){
					$this->session->set_flashdata('flashMessage', '<b>Empresa</b> Registrada Exitosamente');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}else $this->session->set_flashdata('flashMessage', 'La ;<b>Empresa</b> ya se encuentra registrada');
		}elseif($this->input->post('tiporegistro') === 'editar'){
			if($ext) $data['logotipo'] = $nombre;
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar la <b>Empresa</b>');
			if($this->Parametros_model->actualizar('empresa',$data,['idempresa'=> $this->input->post('idempresa')])){
				$this->session->set_flashdata('flashMessage', '<b>Empresa</b> Actualizada');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}
		header('location:'.base_url().'parametros/empresas');
	}
	public function editempresa()
	{
		$this->load->model('Parametros_model');
		$this->load->model('General_model');
		$data = []; $id = $this->input->get('id');
		
		$dep = $this->General_model->departamentos();
		
		$empresa = $this->Parametros_model->querysqlwhere('*', 'empresa', ['idempresa' => $id]);
		$pro = $this->General_model->provincias(['cod_dep'=>substr($empresa[0]->ubigeo,0,2)]);
		$dis = $this->General_model->distritos(['cod_dep'=>substr($empresa[0]->ubigeo,0,2),'cod_pro'=>substr($empresa[0]->ubigeo,2,2)]);
		$data['empresa'] = $empresa[0];
		$data['pro'] = $pro;
		$data['dis'] = $dis;
		$data['lat'] = floatval($data['empresa']->latitud);
		$data['lng'] = floatval($data['empresa']->longitud);
		$data['dep'] = $dep;
		
		return $this->load->view('main',$data);
	}
	public function anular()
	{
		$this->load->model('Parametros_model');
		$msg = 'No se pudo anular el registro';
		$segmento = $this->uri->segment(2);
		
		if($segmento === 'empresas')
			if($this->Parametros_model->actualizar('empresa',['activo' => 0],['idempresa'=> $this->input->get('id')])) $msg = 'Registro anulado';
		
		echo json_encode(['msg' => $msg]);
	}
	public function fileupload($file, $nmb)
	{
		$ext = pathinfo($file['name'],PATHINFO_EXTENSION);
		$f = null;
		//$extension = substr(strtolower(strrchr($tipo, '/')),1);
		//$f1= fopen($file,'rb'); $img = fread($f1, $size); fclose($f1);
		if($ext === 'jpeg' || $ext === 'jpg'){
			$f = imagecreatefromjpeg($file['tmp_name']);
		}elseif($ext === 'x-png' || $ext === 'png'){
			$f = imagecreatefrompng($file['tmp_name']);
		}elseif($ext === 'gif'){
			$f = imagecreatefromgif($file['tmp_name']);
		}
		
		if($f){
			$x = imagesx($f);
			$y = imagesy($f);
			
			if ($x >= $y) {
				$nuevax = 150;
				$nuevay = $nuevax * $y / $x;
			} else {
				$nuevay = 150;
				$nuevax = $x / $y * $nuevay;
			}
			$filenew = imagecreatetruecolor($nuevax, $nuevay);
			//imagecopyresized($filenew, $file, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);
			imagecopyresampled($filenew,$f,0,0,0,0,floor($nuevax),floor($nuevay),$x,$y);
			
			if($ext === 'jpeg' || $ext === 'jpg'){
				imagejpeg($filenew,'./public/images/logos/'.$nmb.'.'.$ext,100);
			}elseif($ext === 'x-png' || $ext === 'png'){
				imagepng($filenew,'./public/images/logos/'.$nmb.'.'.$ext,9);
			}elseif($ext === 'gif'){
				imagegif($filenew,'./public/images/logos/'.$nmb.'.'.$ext,100);
			}
			imagedestroy($filenew);
		}
		
		//file_put_contents('./public/images/logos/'.$nmb, $img);
		//echo '<div class="row"><div class="col-md-7"><img class="img-fluid" src="data:' . $ext . ';base64,' . base64_encode($img).'" /></div></div>';
		
		return $f;
	}
}