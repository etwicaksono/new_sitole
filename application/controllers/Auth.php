<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


	public function index()
	{
		redirect(base_url('auth/login'));
	}

	public function registrasi()
	{
		$this->form_validation->set_rules('nama', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password is too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Registration Page';
			$this->load->view('templates/header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'nama_asli' => htmlspecialchars($this->input->post('nama', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'email' => htmlspecialchars($email),
				'foto' => 'default.jpg',
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', mk_alert('Selamat! Registrasi anda berhasil', 'success col-lg-6 mx-auto text-center'));
			redirect('auth/login');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Login Page';
			$this->load->view('templates/header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		//cek apakah usernya ada
		if ($user) {

			//cek apakah usernya aktif
			if ($user['is_active'] == 1) {
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					$this->session->set_flashdata('message', mk_alert('Selamat datang ' . $user['nama_asli'], 'success col-lg-6 mx-auto mt-5 text-center'));
					redirect('home/index');
				} else {
					$this->session->set_flashdata('message', mk_alert('Password salah!', 'danger col-lg-4 mx-auto text-center'));
					redirect('auth/login');
				}
			} else {
				$this->session->set_flashdata('message', mk_alert('Akun ini belum diaktifkan!', 'danger col-lg-4 mx-auto text-center'));
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message', mk_alert('Email ini belum terdaftar!', 'danger col-lg-4 mx-auto text-center'));
			redirect('auth/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', mk_alert('Anda berhasil logout.', 'success col-lg-4 mx-auto text-center'));
		redirect('auth/login');
	}
}