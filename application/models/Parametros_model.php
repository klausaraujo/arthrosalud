<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Parametros_model extends CI_Model
{    
	public function __construct(){ parent::__construct(); }
    
	public function querysqlwhere($q,$t,$where)
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
		if ($this->db->insert($t, $data)){
			return $this->db->insert_id();
		}else return 0;
	}
	public function validar($q,$t,$where)
	{
		$query = $this->db->select($q)->from($t)->where($where)->get();
		return $query->num_rows() > 0? $query->result() : array();
	}
}