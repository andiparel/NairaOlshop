<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends REST_Controller {

	function Customer() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_cust = $this->input->post('id_cust');
				if ($id_cust == '') {
					$customer = $this->db->get('customer')->result_array();
				} else {
					$this->db->where('id_cust', $id_cust);
					$customer = $this->db->get('customer')->result_array();
				}
				$data['message'] = "Data ditemukan";
				$output = $customer;
				return $output;
			}
		});
	}
	function TambahCustomer() {
		$this->form_validation->set_rules('email', 'inputan email salah','valid_email|max_length[256]');
		$this->form_validation->set_rules('password', 'password terlalu panjang','max_length[256]');

		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
				$data = array(
							'id_cust'      => $this->input->post('id_cust'),
							'nama'         => $this->input->post('nama'),
							'email'      => $this->input->post('email'),
							'password'      =>$this->input->post('password'),
							'notelp'      => $this->input->post('notelp'));
				if ($data['nama'] == ''|| $data['email'] == '' || $data['password'] == '' || $data['password'] == '')
				{
					$customer = ['message' => 'Data perlu di isi semua, Nama , Email , Password, Notelp'];
				}else {
					$update = $this->db->insert('customer', $data);
					$data['message'] = "Data berhasil ditambahkan";
					if ($update) {
						$customer = $data;
					} else {
						$customer = ['status' => 'fail'];
					}
				}
				$output = $customer;
				return $output;
			}
		});
    }

	function HapusCustomer() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
				$id_cust = $this->input->post('id_cust');
				if( $id_cust == ''){
					$customer = ['id_cust perlu di isi'];
				}else{
					$this->db->where('id_cust', $id_cust);
					$delete = $this->db->delete('customer');
					if ($delete) {
						$customer = ['Berhasil dihapus'];
					} else {
						$customer = ['Gagal dihapus, id_cust tidak ada'];
					}
				}
				$output = $customer;
				return $output;
			}
		});
	}
	
	function UpdateCustomer() {
		$this->form_validation->set_rules('email', 'inputan email salah','valid_email|max_length[256]');
		$this->form_validation->set_rules('password', 'password terlalu panjang','max_length[256]');

		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_cust = $this->input->post('id_cust');
				$data = array(
							'id_cust'      => $this->input->post('id_cust'),
							'nama'         => $this->input->post('nama'),
							'email'      => $this->input->post('email'),
							'password'      =>$this->input->post('password'),
							'notelp'      => $this->input->post('password'));
				if ( $id_cust == ''){
					$customer = ['message' => 'Id_cust perlu di isi'];
					} if ($data['nama'] == ''|| $data['email'] == '' || $data['password'] == '' || $data['password'] == '') {
						$customer = ['message' => 'Data perlu di isi semua, Nama , Email , Password, Notelp'];
					}else {
						$this->db->where('id_cust', $id_cust);
						$update = $this->db->update('customer', $data);
						$data['message'] = "Data berhasil diubah";
						if ($update) {
							$customer = $data;
						} else {
							$customer = ['status' => 'fail'];
						}
					}
				$output = $customer;
				return $output;
			}
		});
	}
	
}