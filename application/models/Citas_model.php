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
	public function paciente($where)
	{
		$this->db->select('p.*,DATE_FORMAT(p.fecnac,"%d/%m/%Y") as fecnac,td.tipo_documento,e.estado_civil');
		$this->db->from('paciente p');
		$this->db->join('tipo_documento td','p.idtipodocumento=td.idtipodocumento');
		$this->db->join('estado_civil e','p.idestadocivil=e.idestadocivil');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function listaturnos($where)
	{
		$this->db->select('t.*,c.consultorio,e.nombre_comercial,d.departamento,CONCAT(p.apellidos," ",p.nombres) as nprof,m.mes');
		$this->db->from('turnos t');
		$this->db->join('consultorio c','t.idconsultorio=c.idconsultorio');
		$this->db->join('empresa e','c.idempresa=e.idempresa');
		$this->db->join('departamento d','t.iddepartamento=d.iddepartamento');
		$this->db->join('profesional p','t.idprofesional=p.idprofesional');
		$this->db->join('mes m','t.idmes=m.idmes');
		$this->db->where($where);
		$this->db->order_by('t.idturno','ASC');
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
	public function medico($where)
	{
		$this->db->select('p.*,td.tipo_documento,tp.tipo_profesional,e.especialidad');
		$this->db->from('profesional p');
		$this->db->join('tipo_documento td','p.idtipodocumento=td.idtipodocumento');
		$this->db->join('tipo_profesional tp','p.idtipoprofesional=tp.idtipoprofesional');
		$this->db->join('especialidad e','p.idespecialidad=e.idespecialidad');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function listaprofdash()
	{
		$this->db->select('p.*,td.tipo_documento,tp.tipo_profesional,e.especialidad');
		$this->db->from('profesional p');
		$this->db->join('tipo_documento td','p.idtipodocumento=td.idtipodocumento');
		$this->db->join('tipo_profesional tp','p.idtipoprofesional=tp.idtipoprofesional');
		$this->db->join('especialidad e','p.idespecialidad=e.idespecialidad');
		$this->db->where(['p.activo' => 1,'tp.idtipoprofesional' => 1,'atencion_consultorio' => 1]);
		$this->db->order_by('p.apellidos','ASC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listaconsultorios($where)
	{
		$this->db->select('c.*,e.nombre_comercial');
		$this->db->from('consultorio c');
		$this->db->join('empresa e','c.idempresa=e.idempresa');
		$this->db->where($where);
		$this->db->order_by('c.idconsultorio','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listacitas($where)
	{
		$this->db->select('t.*,DATE_FORMAT(t.entrada,"%H:%i") as entrada,DATE_FORMAT(t.salida,"%H:%i") as salida,c.consultorio,d.departamento,
			CONCAT(p.apellidos," ",p.nombres) as nprof,CONCAT(pa.apellidos," ",pa.nombres) as npac,e.nombre_comercial');
		$this->db->from('citas t');
		$this->db->join('consultorio c','t.idconsultorio=c.idconsultorio');
		$this->db->join('empresa e','c.idempresa=e.idempresa');
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
	public function listahistorias()
	{
		$this->db->select('h.*,DATE_FORMAT(h.fecha_registro,"%d/%m/%Y") as freg,CONCAT(p.apellidos," ",p.nombres) as nombres,p.numero_documento,ec.estado_civil,t.tipo_documento');
		$this->db->from('historia_clinica h');
		$this->db->join('paciente p','p.idpaciente=h.idpaciente');
		$this->db->join('tipo_documento t','p.idtipodocumento=t.idtipodocumento');
		$this->db->join('estado_civil ec','ec.idestadocivil=p.idestadocivil');
		$this->db->where(['h.activo' => 1]);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listardiag($where)
	{
		$this->db->select('hd.idcie10,hd.tipo,c.cie10,c.descripcion_cie10');
		$this->db->from('historia_clinica_atenciones_diagnostico hd');
		$this->db->join('cie10 c','c.idcie10=hd.idcie10');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listarproc($where)
	{
		$this->db->select('hp.idprocedimiento,hp.indicaciones,hp.estado,hp.avatar,p.procedimiento,tp.tipo_procedimiento');
		$this->db->from('historia_clinica_atenciones_procedimientos hp');
		$this->db->join('procedimiento p','p.idprocedimiento=hp.idprocedimiento');
		$this->db->join('tipo_procedimiento tp','p.idtipoprocedimiento=tp.idtipoprocedimiento');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function lprocedimientos()
	{
		$this->db->select('p.*,tp.tipo_procedimiento');
		$this->db->from('procedimiento p');
		$this->db->join('tipo_procedimiento tp','p.idtipoprocedimiento=tp.idtipoprocedimiento');
		$this->db->where('p.activo',1);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function listarprocedimientos($where)
	{
		$this->db->select('hi.idarticulo,hi.cantidad,hi.indicaciones,a.descripcion');
		$this->db->from('historia_clinica_atenciones_indicaciones hi');
		$this->db->join('articulos a','a.idarticulo=hi.idarticulo');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function historia($where)
	{
		$this->db->select('h.*,DATE_FORMAT(h.fecha_registro,"%d/%m/%Y") as fecha,p.*,DATE_FORMAT(p.fecnac,"%d/%m/%Y") as fecnac,tp.tipo_documento,estado_civil');
		$this->db->from('historia_clinica h');
		$this->db->join('paciente p','h.idpaciente=p.idpaciente');
		$this->db->join('tipo_documento tp','p.idtipodocumento=tp.idtipodocumento');
		$this->db->join('estado_civil ec','p.idestadocivil=ec.idestadocivil');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->row() : array();
	}
	public function atenciones($where)
	{
		$this->db->select('h.*,DATE_FORMAT(fecha_atencion,"%d/%m/%Y") as fecha,CONCAT(p.apellidos," ",p.nombres) as nombres,e.razon_social');
		$this->db->from('historia_clinica_atenciones h');
		$this->db->join('profesional p','h.idprofesional=p.idprofesional');
		$this->db->join('consultorio c','h.idconsultorio=c.idconsultorio');
		$this->db->join('empresa e','c.idempresa=e.idempresa');
		$this->db->where($where);
		$this->db->order_by('h.idatencion','DESC');
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function diagnosticos($where)
	{
		$this->db->select('hd.*,c.cie10,c.descripcion_cie10');
		$this->db->from('historia_clinica_atenciones_diagnostico hd');
		$this->db->join('cie10 c','c.idcie10=hd.idcie10');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function proc($where)
	{
		$this->db->select('hd.*,c.correlativo,c.procedimiento');
		$this->db->from('historia_clinica_atenciones_procedimientos hd');
		$this->db->join('procedimiento c','c.idprocedimiento=hd.idprocedimiento');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function examenes($where)
	{
		$this->db->select('hd.*,c.correlativo,c.examen_auxiliar');
		$this->db->from('historia_clinica_atenciones_examenes hd');
		$this->db->join('examenes_auxiliares c','c.idexamenauxiliar=hd.idexamenauxiliar');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function indic($where)
	{
		$this->db->select('hd.*,c.*');
		$this->db->from('historia_clinica_atenciones_indicaciones hd');
		$this->db->join('articulos c','c.idarticulo=hd.idarticulo');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function detallereceta($where)
	{
		$this->db->select('rmd.*,a.descripcion');
		$this->db->from('receta_medica_detalle rmd');
		$this->db->join('articulos a','a.idarticulo=rmd.idarticulo');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function diagnostico($where)
	{
		$this->db->select('rmd.*,a.cie10,a.descripcion_cie10');
		$this->db->from('receta_medica_dx rmd');
		$this->db->join('cie10 a','a.idcie10=rmd.idcie10');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function detalleorden($where)
	{
		$this->db->select('oed.*,ea.correlativo,ea.examen_auxiliar');
		$this->db->from('orden_examenes_detalle oed');
		$this->db->join('examenes_auxiliares ea','ea.idexamenauxiliar=oed.idexamenauxiliar');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
	}
	public function validaturno($where)
	{
		$this->db->select('e.idempresa');
		$this->db->from('turnos t');
		$this->db->join('consultorio c','t.idconsultorio=c.idconsultorio');
		$this->db->join('empresa e','c.idempresa=e.idempresa');
		$this->db->where($where);
		$result = $this->db->get();
		return ($result->num_rows() > 0)? $result->result() : array();
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
	public function borrar($t, $data)
	{
		return $this->db->delete($t, $data);
	}
	public function registrarbatch($t, $data)
	{
		if ($this->db->insert_batch($t, $data)) return 1;
		else return 0;
	}
	public function actualizar($t, $data, $where)
	{
		//$this->db->db_debug = TRUE;
		$this->db->where($where);
		if($this->db->update($t, $data)) return true;
        else return false;
	}
}