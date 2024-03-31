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
	
	public function empresas()
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
		$this->load->model('Parametros_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		
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
					'logotipo' => $this->input->post('logotipo'),
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
			header('location:'.base_url().'parametros');
		}else{
			$this->session->set_flashdata('flashMessage', 'La <b>Empresa</b> ya se encuentra registrada');
			header('location:'.base_url().'parametros/empresas');
		}
		
	}
}