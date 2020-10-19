<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_cartproduk extends REST_Controller {


    //STATUS-CART BY CUST
    public function detailcartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cart'];
                
                require_once 'utils/koneksi.php';
                if( $id == '') {
                    echo json_encode(array('kode' => 0,'pesan' => 'id_cust tidak boleh kosong'));
                }else {
                    // $query = "SELECT * FROM cartproduk  WHERE id_cart='$id' ";
        
                    $query = "SELECT * FROM cartproduk
                    INNER JOIN barang
                    ON cartproduk.kd_brg = barang.kd_brg
                    WHERE id_cart='$id'";
        
                    // $query = "SELECT * FROM statusorder , customer WHERE statusorder.id_cust = customer.id_cust order by id_jual='$id' ";
        
                    $result = mysqli_query($konek,$query);
                    
                     
                    $array = array();
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $array[] = $row;
                    }
                    
                    echo ($result) ?
                    json_encode(array("kode" => 1, "resultjualdetailmany"=> $array, "message" => "Data ditemukan")):
                    json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
                
                    return $output;

                }
			}
		});
    }

       //STATUS-CART BY CUST
       public function tambah_cartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_cart'];
                
                $id_cart   = $_POST['id_cart'];
                $id_key   = $_POST['id_key'];
                $id_cust   = $_POST['id_cust'];
                $kd_brg   = $_POST['kd_brg'];
                $qty        = $_POST['qty'];
                $harga      = $_POST['hargaplusqty'];
            
                $cekbrg    = "SELECT * FROM cartproduk WHERE kd_brg='$kd_brg' AND id_cust='$id_cust' AND id_cart='$id_cart'";
                $query1 = mysqli_query($konek,$cekbrg);
    
                if( $id_cust == '' && $kd_brg1 == '' && $qty == '' &&
                $harga == ''){
                    echo json_encode(array('kode' => 0, 'pesan' => 'Tgl_jual , id_cust , alamat , provinsi, 
                                            kota , kecamatan, kd_pos, status harus di isi'));
                }else if( mysqli_num_rows($query1) > 0) {
                    echo json_encode(array('kode' => 0, 'pesan' => 'kd_brg telah terdaftar di dalam database'));
    
                }else {
                    $query = "INSERT INTO cartproduk (id_cart,id_key,id_cust, kd_brg, qty,hargaplusqty) 
                    VALUES ('$id_cart','$id_key ','$id_cust','$kd_brg','$qty','$harga')";
                    
                    $exeQuery = mysqli_query($konek,$query);
                    
                    echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'Berhasil menambahkan data')):
                    json_encode(array('kode' => 2,'pesan' => 'Data gagal ditambahkan'));
                 
                    return $output;

                }
			}
		});
    }

     //DELETE CART-PRODUK BY ID_CART
     public function hapus_cartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_cart'];
                
                if ( $id == '' ){
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_jual perlu ada'));
                } else {
                    $query = "DELETE FROM cartproduk WHERE id_cart='$id'";
    
                    $exequery = mysqli_query($konek, $query);
        
                    echo($exequery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil dihapus'))
                    : json_encode(array('kode' => 2, 'pesan' => 'data gagal dihapus'));
                
                    return $output;

                }
			}
		});
    }

      //EDIT KEY CART-PRODUK 
      public function editkey_cartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_cart'];
                $id_key = $_POST['id_key'];

                if ( $id == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'id_cust tidak boleh kosong'));
                }else  {
                        $query = "UPDATE cartproduk SET 
                        id_key = '$id_key' WHERE id_cart = '$id'";
            
                        $exeQuery = mysqli_query($konek, $query);
            
                        echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil diupdate')) 
                                : json_encode(array('kode' => 2, 'pesan' => 'data gagal diupdate'));
                    
                    return $output;

                }
			}
		});
    }

    //EDIT ID_CART WITH KEY CART-PRODUK 
    public function editIDcart_cartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_key'];
                $id_cart = $_POST['id_cart'];
                
                if ( $id == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'id_cust tidak boleh kosong'));
                }else  {
                        $query = "UPDATE cartproduk SET 
                        id_cart = '$id_cart' WHERE id_key = '$id'";
            
                        $exeQuery = mysqli_query($konek, $query);
            
                            echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil diupdate')) 
                                : json_encode(array('kode' => 2, 'pesan' => 'data gagal diupdate'));
                                
                                
                    } 
                    return $output;
			}
		});
    }

     //UPDATE QTY , HARGAPLUSQTY BY ID_CART & ID_CUST CART-PRODUK 
     public function update_cartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_cust'];
                $id_cart = $_POST['id_cart'];
                $kd_brg = $_POST['kd_brg'];
                $qty = $_POST['qty'];
                $hargaplusqty = $_POST['hargaplusqty'];
                
                if ( $id == '' || $id_cart == '' || $kd_brg == '' || $qty == ''  ){
                    echo json_encode(array('kode' => 0,'pesan' => 'id_cust , id_cart , kd_brg dan qty tidak boleh kosong'));
                }else  {
                        $query = "UPDATE cartproduk SET 
                        qty = '$qty' ,hargaplusqty= '$hargaplusqty' WHERE id_cart = '$id_cart' &&  id_cust = '$id' &&  kd_brg = '$kd_brg'";
            
                        $exeQuery = mysqli_query($konek, $query);
            
                        echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil diupdate')) 
                                : json_encode(array('kode' => 2, 'pesan' => 'data gagal diupdate'));
                }
                    return $output;
			}
		});
    }

    
     //DELETE CART-PRODUK BY BARANG
     public function hapusbybrg_cartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['kd_brg'];

                if ( $id == '' ){
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_cust perlu ada'));
                } else {
                    $query = "DELETE FROM cartproduk WHERE kd_brg='$id'";
                    // $query = "DELETE FROM cartproduk WHERE kd_brg='$id'";
    
                    $exequery = mysqli_query($konek, $query);
        
                    echo($exequery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil dihapus'))
                    : json_encode(array('kode' => 2, 'pesan' => 'data gagal dihapus'));
                
                    return $output;

                }
			}
		});
    }

       //JUMLAH CART
       public function jumlahcartproduk() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cust'];
                
                require_once 'utils/koneksi.php';
            
                $query = "SELECT * FROM cartproduk  WHERE id_cust='$id'";

                
                $response = mysqli_query($konek, $query);
                if( mysqli_num_rows($response) > 0){
                    $result = array();
                    $result['read'] = array();
                
            
                    while (($row = mysqli_fetch_array($response)))
                    {
                        $array[] = $row;
                    }
        
                    $count = count($array);
                    $h['total']  = $count;
                    array_push($result["read"], $h);
        
                    $result["success"] = "1";
                    echo json_encode($result);
                    return $output;

                }else {
                    $result = array();
                    $result['read'] = array();
                
            
                    while (($row = mysqli_fetch_array($response)))
                    {
                        $array[] = $row;
                    }
    
                    $h['total']  = '';
                    array_push($result["read"], $h);
        
                    $result["success"] = "1";
                    echo json_encode($result);
                    return $output;

                }
			}
		});
    }

}