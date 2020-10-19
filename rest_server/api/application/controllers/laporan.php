<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan extends REST_Controller {

    public function List_Laporan() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
                if ($id == '') {
                    $output = $this->db->get('laporan')->result();
                } else {
                    $this->db->where('id', $id);
                    $output = $this->db->get('jual')->result();
                }
				return $output;
			}
		
		});
    }
    
    public function Tambah_Laporan() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $data = array(
                    'id'         => $this->input->post('id'),
                    'id_jual'         => $this->input->post('id_jual'),
                    'pendapatan'         => $this->input->post('pendapatan'),
                    'tgl'         => $this->input->post('tgl'));
                $insert = $this->db->insert('laporan', $data);
                $data['message'] = "Data berhasil ditambahkan";
                if ($insert) {
                    $output = $data;
                } else {
                    $output = ['status' => 'fail'];
                }
				return $output;
			}
		
		});
    }
    
    public function Update_Laporan() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
                $data = array(
                    'id'         => $this->input->post('id'),
                    'id_jual'         => $this->input->post('id_jual'),
                    'pendapatan'         => $this->input->post('pendapatan'),
                    'tgl'         => $this->input->post('tgl'));
                $this->db->where('id', $id);
                $update = $this->db->update('laporan', $data);
                $data['message'] = "Data berhasil diupdate";
                if ($update) {
                    $output = $data;
                } else {
                    $output = ['status' => 'fail'];
                }
				return $output;
			}
		
		});
    }
    
    public function Delete_Laporan() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
                $this->db->where('id', $id);
                $delete = $this->db->delete('laporan');
                if ($delete) {
                    $output = ['status' => 'Berhasil dihapus'];
                } else {
                    $output = ['status' => 'Gagal dihapus'];
                }
				return $output;
			}
		
		});
	}

}