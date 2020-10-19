<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_produk extends REST_Controller {


    //JUMLAH CART
    public function list_barang() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                
                require_once 'utils/koneksi.php';
                $query = "SELECT * FROM barang
                INNER JOIN kategori
                ON barang.id_kat = kategori.id_kat";
        
                $result = mysqli_query($konek,$query);
                
                $array = array();
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    $array[] = $row;
                }
                
                echo ($result) ?
                json_encode(array("kode" => 1, "resultbarang"=> $array, "message" => "Data ditemukan")):
                json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
                   
                return $output;

                
			}
		});
    }

    public function BarangByKategori() {
		return Validation::validate($this, 'user', 'read', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                
                require_once 'utils/koneksi.php';
                $id = $_POST['id_kat'];

                if( $id == '') {
                    echo json_encode(array('kode' => 0,'pesan' => 'id_kat tidak boleh kosong'));
                }else {
                    $query = "SELECT * FROM barang WHERE id_kat='$id'";
        
                    
                    // $query = "SELECT * FROM kategori
                    // INNER JOIN barang
                    // WHERE id_kat='$id'";
        
                    $result = mysqli_query($konek,$query);
                    
                     
                    $array = array();
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $array[] = $row;
                    }
                    
                    echo ($result) ?
                    json_encode(array("kode" => 1, "resultbarang"=> $array, "message" => "Data ditemukan")):
                    json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
                    return $output;
                }    
			}
		});
    }
}