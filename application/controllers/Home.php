<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


	public function index()
	{
		$data['judul'] = 'HOME';
		$this->load->view('templates/header.php', $data);
		$this->load->view('home/home.php');
		$this->load->view('templates/footer.php');
	}
}