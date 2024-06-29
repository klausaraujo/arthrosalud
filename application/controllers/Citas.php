<?php
if (! defined("BASEPATH")) exit("No direct script access allowed");

class Citas extends CI_Controller
{
	private $usuario;
	private $absolutePath;
	
    public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('America/Lima');
		$this->absolutePath = $_SERVER['DOCUMENT_ROOT'].'/arthrosalud/';
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
		$data = array(
			//'t.idconsultorio' => $this->input->post('idconsultorio'),
			't.iddepartamento' => $this->input->post('iddepartamento'),
			//'t.idprofesional' => $this->input->post('idprofesional'),
			't.anio' => $this->input->post('anio'),
			't.idmes' => $this->input->post('mes'),
			't.activo' => 1,
		);
		
		if($this->input->post('idprofesional') !== '') $data['t.idprofesional'] = $this->input->post('idprofesional');
		if($this->input->post('idconsultorio') !== '') $data['t.idconsultorio'] = $this->input->post('idconsultorio');
		
		$this->load->model('Citas_model');
		$turnos = $this->Citas_model->listaturnos($data);
		echo json_encode(['data' => $turnos]);
	}
	public function listaconsultorios()
	{
		$this->load->model('Citas_model');
		$cons = $this->Citas_model->listaconsultorios(['c.idempresa' => $this->input->post('idempresa'),'c.activo' => 1]);
		echo json_encode(['data' => $cons]);
	}
	public function listaPacServer()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'paciente',
			'primary_key' => 'idpaciente',
			'columns' => array('idtipodocumento','numero_documento','apellidos','nombres','idpaciente','fecnac',
						'idestadocivil','celular','correo'),
			'where' => array('activo' => 1,'idpaciente >' => 1),
		));
		//$this->datatables_server_side->process();
		$this->datatables_server_side->process('data','','fecnac','DATE_FORMAT(fecnac,"%d/%m/%Y") as fecnac');
	}
	public function listaCIE()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'cie10',
			'primary_key' => 'idcie10',
			'columns' => array('cie10','descripcion_cie10','idcie10'),
			'order_by' => 'ASC',
			//'where' => array('activo' => 1,'idpaciente >' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listaprocserver()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'procedimiento',
			'primary_key' => 'idprocedimiento',
			'columns' => array('idprocedimiento','procedimiento','tarifa_base'),
			'order_by' => 'ASC',
			'where' => array('idtipoprocedimiento' => $this->input->get('idtipo'),'activo' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listaartserver()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'articulos',
			'primary_key' => 'idarticulo',
			'columns' => array('idarticulo','descripcion'),
			'order_by' => 'ASC',
			'where' => array('activo' => 1, 'disponible_venta' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listaauxserver()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'examenes_auxiliares',
			'primary_key' => 'idexamenauxiliar',
			'columns' => array('idexamenauxiliar','correlativo','examen_auxiliar','tarifa_base'),
			'order_by' => 'ASC',
			'where' => array('activo' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listacitas()
	{
		$data = array(
			't.idconsultorio' => $this->input->post('idconsultorio'),
			't.iddepartamento' => $this->input->post('iddepartamento'),
			't.idprofesional' => $this->input->post('idprofesional'),
			'DATE_FORMAT(t.fecha,"%Y")' => $this->input->post('anio'),
			'DATE_FORMAT(t.fecha,"%c")' => $this->input->post('mes'),
			'DATE_FORMAT(t.fecha,"%e")' => $this->input->post('dia'),
			't.activo' => 1,
		);
		$this->load->model('Citas_model');
		$citas = $this->Citas_model->listacitas($data);
		echo json_encode(['data' => $citas]);
	}
	public function listahistorias()
	{
		$this->load->model('Citas_model');
		$hist = $this->Citas_model->listahistorias();
		echo json_encode(['data' => $hist]);
	}
	public function listadiagnostico()
	{
		$this->load->model('Citas_model');
		$diag = $this->Citas_model->listardiag(['idatencion' => $this->input->post('idatencion')]);
		echo json_encode(['data' => $diag]);
	}
	public function listaprocedimientos()
	{
		$this->load->model('Citas_model');
		$proc = $this->Citas_model->listarproc(['idatencion' => $this->input->post('idatencion')]);
		echo json_encode(['data' => $proc]);
	}
	public function listaindicaciones()
	{
		$this->load->model('Citas_model');
		$indic = $this->Citas_model->listarindic(['idatencion' => $this->input->post('idatencion')]);
		echo json_encode(['data' => $indic]);
	}
	public function lprocedimientos()
	{
		$this->load->model('Citas_model');
		$proc = $this->Citas_model->lprocedimientos();
		echo json_encode(['data' => $proc]);
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
	public function editarpaciente()
	{
		$prov = null; $dis = null; $prov1 = null; $dis1 = null;
		$this->load->model('Citas_model');
		$this->load->model('General_model');
		$tipo = $this->Citas_model->querysqlwhere('idtipodocumento,tipo_documento','tipo_documento',['activo' => 1]);
		$edo = $this->Citas_model->querysqlwhere('idestadocivil,estado_civil','estado_civil',['activo' => 1]);
		$dep = $this->General_model->departamentos();
		$paciente = $this->Citas_model->queryindividual('*','paciente',['idpaciente' => $this->input->get('id')]);
		
		$prov = $this->General_model->provincias(['cod_dep' => substr($paciente->ubigeo_nacimiento,0,2)]);
		$dis = $this->General_model->distritos(['cod_dep' => substr($paciente->ubigeo_nacimiento,0,2), 'cod_pro' => substr($paciente->ubigeo_nacimiento,2,2)]);
		
		if($paciente->ubigeo_domicilio !== $paciente->ubigeo_nacimiento){
			$prov1 = $this->General_model->provincias(['cod_dep' => substr($paciente->ubigeo_domicilio,0,2)]);
			$dis1 = $this->General_model->distritos(['cod_dep' => substr($paciente->ubigeo_domicilio,0,2), 'cod_pro' => substr($paciente->ubigeo_domicilio,2,2)]);
		}else{
			$prov1 = $prov; $dis1 = $dis;
		}
		
		$data = array(
			'tipo' => $tipo,
			'edo' => $edo,
			'dep' => $dep,
			'paciente' => $paciente,
			'provincias' => $prov,
			'distritos' => $dis,
			'provincias1' => $prov1,
			'distritos1' => $dis1,			
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
		
		$paciente = $this->Citas_model->querysqlwhere('count(idpaciente) as qty','paciente',['numero_documento' => $this->input->post('doc')]);
		if($this->input->post('tiporegistro') === 'registrar'){
			if(intval($paciente[0]->qty) === 0){
				if($this->Citas_model->registrar('paciente', $data)){
					$this->session->set_flashdata('claseMsg', 'alert-success');
					$this->session->set_flashdata('flashMessage', '<b>Paciente</b> registrado exitosamente');
				}
			}else{
				$this->session->set_flashdata('claseMsg', 'alert-warning');
				$this->session->set_flashdata('flashMessage', 'El <b>Paciente</b> ya se encuentra registrado');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			unset($data['idtipodocumento']);
			unset($data['numero_documento']);
			unset($data['apellidos']);
			unset($data['nombres']);
			unset($data['fecnac']);
			unset($data['sexo']);
			if($this->Citas_model->actualizar('paciente', $data, ['idpaciente' => $this->input->post('idpaciente')])){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>Paciente</b> actualizado exitosamente');
			}
		}
		header('location:'.base_url().'citas/pacientes');
	}
	public function consultorios()
	{
		$this->load->model('Citas_model');
		$empresa = $tipo = $this->Citas_model->querysqlwhere('*','empresa',['activo' => 1]);
		return $this->load->view('main',['empresa' => $empresa]);
	}
	public function formconsultorio()
	{
		$this->load->model('Citas_model');
		$consultorios = $tipo = $this->Citas_model->querysqlwhere('*','empresa',['activo' => 1]);
		return $this->load->view('main', ['cons' => $consultorios]);
	}
	public function editarconsultorio()
	{
		$this->load->model('Citas_model');
		$empresas = $tipo = $this->Citas_model->querysqlwhere('*','empresa',['activo' => 1]);
		$consultorio = $tipo = $this->Citas_model->queryindividual('*','consultorio',['idconsultorio' => $this->input->get('id')]);
		return $this->load->view('main', ['cons' => $consultorio, 'empresas' => $empresas]);
	}
	public function regconsultorio()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		
		$data = array(
			'idempresa' => $this->input->post('idempresa'),
			'consultorio' => $this->input->post('consultorio'),
			'observaciones' => $this->input->post('obs'),
		);
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Consultorio</b>');
			if($this->Citas_model->registrar('consultorio', $data)){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>Consultorio</b> registrado exitosamente');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar el <b>Consultorio</b>');
			if($this->Citas_model->actualizar('consultorio', $data, ['idconsultorio' => $this->input->post('idconsultorio')])){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>Consultorio</b> actualizado exitosamente');
			}
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
		$user = $this->Citas_model->querysqlwhere('idusuario,usuario,CONCAT(apellidos," ",nombres) as prof','usuarios',['activo' => 1]);
		
		$data = array(
			'tipo' => $tipo,
			'edo' => $edo,
			'dep' => $dep,
			'tipop' => $tipop,
			'esp' => $esp,
			'user' => $user,
		);
		return $this->load->view('main', $data);
	}
	public function editarmedico()
	{
		$prov = null; $dis = null; $prov1 = null; $dis1 = null;
		$this->load->model('Citas_model');
		$this->load->model('General_model');
		$tipo = $this->Citas_model->querysqlwhere('idtipodocumento,tipo_documento','tipo_documento',['activo' => 1]);
		$edo = $this->Citas_model->querysqlwhere('idestadocivil,estado_civil','estado_civil',['activo' => 1]);
		$dep = $this->General_model->departamentos();
		$tipop = $this->Citas_model->querysqlwhere('idtipoprofesional,tipo_profesional','tipo_profesional',['activo' => 1]);
		$esp = $this->Citas_model->querysqlwhere('idespecialidad,especialidad','especialidad',['activo' => 1]);
		$user = $this->Citas_model->querysqlwhere('idusuario,usuario,CONCAT(apellidos," ",nombres) as prof','usuarios',['activo' => 1]);
		
		$profesional = $this->Citas_model->queryindividual('*','profesional',['idprofesional' => $this->input->get('id')]);
		
		$prov = $this->General_model->provincias(['cod_dep' => substr($profesional->ubigeo_nacimiento,0,2)]);
		$dis = $this->General_model->distritos(['cod_dep' => substr($profesional->ubigeo_nacimiento,0,2), 'cod_pro' => substr($profesional->ubigeo_nacimiento,2,2)]);
		
		if($profesional->ubigeo_domicilio !== $profesional->ubigeo_nacimiento){
			$prov1 = $this->General_model->provincias(['cod_dep' => substr($profesional->ubigeo_domicilio,0,2)]);
			$dis1 = $this->General_model->distritos(['cod_dep' => substr($profesional->ubigeo_domicilio,0,2), 'cod_pro' => substr($profesional->ubigeo_domicilio,2,2)]);
		}else{
			$prov1 = $prov; $dis1 = $dis;
		}
		
		$data = array(
			'tipo' => $tipo,
			'edo' => $edo,
			'dep' => $dep,
			'tipop' => $tipop,
			'esp' => $esp,
			'user' => $user,
			'profesional' => $profesional,
			'provincias' => $prov,
			'distritos' => $dis,
			'provincias1' => $prov1,
			'distritos1' => $dis1,			
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
			'idusuario_sistema' => $this->input->post('idusuario'),
			'idusuario_registro' => $this->usuario->idusuario,
			'fecha_registro' => date('Y-m-d H:i:s'),
			'celular' => $this->input->post('celular'),
			//'celuar_mensaje' => $this->input->post(''),
			'correo' => $this->input->post('correo'),
			'observaciones' => $this->input->post('obs'),
		);
		if($this->input->post('tiporegistro') === 'registrar'){
			$medico = $this->Citas_model->querysqlwhere('count(idprofesional) as qty','profesional',['numero_documento' => $this->input->post('doc')]);
			
			if(intval($medico[0]->qty) === 0){
				if($this->Citas_model->registrar('profesional', $data)){
					$this->session->set_flashdata('claseMsg', 'alert-success');
					$this->session->set_flashdata('flashMessage', '<b>M&eacute;dico</b> registrado exitosamente');
				}
			}else{
				$this->session->set_flashdata('claseMsg', 'alert-warning');
				$this->session->set_flashdata('flashMessage', 'El <b>M&eacute;dico</b> ya se encuentra registrado');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			unset($data['idtipodocumento']);
			unset($data['numero_documento']);
			unset($data['apellidos']);
			unset($data['nombres']);
			unset($data['fecnac']);
			unset($data['sexo']);
			if($this->Citas_model->actualizar('profesional', $data, ['idprofesional' => $this->input->post('idprofesional')])){
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>M&eacute;dico</b> actualizado exitosamente');
			}
		}
		header('location:'.base_url().'citas/medicos');
	}
	public function turnos()
	{
		$this->load->model('Citas_model');
		$estab = $this->Citas_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$dep = $this->Citas_model->querysqlwhere('iddepartamento,departamento','departamento',['activo' => 1]);
		$cons = null; $i = 1;
		foreach($estab as $row):
			if($i === 1){
				$cons = $this->Citas_model->querysqlwhere('idconsultorio,consultorio','consultorio',['idempresa' => $row->idempresa,'activo' => 1]);
				$i++;
			}
		endforeach;
		$prof = $this->Citas_model->querysqlwhere('idprofesional,nombres,apellidos','profesional',['activo' => 1]);
		$mes = $this->Citas_model->querysqlwhere('idmes,mes','mes',['activo' => 1]);
		$anio = $this->Citas_model->querysqlwhere('anio','anio',['activo' => 1]);
		
		$data = array(
			'dep' => $dep,
			'estab' => $estab,
			'cons' => $cons,
			'prof' => $prof,
			'mes' => $mes,
			'anio' => $anio,
		);
		return $this->load->view('main',$data);
	}
	public function formturnos()
	{
		$this->load->model('Citas_model');
		$this->load->model('General_model');
		$estab = $this->Citas_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$dep = $this->Citas_model->querysqlwhere('iddepartamento,departamento','departamento',['activo' => 1]);
		//$cons = $this->Citas_model->querysqlwhere('idconsultorio,consultorio','tipo_profesional',['activo' => 1]);
		$prof = $this->Citas_model->querysqlwhere('idprofesional,nombres,apellidos','profesional',['activo' => 1]);
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
	public function detalle_turno()
	{
		$this->load->model('Citas_model');
		$turno = $this->Citas_model->listaturno(['idturno' => $this->input->get('id'),'t.activo' => 1]);
		$horas = $this->Citas_model->querysqlwhere('*','turnos_detalle',['idturno' => $this->input->get('id')]);
		foreach($horas as $row):
			$det = $this->Citas_model->querysqlwhere('*','citas','idpaciente <> 1 AND fecha="'.$row->fecha.'" AND entrada BETWEEN "'.$row->entrada1.'" AND "'.$row->salida1.'"');
			$row->valida1 = count($det)? 1 : 0;
			$det = $this->Citas_model->querysqlwhere('*','citas','idpaciente <> 1 AND fecha="'.$row->fecha.'" AND entrada BETWEEN "'.$row->entrada2.'" AND "'.$row->salida2.'"');
			$row->valida2 = count($det)? 1 : 0;
			$det = $this->Citas_model->querysqlwhere('*','citas','idpaciente <> 1 AND fecha="'.$row->fecha.'" AND entrada BETWEEN "'.$row->entrada3.'" AND "'.$row->salida3.'"');
			$row->valida3 = count($det)? 1 : 0;
		endforeach;
		return $this->load->view('main',['turno' => $turno, 'horas' => $horas]);
	}
	public function regdetalle()
	{
		$this->load->model('Citas_model');
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		$msg = 'No se pudo registrar los Horarios';
		
		$dura = intval($data->detalle->duracion);
		$dep = $data->detalle->dep;
		$cons = $data->detalle->cons;
		$prof = $data->detalle->prof;
		$detalle = $data->data;
		
		if($this->Citas_model->borrar('turnos_detalle', ['idturno' => $detalle[0]->idturno])){
			$borracitas = false;
			if($this->Citas_model->borrar('citas',['idturno' => $detalle[0]->idturno])) $borracitas = true;
			foreach($detalle as $row):
				if($this->Citas_model->registrar('turnos_detalle', $row)){
					$msg = 'Horarios Registrados'; $j = 0;
					// Diferencia entre las horas
					$h1 = new DateTime($row->entrada1);
					$h2 = new DateTime($row->salida1);
					$dif = $h1->diff($h2);
					$minutos = (intval($dif->format('%H')) * 60) + intval($dif->format('%i'));
					$nrocitas = intval($minutos / intval($dura));
					
					for($i = 0; $i < $nrocitas; $i++){
						$hi = $h1->format('H:i');
						// Variable temporal para formatear la hora final
						$ht = $h1->modify('+'.$dura.' minutes');
						$hf = $ht->format('H:i');
						// Array para insertar los registros en la tabla citas
						$cita[$j] = array(
							'idconsultorio' => $cons,
							'iddepartamento' => $dep,
							'idprofesional' => $prof,
							'idpaciente' => 1,
							'idturno' => $row->idturno,
							'fecha' => $row->fecha,
							'entrada' => $hi,
							'salida' => $hf,
						);
						$j++;
					}
					
					$h3 = new DateTime($row->entrada2);
					$h4 = new DateTime($row->salida2);
					$dif = $h3->diff($h4);
					// Minutos totales entre la Ultima hora y la primera 
					$minutos = (intval($dif->format('%H')) * 60) + intval($dif->format('%i'));
					$nrocitas = intval($minutos / intval($dura));
					
					for($i = 0; $i < $nrocitas; $i++){
						$hi = $h3->format('H:i');
						// Variable temporal para formatear la hora final
						$ht = $h3->modify('+'.$dura.' minutes');
						$hf = $ht->format('H:i');
						// Array para insertar los registros en la tabla citas
						$cita[$j] = array(
							'idconsultorio' => $cons,
							'iddepartamento' => $dep,
							'idprofesional' => $prof,
							'idpaciente' => 1,
							'idturno' => $row->idturno,
							'fecha' => $row->fecha,
							'entrada' => $hi,
							'salida' => $hf,
						);
						$j++;
					}
					
					$h5 = new DateTime($row->entrada3);
					$h6 = new DateTime($row->salida3);
					$dif = $h5->diff($h6);
					// Minutos totales entre la Ultima hora y la primera 
					$minutos = (intval($dif->format('%H')) * 60) + intval($dif->format('%i'));
					// Cantidad de citas disponibles
					$nrocitas = intval($minutos / intval($dura));
					
					for($i = 0; $i < $nrocitas; $i++){
						$hi = $h5->format('H:i');
						// Variable temporal para formatear la hora final
						$ht = $h5->modify('+'.$dura.' minutes');
						$hf = $ht->format('H:i');
						// Array para insertar los registros en la tabla citas
						$cita[$j] = array(
							'idconsultorio' => $cons,
							'iddepartamento' => $dep,
							'idprofesional' => $prof,
							'idpaciente' => 1,
							'idturno' => $row->idturno,
							'fecha' => $row->fecha,
							'entrada' => $hi,
							'salida' => $hf,
						);
						$j++;
					}
					
					if($borracitas) $this->Citas_model->registrarbatch('citas', $cita);
				}
			endforeach;
		}
		
		echo json_encode(['msg' => $msg,'id' => $detalle[0]->idturno]);
	}
	public function citasprof()
	{
		$this->load->model('Citas_model');
		$estab = $this->Citas_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$dep = $this->Citas_model->querysqlwhere('iddepartamento,departamento','departamento',['activo' => 1]);
		$cons = null; $i = 1;
		foreach($estab as $row):
			if($i === 1){
				$cons = $this->Citas_model->querysqlwhere('idconsultorio,consultorio','consultorio',['idempresa' => $row->idempresa,'activo' => 1]);
				$i++;
			}
		endforeach;
		$prof = ['idprofesional' => $this->input->get('i'), 'nombres' => $this->input->get('r')];
		$mes = $this->Citas_model->querysqlwhere('idmes,mes','mes',['activo' => 1]);
		$anio = $this->Citas_model->querysqlwhere('anio','anio',['activo' => 1]);
		
		$data = array(
			'dep' => $dep,
			'estab' => $estab,
			'cons' => $cons,
			'prof' => (object)$prof,
			'mes' => $mes,
			'anio' => $anio,
		);
		$this->load->view('main', $data);
	}
	public function citaadicional()
	{
		$this->load->model('Citas_model');
		// Diferencia entre las horas
		$json = json_decode($this->input->post('json'));
		$hi = new DateTime($json->entrada);
		$hf = new DateTime($json->salida);
		$dif = $hi->diff($hf);
		$horanueva = $hf->add($dif);
		//$horanueva->format('H:i');
		$json->entrada = $json->salida;
		$json->salida = $horanueva->format('H:i');
		$json->duracion = (intval($dif->format('%H')) * 60) + intval($dif->format('%i'));
		$this->load->view('main', ['data' => $json]);
	}
	public function regadicional()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('flashMessage', 'No se pudo registrar la <b>Cita Adicional</b>');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		
		$data = array(
			'idconsultorio' => $this->input->post('idcons'),
			'iddepartamento' => $this->input->post('iddep'),
			'idprofesional' => $this->input->post('idprof'),
			'idpaciente' => $this->input->post('idpaciente'),
			'idturno' => $this->input->post('idturno'),
			'tipo' => 1,
			'fecha' => $this->input->post('fecha'),
			'entrada' => $this->input->post('entrada'),
			'salida' => $this->input->post('salida'),
			'observaciones' => $this->input->post('obs')
		);
		
		if($this->Citas_model->registrar('citas', $data)){
			$this->session->set_flashdata('flashMessage', '<b>Cita Adicional</b> Registrada');
			$this->session->set_flashdata('claseMsg', 'alert-success');
		}
		header('location:'.base_url().'citas');
	}
	public function asignarpaciente()
	{
		$this->load->model('Citas_model'); $msg = 'No se pudo asignar la cita';
		
		if($this->Citas_model->actualizar('citas', ['idpaciente' => $this->input->post('idpaciente'),'observaciones' => $this->input->post('obs')],
											['idcita' => $this->input->post('idcita')])){
			$msg = 'Se asign&oacute; el Paciente';
		}
		echo json_encode(['msg' => $msg]);
	}
	public function despaciente()
	{
		$this->load->model('Citas_model'); $msg = 'No se pudo eliminar la asignaci&oacute;n';
		if($this->Citas_model->actualizar('citas', ['idpaciente' => 1,'observaciones' => ''], ['idcita' => $this->input->get('id')])){
			$msg = 'Se elimin&oacute; la asignaci&oacute;n';
		}
		echo json_encode(['msg' => $msg]);
	}
	public function cerrar()
	{
		$this->load->model('Citas_model'); $msg = 'No se pudo Confirmar';
		if($this->Citas_model->actualizar('citas', ['atendido' => 1], ['idcita' => $this->input->get('id')])){
			$msg = 'Se confirm&oacute; la cita';
		}
		echo json_encode(['msg' => $msg]);
	}
	public function historia()
	{
		return $this->load->view('main');
	}
	public function formhistoria()
	{
		return $this->load->view('main');
	}
	public function reghistoria()
	{
		$this->load->model('Citas_model');
		
		if($this->input->post('idpaciente') === ''){
			$this->session->set_flashdata('adv', 'Debe elegir un paciente');
			header('location:'.base_url().'citas/historia/nuevo');
			exit;
		}
		
		$valida = $this->Citas_model->queryindividual('idpaciente','historia_clinica',['idpaciente' => $this->input->post('idpaciente'),'activo' => 1]);
		if(empty($valida)){
			$this->session->set_flashdata('claseMsg', 'alert-danger');
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar la <b>Historia Cl&iacute;nica</b>');
			
			$n = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true)))); $file = null; $ext = '';
			if($_FILES['file-2']['name'] !== '') $ext = pathinfo($_FILES['file-2']['name'],PATHINFO_EXTENSION);
			
			if($ext === 'pdf'){
				$content = file_get_contents($_FILES['file-2']['tmp_name']);
				if(file_put_contents('./public/images/avatar/'.$n.'.'.$ext, $content)) $file = $n.'.'.$ext;
			}
			
			$data = array(
				'numerofisico' => $this->input->post('nrofisico'),
				'fecha_registro' => date('Y-m-d'),
				'idpaciente' => $this->input->post('idpaciente'),
				'avatar' => $file,
			);
			if($id = $this->Citas_model->registrar('historia_clinica', $data)){
				$this->Citas_model->actualizar('historia_clinica', ['numero' => $id], ['idhistoria' => $id]);
				$this->session->set_flashdata('claseMsg', 'alert-success');
				$this->session->set_flashdata('flashMessage', '<b>Historia Cl&iacute;nica</b> registrada exitosamente');
			}
		}else{
			$this->session->set_flashdata('claseMsg', 'alert-warning');
			$this->session->set_flashdata('flashMessage', 'La <b>Historia Cl&iacute;nica</b> ya est&aacute; registrada');
		}
		header('location:'.base_url().'citas/historia');
	}
	public function reghistdetalle()
	{
		$this->load->model('Citas_model');
		$historia = $this->Citas_model->queryindividual('numero,idpaciente','historia_clinica',['idhistoria' => $this->input->get('id')]);
		$paciente = $this->Citas_model->queryindividual('*,DATE_FORMAT(fecnac,"%d/%m/%Y") as fecha','paciente',['idpaciente' => $historia->idpaciente]);
		$estab = $this->Citas_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$dep = $this->Citas_model->querysqlwhere('iddepartamento,departamento','departamento',['activo' => 1]);
		$prof = $this->Citas_model->querysqlwhere('idprofesional,nombres,apellidos','profesional',['activo' => 1]);
		$cons = null; $i = 1;
		foreach($estab as $row):
			if($i === 1){
				$cons = $this->Citas_model->querysqlwhere('idconsultorio,consultorio','consultorio',['idempresa' => $row->idempresa,'activo' => 1]);
				$i++;
			}
		endforeach;
		$v = $this->Citas_model->querysqlwhere('*','historia_clinica_atenciones',['idhistoria' => $this->input->get('id')]);
		$proc = $this->Citas_model->querysqlwhere('idtipoprocedimiento,tipo_procedimiento','tipo_procedimiento',['activo' => 1]);
		
		$data = array(
			'pac' => $paciente,
			'hist' => $historia,
			'estab' => $estab,
			'dep' => $dep,
			'prof' => $prof,
			'cons' => $cons,
			'valida' => $v,
			'proc' => $proc
		);
		
		return $this->load->view('main', $data);
	}
	public function regatencion()
	{
		$this->load->model('Citas_model');
		$msg = 'Error al registrar'; $status = 500; $g = $this->input->post('gestante')? 1 : 0; $idatencion = 0;
		
		$data = array(
			'idconsultorio' => $this->input->post('idcons'),
			'iddepartamento' => $this->input->post('iddep'),
			'idprofesional' => $this->input->post('idprof'),
			'idhistoria' => $this->input->post('idhistoria'),
			'fecha_atencion' => date('Y-m-d'),
			'hora_atencion' => $this->input->post('hora'),
			'tipo_atencion' => $this->input->post('tipoatencion'),
			'prioridad' => $this->input->post('prioridad'),
			'gestante' => $g,
			'presion01' => $this->input->post('p1'),
			'presion02' => $this->input->post('p2'),
			'presion_venosa' => $this->input->post('pvenosa'),
			'temperatura' => $this->input->post('temp'),
			'saturacion' => $this->input->post('saturacion'),
			'frecuencia_cardiaca' => $this->input->post('fcardiaca'),
			'frecuencia_respiratoria' => $this->input->post('frespiratoria'),
			'peso' => $this->input->post('peso'),
			'talla' => $this->input->post('talla'),
			'imc' => $this->input->post('imc'),
			'AO' => $this->input->post('ao'),
			'RV' => $this->input->post('rv'),
			'RM' => $this->input->post('rm'),
			'glasgow' => $this->input->post('glasgow'),
			'observaciones' => $this->input->post('obs'),
		);
		
		if($g) $data['tiempo_gestacion'] =  $this->input->post('semanas');
		
		if($this->input->post('idatencion') !== ''){
			unset($data['fecha_atencion']); unset($data['hora_atencion']);
			if($this->Citas_model->actualizar('historia_clinica_atenciones',$data,['idatencion' => $this->input->post('idatencion')])){
				$msg = 'Actualizado'; $status = 200;
			}
		}else{
			if($idatencion = $this->Citas_model->registrar('historia_clinica_atenciones',$data)){
				$msg = 'Registrado'; $status = 200;
			}
		}
		
		$data = array(
			'status' => $status,
			'msg' => $msg,
			'idatencion' => ($idatencion? $idatencion : $this->input->post('idatencion')),
		);
		echo json_encode($data);
	}
	public function regdiagnostico()
	{
		$this->load->model('Citas_model');
		$msg = 'Error al registrar'; $data = null; $status = 500;
		$json = json_decode(file_get_contents('php://input'));
		
		$cta = $this->Citas_model->queryindividual('COUNT(idindicacion) as cta','historia_clinica_atenciones_indicaciones',
				['idatencion' => $json[0]->idatencion]);
		if($cta->cta) $status = 200;
		
		if($this->Citas_model->borrar('historia_clinica_atenciones_diagnostico',['idatencion' => $json[0]->idatencion])){
			if($this->Citas_model->registrarbatch('historia_clinica_atenciones_diagnostico', $json)) $msg = 'Diagn&oacute;stico Registrado';
		}
		$data = array(
			'msg' => $msg,
			'status' => $status,
		);
		echo json_encode($data);
	}
	public function regprocedimiento()
	{
		$this->load->model('Citas_model');
		$msg = 'Error al registrar'; $data = null; $dh = null;
		$json = json_decode(file_get_contents('php://input'));
		
		if($this->Citas_model->borrar('historia_clinica_atenciones_procedimientos',['idatencion' => $json[0]->idatencion])){
			if($this->Citas_model->registrarbatch('historia_clinica_atenciones_procedimientos', $json)) $msg = 'Procedimiento Registrado';
		}
		$data = array(
			'msg' => $msg,
		);
		echo json_encode($data);
	}
	public function regexamenes()
	{
		$this->load->model('Citas_model');
		$msg = 'Error al registrar'; $data = null; $status = 500;
		$json = json_decode(file_get_contents('php://input'));
		
		if($this->Citas_model->borrar('historia_clinica_atenciones_examenes',['idatencion' => $json[0]->idatencion])){
			if($this->Citas_model->registrarbatch('historia_clinica_atenciones_examenes', $json)) $msg = 'Ex&aacute;menes Auxiliares Registrados';
		}
		
		$data = array('msg' => $msg,);
		echo json_encode($data);
	}
	public function regindicaciones()
	{
		$this->load->model('Citas_model');
		$msg = 'Error al registrar'; $data = null; $status = 500;
		$json = json_decode(file_get_contents('php://input'));
		
		$cta = $this->Citas_model->queryindividual('COUNT(iddiagnostico) as cta','historia_clinica_atenciones_diagnostico',
				['idatencion' => $json[0]->idatencion]);
		if($cta->cta) $status = 200;
		
		if($this->Citas_model->borrar('historia_clinica_atenciones_indicaciones',['idatencion' => $json[0]->idatencion])){
			if($this->Citas_model->registrarbatch('historia_clinica_atenciones_indicaciones', $json)) $msg = 'Indicaciones Registradas';
		}
		
		$data = array('msg' => $msg,'status' => $status);
		echo json_encode($data);
	}
	public function datosreceta()
	{
		$this->load->model('Citas_model');
		$iddep = $this->input->post('iddep'); $alm = []; $status = 500; $msg = '';
		$cta = $this->Citas_model->queryindividual('COUNT(iddiagnostico) as cta','historia_clinica_atenciones_diagnostico',
				['idatencion' => $this->input->post('idatencion')]);
		if($cta->cta){
			$almacen = $this->Citas_model->querysqlwhere('idalmacen,nombre_almacen','almacen',['idempresa' => $iddep,'tipo_almacen' => 2,'activo' => 1]);
			$status = 200;
		}else $msg = 'No hay Diagn&oacute;sticos registrados';
		
		echo json_encode(['almacen' => $almacen,'status' => $status,'msg' => $msg]);
	}
	public function regreceta()
	{
		$this->load->model('Citas_model');
		$cab = json_decode($this->input->post('cab')); $indic = json_decode($this->input->post('indic')); $diag = json_decode($this->input->post('diag'));
		$msg = 'Error al registrar'; $id = $this->input->post('idreceta'); $numb = 1; $status = 500;
		
		if($id !== ''){
			$this->Citas_model->borrar('receta_medica',['idrecetamedica' => $id]);
			$this->Citas_model->borrar('receta_medica_detalle',['idrecetamedica' => $id]);
			$this->Citas_model->borrar('receta_medica_dx',['idrecetamedica' => $id]);
		}
		
		$nro = $this->Citas_model->queryindividual('MAX(numero) as nro','receta_medica',['idalmacen' => $cab->idalmacen]);
		if($nro->nro) $numb = intval($nro->nro) + 1;
		$cab->numero = $numb;
		
		if($id = $this->Citas_model->registrar('receta_medica',$cab)){
			foreach($indic as $row):
				unset($row->descripcion);
				$row->idrecetamedica = $id;
			endforeach;
			foreach($diag as $row):
				unset($row->cie10, $row->descripcion_cie10);
				$row->idrecetamedica = $id;
			endforeach;
			if($this->Citas_model->registrarbatch('receta_medica_detalle',$indic)){
				if($this->Citas_model->registrarbatch('receta_medica_dx',$diag)){
					$status = 200; $msg = 'Receta Registrada';
				}
			}
		}
		
		$data = array('msg' => $msg, 'idreceta' => $id, 'status' => $status);
		
		echo json_encode($data);
		
	}
	public function procedimientos()
	{
		return $this->load->view('main');
	}
	public function nuevoprocedimiento()
	{
		$this->load->model('Citas_model');
		$tpproc = $this->Citas_model->querysqlwhere('idtipoprocedimiento,tipo_procedimiento','tipo_procedimiento',['activo' => 1]);
		$this->load->view('main',['tipo' => $tpproc]);
	}
	public function editarprocedimiento()
	{
		$this->load->model('Citas_model');
		$tpproc = $this->Citas_model->querysqlwhere('idtipoprocedimiento,tipo_procedimiento','tipo_procedimiento',['activo' => 1]);
		$proc = $this->Citas_model->queryindividual('*','procedimiento',['idprocedimiento' => $this->input->get('id')]);
		$this->load->view('main',['tipo' => $tpproc, 'proced' => $proc]);
	}
	public function rprocedimientos()
	{
		$this->load->model('Citas_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		
		$data = array(
			'idtipoprocedimiento' => $this->input->post('tipo'),
			'procedimiento' => $this->input->post('procedimiento'),
			'tarifa_base' => $this->input->post('tarifa'),
		);
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Procedimiento</b>');
			if($id = $this->Citas_model->registrar('procedimiento', $data)){
				$this->Citas_model->actualizar('procedimiento',['correlativo' => 'PROC'.sprintf('%04s',$id)],['idprocedimiento' => $id]);
				$this->session->set_flashdata('flashMessage', '<b>Procedimiento</b> Registrado');
				$this->session->set_flashdata('claseMsg', 'alert-success');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar el <b>Procedimiento</b>');
			if($this->Citas_model->actualizar('procedimiento', $data, ['idprocedimiento' => $this->input->post('idprocedimiento')])){
				$this->session->set_flashdata('flashMessage', '<b>Procedimiento</b> Actualizado');
				$this->session->set_flashdata('claseMsg', 'alert-success');
			}
		}
		header('location:'.base_url().'citas/procedimientos');
	}
	public function anular()
	{
		$this->load->model('Citas_model');
		$seg = $this->uri->segment(2); $valida = false; $msg = 'No se pudo anular';
		if($seg === 'medicos'){
			$valida = $this->Citas_model->actualizar('profesional',['activo' => 0],['idprofesional' => $this->input->get('id')]);
			if($valida) $msg = 'Profesional Anulado';
		}elseif($seg === 'pacientes'){
			$valida = $this->Citas_model->actualizar('paciente',['activo' => 0],['idpaciente' => $this->input->get('id')]);
			if($valida) $msg = 'Paciente Anulado';
		}elseif($seg === 'historia'){
			$valida = $this->Citas_model->actualizar('historia_clinica',['activo' => 0],['idhistoria' => $this->input->get('id')]);
			if($valida) $msg = 'Historia Anulada';
		}elseif($seg === 'consultorios'){
			$valida = $this->Citas_model->actualizar('consultorio',['activo' => 0],['idconsultorio' => $this->input->get('id')]);
			if($valida) $msg = 'Consultorio Anulado';
		}elseif($seg === 'turnos'){
			/*$valida = $this->Citas_model->actualizar('consultorio',['activo' => 0],['idconsultorio' => $this->input->get('id')]);
			if($valida) $msg = 'Turno Anulado';*/
		}elseif($seg === 'procedimientos'){
			$valida = $this->Citas_model->actualizar('procedimiento',['activo' => 0],['idprocedimiento' => $this->input->get('id')]);
			if($valida) $msg = 'Procedimiento Anulado';
		}
		
		echo json_encode(['msg' => $msg]);
	}
	/*public function verhistoria()
	{
		$this->load->model('Citas_model');
		$versionphp = 7; $id = $this->input->get('id'); $html = null; $a5 = 'A4'; $direccion = 'portrait';
		$diag = []; $proc = []; $indic = []; $i = 0; $j = 0; $k = 0;
		$historia = $this->Citas_model->historia(['idhistoria' => $this->input->get('id')]);
		$atencion = $this->Citas_model->atenciones(['idhistoria' => $this->input->get('id')]);
		
		foreach($atencion as $row):
			$d = $this->Citas_model->diagnosticos(['idatencion' => $row->idatencion]);
			if(count($d)) $diag[] = $d;
			$p = $this->Citas_model->proc(['idatencion' => $row->idatencion]);
			if(count($p)) $proc[] = $p;
			$in = $this->Citas_model->indic(['idatencion' => $row->idatencion]);
			if(count($in)) $indic[] = $in;
		endforeach;
		$data = array(
			'historia' => $historia,
			'atencion' => $atencion,
			'diagnostico' => count($diag)? $diag[0] : array(),
			'procedimiento' =>  count($proc)? $proc[0] : array(),
			'indicaciones' =>  count($indic)? $indic[0] : array(),
		);
		
		$html = $this->load->view('citas/historia-pdf', $data, true);
		
		if(floatval(phpversion()) < $versionphp){
			$this->load->library('dom');
			$this->dom->generate($direccion, $a5, $html, 'Informe');
		}else{
			$this->load->library('dom1');
			$this->dom1->generate($direccion, $a5, $html, 'Informe');
		}
	}*/
}