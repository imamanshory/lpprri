<?php

	class Model_user extends CI_Model{
		public function insertUser(){
			$data = [
				'user_nip' => htmlspecialchars($this->input->post('nip', true)),
				'user_status' => htmlspecialchars($this->input->post('status', true)),
				'user_kata_sandi' => password_hash($this->input->post('kata_sandi'), PASSWORD_DEFAULT)
			];

			$this->db->insert('users', $data);
		}

		public function updateSandiUser($id){
			$data = [
				'user_kata_sandi' => password_hash($this->input->post('ceksandibaru', true), PASSWORD_DEFAULT)
			];

			$this->db->where('user_nip', $id);
			$this->db->update('users', $data);
		}

		public function getAllUserById($id){
			$this->db->where("user_nip = $id");
			$query = $this->db->get('users');
			return $query->result_array();
		}

		public function getAllUserByEmail($email){
			
			return $this->db->select('*')
							->from('users')
							->where('email', $email)
							->get()->row_array();
		}

		public function insertToken($data){
			
			$this->db->insert('users_token', $data);
		}

		public function getToken($email, $token){
			
			return $this->db->select('*')
							->from('users_token')
							->where(['email' => $email, 'token' => $token])
							->get()->row_array();
		}


  }
