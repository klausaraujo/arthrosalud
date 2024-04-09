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
		$nombre = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true))));
		if($file = $this->fileupload($_FILES['file-2'], $nombre)){
			$this->load->model('Parametros_model');
			
			imagedestroy($file);
			$ext = pathinfo($_FILES['file-2']['name'],PATHINFO_EXTENSION);
			$nombre .= '.'.$ext;
			
			$ubigeo = $this->input->post('dep').$this->input->post('pro').$this->input->post('dis');
			$lat = $this->input->post('lat'); $lng = $this->input->post('lng');
			
			if(!$this->Parametros_model->validar('*','empresa',['ruc' => $this->input->post('ruc')])){
				if($this->input->post('tiporegistro') === 'registrar'){
					//if($this->input->post('tipodoc') != '' && $this->input->post('doc') != '' && $this->input->post('nombres') != '' && $this->input->post('direccion') != ''){
					$this->session->set_flashdata('flashMessage', 'No se pudo registrar la <b>Empresa</b>');
					$data = array(
						'ruc' => $this->input->post('ruc'),
						'razon_social' => $this->input->post('nombres'),
						'nombre_comercial' => $this->input->post('nombres'),
						'domicilio' => $this->input->post('direccion'),
						'ubigeo' => $ubigeo,
						'latitud' => $lat,
						'longitud' => $lng,
						'logotipo' => $nombre,
						'renipress' => $this->input->post('renipress'),
					);
					if($this->Parametros_model->registrar('empresa', $data)){
						$this->session->set_flashdata('flashMessage', '<b>Empresa</b> Registrada Exitosamente');
						$this->session->set_flashdata('claseMsg', 'alert-primary');
					}
					
				}elseif($this->input->post('tiporegistro') === 'editar'){
					$id = $this->input->post('idproveedor');
					$this->session->set_flashdata('flashMessage', 'No se pudo actualizar la <b>Empresa</b>');
					
					$data = array(
						'RUC' => $this->input->post('ruc'),
						'domicilio' => $this->input->post('direccion'),
						'celular' => $this->input->post('celular'),
						'correo' => $this->input->post('email'),
						'ubigeo' => $ubigeo,
						'latitud' => $lat,
						'longitud' => $lng,
						'zona' => $this->input->post('zona'),
						'finca' => $this->input->post('finca'),
						'altitud' => $this->input->post('altitud'),
					);
					
					if($this->Proveedores_model->editar( $data, ['idproveedor'=>$id] )){
						$this->session->set_flashdata('flashMessage', '<b>Empresa</b> Actualizada');
						$this->session->set_flashdata('claseMsg', 'alert-primary');
					}
				}
				header('location:'.base_url().'parametros/empresas');
			}else{
				$this->session->set_flashdata('flashMessage', 'La <b>Empresa</b> ya se encuentra registrada');
				header('location:'.base_url().'parametros/empresas');
			}
		}else{
			$this->session->set_flashdata('flashMessage', 'El formato del <b>Logotipo</b> no es correcto');
			header('location:'.base_url().'parametros/empresas');
		}
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