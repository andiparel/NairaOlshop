<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_detiljual extends REST_Controller {


    //STATUS-CART BY CUST
    public function tambah_detiljual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
    
                $id_cart   = $_POST['id_cart'];
                $id_jual   = $_POST['id_jual'];
                $total   = $_POST['total'];
    
                if( $id_jual == '' && $id_cart == '' && $total == ''){
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_jual , kd_brg , total , harga harus di isi'));
                }else if( $id_jual == ''  ) {
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_jual harus di isi'));
                }else if( $id_cart == ''  ) {
                    echo json_encode(array('kode' => 0, 'pesan' => 'kd_brg harus di isi'));
                }else if( $total == ''  ) {
                    echo json_encode(array('kode' => 0, 'pesan' => 'total harus di isi'));
                }else{
                    $query = "INSERT INTO detiljual (id_jual,id_cart, total) 
                    VALUES ('$id_jual','$id_cart','$total')";
    
                    $exeQuery = mysqli_query($konek,$query);
    
                    echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'Berhasil menambahkan data')):
                            json_encode(array('kode' => 2,'pesan' => 'Data gagal ditambhkan'));
                
                    return $output;

                }
			}
		});
    }

}