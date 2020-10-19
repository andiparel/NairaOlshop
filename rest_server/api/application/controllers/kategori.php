<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kategori extends REST_Controller {

    public function List_Kategori() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_kat = $this->input->post('id_kat');
                if ($id_kat == '') {
                    $output = $this->db->get('kategori')->result();
                } else {
                    $this->db->where('id_kat', $id_kat);
                    $output = $this->db->get('kategori')->result();
                }
				return $output;
			}
		
		});
    }
    
    public function Tambah_Kategori() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $data = array(
                    'id_kat'         => $this->input->post('id_kat'),
                    'nm_kat'         => $this->input->post('nm_kat'));
                if( $data['nm_kat'] == '')
                {
                    $output = ['Message' => 'id_kat dan nm_kat perlu di isi'];
                }else {
                    $insert = $this->db->insert('kategori', $data);
                    $data['message'] = "Data berhasil ditambahkan";
                    if ($insert) {
                        $output = $data;
                    } else {
                        $output = ['status' => 'fail'];
                    }
                }
				return $output;
			}
		
		});
    }
    
    public function Update_Kategori() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_kat = $this->input->post('id_kat');
                $data = array(
                            'id_kat'       => $this->input->post('id_kat'),
                            'nm_kat'          => $this->input->post('nm_kat'));
                if( $data['id_kat'] == '' || $data['nm_kat'] == '')
                {
                    $output = ['Message' => 'id_kat dan nm_kat perlu di isi'];
                }else{
                    $this->db->where('id_kat', $id_kat);
                    $update = $this->db->update('kategori', $data);
                    $data['message'] = "Data berhasil diupdate";
                    if ($update) {
                        $output = $data;
                    } else {
                        $output = ['status' => 'fail'];
                    }
                }
				return $output;
			}
		
		});
    }
    
    public function Delete_Kategori() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_kat = $this->input->post('id_kat');
                if ($id_kat == '') {
                    $output = ['Message' => 'id_kat perlu di isi'];
                }else {
                    $this->db->where('id_kat', $id_kat);
                    $delete = $this->db->delete('kategori');
                    if ($delete) {
                        $output = ['Message' => 'Berhasil dihapus'];
                    } else {
                        $output = ['status' => 'Gagal, id_kat tidak ada'];
                    }
                }
				return $output;
			}
		
		});
	}

}