<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Logistica extends CI_Controller
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
	
	public function listaproveedores()
	{
		$this->load->model('Logistica_model');
		$proveedores = $this->Logistica_model->querysqlwhere('*','proveedor',['activo' => 1]);
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $proveedores]);
	}
	public function listabienes()
	{
		$this->load->model('Logistica_model');
		$bienes = $this->Logistica_model->listabienes(['a.activo' => 1]);
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $bienes]);
	}
	public function proveedores()
	{
		return $this->load->view('main');
	}
	public function bienes()
	{
		return $this->load->view('main');
	}
	public function nuevo()
	{
		$this->load->model('Logistica_model');
		$this->load->model('General_model');
		$data = [];
		//$itiempo = date_format(date_create($this->input->post('finicio')),'Y-m-d H:i');
		//header('location:'.base_url().'parametros');
		$doc = $this->Logistica_model->querysql('*','tipo_documento');
		$cta = $this->Logistica_model->querysql('*','tipo_cuenta');
		$bco = $this->Logistica_model->querysql('*','banco');
		$moneda = $this->Logistica_model->querysql('*','tipo_moneda');
		$dep = $this->General_model->departamentos();
		
		$data['lat'] = -12.0811;
		$data['lng'] = -77.0306;
		$data['tipodoc'] = $doc;
		$data['dep'] = $dep;
		$data['cta'] = $cta;
		$data['bco'] = $bco;
		$data['moneda'] = $moneda;
		
		return $this->load->view('main',$data);
	}
	public function nuevobienes()
	{
		$this->load->model('Logistica_model');
		$tart = $this->Logistica_model->querysqlwhere('*','tipo_articulo',['activo' => 1]);
		$lab = $this->Logistica_model->querysqlwhere('*','laboratorio',['activo' => 1]);
		$um = $this->Logistica_model->querysqlwhere('*','unidad_medida',['uso_bienes' => 1,'activo' => 1]);
		$pres = $this->Logistica_model->querysqlwhere('*','presentacion',['activo' => 1]);
		
		$data = array(
			'tipoart' => $tart,
			'laboratorio' => $lab,
			'um' => $um,
			'presentacion' => $pres
		);
		return $this->load->view('main', $data);
	}
	public function regproveedor()
	{
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		//$nombre = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true))));
		$this->load->model('Logistica_model');

		$ubigeo = $this->input->post('dep').$this->input->post('pro').$this->input->post('dis');
		$lat = $this->input->post('lat'); $lng = $this->input->post('lng');
		
		if(!$this->Logistica_model->validar('*','proveedor',['numero_ruc' => $this->input->post('ruc')])){
			if($this->input->post('tiporegistro') === 'registrar'){
				//if($this->input->post('tipodoc') != '' && $this->input->post('doc') != '' && $this->input->post('nombres') != '' && $this->input->post('direccion') != ''){
				$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Proveedor</b>');
				$data = array(
					'numero_ruc' => $this->input->post('ruc'),
					'razon_social' => $this->input->post('nombres'),
					'nombre_comercial' => $this->input->post('nombres'),
					'domicilio' => $this->input->post('direccion'),
					'ubigeo' => $ubigeo,
					'latitud' => $lat,
					'longitud' => $lng,
					'celular' => $this->input->post('celular'),
					'contacto' => $this->input->post('contacto'),
					'correo' => $this->input->post('correo'),
					'idtipocuenta' => $this->input->post('idtipocuenta'),
					'idbanco' => $this->input->post('idbanco'),
					'numero_cuenta' => $this->input->post('nrocuenta'),
					'cci_cuenta' => $this->input->post('cci'),
					'idtipomoneda' => $this->input->post('tipomoneda'),
					'observaciones' => $this->input->post('obs'),
				);
				if($this->Logistica_model->registrar('proveedor', $data)){
					$this->session->set_flashdata('flashMessage', '<b>Proveedor</b> Registrado Exitosamente');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
				
			}elseif($this->input->post('tiporegistro') === 'editar'){
				$id = $this->input->post('idproveedor');
				$this->session->set_flashdata('flashMessage', 'No se pudo actualizar el <b>Proveedor</b>');
				
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
					$this->session->set_flashdata('flashMessage', '<b>Proveedor</b> Actualizado');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}
			header('location:'.base_url().'logistica/proveedores');
		}else{
			$this->session->set_flashdata('flashMessage', 'El <b>Proveedor</b> ya se encuentra registrado');
			header('location:'.base_url().'logistica/proveedores');
		}
	}
	public function regbienes()
	{
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$nombre = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true)))); $file = null; $ext = '';
		$this->load->model('Logistica_model');
		
		if($_FILES['img']['name'] !== ''){
			if($file = $this->fileupload($_FILES['img'], $nombre)){
				imagedestroy($file);
				$ext = pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
				$nombre .= '.'.$ext;
			}
		}
		
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Art&iacute;culo</b>');
			$data = array(
				'idtipoarticulo' => $this->input->post('tipoart'),
				'idlaboratorio' => $this->input->post('laboratorio'),
				'idunidadmedida' => $this->input->post('um'),
				'idpresentacion' => $this->input->post('presentacion'),
				'descripcion' => $this->input->post('descripcion'),
				'fotografia' => ($ext? $nombre : ''),
				'disponible_compra' => ($this->input->post('compra')? 1 : 0),
				'disponible_venta' => ($this->input->post('venta')? 1 : 0),
				'porcentaje_utilidad' => $this->input->post('porcentaje'),
				'observaciones' => $this->input->post('obs'),
			);
			if($this->Logistica_model->registrar('articulos', $data)){
				$this->session->set_flashdata('flashMessage', '<b>Art&iacute;culo</b> Registrado Exitosamente');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){}
		header('location:'.base_url().'logistica/bienes');
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
				imagejpeg($filenew,'./public/images/articulos/'.$nmb.'.'.$ext,100);
			}elseif($ext === 'x-png' || $ext === 'png'){
				imagepng($filenew,'./public/images/articulos/'.$nmb.'.'.$ext,9);
			}elseif($ext === 'gif'){
				imagegif($filenew,'./public/images/articulos/'.$nmb.'.'.$ext,100);
			}
			imagedestroy($filenew);
		}
		
		//file_put_contents('./public/images/logos/'.$nmb, $img);
		//echo '<div class="row"><div class="col-md-7"><img class="img-fluid" src="data:' . $ext . ';base64,' . base64_encode($img).'" /></div></div>';
		
		return $f;
	}
}