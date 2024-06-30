<?php

	class Model_token extends CI_Model{

		public function insertToken(){
			$data = [
				'email' => htmlspecialchars($this->input->post('email', true)),
				'token' => htmlspecialchars($this->input->post('token', true)),
				'date_create' => htmlspecialchars($this->input->post('date_create', true))
			];
			$this->db->insert('user_token', $data);
		}

		public function getToken($email, $token){
			
			return $this->db->select('*')
							->from('users_token')
							->where(['email' => $email, 'token' => $token])
							->get()->row_array();
		}

		}
	