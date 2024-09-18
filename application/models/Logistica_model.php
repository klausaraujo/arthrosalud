<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Logistica_model extends CI_Model
{    
	public function __construct(){ parent::__construct(); }
    
	public function listabienes()
	{
		$this->db->select('a.*,tp.tipo_articulo,l.laboratorio,u.unidad_medida,p.presentacion');
		$this->db->from('articulos a');
		$this->db->join('tipo_articulo tp','a.idtipoarticulo=tp.idtipoarticulo');
		$this->db->join('laboratorio l','a.idlaboratorio=l.idlaboratorio');
		$this->db->join('unidad_medida u','a.idunidadmedida=u.idunidadmedida');
		$this->db->join('presentacion p','a.idpresentacion=p.idpresentacion');
		$this->db->where(['a.activo' => 1]);
		$this->db->order_by('a.idarticulo','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaservicios()
	{
		$this->db->select('s.*,ts.descripcion,u.unidad_medida');
		$this->db->from('servicios s');
		$this->db->join('tipo_servicio ts','s.idtiposervicio=ts.idtiposervicio');
		$this->db->join('unidad_medida u','s.idunidadmedida=u.idunidadmedida');
		$this->db->where(['s.activo' => 1]);
		$this->db->order_by('s.idservicio','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaingresos()
	{
		$this->db->select('gi.*,tp.tipo_movimiento,p.razon_social,tc.tipo_comprobante');
		$this->db->from('guia_ingreso gi');
		$this->db->join('tipo_movimiento tp','gi.idtipomovimiento=tp.idtipomovimiento');
		$this->db->join('proveedor p','gi.idproveedor=p.idproveedor');
		$this->db->join('tipo_comprobante tc','gi.idtipocomprobante=tc.idtipocomprobante');
		$this->db->where(['gi.activo' => 1]);
		$this->db->order_by('gi.numero','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listasalidas()
	{
		$this->db->select('ge.*,tp.tipo_movimiento,p.razon_social,tc.tipo_comprobante');
		$this->db->from('guia_salida ge');
		$this->db->join('tipo_movimiento tp','ge.idtipomovimiento=tp.idtipomovimiento');
		$this->db->join('proveedor p','ge.idproveedor=p.idproveedor');
		$this->db->join('tipo_comprobante tc','ge.idtipocomprobante=tc.idtipocomprobante');
		$this->db->where(['ge.activo' => 1]);
		$this->db->order_by('ge.numero','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaarticulos($t, $where)
	{
		//$this->db->db_debug = TRUE;
		$this->db->select('ge.*,tp.descripcion,p.presentacion,t.tipo_articulo');
		$this->db->from($t.' ge');
		$this->db->join('articulos tp','ge.idarticulo=tp.idarticulo');
		$this->db->join('presentacion p','p.idpresentacion=tp.idpresentacion');
		$this->db->join('tipo_articulo t','t.idtipoarticulo=tp.idtipoarticulo');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaserv($t, $where)
	{
		$this->db->db_debug = TRUE;
		$this->db->select('ge.*,tp.descripcion,p.descripcion as tiposervicio');
		$this->db->from($t.' ge');
		$this->db->join('servicios tp','ge.idservicio=tp.idservicio');
		$this->db->join('tipo_servicio p','p.idtiposervicio=tp.idtiposervicio');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaoc($where)
	{
		$this->db->select('oc.*,e.razon_social,cc.centro_costos,p.razon_social as provnombre,tp.tipo_pago');
		$this->db->from('orden_compra oc');
		$this->db->join('empresa e','e.idempresa=oc.idempresa');
		$this->db->join('centro_costos cc','cc.idcentro=oc.idcentro');
		$this->db->join('proveedor p','p.idproveedor=oc.idproveedor');
		$this->db->join('tipo_pago tp','tp.idtipopago=oc.idtipopago');
		$this->db->where($where);
		$this->db->order_by('oc.numero','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaos($where)
	{
		$this->db->select('oc.*,e.razon_social,cc.centro_costos,p.razon_social as provnombre,tp.tipo_pago');
		$this->db->from('orden_servicio oc');
		$this->db->join('empresa e','e.idempresa=oc.idempresa');
		$this->db->join('centro_costos cc','cc.idcentro=oc.idcentro');
		$this->db->join('proveedor p','p.idproveedor=oc.idproveedor');
		$this->db->join('tipo_pago tp','tp.idtipopago=oc.idtipopago');
		$this->db->where($where);
		$this->db->order_by('oc.numero','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function ospdf($where)
	{
		//$this->db->db_debug = TRUE;
		$this->db->select('os.*,e.ruc,e.nombre_comercial,e.domicilio,p.numero_ruc,p.razon_social,p.domicilio as dom,p.celular,p.correo');
		$this->db->from('orden_servicio os');
		$this->db->join('empresa e','e.idempresa=os.idempresa');
		$this->db->join('proveedor p','p.idproveedor=os.idproveedor');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function osdpdf($where)
	{
		$this->db->select('osd.*,s.descripcion,u.unidad_medida');
		$this->db->from('orden_servicio_detalle osd');
		$this->db->join('servicios s','s.idservicio=osd.idservicio');
		$this->db->join('unidad_medida u','u.idunidadmedida=s.idunidadmedida');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function detprovpdf($where)
	{
		$this->db->select('pc.*,b.*');
		$this->db->from('proveedor_cuentas pc');
		$this->db->join('banco b','b.idbanco=pc.idbanco');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function ocpdf($where)
	{
		//$this->db->db_debug = TRUE;
		$this->db->select('oc.*,e.ruc,e.nombre_comercial,e.domicilio,p.numero_ruc,p.razon_social,p.domicilio as dom,p.celular,p.correo');
		$this->db->from('orden_compra oc');
		$this->db->join('empresa e','e.idempresa=oc.idempresa');
		$this->db->join('proveedor p','p.idproveedor=oc.idproveedor');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function ocdpdf($where)
	{
		$this->db->select('ocd.*,a.descripcion,u.unidad_medida');
		$this->db->from('orden_compra_detalle ocd');
		$this->db->join('articulos a','a.idarticulo=ocd.idarticulo');
		$this->db->join('unidad_medida u','u.idunidadmedida=a.idunidadmedida');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function guiainpdf($where)
	{
		$this->db->db_debug = TRUE;
		$this->db->select('oc.*,e.ruc,e.nombre_comercial,e.domicilio,p.numero_ruc,p.razon_social,p.domicilio as dom,p.celular,p.correo');
		$this->db->from('guia_ingreso oc');
		$this->db->join('proveedor p','p.idproveedor=oc.idproveedor');
		$this->db->join('almacen a','a.idalmacen=oc.idalmacen');
		$this->db->join('empresa e','e.idempresa=a.idempresa');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function guiaindetpdf($where)
	{
		$this->db->select('ocd.*,a.descripcion,u.unidad_medida');
		$this->db->from('guia_ingreso_detalle ocd');
		$this->db->join('articulos a','a.idarticulo=ocd.idarticulo');
		$this->db->join('unidad_medida u','u.idunidadmedida=a.idunidadmedida');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function guiasapdf($where)
	{
		$this->db->db_debug = TRUE;
		$this->db->select('oc.*,e.ruc,e.nombre_comercial,e.domicilio,p.numero_ruc,p.razon_social,p.domicilio as dom,p.celular,p.correo');
		$this->db->from('guia_salida oc');
		$this->db->join('proveedor p','p.idproveedor=oc.idproveedor');
		$this->db->join('almacen a','a.idalmacen=oc.idalmacen');
		$this->db->join('empresa e','e.idempresa=a.idempresa');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function guiasadetpdf($where)
	{
		$this->db->select('ocd.*,a.descripcion,u.unidad_medida');
		$this->db->from('guia_salida_detalle ocd');
		$this->db->join('articulos a','a.idarticulo=ocd.idarticulo');
		$this->db->join('unidad_medida u','u.idunidadmedida=a.idunidadmedida');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function querysqlwhere($q, $t ,$where)
	{
		$query = $this->db->select($q)->from($t)->where($where)->get();
		return $query->num_rows() > 0? $query->result() : array();
	}
	public function querysql($q,$t)
	{
		$query = $this->db->select($q)->from($t)->get();
		return $query->num_rows() > 0? $query->result() : array();
	}
	public function queryindividual($q,$t,$where)
	{
		$query = $this->db->select($q)->from($t)->where($where)->get();
		return $query->num_rows() > 0? $query->row() : array();
	}
	public function registrar($t, $data)
	{
		if ($this->db->insert($t, $data)) return $this->db->insert_id();
		else return 0;
	}
	public function registrarbatch($t, $data)
	{
		$this->db->db_debug = TRUE;
		if ($this->db->insert_batch($t, $data)) return 1;
		else return 0;
	}
	public function actualizar($t, $data, $where)
	{
		$this->db->where($where);
		if($this->db->update($t, $data)) return true;
        else return false;
	}
	public function validar($q, $t ,$where)
	{
		$query = $this->db->select($q)->from($t)->where($where)->get();
		return $query->num_rows() > 0? $query->result() : array();
	}
	public function borrar($t, $data)
	{
		return $this->db->delete($t, $data);
	}
}