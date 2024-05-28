<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Citas_model extends CI_Model
{    
	public function __construct(){ parent::__construct(); }
    
	public function listapacientes()
	{
		$this->db->select('p.*,DATE_FORMAT(p.fecnac,"%d/%m/%Y") as fechanac,td.tipo_documento,e.estado_civil');
		$this->db->from('paciente p');
		$this->db->join('tipo_documento td','p.idtipodocumento=td.idtipodocumento');
		$this->db->join('estado_civil e','p.idestadocivil=e.idestadocivil');
		$this->db->where(['p.activo' => 1,'idpaciente>' => 1]);
		$this->db->order_by('p.idpaciente','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaturnos()
	{
		$this->db->select('t.*,c.consultorio,d.departamento,CONCAT(p.nombres," ",p.apellidos) as nprof,m.mes');
		$this->db->from('turnos t');
		$this->db->join('consultorio c','t.idconsultorio=c.idconsultorio');
		$this->db->join('departamento d','t.iddepartamento=d.iddepartamento');
		$this->db->join('profesional p','t.idprofesional=p.idprofesional');
		$this->db->join('mes m','t.idmes=m.idmes');
		$this->db->where(['t.activo' => 1]);
		$this->db->order_by('t.idturno','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listamedicos()
	{
		$this->db->select('p.*,td.tipo_documento,tp.tipo_profesional,e.especialidad');
		$this->db->from('profesional p');
		$this->db->join('tipo_documento td','p.idtipodocumento=td.idtipodocumento');
		$this->db->join('tipo_profesional tp','p.idtipoprofesional=tp.idtipoprofesional');
		$this->db->join('especialidad e','p.idespecialidad=e.idespecialidad');
		$this->db->where(['p.activo' => 1]);
		$this->db->order_by('p.idprofesional','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaconsultorios()
	{
		$this->db->select('c.*,e.nombre_comercial');
		$this->db->from('consultorio c');
		$this->db->join('empresa e','c.idempresa=e.idempresa');
		$this->db->where(['c.activo' => 1]);
		$this->db->order_by('c.idconsultorio','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listacitas($where)
	{
		$this->db->select('t.*,DATE_FORMAT(t.entrada,"%H:%i") as entrada,DATE_FORMAT(t.salida,"%H:%i") as salida,c.consultorio,d.departamento,
			CONCAT(p.nombres," ",p.apellidos) as nprof,CONCAT(pa.nombres," ",pa.apellidos) as npac');
		$this->db->from('citas t');
		$this->db->join('consultorio c','t.idconsultorio=c.idconsultorio');
		$this->db->join('departamento d','t.iddepartamento=d.iddepartamento');
		$this->db->join('profesional p','t.idprofesional=p.idprofesional');
		$this->db->join('paciente pa','t.idpaciente=pa.idpaciente');
		$this->db->where($where);
		$this->db->order_by('t.idcita','ASC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaturno($where)
	{
		$this->db->select('t.*,c.consultorio,d.departamento,p.nombres,p.apellidos,m.mes');
		$this->db->from('turnos t');
		$this->db->join('consultorio c','t.idconsultorio=c.idconsultorio');
		$this->db->join('departamento d','t.iddepartamento=d.iddepartamento');
		$this->db->join('profesional p','t.idprofesional=p.idprofesional');
		$this->db->join('mes m','t.idmes=m.idmes');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
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
		if ($this->db->insert($t, $data)) return $this->db->insert_id();
		else return 0;
	}
	public function borrar($t, $data)
	{
		return $this->db->delete($t, $data);
	}
	public function registrarbatch($t, $data)
	{
		if ($this->db->insert_batch($t, $data)) return 1;
		else return 0;
	}
}