<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_jual extends REST_Controller {


    //TAMBAH - JUAL
    public function tambah_jual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
    
             $id_jual   = $_POST['id_jual'];
            $tgl_jual   = $_POST['tgl_jual'];
            $id_cust   = $_POST['id_cust'];
            $alamat   = $_POST['alamat'];
            $provinsi   = $_POST['provinsi'];
            $kota   = $_POST['kota'];
            $kecamatan   = $_POST['kecamatan'];
            $kd_pos   = $_POST['kd_pos'];
            $ongkir   = $_POST['ongkir'];
            $status   = $_POST['status'];

        
            if( $tgl_jual == '' && $id_cust == '' && $alamat == '' && $provinsi == '' &&
            $kota == '' && $kecamatan == '' && $kd_pos == '' && $ongkir == '' ){
                echo json_encode(array('kode' => 0, 'pesan' => 'Tgl_jual , id_cust , alamat , provinsi, 
                                        kota , kecamatan, kd_pos, ongkir harus di isi'));
            }else if( $tgl_jual == ''  ) {
                echo json_encode(array('kode' => 0, 'pesan' => 'Tgl_jual harus di isi'));
            }else if ( $id_cust == ''){
                echo json_encode(array('kode' => 0, 'pesan' => 'id_cust  harus di isi'));
            }else if ( $alamat == ''){
                echo json_encode(array('kode' => 0, 'pesan' => 'alamat harus di isi'));
            }else if ($provinsi == '' ){
                echo json_encode(array('kode' => 0, 'pesan' => 'provinsi harus di isi'));
            }else if ($kota == '' ){
                echo json_encode(array('kode' => 0, 'pesan' => 'kota harus di isi'));
            }else if ($kecamatan == '' ){
                echo json_encode(array('kode' => 0, 'pesan' => 'kecamatan harus di isi'));
            }else if ($kd_pos == '') {
                echo json_encode(array('kode' => 0, 'pesan' => 'kd_pos harus di isi'));
            }else if ($ongkir == '') {
                echo json_encode(array('kode' => 0, 'pesan' => 'ongkir harus di isi'));
            }else {
                $query = "INSERT INTO jual (id_jual,tgl_jual, id_cust, alamat,provinsi,
                kota,kecamatan,kd_pos,ongkir,status) 
                VALUES ('$id_jual','$tgl_jual','$id_cust','$alamat','$provinsi','$kota','$kecamatan'
                ,'$kd_pos','$ongkir','$status')";
                
                $exeQuery = mysqli_query($konek,$query);
                
                echo ($exeQuery) ? json_encode(array('kode' => 1, 'psean' => 'Berhasil menambahkan data')):
                json_encode(array('kode' => 2,'pesan' => 'Data gagal ditambhkan'));
            
                    return $output;

            }
			}
		});
    }

    //HAPUS JUAL
    public function hapus_jual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_jual'];

                if ( $id == '' ){
                    echo json_encode(array('kode' => 0, 'pesan' => 'id_jual perlu ada'));
                } else {
                    $query = "DELETE FROM jual WHERE id_jual='$id'";
    
                    $exequery = mysqli_query($konek, $query);
        
                    echo($exequery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil dihapus'))
                    : json_encode(array('kode' => 2, 'pesan' => 'data gagal dihapus'));
                
                    return $output;

            }
			}
		});
    }

     //UPDATE STATUS JUAL
     public function updatestatus_jual() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                require_once 'utils/koneksi.php';
                $id = $_POST['id_jual'];
                $status = $_POST['status'];

              
            if ( $id == ''){
                echo json_encode(array('kode' => 0,'pesan' => 'status tidak boleh kosong'));
            }else {

                    $query = "UPDATE jual SET 
                    status = '$status'
                     WHERE id_jual = '$id'";
        
                    $exeQuery = mysqli_query($konek, $query);
        
                    echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil diupdate')) 
                            : json_encode(array('kode' => 2, 'pesan' => 'data gagal diupdate'));
                
            
                    return $output;

            }
			}
		});
    }

}