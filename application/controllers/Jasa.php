<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends CI_Controller
{

	public function index()
	{
		$data['judul'] = 'JASA';
		$this->load->view('templates/header', $data);
		$this->load->view('jasa/index');
		$this->load->view('templates/footer');
	}
}