<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Citas extends CI_Controller
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
	
	public function listapacientes()
	{
		$this->load->model('Citas_model');
		$pacientes = $this->Citas_model->listapacientes();
		echo json_encode(['data' => $pacientes]);
	}
	public function listamedicos()
	{
		$this->load->model('Citas_model');
		$medicos = $this->Citas_model->listamedicos();
		echo json_encode(['data' => $medicos]);
	}
	public function listaturnos()
	{
		$this->load->model('Citas_model');
		$turnos = $this->Citas_model->listaturnos();
		echo json_encode(['data' => $turnos]);
	}
	public function listaconsultorios()
	{
		$this->load->model('Citas_model');
		$cons = $this->Citas_model->listaconsultorios();
		echo json_encode(['data' => $cons]);
	}
	public function listacitas()
	{
		$this->load->model('Citas_model');
		$citas = $this->Citas_model->listacitas();
		echo json_encode(['data' => $citas]);
	}
	
	public function pacientes()
	{
		return $this->load->view('main');
	}
	public function formpaciente()
	{
		$this->load->model('Citas_model');
		$this->load->model('General_model');
		$tipo = $this->Citas_model->querysqlwhere('idtipodocumento,tipo_documento','tipo_documento',['activo' => 1]);
		$edo = $this->Citas_model->querysqlwhere('idestadocivil,estado_civil','estado_civil',['activo' => 1]);
		$dep = $this->General_model->departamentos();
		
		$data = array(
			'tipo' => $tipo,
			'edo' => $edo,
			'dep' => $dep,
		);
		return $this->load->view('main', $data);
	}
	public function regpaciente()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Paciente</b>');
		$ubigeo = $this->input->post('dep').$this->input->post('pro').$this->input->post('dis');
		$ubigeo1 = $this->input->post('dep1').$this->input->post('pro1').$this->input->post('dis1');
		$paciente = $this->Citas_model->querysqlwhere('count(idpaciente) as qty','paciente',['numero_documento' => $this->input->post('doc')]);
		
		if(intval($paciente[0]->qty) === 0){
			$data = array(
				'idtipodocumento' => $this->input->post('tipo'),
				'numero_documento' => $this->input->post('doc'),
				//'avatar' => $this->input->post(''),
				'apellidos' => $this->input->post('apellidos'),
				'nombres' => $this->input->post('nombres'),
				'fecnac' => $this->input->post('fechanac'),
				'sexo' => $this->input->post('sexo'),
				'idestadocivil' => $this->input->post('edo'),
				'ubigeo_nacimiento' => $ubigeo,
				'domicilio' => $this->input->post('direccion'),
				'ubigeo_domicilio' => $ubigeo1,
				'idusuario_registro' => $this->usuario->idusuario,
				'fecha_registro' => date('Y-m-d H:i:s'),
				'celular' => $this->input->post('celular'),
				//'celuar_mensaje' => $this->input->post(''),
				'correo' => $this->input->post('correo'),
				'observaciones' => $this->input->post('obs'),
			);
			if($this->Citas_model->registrar('paciente', $data)){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>Paciente</b> registrado exitosamente');
			}
		}else{
			$this->session->set_flashdata('claseMsg', 'alert-warning');
			$this->session->set_flashdata('flashMessage', 'El <b>Paciente</b> ya se encuentra registrado');
		}
		header('location:'.base_url().'citas/pacientes');
	}
	public function consultorios()
	{
		return $this->load->view('main');
	}
	public function formconsultorio()
	{
		$this->load->model('Citas_model');
		$consultorios = $tipo = $this->Citas_model->querysqlwhere('*','empresa',['activo' => 1]);
		return $this->load->view('main', ['cons' => $consultorios]);
	}
	public function regconsultorio()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Consultorio</b>');
		
		$data = array(
			'idempresa' => $this->input->post('idempresa'),
			'consultorio' => $this->input->post('consultorio'),
			'observaciones' => $this->input->post('obs'),
		);
		if($this->Citas_model->registrar('consultorio', $data)){
			$this->session->set_flashdata('claseMsg', 'alert-success');
			$this->session->set_flashdata('flashMessage', '<b>Consultorio</b> registrado exitosamente');
		}
		header('location:'.base_url().'citas/consultorios');
	}
	public function medicos()
	{
		return $this->load->view('main');
	}
	public function formmedico()
	{
		$this->load->model('Citas_model');
		$this->load->model('General_model');
		$tipo = $this->Citas_model->querysqlwhere('idtipodocumento,tipo_documento','tipo_documento',['activo' => 1]);
		$edo = $this->Citas_model->querysqlwhere('idestadocivil,estado_civil','estado_civil',['activo' => 1]);
		$dep = $this->General_model->departamentos();
		$tipop = $this->Citas_model->querysqlwhere('idtipoprofesional,tipo_profesional','tipo_profesional',['activo' => 1]);
		$esp = $this->Citas_model->querysqlwhere('idespecialidad,especialidad','especialidad',['activo' => 1]);
		
		$data = array(
			'tipo' => $tipo,
			'edo' => $edo,
			'dep' => $dep,
			'tipop' => $tipop,
			'esp' => $esp,
		);
		return $this->load->view('main', $data);
	}
	public function regmedico()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>M&eacute;dico</b>');
		$ubigeo = $this->input->post('dep').$this->input->post('pro').$this->input->post('dis');
		$ubigeo1 = $this->input->post('dep1').$this->input->post('pro1').$this->input->post('dis1');
		$medico = $this->Citas_model->querysqlwhere('count(idprofesional) as qty','profesional',['numero_documento' => $this->input->post('doc')]);
		
		if(intval($medico[0]->qty) === 0){
			$data = array(
				'idtipodocumento' => $this->input->post('tipo'),
				'numero_documento' => $this->input->post('doc'),
				//'avatar' => $this->input->post(''),
				'apellidos' => $this->input->post('apellidos'),
				'nombres' => $this->input->post('nombres'),
				'fecnac' => $this->input->post('fechanac'),
				'sexo' => $this->input->post('sexo'),
				'idestadocivil' => $this->input->post('edo'),
				'ubigeo_nacimiento' => $ubigeo,
				'domicilio' => $this->input->post('direccion'),
				'ubigeo_domicilio' => $ubigeo1,
				'idtipoprofesional' => $this->input->post('tipoprof'),
				'colegiatura' => $this->input->post('colegiatura'),
				'idespecialidad' => $this->input->post('especialidad'),
				'rne' => $this->input->post('rne'),
				'idusuario_registro' => $this->usuario->idusuario,
				'fecha_registro' => date('Y-m-d H:i:s'),
				'celular' => $this->input->post('celular'),
				//'celuar_mensaje' => $this->input->post(''),
				'correo' => $this->input->post('correo'),
				'observaciones' => $this->input->post('obs'),
			);
			if($this->Citas_model->registrar('profesional', $data)){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>M&eacute;dico</b> registrado exitosamente');
			}
		}else{
			$this->session->set_flashdata('claseMsg', 'alert-warning');
			$this->session->set_flashdata('flashMessage', 'El <b>M&eacute;dico</b> ya se encuentra registrado');
		}
		header('location:'.base_url().'citas/medicos');
	}
	public function turnos()
	{
		return $this->load->view('main');
	}
	public function formturnos()
	{
		$this->load->model('Citas_model');
		$this->load->model('General_model');
		$estab = $this->Citas_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$dep = $this->Citas_model->querysqlwhere('iddepartamento,departamento','departamento',['activo' => 1]);
		//$cons = $this->Citas_model->querysqlwhere('idconsultorio,consultorio','tipo_profesional',['activo' => 1]);
		$prof = $this->Citas_model->querysqlwhere('idprofesional,nombres','profesional',['activo' => 1]);
		$mes = $this->Citas_model->querysqlwhere('idmes,mes','mes',['activo' => 1]);
		$anio = $this->Citas_model->querysqlwhere('anio','anio',['activo' => 1]);
		
		$data = array(
			'estab' => $estab,
			'dep' => $dep,
			'prof' => $prof,
			'mes' => $mes,
			'anio' => $anio,
		);
		return $this->load->view('main', $data);
	}
	public function findconsultorios()
	{
		$this->load->model('Citas_model');
		$consultorios = $this->Citas_model->querysqlwhere('idconsultorio,consultorio','consultorio',['idempresa' => $this->input->post('idempresa'),'activo' => 1]);
		echo json_encode($consultorios);
	}
	public function regturno()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Turno</b>');
		$est = $this->input->post('idestablecimiento'); $dep = $this->input->post('iddepartamento'); $cons = $this->input->post('idconsultorio');
		$prof = $this->input->post('idprofesional'); $a = $this->input->post('anio'); $m = $this->input->post('idmes');
		
		$turno = $this->Citas_model->querysqlwhere('count(idturno) as qty','turnos',['idconsultorio' => $cons,'iddepartamento' => $dep,'idprofesional' => $prof,
				'anio' => $a,'idmes' => $m,'activo' => 1]);
		
		if(intval($turno[0]->qty) === 0){
			$data = array(
				'idconsultorio' => $cons,
				'iddepartamento' => $dep,
				'idprofesional' => $prof,
				'anio' => $a,
				'idmes' => $m,
				'duracion_consulta' => $this->input->post('duracion'),
				'observaciones' => $this->input->post('obs'),
			);
			if($this->Citas_model->registrar('turnos', $data)){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>Turno</b> registrado exitosamente');
			}
		}else{
			$this->session->set_flashdata('claseMsg', 'alert-warning');
			$this->session->set_flashdata('flashMessage', 'El <b>Turno</b> ya se encuentra registrado');
		}
		header('location:'.base_url().'citas/turnos');
	}
	public function citas()
	{
		return $this->load->view('main');
	}
	public function calendario()
	{
		return $this->load->view('main');
	}
}