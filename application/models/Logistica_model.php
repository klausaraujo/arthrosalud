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
	public function registrar($t, $data)
	{
		if ($this->db->insert($t, $data)) return $this->db->insert_id();
		else return 0;
	}
	public function actualizar($t, $data, $where)
	{
		$this->db->db_debug = TRUE;
		$this->db->where($where);
		if($this->db->update($t, $data)) return true;
        else return false;
	}
	public function validar($q, $t ,$where)
	{
		$query = $this->db->select($q)->from($t)->where($where)->get();
		return $query->num_rows() > 0? $query->result() : array();
	}
}