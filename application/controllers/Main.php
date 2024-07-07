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
		$permisos = $this->Usuarios_model->buscamenus('botones',['activo' => 1],'orden');
		$modulos = $this->Usuarios_model->buscamenus('modulos','orden <> 0','orden');
		$mnus = $this->Usuarios_model->buscamenus('menu',['activo' => 1],'idmodulo');
		$sbmnus = $this->Usuarios_model->buscamenus('menu_detalle',['activo' => 1],'orden');
		
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
			'menus' => $mnus,
			'submenus' => $sbmnus,
		);
		$this->load->view('main',$data);
	}
	public function parametros()
	{
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
	public function citas()
	{
		$this->load->model('Usuarios_model');
		foreach($this->usuario->modulos as $valor):
			if($valor->url === $this->uri->segment(1)){
				$idmodulo = $valor->idmodulo; break;
			}
		endforeach;
		$bot = $this->Usuarios_model->buscaPerByModByUser(['idusuario' => $this->usuario->idusuario,'idmodulo' => $idmodulo,'b.activo' => 1]);
		$this->session->set_userdata('perCitas', json_encode($bot));

		$this->load->model('Citas_model');
		$prof = $this->Citas_model->listaprofdash();

		$data = array('prof' => $prof);
		
		$this->load->view('main', $data);
	}
	public function error()
	{
		$this->load->view('main');
	}
	public function perfil(){ $this->load->view('main'); }
	public function password()
    {
        $this->load->model('Usuario_model');
        
        $actual = $this->input->post('old_password');
        $password = $this->input->post('password');
        $id = $this->input->post('cod_usuario');
		$status = 500;
        $message = 'Contrase&ntilde;a actual no coincide';
		
		$this->Usuario_model->setPassword($actual);
		$validacion = $this->Usuario_model->validar_password(['idusuario' => $this->usuario->idusuario]);
		
		if($validacion === 1){
			$message = 'No se pudo actualizar la contrase&ntilde;a';
			$this->Usuario_model->setPassword($password);            
            if ($this->Usuario_model->password(['idusuario' => $id]) === 1){
                $message = 'La contrase&ntilde;a ha sido actualizada';
                $status = 200;
            }
        }
        echo json_encode(array('status'=>$status,'message'=>$message));
    }
	public function provincias(){
		$this->load->model('General_model');
		
		$listaProv = $this->General_model->provincias(['cod_dep'=>$this->input->post('cod_dep')]);
		
        echo json_encode($listaProv);
	}
	public function distritos(){
		$this->load->model('General_model');
		
		$listaDis = $this->General_model->distritos(['cod_dep'=>$this->input->post('cod_dep'),'cod_pro'=>$this->input->post('cod_pro')]);
		
        echo json_encode($listaDis);
	}
	public function cargarLatLng(){
		$this->load->model('General_model');
		$ubigeo = $this->input->post('cod_dep').$this->input->post('cod_pro').$this->input->post('cod_dis');
		$latLng = $listaDis = $this->General_model->latLng(['ubigeo'=>$ubigeo]);
		echo json_encode($latLng);
	}
	public function ruccurl()
	{
		// Datos
		$url = 'https://api.apis.net.pe/v1/ruc?numero='.$this->input->post('ruc');

		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => trim($url),
			CURLOPT_MAXREDIRS => 5,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_FOLLOWLOCATION => 1,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HEADER => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			//CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
		));
		
		$result = curl_exec($curl);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		
		echo json_encode(array('data' => json_decode($result),'status' => $code));
	}
	public function consultadni()
	{
		$user = 'lfernandez';
		$pass = 'Ole220522';
		$url = 'https://sireed.minsa.gob.pe/doLogin';
		$con = 'https://sireed.minsa.gob.pe/brigadistas/curl';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "usuario=$user&key=$pass");
		//curl_setopt($ch, CURLOPT_USERPWD, "$pass:$user");
		curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__.'/cookies.txt');
		curl_exec($ch);
		if($error = curl_error($ch)){
			die ($error);
		}
		curl_setopt($ch, CURLOPT_URL, $con);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			"type=01&document=42545573");
		curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__.'/cookies.txt');
		$res = curl_exec($ch);
		if($error = curl_error($ch)){
			die ($error);
		}
		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200){
			$data = json_decode($res);
			print_r($data->data->attributes);
		}
		curl_close( $ch );
	}
}