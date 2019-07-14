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
				'is_active' => 0,
				'date_created' => time()
			];

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', mk_alert('Registrasi berhasil. Silahkan buka email anda untuk mengaktifkan akun.', 'success col-lg-6 mx-auto text-center'));
			redirect('auth/login');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol'      => 'smtp',
			'smtp_host'     => 'ssl://smtp.googlemail.com',
			'smtp_user'     => 'sitole2019@gmail.com',
			'smtp_pass'     => 'gokugoku',
			'smtp_port'     => 465,
			'mailtype'      => 'html',
			'charset'       => 'utf-8',
			'newline'       => "\r\n"
		];

		//$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('sitole2019@gmail.com', 'Sitole');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to activate your account: <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password: <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		// $our_server = 'smtp.googlemail.com';
		// ini_set('SMTP', $our_server);

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created']   < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', mk_alert($email . ' telah berhasil diaktifkan, silahkan login', 'success col-lg-6 mx-auto text-center'));
					redirect('auth/login');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_t oken', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
					$this->session->set_flashdata('message', mk_alert('Aktivasi akun gagal, token kadaluarsa.', 'danger col-lg-6 mx-auto text-center'));
					redirect('auth/login');
				}
			} else {
				$this->session->set_flashdata('message', mk_alert('Aktivasi akun gagal, token salah.', 'success col-lg-6 mx-auto text-center'));
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message', mk_alert('Aktivasi akun gagal, email salah.', 'success col-lg-6 mx-auto text-center'));
			redirect('auth/login');
		}
	}


	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
				redirect('auth/forgotpassword');
			}
		}
	}


	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
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