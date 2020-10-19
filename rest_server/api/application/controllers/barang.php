<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class barang extends REST_Controller {

	public function List_Barang() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $kd_brg = $this->input->post('kd_brg');
                if ($kd_brg == '') {
                    $output = $this->db->get('barang')->result();
                } else {
                    $this->db->where('kd_brg', $kd_brg);
                    $output = $this->db->get('barang')->result();
                }
				return $output;
			}
		});
    }
    
    public function Tambah_Barang() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $data = array(
                    'kd_brg'         => $this->input->post('kd_brg'),
                    'nm_brg'         => $this->input->post('nm_brg'),
                    'stok'         => $this->input->post('stok'),
                    'harga'         => $this->input->post('harga'),
                    'foto'         => $this->input->post('foto'),
                    'berat'         => $this->input->post('berat'),
                    'deskripsi'         => $this->input->post('deskripsi'),
                    'id_kat'         => $this->input->post('id_kat'));
                if ( $data['nm_brg'] == '' ||$data['stok'] == '' )
                    {
                        $output = ['Message' => 'Gagal, inputan data harus lengkap, nm_brg, stok, harga, foto, berat, id_kat'];
                    }else {
                        $insert = $this->db->insert('barang', $data);
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
    
    public function Update_Barang() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $kd_brg = $this->input->post('kd_brg');
                $data = array(
                    'kd_brg'         => $this->input->post('kd_brg'),
                    'nm_brg'         => $this->input->post('nm_brg'),
                    'stok'         => $this->input->post('stok'),
                    'harga'         => $this->input->post('harga'),
                    'foto'         => $this->input->post('foto'),
                    'berat'         => $this->input->post('berat'),
                    'deskripsi'         => $this->input->post('deskripsi'),
                    'id_kat'         => $this->input->post('id_kat'));

                if ( $kd_brg == ''){
                    $output = ['message' => 'kd_brg harus di isi'];
                }else {
                    if ( $data['nm_brg'] == '' ||$data['stok'] == '' || $data['harga'] == '' || $data['foto'] == '' ||
                    $data['berat'] == '' ||$data['deskripsi'] == '' ||$data['id_kat'] == '') {
                        $output = ['message' => 'Gagal, inputan data harus lengkap, nm_brg, stok, harga, foto, berat, deskripsi, id_kat'];
                    }else {
                        $this->db->where('kd_brg', $kd_brg);
                        $update = $this->db->update('barang', $data);
                        $data['message'] = "Data berhasil diupdate";
                        if ($update) {
                            $output = $data;
                        } else {
                            $output = ['status' => 'fail'];
                        }
                    }
                } 
				return $output;
			}
		
		});
    }
    
    public function Delete_Barang() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $kd_brg = $this->input->post('kd_brg');
                if ( $kd_brg == '') {
                    $output = ['Message' => 'kd_brg harus di isi'];
                }else {
                    $this->db->where('kd_brg', $kd_brg);
                    $delete = $this->db->delete('barang');
                    if ($delete) {
                        $output = ['status' => 'Berhasil dihapus'];
                    } else {
                        $output = ['status' => 'Gagal dihapus'];
                    }
                }
				return $output;
			}
		
		});
	}

}