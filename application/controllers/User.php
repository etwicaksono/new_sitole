<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $email = $this->session->userdata('email');
		// $user = $this->db->get_where('user', ['email' => $email])->row_array();
		// var_dump($user);

		// $this->db->set('foto', 'tes');
		// $this->db->where('email', $email);
		// // $this->db->update('user');
		// if ($this->db->update('user')) {
		// 	echo 'update sukses';
		// 	die;
		// } else {
		// 	echo 'update gagal';
		// 	die;
		// }
	}


	public function index()
	{
		$data['judul'] = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('user/myProfile');
		$this->load->view('templates/footer');
	}

	public function editProfile()
	{
		$data['judul'] = 'Edit Profile';
		$data['user'] = $this->session->userdata();

		$this->form_validation->set_rules('nama', 'Full Name', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('user/editProfile');
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('nama');
			$email = $this->input->post('email');
			$kontak = $this->input->post('kontak');
			$alamat = $this->input->post('alamat');

			//cek jika ada gambar yang diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['foto'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('foto', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('nama_asli', $name);
			$this->db->set('no_hp', $name);
			$this->db->set('alamat', $name);
			$this->db->where('email', $email);
			$this->db->update('user');
			// if ($this->db->update('user')) {
			// 	var_dump($new_image);
			// 	echo 'update sukses';
			// 	die;
			// } else {
			// 	echo 'update gagal';
			// 	die;
			// }

			$user = $this->db->get_where('user', ['email' => $email])->row_array();
			$user = $this->session->set_userdata($user);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
			redirect('user');
		}
	}
}