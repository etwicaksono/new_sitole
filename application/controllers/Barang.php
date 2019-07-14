<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	public function index()
	{
        $data['judul'] = 'BARANG';
		$this->load->view('templates/header',$data);
		$this->load->view('barang/index');
		$this->load->view('templates/footer');
    }
}