<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model
{    
	public function __construct(){ parent::__construct(); }
    
	public function departamentos()
    {
		$this->db->distinct();
        $this->db->select('cod_dep,departamento');
        $this->db->from('ubigeo');
        $this->db->order_by('cod_dep', 'ASC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
    }
	public function provincias($where)
    {
		$this->db->distinct();
        $this->db->select('cod_pro,provincia');
        $this->db->from('ubigeo');
		//$this->db->where('idusuario', $this->idUser);
		$this->db->where($where);
        $this->db->order_by('cod_pro', 'ASC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
    }
	public function distritos($where)
    {
		$this->db->distinct();
        $this->db->select('cod_dis,distrito');
        $this->db->from('ubigeo');
		//$this->db->where('idusuario', $this->idUser);
		$this->db->where($where);
        $this->db->order_by('cod_dis', 'ASC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
    }
	public function latLng($where){
		$this->db->select('latitud,longitud');
        $this->db->from('lista_ubigeo');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function ubigeo($where)
    {
		$this->db->distinct();
        $this->db->select('*');
        $this->db->from('ubigeo');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
    }
}