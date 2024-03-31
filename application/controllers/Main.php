<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Main extends CI_Controller
{
	private $usuario;
	private $absolutePath;
	private $modulo = false;
	
    public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Lima');
		if($this->session->userdata('user')){
			$this->usuario = json_decode($this->session->userdata('user'));
			$this->absolutePath = $_SERVER['DOCUMENT_ROOT'].'/arthrosalud/';
			$seg = $this->uri->segment(1);
			foreach($this->usuario->modulos as $mod):
				if($mod->url === $seg){
					if($mod->activo) $this->modulo = true;
				}
			endforeach;
			
			if($seg === 'main') $this->modulo = true;
			
			if(!$this->modulo) header('location:' .base_url());
			
		}else header('location:' .base_url());
	}

    public function index(){}
	
	public function usuarios()
	{
		$this->load->model('Usuarios_model');
		$idmodulo = '';
		foreach($this->usuario->modulos as $valor):
			if($valor->url === $this->uri->segment(1)){
				$idmodulo = $valor->idmodulo; break;
			}
		endforeach;
		$bot = $this->Usuarios_model->buscaPerByModByUser(['idusuario' => $this->usuario->idusuario,'idmodulo' => $idmodulo,'b.activo' => 1]);
		$this->session->set_userdata('perUser', json_encode($bot));
		$permisos = $this->Usuarios_model->permisosOpciones();
		$modulos = $this->Usuarios_model->buscaModulos();
		
		$headers = array(
			'0'=>['title' => 'Acciones', 'targets' => 0],'1'=>['title' => 'ID', 'targets' => 1],'2'=>['title' => 'Documento', 'targets' => 2],
			'3'=>['title' => 'N&uacute;mero', 'targets' => 3],'4'=>['title' => 'Avatar', 'targets' => 4],'5'=>['title' => 'Apellidos', 'targets' => 5],
			'6'=>['title' => 'nombres', 'targets' => 6],'7'=>['title' => 'Usuario', 'targets' => 7],'8'=>['title' => 'Perfil', 'targets' => 8],
			'9'=>['title' => 'Estado', 'targets' => 9],'10'=>['targets' => 'no-sort', 'orderable' => false],'11'=>['targets' => 1, 'visible' => false],
		);
		$data = array(
			'permisos' => $permisos,
			'headers' => $headers,
			'modulos' => $modulos,
		);
		$this->load->view('main',$data);
	}
	public function parametros()
	{
		$this->load->model('Parametros_model');
		$this->load->model('Usuarios_model');
		foreach($this->usuario->modulos as $valor):
			if($valor->url === $this->uri->segment(1)){
				$idmodulo = $valor->idmodulo; break;
			}
		endforeach;
		$bot = $this->Usuarios_model->buscaPerByModByUser(['idusuario' => $this->usuario->idusuario,'idmodulo' => $idmodulo,'b.activo' => 1]);
		$this->session->set_userdata('perParametros', json_encode($bot));
		
		$this->load->view('main');
	}
	public function logistica()
	{
		$this->load->model('Logistica_model');
		$this->load->model('Usuarios_model');
		foreach($this->usuario->modulos as $valor):
			if($valor->url === $this->uri->segment(1)){
				$idmodulo = $valor->idmodulo; break;
			}
		endforeach;
		$bot = $this->Usuarios_model->buscaPerByModByUser(['idusuario' => $this->usuario->idusuario,'idmodulo' => $idmodulo,'b.activo' => 1]);
		$this->session->set_userdata('perLogistica', json_encode($bot));
		
		$this->load->view('main');
	}
}