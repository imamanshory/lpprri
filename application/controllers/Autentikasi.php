<?php

	class Autentikasi extends CI_Controller {

		public function _construct(){
			parent::_construct();
			 $this->load->library("session");
    $this->load->helper('url');
			$this->library('form_validation');
			$this->load->model('Model_user');
			$this->load->model('Model_token');
		}

		public function index(){
			if ($this->session->has_userdata('user')) {
				redirect(base_url('home/index'));
			}

			$this->form_validation->set_rules('nip', 'NIP', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('sandi', 'Sandi', 'required|trim|min_length[5]');

			if($this->form_validation->run() == false) {
				$this->load->view('masuk');
			} else {
				$nip = $this->input->post('nip');
				$sandi = $this->input->post('sandi');

				$user = $this->db->get_where('users', ['user_nip' => $nip])->row_array();

				if($user){
					if(password_verify($sandi, $user['user_kata_sandi'])){
						$this->session->set_userdata('user', $user['user_nip']);
						$this->session->set_userdata('status', $user['user_status']);
						
						redirect(base_url('home/index'));
					} else {
						$this->session->set_flashdata('pesan', '<div class="callout callout-danger"><h4><b>Gagal !</b></h4> Kata sandi Salah</div>');
						redirect(base_url('autentikasi/index'));
					}
				} else {
					$this->session->set_flashdata('pesan', '<div class="callout callout-danger"><h4><b>Gagal !</b></h4> NIP Salah atau belum terdaftar</div>');
					redirect(base_url('autentikasi/index'));
				}
			}
		}

		public function keluar(){
			if (!$this->session->has_userdata('user')) {
				redirect(base_url('autentikasi/index'));
			}

			$this->session->unset_userdata('user');
			$this->session->unset_userdata('status');
			
			redirect(base_url('autentikasi/index'));
		}

		public function lupasandi(){
			
			redirect(base_url('autentikasi/lupa'));
		}

		public function lupa(){

			$this->load->view('pengguna/lupa');

		}

		public function konfirm(){

			

			$this->form_validation->set_rules('email', 'Email Address', 'required');

			if ($this->form_validation->run() == false) {
				$data['title'] = 'Forget Password';
				$this->load->view('pengguna/lupa', $data);
			}
			else{
				$email = $this->input->post('email');
				$user = $this->Model_user->getAllUserByEmail($email);
				
			}

			if ($user) {
				
				$token = base64_encode(random_bytes(32));

				$data = [
					'email' => $email,
					'token' => $token,
					'date_create' => time()
				];

				$insert = $this->Model_user->insertToken($data);

				if ($insert) {

					$sendemail = $this->_sendEmail($token);

					if ($sendemail) {
						echo "string";
						# code...
					}
				}
				else{
					echo "gagal";
				}
			}
			else{

				$this->session->set_flashdata('pesan', '<div class="callout callout-danger"><h4><b>Gagal !</b></h4> Email Salah atau belum terdaftar</div>');
				redirect(base_url('autentikasi/lupa'));

			}



		}

		private function _sendEmail($token){

			$config = [
				'protokol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_user' => '',
				'smtp_pass' => '',
				'smtp_post' => '465',
				'mail_type' => 'html',
				'charset' => 'utf-8',
				'newline' => "\r\n"
			];

			$this->load->library('email', $config);
			$this->email->intialize($config);

			$this->email->form('', 'Noreply');
			$this->email->to($this->input->post('email'));

			$this->email->subject('Reset Password');
			$this->email->message('Klik ling di sini untuk ubah password: <a href="' . base_url() . 'autentikasi/resetpassword?email=' . $this->input->post('email') . '&token' . urlencode($token) . '">Reset Password</a>');

			if ($this->email->send()) {
				return true;
			}
			else{
				echo $this->email->print_debuger();
				die;
			}

		}

		

	}
	?>