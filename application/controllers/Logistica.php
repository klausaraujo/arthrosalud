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
		$bienes = $this->Logistica_model->listabienes();
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $bienes]);
	}
	public function listaservicios()
	{
		$this->load->model('Logistica_model');
		$servicios = $this->Logistica_model->listaservicios();
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $servicios]);
	}
	public function listaingresos()
	{
		$this->load->model('Logistica_model');
		$ingresos = $this->Logistica_model->listaingresos();
		echo json_encode(['data' => $ingresos]);
	}
	public function listasalidas()
	{
		$this->load->model('Logistica_model');
		$salidas = $this->Logistica_model->listasalidas();
		echo json_encode(['data' => $salidas]);
	}
	public function findalmacenes()
	{
		$this->load->model('Logistica_model');
		$almacenes = $this->Logistica_model->querysqlwhere('idalmacen,nombre_almacen','almacen',
				['idempresa' => $this->input->post('idempresa'),'tipo_almacen' => 1,'activo' => 1]);
		echo json_encode($almacenes);
	}
	public function findcc()
	{
		$this->load->model('Logistica_model');
		$centros = $this->Logistica_model->querysqlwhere('idcentro,centro_costos','centro_costos',
				['idempresa' => $this->input->post('idempresa'),'activo' => 1]);
		echo json_encode($centros);
	}
	public function listaProvServer()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'proveedor',
			'primary_key' => 'idproveedor',
			'columns' => array('numero_ruc','nombre_comercial','domicilio','ubigeo','idproveedor','contacto',
						'correo','activo'),
			'where' => array('activo' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listaarticulosguias()
	{
		$this->load->model('Logistica_model');
		$articulos = $this->Logistica_model->listaarticulos($this->input->post('tabla'),
				['idguia' => $this->input->post('idguia'),'ge.activo' => 1]);
		echo json_encode(['data' => $articulos]);
	}
	public function articulosocos()
	{
		$this->load->model('Logistica_model'); $articulos = null;
		
		if($this->uri->segment(2) === 'ocompra')
			$articulos = $this->Logistica_model->listaarticulos($this->input->post('tabla'),
					['idorden' => $this->input->post('idorden'),'ge.activo' => 1]);
		else
			$articulos = $this->Logistica_model->listaserv($this->input->post('tabla'),
					['idorden' => $this->input->post('idorden'),'ge.activo' => 1]);
		
		echo json_encode(['data' => $articulos]);
	}
	public function listaArtServer()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'articulos',
			'primary_key' => 'idarticulo',
			'columns' => array('correlativo','descripcion','fotografia','activo','idarticulo'),
			'where' => array('disponible_compra' => 1,'activo' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listaServServer()
	{
		$this->load->library('datatables_server_side', array(
			'table' => 'servicios',
			'primary_key' => 'idservicio',
			'columns' => array('idservicio','descripcion','idunidadmedida','activo'),
			'where' => array('disponible_venta' => 1,'activo' => 1),
		));
		$this->datatables_server_side->process();
	}
	public function listaoc()
	{
		$this->load->model('Logistica_model');
		$oc = $this->Logistica_model->listaoc();
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $oc]);
	}
	public function listaos()
	{
		$this->load->model('Logistica_model');
		$oc = $this->Logistica_model->listaos();
		//$data = json_decode(json_encode($empresas, JSON_FORCE_OBJECT));
		echo json_encode(['data' => $oc]);
	}
	public function proveedores()
	{
		return $this->load->view('main');
	}
	public function bienes()
	{
		return $this->load->view('main');
	}
	public function servicios()
	{
		return $this->load->view('main');
	}
	public function entrada()
	{
		$data = array('detalle' => array());
		return $this->load->view('main',$data);
	}
	public function salida()
	{
		$data = array('detalle' => array());
		return $this->load->view('main',$data);
	}
	public function oc()
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
	public function nuevoservicios()
	{
		$this->load->model('Logistica_model');
		$tserv = $this->Logistica_model->querysqlwhere('*','tipo_servicio',['activo' => 1]);
		$um = $this->Logistica_model->querysqlwhere('*','unidad_medida',['uso_servicios' => 1,'activo' => 1]);
		
		$data = array(
			'servicios' => $tserv,
			'um' => $um,
		);
		return $this->load->view('main', $data);
	}
	public function formingresos()
	{
		$this->load->model('Logistica_model');
		$estab = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);		
		$alm = null; $i = 1;
		foreach($estab as $row):
			if($i === 1){
				$alm = $this->Logistica_model->querysqlwhere('idalmacen,nombre_almacen','almacen',
						['idempresa' => $row->idempresa,'tipo_almacen' => 1,'activo' => 1]);
				$i++;
			}
		endforeach;
		
		$mov = $this->Logistica_model->querysqlwhere('idtipomovimiento,tipo_movimiento','tipo_movimiento',['factor' => 1,'activo' => 1]);
		$comp = $this->Logistica_model->querysqlwhere('idtipocomprobante,tipo_comprobante','tipo_comprobante',['activo' => 1]);
		
		$data = array(
			'estab' => $estab,
			'alm' => $alm,
			'mov' => $mov,
			'comp' => $comp,
		);
		return $this->load->view('main',$data);
	}
	public function formsalidas()
	{
		$this->load->model('Logistica_model');
		$estab = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);		
		$alm = null; $i = 1;
		foreach($estab as $row):
			if($i === 1){
				$alm = $this->Logistica_model->querysqlwhere('idalmacen,nombre_almacen','almacen',
						['idempresa' => $row->idempresa,'tipo_almacen' => 1,'activo' => 1]);
				$i++;
			}
		endforeach;
		
		$mov = $this->Logistica_model->querysqlwhere('idtipomovimiento,tipo_movimiento','tipo_movimiento',['factor' => -1,'activo' => 1]);
		$comp = $this->Logistica_model->querysqlwhere('idtipocomprobante,tipo_comprobante','tipo_comprobante',['activo' => 1]);
		
		$data = array(
			'estab' => $estab,
			'alm' => $alm,
			'mov' => $mov,
			'comp' => $comp,
		);
		return $this->load->view('main',$data);
	}
	public function ocform()
	{
		$this->load->model('Logistica_model');
		$anio = $this->Logistica_model->querysqlwhere('anio','anio',['activo' => 1]);
		$emp = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$medio = $this->Logistica_model->querysqlwhere('idmediopago,medio_pago','medio_pago',['activo' => 1]);
		$tipo = $this->Logistica_model->querysqlwhere('idtipopago,tipo_pago','tipo_pago',['activo' => 1]);
		$mon = $this->Logistica_model->querysqlwhere('idtipomoneda,tipo_moneda','tipo_moneda',['activo' => 1]);
		
		$data = array(
			'anio' => $anio,
			'emp' => $emp,
			'medio' => $medio,
			'tipo' => $tipo,
			'mon' => $mon,
		);
		return $this->load->view('main', $data);
	}
	public function regproveedor()
	{
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		//$nombre = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true))));
		$this->load->model('Logistica_model');
		$ubigeo = $this->input->post('dep').$this->input->post('pro').$this->input->post('dis');
		
		$data = array(
			'numero_ruc' => $this->input->post('ruc'),
			'razon_social' => $this->input->post('nombres'),
			'nombre_comercial' => $this->input->post('nombres'),
			'domicilio' => $this->input->post('direccion'),
			'ubigeo' => $ubigeo,
			'latitud' => $this->input->post('lat'),
			'longitud' => $this->input->post('lng'),
			'celular' => $this->input->post('celular'),
			'contacto' => $this->input->post('contacto'),
			'correo' => $this->input->post('correo'),
			/*'idtipocuenta' => $this->input->post('idtipocuenta'),
			'idbanco' => $this->input->post('idbanco'),
			'numero_cuenta' => $this->input->post('nrocuenta'),
			'cci_cuenta' => $this->input->post('cci'),
			'idtipomoneda' => $this->input->post('tipomoneda'),*/
			'observaciones' => $this->input->post('obs'),
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			if(!$this->Logistica_model->validar('*','proveedor',['numero_ruc' => $this->input->post('ruc')])){
				$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Proveedor</b>');
				
				if($this->Logistica_model->registrar('proveedor', $data)){
					$this->session->set_flashdata('flashMessage', '<b>Proveedor</b> Registrado Exitosamente');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}else $this->session->set_flashdata('flashMessage', 'El <b>Proveedor</b> ya se encuentra registrado');
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$id = $this->input->post('idproveedor');
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar el <b>Proveedor</b>');
			
			if($this->Logistica_model->actualizar('proveedor', $data, ['idproveedor'=>$id])){
				$this->session->set_flashdata('flashMessage', '<b>Proveedor</b> Actualizado');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}
		header('location:'.base_url().'logistica/proveedores');
	}
	public function regbienes()
	{
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$nombre = date('dmY').''.str_replace('.','',(microtime(true) - intval(microtime(true)))); $file = null; $ext = ''; $data = null;
		$this->load->model('Logistica_model');
		$path = './public/images/articulos/';
		
		if($_FILES['img']['name'] !== ''){
			if($file = $this->fileupload($_FILES['img'], $nombre)){
				imagedestroy($file);
				$ext = pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
				$nombre .= '.'.$ext;
				if($this->input->post('foto') && $this->input->post('foto') !== 'img_default.png'){
					if(is_writable($path.$this->input->post('foto'))) unlink($path.$this->input->post('foto'));
				}
			}
		}
		$data = array(
			'idtipoarticulo' => $this->input->post('tipoart'),
			'idlaboratorio' => $this->input->post('laboratorio'),
			'idunidadmedida' => $this->input->post('um'),
			'idpresentacion' => $this->input->post('presentacion'),
			'descripcion' => $this->input->post('descripcion'),
			'disponible_compra' => ($this->input->post('compra')? 1 : 0),
			'disponible_venta' => ($this->input->post('venta')? 1 : 0),
			'porcentaje_utilidad' => $this->input->post('porcentaje'),
			'observaciones' => $this->input->post('obs'),
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Art&iacute;culo</b>');
			$data['fotografia'] = ($ext? $nombre : 'img_default.png');
			if($id = $this->Logistica_model->registrar('articulos', $data)){
				$this->Logistica_model->actualizar('articulos', ['correlativo' => 'ART'.sprintf("%'05s",$id)],['idarticulo' => $id]);
				$this->session->set_flashdata('flashMessage', '<b>Art&iacute;culo</b> Registrado Exitosamente');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar el <b>Art&iacute;culo</b>');
			if($ext) $data['fotografia'] = $nombre;
			if($this->Logistica_model->actualizar('articulos', $data, ['idarticulo' => $this->input->post('id')])){
				$this->session->set_flashdata('flashMessage', '<b>Art&iacute;culo</b> Actualizado');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}
		header('location:'.base_url().'logistica/bienes');
	}
	public function regservicios()
	{
		$this->session->set_flashdata('claseMsg', 'alert-danger');
		$this->load->model('Logistica_model');
		
		$data = array(
			//'idtiposervicio' => 1,
			'idtiposervicio' => $this->input->post('tiposerv'),
			'idunidadmedida' => $this->input->post('um'),
			//'idpresentacion' => 1,
			'descripcion' => $this->input->post('descripcion'),
			//'fotografia' => 'NO APLICA',
			'disponible_compra' => ($this->input->post('compra')? 1 : 0),
			'disponible_venta' => ($this->input->post('venta')? 1 : 0),
			'porcentaje_utilidad' => $this->input->post('porcentaje'),
			'observaciones' => $this->input->post('obs')
		);
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el <b>Servicio</b>');
			if($this->Logistica_model->registrar('servicios', $data)){
				$this->session->set_flashdata('flashMessage', '<b>Servicio</b> Registrado Exitosamente');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar el <b>Servicio</b>');
			if($this->Logistica_model->actualizar('servicios', $data, ['idarticulo' => $this->input->post('id')])){
				$this->session->set_flashdata('flashMessage', '<b>Servicio</b> Actualizado');
				$this->session->set_flashdata('claseMsg', 'alert-primary');
			}
		}
		header('location:'.base_url().'logistica/servicios');
	}
	public function regentrada()
	{
		$this->load->model('Logistica_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger'); date_default_timezone_set('America/Lima');
		$anio = date('Y'); $numb = 1;
		$nro = $this->Logistica_model->queryindividual('MAX(numero) as nro','guia_ingreso',['anio' => $anio]);
		if($nro->nro) $numb = intval($nro->nro) + 1;
		
		$data = array(
			'anio' => $anio,
			'numero' => $numb,
			'fecha' => date('Y-m-d H:i:s'),
			'idalmacen' => $this->input->post('almacen'),
			'idtipomovimiento' => $this->input->post('idtipo'),
			'idproveedor' => $this->input->post('idproveedor'),
			'idtipocomprobante' => $this->input->post('idcomp'),
			'serie_comprobante' => $this->input->post('serie'),
			'numero_comprobante' => $this->input->post('nrocomp'),
			'fecha_emision_comprobante' => date('Y-m-d H:i:s'),
			'observaciones' => $this->input->post('obs')
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el detalle de la <b>Gu&iacute;a</b>');
			if($idguia = $this->Logistica_model->registrar('guia_ingreso', $data)){
				$detalle = json_decode($this->input->post('json'));
				foreach($detalle as $row):
					unset($row->descripcion);
					$row->idguia = $idguia;
				endforeach;
				if($this->Logistica_model->registrarbatch('guia_ingreso_detalle', $detalle)){
					$this->session->set_flashdata('flashMessage', 'Detalle de <b>Gu&iacute;a</b> registrado con &Eacute;xito');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar la <b>Gu&iacute;a</b>');
			unset($data['anio']);
			unset($data['numero']);
			unset($data['fecha']);
			unset($data['fecha_emision_comprobante']);
			if($this->Logistica_model->actualizar('guia_ingreso', $data, ['idguia' => $this->input->post('idguia')])){
				if($this->Logistica_model->borrar('guia_ingreso_detalle',['idguia' => $this->input->post('idguia')])){
					$detalle = json_decode($this->input->post('json'));
					foreach($detalle as $row):
						unset($row->descripcion);
						unset($row->iddetalle);
					endforeach;
					if($this->Logistica_model->registrarbatch('guia_ingreso_detalle', $detalle)){
						$this->session->set_flashdata('flashMessage', 'Detalle de <b>Gu&iacute;a</b> actualizado con &Eacute;xito');
						$this->session->set_flashdata('claseMsg', 'alert-primary');
					}
				}
			}
		}
		header('location:'.base_url().'logistica/gentrada');
	}
	public function regsalida()
	{
		$this->load->model('Logistica_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger'); date_default_timezone_set('America/Lima');
		$anio = date('Y'); $numb = 1;
		$nro = $this->Logistica_model->queryindividual('MAX(numero) as nro','guia_salida',['anio' => $anio]);
		if($nro->nro) $numb = intval($nro->nro) + 1;
		
		$data = array(
			'anio' => $anio,
			'numero' => $numb,
			'fecha' => date('Y-m-d H:i:s'),
			'idalmacen' => $this->input->post('almacen'),
			'idtipomovimiento' => $this->input->post('idtipo'),
			'idproveedor' => $this->input->post('idproveedor'),
			'idtipocomprobante' => $this->input->post('idcomp'),
			'serie_comprobante' => $this->input->post('serie'),
			'numero_comprobante' => $this->input->post('nrocomp'),
			'fecha_emision_comprobante' => date('Y-m-d H:i:s'),
			'observaciones' => $this->input->post('obs')
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el detalle de la <b>Gu&iacute;a</b>');
			if($idguia = $this->Logistica_model->registrar('guia_salida', $data)){
				$detalle = json_decode($this->input->post('json'));
				foreach($detalle as $row):
					unset($row->descripcion);
					$row->idguia = $idguia;
				endforeach;
				if($this->Logistica_model->registrarbatch('guia_salida_detalle', $detalle)){
					$this->session->set_flashdata('flashMessage', 'Detalle de <b>Gu&iacute;a</b> registrado con &Eacute;xito');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar la <b>Gu&iacute;a</b>');
			unset($data['anio']);
			unset($data['numero']);
			unset($data['fecha']);
			unset($data['fecha_emision_comprobante']);
			if($this->Logistica_model->actualizar('guia_salida', $data, ['idguia' => $this->input->post('idguia')])){
				if($this->Logistica_model->borrar('guia_salida_detalle',['idguia' => $this->input->post('idguia')])){
					$detalle = json_decode($this->input->post('json'));
					foreach($detalle as $row):
						unset($row->descripcion);
						unset($row->iddetalle);
					endforeach;
					if($this->Logistica_model->registrarbatch('guia_salida_detalle', $detalle)){
						$this->session->set_flashdata('flashMessage', 'Detalle de <b>Gu&iacute;a</b> actualizado con &Eacute;xito');
						$this->session->set_flashdata('claseMsg', 'alert-primary');
					}
				}
			}
		}
		header('location:'.base_url().'logistica/gsalida');
	}
	public function regoc()
	{
		$this->load->model('Logistica_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger'); date_default_timezone_set('America/Lima');
		$anio = date('Y'); $numb = 1;
		$nro = $this->Logistica_model->queryindividual('MAX(numero) as nro','orden_compra',['anio' => $anio]);
		if($nro->nro) $numb = intval($nro->nro) + 1;
		
		$data = array(
			'anio' => $this->input->post('anio'),
			'numero' => $numb,
			'fecha' => $this->input->post('fecha'),
			'idempresa' => $this->input->post('idempresa'),
			'idcentro' => $this->input->post('centro'),
			'idproveedor' => $this->input->post('idproveedor'),
			'idtipopago' => $this->input->post('tpago'),
			'idmediopago' => $this->input->post('mpago'),
			'idtipomoneda' => $this->input->post('tmon'),
			'observaciones' => $this->input->post('obs'),
			'tipo_cambio' => $this->input->post('tcambio'),
			'importe' => $this->input->post('importe'),
			'impuesto' => $this->input->post('impuesto'),
			'total' => $this->input->post('total'),
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el detalle de la <b>Orden</b>');
			if($idorden = $this->Logistica_model->registrar('orden_compra', $data)){
				$detalle = json_decode($this->input->post('json'));
				foreach($detalle as $row):
					unset($row->descripcion);
					unset($row->presentacion);
					unset($row->tipo_articulo);
					$row->idorden = $idorden;
				endforeach;
				if($this->Logistica_model->registrarbatch('orden_compra_detalle', $detalle)){
					$this->session->set_flashdata('flashMessage', 'Detalle de <b>Orden</b> registrado con &Eacute;xito');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar la <b>Orden</b>');
			unset($data['anio']);
			unset($data['numero']);
			unset($data['fecha']);
			if($this->Logistica_model->actualizar('orden_compra', $data, ['idorden' => $this->input->post('idorden')])){
				if($this->Logistica_model->borrar('orden_compra_detalle',['idorden' => $this->input->post('idorden')])){
					$detalle = json_decode($this->input->post('json'));
					foreach($detalle as $row):
						unset($row->descripcion);
						unset($row->presentacion);
						unset($row->tipo_articulo);
						unset($row->iddetalle);
						unset($row->idorden);
						$row->idorden = $this->input->post('idorden');
					endforeach;
					if($this->Logistica_model->registrarbatch('orden_compra_detalle', $detalle)){
						$this->session->set_flashdata('flashMessage', 'Detalle de <b>Orden</b> actualizado con &Eacute;xito');
						$this->session->set_flashdata('claseMsg', 'alert-primary');
					}
				}
			}
		}
		header('location:'.base_url().'logistica/ocompra');
	}
	public function regos()
	{
		$this->load->model('Logistica_model');
		$this->session->set_flashdata('claseMsg', 'alert-danger'); date_default_timezone_set('America/Lima');
		$anio = date('Y'); $numb = 1;
		$nro = $this->Logistica_model->queryindividual('MAX(numero) as nro','orden_servicio',['anio' => $anio]);
		if($nro->nro) $numb = intval($nro->nro) + 1;
		
		$data = array(
			'anio' => $this->input->post('anio'),
			'numero' => $numb,
			'fecha' => $this->input->post('fecha'),
			'idempresa' => $this->input->post('idempresa'),
			'idcentro' => $this->input->post('centro'),
			'idproveedor' => $this->input->post('idproveedor'),
			'idtipopago' => $this->input->post('tpago'),
			'idmediopago' => $this->input->post('mpago'),
			'idtipomoneda' => $this->input->post('tmon'),
			'observaciones' => $this->input->post('obs'),
			'tipo_cambio' => $this->input->post('tcambio'),
			'importe' => $this->input->post('importe'),
			'impuesto' => $this->input->post('impuesto'),
			'total' => $this->input->post('total'),
		);
		
		if($this->input->post('tiporegistro') === 'registrar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo registrar el detalle de la <b>Orden</b>');
			if($idorden = $this->Logistica_model->registrar('orden_servicio', $data)){
				$detalle = json_decode($this->input->post('json'));
				foreach($detalle as $row):
					unset($row->descripcion);
					unset($row->tiposervicio);
					$row->idorden = $idorden;
				endforeach;
				if($this->Logistica_model->registrarbatch('orden_servicio_detalle', $detalle)){
					$this->session->set_flashdata('flashMessage', 'Detalle de <b>Orden</b> registrado con &Eacute;xito');
					$this->session->set_flashdata('claseMsg', 'alert-primary');
				}
			}
		}elseif($this->input->post('tiporegistro') === 'editar'){
			$this->session->set_flashdata('flashMessage', 'No se pudo actualizar la <b>Orden</b>');
			unset($data['anio']);
			unset($data['numero']);
			unset($data['fecha']);
			if($this->Logistica_model->actualizar('orden_servicio', $data, ['idorden' => $this->input->post('idorden')])){
				if($this->Logistica_model->borrar('orden_servicio_detalle',['idorden' => $this->input->post('idorden')])){
					$detalle = json_decode($this->input->post('json'));
					foreach($detalle as $row):
						unset($row->descripcion);
						unset($row->tiposervicio);
						unset($row->iddetalle);
						$row->idorden = $this->input->post('idorden');
					endforeach;
					if($this->Logistica_model->registrarbatch('orden_servicio_detalle', $detalle)){
						$this->session->set_flashdata('flashMessage', 'Detalle de <b>Orden</b> actualizado con &Eacute;xito');
						$this->session->set_flashdata('claseMsg', 'alert-primary');
					}
				}
			}
		}
		header('location:'.base_url().'logistica/oservicio');
	}
	public function editproveedor()
	{
		$this->load->model('Logistica_model');
		$this->load->model('General_model');
		$data = []; $id = $this->input->get('id');
		
		//$doc = $this->Logistica_model->querysql('*','tipo_documento');
		$cta = $this->Logistica_model->querysql('*','tipo_cuenta');
		$bco = $this->Logistica_model->querysql('*','banco');
		$moneda = $this->Logistica_model->querysql('*','tipo_moneda');
		$dep = $this->General_model->departamentos();
		
		$proveedor = $this->Logistica_model->querysqlwhere('*', 'proveedor', ['idproveedor' => $id]);
		$pro = $this->General_model->provincias(['cod_dep'=>substr($proveedor[0]->ubigeo,0,2)]);
		$dis = $this->General_model->distritos(['cod_dep'=>substr($proveedor[0]->ubigeo,0,2),'cod_pro'=>substr($proveedor[0]->ubigeo,2,2)]);
		$data['proveedor'] = $proveedor[0];
		$data['pro'] = $pro;
		$data['dis'] = $dis;
		$data['lat'] = floatval($data['proveedor']->latitud);
		$data['lng'] = floatval($data['proveedor']->longitud);
		//$data['tipodoc'] = $doc;
		$data['dep'] = $dep;
		$data['cta'] = $cta;
		$data['bco'] = $bco;
		$data['moneda'] = $moneda;
		
		return $this->load->view('main',$data);
	}
	public function editservicios()
	{
		$this->load->model('Logistica_model');
		$um = $this->Logistica_model->querysqlwhere('*','unidad_medida',['uso_servicios' => 1,'activo' => 1]);
		$servicio = $this->Logistica_model->querysqlwhere('*', 'servicios' , ['idservicio' => $this->input->get('id')]);
		$tserv = $this->Logistica_model->querysqlwhere('*','tipo_servicio',['activo' => 1]);
		$data = ['um' => $um, 'servicio' => $servicio, 'tserv' => $tserv];
		return $this->load->view('main', $data);
	}
	public function editbienes()
	{
		$this->load->model('Logistica_model');
		$bien = $this->Logistica_model->querysqlwhere('*', 'articulos' , ['idarticulo' => $this->input->get('id')]);
		$tart = $this->Logistica_model->querysqlwhere('*','tipo_articulo',['activo' => 1]);
		$lab = $this->Logistica_model->querysqlwhere('*','laboratorio',['activo' => 1]);
		$um = $this->Logistica_model->querysqlwhere('*','unidad_medida',['uso_bienes' => 1,'activo' => 1]);
		$pres = $this->Logistica_model->querysqlwhere('*','presentacion',['activo' => 1]);
		
		$data = array(
			'tipoart' => $tart,
			'laboratorio' => $lab,
			'um' => $um,
			'presentacion' => $pres,
			'bien' => $bien
		);
		return $this->load->view('main', $data);
	}
	public function editingresos()
	{
		$this->load->model('Logistica_model');
		$guia = $this->Logistica_model->queryindividual('*','guia_ingreso',['idguia' => $this->input->get('id')]);
		$estab = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$empresa = $this->Logistica_model->queryindividual('idempresa','almacen',['idalmacen' => $guia->idalmacen]);
		
		$alm = $this->Logistica_model->querysqlwhere('idalmacen,nombre_almacen','almacen',
					['idempresa' => $empresa->idempresa,'tipo_almacen' => 1,'activo' => 1]);
		
		$proveedor = $this->Logistica_model->queryindividual('nombre_comercial','proveedor',['idproveedor' => $guia->idproveedor]);
		$mov = $this->Logistica_model->querysqlwhere('idtipomovimiento,tipo_movimiento','tipo_movimiento',['factor' => 1,'activo' => 1]);
		$comp = $this->Logistica_model->querysqlwhere('idtipocomprobante,tipo_comprobante','tipo_comprobante',['activo' => 1]);
		$detalle = $this->Logistica_model->querysqlwhere('*','guia_ingreso_detalle',['idguia' => $this->input->get('id')]);
		
		$data = array(
			'estab' => $estab,
			'alm' => $alm,
			'mov' => $mov,
			'comp' => $comp,
			'guia' => $guia,
			'emp' => $empresa,
			'prov' => $proveedor,
			'detalle' => json_encode($detalle),
		);
		
		return $this->load->view('main',$data);
	}
	public function editsalidas()
	{
		$this->load->model('Logistica_model');
		$guia = $this->Logistica_model->queryindividual('*','guia_salida',['idguia' => $this->input->get('id')]);
		$estab = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$empresa = $this->Logistica_model->queryindividual('idempresa','almacen',['idalmacen' => $guia->idalmacen]);
		
		$alm = $this->Logistica_model->querysqlwhere('idalmacen,nombre_almacen','almacen',
					['idempresa' => $empresa->idempresa,'tipo_almacen' => 1,'activo' => 1]);
		
		$proveedor = $this->Logistica_model->queryindividual('nombre_comercial','proveedor',['idproveedor' => $guia->idproveedor]);
		$mov = $this->Logistica_model->querysqlwhere('idtipomovimiento,tipo_movimiento','tipo_movimiento',['factor' => -1,'activo' => 1]);
		$comp = $this->Logistica_model->querysqlwhere('idtipocomprobante,tipo_comprobante','tipo_comprobante',['activo' => 1]);
		$detalle = $this->Logistica_model->querysqlwhere('*','guia_salida_detalle',['idguia' => $this->input->get('id')]);
		
		$data = array(
			'estab' => $estab,
			'alm' => $alm,
			'mov' => $mov,
			'comp' => $comp,
			'guia' => $guia,
			'emp' => $empresa,
			'prov' => $proveedor,
			'detalle' => json_encode($detalle),
		);
		
		return $this->load->view('main',$data);
	}
	public function editoc()
	{
		$this->load->model('Logistica_model');
		$orden = $this->Logistica_model->queryindividual('*','orden_compra',['idorden' => $this->input->get('id')]);
		$estab = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$centro = $this->Logistica_model->querysqlwhere('idcentro,centro_costos','centro_costos',['idempresa' => $orden->idempresa]);
		$proveedor = $this->Logistica_model->queryindividual('nombre_comercial','proveedor',['idproveedor' => $orden->idproveedor]);		
		$anio = $this->Logistica_model->querysqlwhere('anio','anio',['activo' => 1]);
		$medio = $this->Logistica_model->querysqlwhere('idmediopago,medio_pago','medio_pago',['activo' => 1]);
		$tipo = $this->Logistica_model->querysqlwhere('idtipopago,tipo_pago','tipo_pago',['activo' => 1]);
		$mon = $this->Logistica_model->querysqlwhere('idtipomoneda,tipo_moneda','tipo_moneda',['activo' => 1]);
		
		$detalle = $this->Logistica_model->querysqlwhere('*','orden_compra_detalle',['idorden' => $this->input->get('id')]);
		
		$data = array(
			'orden' => $orden,
			'emp' => $estab,
			'centro' => $centro,
			'prov' => $proveedor,
			'anio' => $anio,
			'medio' => $medio,
			'tipo' => $tipo,
			'mon' => $mon,
			'detalle' => json_encode($detalle),
		);
		
		return $this->load->view('main',$data);
	}
	public function editos()
	{
		$this->load->model('Logistica_model');
		$orden = $this->Logistica_model->queryindividual('*','orden_servicio',['idorden' => $this->input->get('id')]);
		$estab = $this->Logistica_model->querysqlwhere('idempresa,nombre_comercial','empresa',['activo' => 1]);
		$centro = $this->Logistica_model->querysqlwhere('idcentro,centro_costos','centro_costos',['idempresa' => $orden->idempresa]);
		$proveedor = $this->Logistica_model->queryindividual('nombre_comercial','proveedor',['idproveedor' => $orden->idproveedor]);		
		$anio = $this->Logistica_model->querysqlwhere('anio','anio',['activo' => 1]);
		$medio = $this->Logistica_model->querysqlwhere('idmediopago,medio_pago','medio_pago',['activo' => 1]);
		$tipo = $this->Logistica_model->querysqlwhere('idtipopago,tipo_pago','tipo_pago',['activo' => 1]);
		$mon = $this->Logistica_model->querysqlwhere('idtipomoneda,tipo_moneda','tipo_moneda',['activo' => 1]);
		
		$detalle = $this->Logistica_model->querysqlwhere('*','orden_servicio_detalle',['idorden' => $this->input->get('id')]);
		
		$data = array(
			'orden' => $orden,
			'emp' => $estab,
			'centro' => $centro,
			'prov' => $proveedor,
			'anio' => $anio,
			'medio' => $medio,
			'tipo' => $tipo,
			'mon' => $mon,
			'detalle' => json_encode($detalle),
		);
		
		return $this->load->view('main',$data);
	}
	public function anular()
	{
		$this->load->model('Parametros_model');
		$msg = 'No se pudo anular el registro';
		$segmento = $this->uri->segment(2);
		
		if($segmento === 'proveedores'){
			if($this->Parametros_model->actualizar('proveedor',['activo' => 0],['idproveedor'=> $this->input->get('id')])) $msg = 'Registro anulado';
		}elseif($segmento === 'bienes' || $segmento === 'servicios'){
			if($this->Parametros_model->actualizar('articulos',['activo' => 0],['idarticulo'=> $this->input->get('id')])) $msg = 'Registro anulado';
		}elseif($segmento === 'ocompra'){
			if($this->Parametros_model->actualizar('orden_compra',['activo' => 0],['idorden'=> $this->input->get('id')])) $msg = 'Registro anulado';
		}elseif($segmento === 'oservicio'){
			if($this->Parametros_model->actualizar('orden_servicio',['activo' => 0],['idorden'=> $this->input->get('id')])) $msg = 'Registro anulado';
		}
		
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