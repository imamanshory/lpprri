<?php

	class Model_laporan extends CI_Model{
		public function insertLaporan(){
			$data = [
				'lap_nip' => htmlspecialchars($this->input->post('nip', true)),
				'lap_kegiatan' => htmlspecialchars($this->input->post('kegiatan', true)),
				'lap_tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
				'lap_jam_mulai' => htmlspecialchars($this->input->post('jam_mulai', true)),
				'lap_jam_selesai' => htmlspecialchars($this->input->post('jam_selesai', true)),
				'lap_satuan_kegiatan' => htmlspecialchars($this->input->post('satuan_kegiatan', true)),
				'lap_jumlah_satuan' => htmlspecialchars($this->input->post('jumlah_satuan', true)),
				'lap_tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan', true)),
				'lap_penyelenggara' => htmlspecialchars($this->input->post('penyelenggara', true)),
				'lap_keterangan' => htmlspecialchars($this->input->post('keterangan', true))
			];

			if( $this->db->insert('laporan', $data) ){
				$jam_mulai   = htmlspecialchars($this->input->post('jam_mulai', true));
				$jam_selesai = htmlspecialchars($this->input->post('jam_selesai', true));
				$jamkerja    = substr($jam_selesai, 0, 2) - substr($jam_mulai, 0, 2);
				// var_dump($jamkerja);die;

				
			}
		}

		public function editLaporan(){
			$datalama = $this->db->get_where('laporan', ['lap_id' => $this->input->post('id')])->row_array();
			
			$data = [
				'lap_nip' => htmlspecialchars($this->input->post('nip', true)),
				'lap_kegiatan' => htmlspecialchars($this->input->post('kegiatan', true)),
				'lap_tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
				'lap_jam_mulai' => htmlspecialchars($this->input->post('jam_mulai', true)),
				'lap_jam_selesai' => htmlspecialchars($this->input->post('jam_selesai', true)),
				'lap_satuan_kegiatan' => htmlspecialchars($this->input->post('satuan_kegiatan', true)),
				'lap_jumlah_satuan' => htmlspecialchars($this->input->post('jumlah_satuan', true)),
				'lap_tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan', true)),
				'lap_penyelenggara' => htmlspecialchars($this->input->post('penyelenggara', true)),
				'lap_keterangan' => htmlspecialchars($this->input->post('keterangan', true))
			];

			$this->db->where('lap_id', $this->input->post('id'));
			$this->db->update('laporan', $data);

			

				
		}

		public function getAllLaporanPerPag($limit, $start, $id){
			$tgl = $this->input->post('tanggal');
			if( empty($tgl) ){
				$this->db->where('lap_nip', $id);
				$this->db->order_by('lap_tanggal', 'DESC');
				$query = $this->db->get('laporan', $limit, $start);
				return $query->result_array();
			} else {
				$this->db->where('lap_nip', $id);
				$this->db->where('lap_tanggal', $tgl);
				$query = $this->db->get('laporan', $limit, $start);
				return $query->result_array();
			}
		}

		public function getAllLaporanPerHari($id){
			if( !empty( $this->input->post('tanggal') ) ){
				$this->db->where('lap_tanggal', $this->input->post('tanggal'));
			} else {
				$this->db->where('lap_tanggal', date('Y-m-d'));
			}

			$this->db->where('lap_nip', $id);
			$this->db->order_by('lap_jam_mulai', 'ASC');
			$query = $this->db->get('laporan');
			return $query->result_array();
		}

		




		// Method ini Masih Bermasalah
		public function getAllLaporanPerbulan($id){
			if( !empty( $this->input->post('tanggal') ) ){
				$thn = date("Y");
				$bln = $this->input->post('tanggal');
				$tgl = $thn."-".$bln;
				$this->db->where('lap_tanggal');
			} else {
				$this->db->where('lap_tanggal', date('Y-m'));
			}
			

			return $query;
		}

		public function getAllLaporanById($id){
			$tgl = $this->input->post('tanggal');
			if( !empty($tgl) ){
				$this->db->where("lap_nip = $id");
				$this->db->where("lap_tanggal = $tgl");
				$this->db->order_by('lap_tanggal', 'DESC');
				$query = $this->db->get('laporan');
				return $query->result_array();
			} else {
				$this->db->where("lap_nip = $id");
				$this->db->order_by('lap_tanggal', 'DESC');
				$query = $this->db->get('laporan');
				return $query->result_array();
			}
		}

		public function hapusById($id){
			$datalap = $this->db->get_where('laporan', ['lap_id' => $id])->row_array();
			
			if( empty($cekrek) ){
				$this->db->where('lap_id', $id);
				$this->db->delete('laporan');
			} else {
				$jamlap   = $datalap['lap_jam_selesai'] - $datalap['lap_jam_mulai'];
				if($jamlap < $cekrek['rekap_jamkerja']){
					$jamkerja = $cekrek['rekap_jamkerja'] - $jamlap;
				} else {
					$jamkerja = $jamlap - $cekrek['rekap_jamkerja'];
				}
				$this->db->where('rekap_tanggal', $datalap['lap_tanggal']);
				$this->db->where('rekap_nip', $datalap['lap_nip']);
				$ur = $this->db->update('rekap', ['rekap_jamkerja' => $jamkerja]);

				$this->db->query("DELETE FROM laporan WHERE lap_id = $id");
			}
		}
	}