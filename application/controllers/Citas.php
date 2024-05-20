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
	
	public function formpaciente()
	{
		return $this->load->view('main');
	}
	public function formconsultorio()
	{
		return $this->load->view('main');
	}
	public function formmedico()
	{
		return $this->load->view('main');
	}
}