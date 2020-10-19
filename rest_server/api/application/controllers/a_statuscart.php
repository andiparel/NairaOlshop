<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_statuscart extends REST_Controller {


    //JUMLAH CART
    public function jumlahcart() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cust'];
                
                require_once 'utils/koneksi.php';
    
            
                $query = "SELECT * FROM statuscarts  WHERE id_cust='$id'";

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

      //TOTAL STATUS-CART
      public function totalcart() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cust'];
                
                require_once 'utils/koneksi.php';
    
            
                $query = "SELECT id_cust, SUM(hargaplusqty) FROM statuscarts WHERE id_cust='$id'";

                $response = mysqli_query($konek, $query);
            
                $result = array();
                $result['read'] = array();
            
                if( mysqli_num_rows($response) === 1) {
            
                    if ($row = mysqli_fetch_assoc($response)){
            
                        if( $row['SUM(hargaplusqty)'] == null ){
                            $h['total']  = 0;
                        }else {
                            $h['total']  =   $row['SUM(hargaplusqty)'];
                        }
            
                        array_push($result["read"], $h);
            
                        $result["success"] = "1";
                        echo json_encode($result);
                    }
                
                    return $output;

                }
			}
		});
    }

     //AMBIL STATUS-CART
     public function ambil_statuscart() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cust'];
                
                require_once 'utils/koneksi.php';
                    
                $sql = "SELECT * FROM statuscarts WHERE id_cust='$id'";
            
                $response = mysqli_query($konek, $sql);
            
                $result = array();
                $result['read'] = array();
            
                if ($row = mysqli_fetch_assoc($response)){
        
                    $h['id_cart']    =   $row['id_cart'];
                
                    array_push($result["read"], $h);
        
                    $result["success"] = "1";
                    echo json_encode($result);
                
                   
                } return $output;
			}
		});
    }

        //STATUS-CART BY CUSTOMER
        public function statuscart_bycust() {
            return Validation::validate($this, 'user', '', function($token, $output)
            {
                if ( $token == false){
                    $output['pesan'] = 'Periksa kembali token';
                    return $output;
                }else {
                    $id = $_POST['id_cust'];
                    
                    require_once 'utils/koneksi.php';
                    if( $id == '') {
                        echo json_encode(array('kode' => 0,'pesan' => 'id_cust tidak boleh kosong'));
                    }else {
            
                        $query = "SELECT * FROM statuscarts
                        INNER JOIN barang
                        ON statuscarts.kd_brg = barang.kd_brg
                        WHERE id_cust='$id'";

                       $result = mysqli_query($konek,$query);
                         
                        $array = array();
                        
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $array[] = $row;
                        }
                        
                        echo ($result) ?
                        json_encode(array("kode" => 1, "resultcartbycust"=> $array, "message" => "Data ditemukan")):
                        json_encode(array("kode" => 0, "pesan" => "data tidak ditemukan"));
                        
                        return $output;
                    }
                }
            });
        }

    //TAMBAH STATUS-CART
    public function tambah_statuscart() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id_cart   = $_POST['id_cart'];
                $id_key   = $_POST['id_key'];
                $id_cust   = $_POST['id_cust'];
                $kd_brg   = $_POST['kd_brg'];
                $qty        = $_POST['qty'];
                $harga      = $_POST['hargaplusqty'];
            
                $cekbrg    = "SELECT * FROM statuscarts WHERE kd_brg='$kd_brg' AND id_cust='$id_cust'";
                $query1 = mysqli_query($konek,$cekbrg);
    
                if( $id_cust == '' && $kd_brg1 == '' && $qty == '' &&
                $harga == ''){
                    echo json_encode(array('kode' => 0, 'pesan' => 'Tgl_jual , id_cust , alamat , provinsi, 
                                            kota , kecamatan, kd_pos, status harus di isi'));
                }else if( mysqli_num_rows($query1) > 0) {
                    echo json_encode(array('kode' => 0, 'pesan' => 'kd_brg telah terdaftar di dalam database'));
    
                }else{
                    $query = "INSERT INTO statuscarts (id_cart,id_key,id_cust, kd_brg, qty,hargaplusqty) 
                    VALUES ('$id_cart','$id_key','$id_cust','$kd_brg','$qty','$harga')";
                    
                    $exeQuery = mysqli_query($konek,$query);
                    
                    echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'Berhasil menambahkan data')):
                    json_encode(array('kode' => 2,'pesan' => 'Data gagal ditambahkan'));
                
                }return $output;
			}
		});
    }

      //HAPUS STATUS-CART BY ID_CART
      public function hapus_statuscart() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_cart'];

                if ( $id == '' ){
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_cart perlu ada'));
                } else {
                    $query = "DELETE FROM statuscarts WHERE id_cart='$id'";
    
                    $exequery = mysqli_query($konek, $query);
        
                    echo($exequery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil dihapus'))
                    : json_encode(array('kode' => 2, 'pesan' => 'data gagal dihapus'));
                }return $output;
			}
		});
    }

     //TAMPIL QTY STATUS-CART BY ID_CUST
     public function qty_statuscart() {
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
            
                $sql = "SELECT * FROM statuscarts WHERE id_cust='$id' && id_cart='$id_cart'&& kd_brg='$kd_brg'";
            
                $response = mysqli_query($konek, $sql);
            
                $result = array();
                $result['read'] = array();
            
                if( mysqli_num_rows($response) === 1) {
            
                    if ($row = mysqli_fetch_assoc($response)){
            
                        $h['qty']  =   $row['qty'];
                      
            
                        array_push($result["read"], $h);
            
                        $result["success"] = "1";
                        echo json_encode($result);
                    }
                }return $output;
			}
		});
    }

    //HAPUS BY BARANG STATUS-CART BY ID_CART
    public function hapusbybrg_statuscart() {
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
                $query = "DELETE FROM statuscarts WHERE kd_brg='$id'";
                // $query = "DELETE FROM cartproduk WHERE kd_brg='$id'";

                $exequery = mysqli_query($konek, $query);
    
                echo($exequery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil dihapus'))
                : json_encode(array('kode' => 2, 'pesan' => 'data gagal dihapus'));
                }   return $output;
			}
		});
    }


    //UPDATE QTY & HARGAPLUSQTY, STATUS-CART BY ID_CUST & ID_CART
    public function updateqtyharga_statuscart() {
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
                        $query = "UPDATE statuscarts SET 
                        qty = '$qty' ,hargaplusqty= '$hargaplusqty' WHERE id_cart = '$id_cart' &&  id_cust = '$id' &&  kd_brg = '$kd_brg'";
            
                        $exeQuery = mysqli_query($konek, $query);
            
                        echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil diupdate22')) 
                                : json_encode(array('kode' => 2, 'pesan' => 'data gagal diupdate'));
                    }   return $output;
			}
		});
    }
}