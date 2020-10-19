<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jual extends REST_Controller {

    // public function List_Jual() {
	// 	return Validation::validate($this, 'user', '', function($token, $output)
	// 	{
	// 		if ( $token == false){
	// 			$output['pesan'] = 'Periksa kembali token';
	// 			return $output;
	// 		}else {
    //             $id_jual = $this->input->post('id_jual');
    //             if ($id_jual == '') {
    //                 $output = $this->db->get('jual')->result();
    //             } else {
    //                 $this->db->where('id_jual', $id_jual);
    //                 $output = $this->db->get('jual')->result();
    //             }
	// 			return $output;
	// 		}
		
	// 	});
    // }

    public function List_Jual() {
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
                    ON jual.id_cust = customer.id_cust";
    
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

//    public function List_Jual() {
// 		return Validation::validate($this, 'user', '', function($token, $output)
// 		{
// 			if ( $token == false){
// 				$output['pesan'] = 'Periksa kembali token';
// 				return $output;
// 			}else {
//                 $id_jual = $this->input->post('id_jual');
//                 if ($id_jual == '') {
//                     $output = $this->db->get('jual,customer WHERE')->result();
//                 } else {
//                     $this->db->where('id_jual', $id_jual);
//                     $output = $this->db->get('jual')->result();
//                 }
// 				return $output;
// 			}
		
// 		});
//     }
   
    
    public function Tambah_Jual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $data = array(
                    'id_jual'         => $this->input->post('id_jual'),
                    'tgl_jual'         => $this->input->post('tgl_jual'),
                    'id_cust'         => $this->input->post('id_cust'),
                    'alamat'         => $this->input->post('alamat'),
                    'provinsi'         => $this->input->post('provinsi'),
                    'kota'         => $this->input->post('kota'),
                    'kecamatan'         => $this->input->post('kecamatan'),
                    'kd_pos'         => $this->input->post('kd_pos'),
                    'ongkir'         => $this->input->post('ongkir'),
                    'status'         => $this->input->post('status'));
                if ($data['tgl_jual'] == '' || $data['id_cust'] == '' ||$data['alamat'] == '' ||
                    $data['provinsi'] == '' || $data['kota'] == '' ||$data['kecamatan'] == '' ||
                    $data['kd_pos'] == '' || $data['ongkir'] == '' || $data['status'] == '' )
                    {
                        $output = ['message' => 'Inputan data tidak lengkap'];
                    }else 
                    {
                        $insert = $this->db->insert('jual', $data);
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
    
    public function Update_Jual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_jual = $this->input->post('id_jual');

                $data = array(
                    'id_jual'       =>  $this->input->post('id_jual'),
                    'status'      => 'Dikirim');

                if ($data['id_jual'] == '')
                {
                    $output = ['message' => 'id_jual perlu di isi'];
                }else {
                    $this->db->where('id_jual', $id_jual);
                    $update = $this->db->update('jual', $data);
                    $data['message'] = "Data berhasil diupdate";
                    if ($update) {
                        $output = $data;
                    } else {
                        $output = 'Gagal diupdate';                
                    }
                }
				return $output;
			}
		
		});
    }
    
    public function Delete_Jual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_jual = $this->input->post('id_jual');
                if ($id_jual == '' )
                {
                    $output = ['Message' => 'id_jual perlu di isi'];
                }else {
                    $this->db->where('id_jual', $id_jual);
                    $delete = $this->db->delete('jual');
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