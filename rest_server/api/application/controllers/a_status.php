<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_status extends REST_Controller {


    //STATUS-CART BY CUST
    public function status_bycust() {
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
                    $query = "SELECT * FROM statusorder  WHERE id_cust='$id' ";
        
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

     //STATUS-ORDER BY CUST
     public function statusorder_bycust() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                // $id = $_POST['id_cust'];
                
                require_once 'utils/koneksi.php';

                $id = $_POST['id_cust'];
                
                $sql = "SELECT * FROM statusorder WHERE id_cust='$id'";
            
                $response = mysqli_query($konek, $sql);
            
                $result = array();
                $result['read'] = array();
            
                if ($row = mysqli_fetch_assoc($response)){
        
                    $h['id_jual']    =   $row['id_jual'];
                
                    array_push($result["read"], $h);
        
                    $result["success"] = "1";
                    echo json_encode($result);

                    // $output = $result;
                
                }
                
                return $output;

                
			}
		});
    }

       //HAPUS STATUS-ORDER
       public function hapus_statusorder() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                // $id = $_POST['id_cust'];
                
                require_once 'utils/koneksi.php';

                
                $id = $_POST['id_jual'];

                if ( $id == '' ){
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_jual perlu ada'));
                } else {
                    $query = "DELETE FROM statusorder WHERE id_jual='$id'";
    
                    $exequery = mysqli_query($konek, $query);
        
                    echo($exequery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil dihapus'))
                    : json_encode(array('kode' => 2, 'pesan' => 'data gagal dihapus'));
                }
                
                
                return $output;

                
			}
		});
    }

     //TAMBAH STATUS-ORDER
     public function tambah_statusorder() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                // $id = $_POST['id_cust'];
                
            require_once 'utils/koneksi.php';

            $id_jual   = $_POST['id_jual'];
            $tgl_jual   = $_POST['tgl_jual'];
            $id_cust   = $_POST['id_cust'];
            $alamat   = $_POST['alamat'];
            $provinsi   = $_POST['provinsi'];
            $kota   = $_POST['kota'];
            $kecamatan   = $_POST['kecamatan'];
            $kd_pos   = $_POST['kd_pos'];
            $status   = $_POST['status'];
            $hargaplusqty   = $_POST['hargaplusqty'];
            $id_cart   = $_POST['id_cart'];
          
        
            if( $tgl_jual == '' && $id_cust == '' && $alamat == '' && $provinsi == '' &&
            $kota == '' && $kecamatan == '' && $kd_pos == '' && $status == '' ){
                echo json_encode(array('kode' => 0, 'pesan' => 'Tgl_jual , id_cust , alamat , provinsi, 
                                        kota , kecamatan, kd_pos, status harus di isi'));
            }else {
                $query = "INSERT INTO statusorder (id_jual,tgl_jual, id_cust, alamat,provinsi,
                kota,kecamatan,kd_pos,status,hargaplusqty,id_cart) 
                VALUES ('$id_jual','$tgl_jual','$id_cust','$alamat','$provinsi','$kota','$kecamatan'
                ,'$kd_pos','$status','$hargaplusqty','$id_cart')";
                
                $exeQuery = mysqli_query($konek,$query);
                
                echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'Berhasil menambahkan data')):
                json_encode(array('kode' => 2,'pesan' => 'Data gagal ditambhkan'));
            } 
                return $output;
			}
		});
    }
}