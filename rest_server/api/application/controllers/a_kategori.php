<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_kategori extends REST_Controller {


    //LIST KATEGORI
    public function list_kategori() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {

                require_once 'utils/koneksi.php';

                $query = "SELECT * FROM kategori ORDER BY id_kat";
        
                $result = mysqli_query($konek,$query);
                
                $array = array();
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    $array[] = $row;
                }
                
                echo ($result) ?
                json_encode(array("kode" => 1, "result"=> $array)):
                json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
                   
                return $output;

                
			}
		});
    }
}