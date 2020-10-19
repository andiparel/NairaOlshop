<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends REST_Controller {


	function CekAdmin() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
				require_once 'utils/koneksi.php';

				// $kd_brg   	= $this->input->post('kd_brg');
                $email = $this->input->post('email');
				$password = $this->input->post('password');
				
				$sql = "SELECT * FROM admin WHERE email='$email'";
    
                $response = mysqli_query($konek, $sql);
    
                $result = array();
    
                if( mysqli_num_rows($response) === 1 ){
                    
                    $row = mysqli_fetch_assoc($response);
    
                    if( password_verify($password, $row['password']) ){
						$index = 'Login Sukses';
                        array_push( $result, $index);
    
                     
                        // echo json_encode($result);
    
                        // mysqli_close($conn);
                    }else {
    
                        $result['success'] = "0";
                        $result['message'] = "error";
                        // echo json_encode($result);
    
                        // mysqli_close($conn);
                    }
                }
			
				$output = $result;
				return $output;
			}
		});
	}
	
	// function CekAdmin() {
	// 	return Validation::validate($this, 'user', '', function($token, $output)
	// 	{
	// 		if ( $token == false){
	// 			$output['pesan'] = 'Periksa kembali token';
	// 			return $output;
	// 		}else {
	// 			// $kd_brg   	= $this->input->post('kd_brg');
    //             $email = $this->input->post('email');
    //             $password = $this->input->post('password');
    //             if ($email == '' &&  $password =='') {
    //                 echo json_encode(array('kode' => 0, 'pesan' => 'Email dan Password belum diisi'));
    //             } else {
    //                 $this->db->where('email', $email);
    //                 $this->db->where('password', $password);
    //                 $barang1 = $this->db->get('admin')->result();
        
    //                 if ( $barang1 == null) {
    //                     $barang[] = 'Email atau Password Salah';
    //                 }   else {
    //                     $barang[] = 'Login Sukses';
    //                 }
    //             }
			
	// 			$output = $barang;
	// 			return $output;
	// 		}
	// 	});
	// }

	function AkunAdmin() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
				if ($id == '') {
					$customer = $this->db->get('admin')->result_array();
				} else {
					$this->db->where('id', $id);
					$customer = $this->db->get('admin')->result_array();
				}
			
				$output = $customer;
				return $output;
			}
		});
	}
	
	function HapusAdmin() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
				$this->db->where('id', $id);
				$admin = $this->db->delete('admin');
				if ($admin) {
					$admin = ['Berhasil dihapus'];
				} else {
					$admin = ['Gagal dihapus'];
				}
				$output = $admin;
				return $output;
			}
		});
	}
	
	function UpdateAdmin() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $this->input->post('id');
				$data = array(
							'id'      => $this->input->post('id'),
							'email'      => $this->input->post('email'),
							'password'      =>$this->input->post('password'));
				$this->db->where('id', $id);
				$update = $this->db->update('admin', $data);
				$data['message'] = "Data berhasil diubah";
				if ($update) {
					$admin = $data;
				} else {
					$admin = ['status' => 'fail'];
				}
				$output = $admin;
				return $output;
			}
		});
    }
    function TambahAdmin() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
				$data = array(
							'id'      => $this->input->post('id'),
							'email'      => $this->input->post('email'),
							'password'      =>$this->input->post('password'));
				$insert = $this->db->insert('admin', $data);
				$data['message'] = "Data berhasil diubah";
				if ($insert) {
					$admin = $data;
				} else {
					$admin = ['status' => 'fail'];
				}
				$output = $admin;
				return $output;
			}
		});
    }
}