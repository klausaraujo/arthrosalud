<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
class Menu_model extends CI_Model
{    
	public function __construct(){ parent::__construct(); }
    
	public function mnusuario($data)
    {
        $this->db->select('pm.idmenu,pm.activo,idmodulo,descripcion,nivel,url,icono');
        $this->db->from('permisos_menu pm');
		$this->db->join('menu m','m.idmenu=pm.idmenu');
		$this->db->where($data);
		$this->db->order_by('m.idmenu', 'asc');
        $result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
    }
	public function smnusuario($data)
    {
        $this->db->select('pm.idmenudetalle,pm.activo,idmenu,descripcion,url,icono,orden');
        $this->db->from('permisos_menu_detalle pm');
		$this->db->join('menu_detalle md','md.idmenudetalle=pm.idmenudetalle');
        $this->db->where($data);
		$this->db->order_by('pm.idmenudetalle', 'asc');
        $result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
    }
	public function modulosid()
	{
		$this->db->select('idmodulo,url');
		$this->db->from('modulos');
		$this->db->order_by('idmodulo', 'asc');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
}