<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detiljual extends REST_Controller {

    // public function List_DetilJual() {
	// 	return Validation::validate($this, 'user', '', function($token, $output)
	// 	{
	// 		if ( $token == false){
	// 			$output['pesan'] = 'Periksa kembali token';
	// 			return $output;
	// 		}else {
    //             $id_jual = $this->input->post('id_jual');
    //             if ($id_jual == '') {
    //                 $output = $this->db->get('detiljual')->result();
    //             } else {
    //                 $this->db->where('id_jual', $id_jual);
    //                 $output = $this->db->get('detiljual')->result();
    //             }
	// 			return $output;
	// 		}
		
	// 	});
    // }

    public function List_DetilJual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id_jual = $this->input->post('id_jual');

                // $query = "SELECT * FROM barang ORDER BY nm_brg";

                if( $id_jual == ''){
                    $query = "SELECT * FROM jual
                    INNER JOIN customer
                    ON jual.id_cust = customer.id_cust
                    INNER JOIN detiljual
                    ON jual.id_jual = detiljual.id_jual";
    
                    $result = mysqli_query($konek,$query);
                    
                    $array = array();
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $array[] = $row;
                    }
                    
                    ($result) ?
                    json_encode(array("kode" => 1, "result"=> $array, "message" => "Data ditemukan")):
                    json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
    
                    $output = $array;
                }else {
                    $query = "SELECT * FROM jual
                    INNER JOIN customer
                    ON jual.id_cust = customer.id_cust WHERE id_jual='$id_jual'";
    
                    $result = mysqli_query($konek,$query);
                    
                    $array = array();
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $array[] = $row;
                    }
                    
                    ($result) ?
                    json_encode(array("kode" => 1, "result"=> $array, "message" => "Data ditemukan")):
                    json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
    
                    $output = $array;
                }
              
				return $output;
			}
		
		});
    }

    public function List_DetilJualPlusBarang() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{

			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id_jual = $this->input->post('id_jual');
                if( $id_jual == '') {
                    echo json_encode(array('kode' => 0,'pesan' => 'id_jual tidak boleh kosong'));
                }else {
                    $query = "SELECT * FROM detiljual
                    INNER JOIN cartproduk
                    ON detiljual.id_cart = cartproduk.id_cart
                    INNER JOIN barang
                    ON cartproduk.kd_brg = barang.kd_brg WHERE id_jual='$id_jual'";

                    $result = mysqli_query($konek,$query);
                                
                    $array = array();

                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $array[] = $row;
                    }
                    // echo ($result) ?
                    // json_encode(array("kode" => 1, "detiljual"=> $array, "message" => "Data ditemukan")):
                    // json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
                    $result = $array;
                    $output = $result;
                    return $output;
                }
              
			}
		});
    }
    
    public function Tambah_DetilJual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $data = array(
                    'id_jual'         => $this->input->post('id_jual'),
                    'id_cart'         => $this->input->post('id_cart'),
                    'total'         => $this->input->post('total'));
                $insert = $this->db->insert('detiljual', $data);
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
    
    public function Update_DetilJual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_jual = $this->input->post('id_jual');
                $data = array(
                    'id_jual'         => $this->input->post('id_jual'),
                    'id_cart'         => $this->input->post('id_cart'),
                    'total'         => $this->input->post('total'));
                $this->db->where('id_jual', $id_jual);
                $update = $this->db->update('detiljual', $data);
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
    
    public function Delete_DetilJual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_jual = $this->input->post('id_jual');
                $this->db->where('id_jual', $id_jual);
                $delete = $this->db->delete('detiljual');
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