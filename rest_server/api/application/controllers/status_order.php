<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class status_order extends REST_Controller {

    public function Tambah_StatusOrder() {
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
                $status   = $_POST['status'];
                $hargaplusqty   = $_POST['hargaplusqty'];
                $id_cart   = $_POST['id_cart'];

                if( $tgl_jual == '' && $id_cust == '' && $alamat == '' && $provinsi == '' &&
                        $kota == '' && $kecamatan == '' && $kd_pos == '' && $status == '' )
                {
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

                    return $output;
                } 
			
			}
		});
    }
    public function Delete_StatusOrder() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id_jual = $this->input->post('id_jual');
                $this->db->where('id_jual', $id_jual);
                $delete = $this->db->delete('statusorder');
                if ($delete) {
                    $output = 'Berhasil dihapus';
                } else {
                    $output = 'Gagal dihapus';
                }
				return $output;
			}
		
		});
    }
    
    public function Update_Status() {
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
                    $update = $this->db->update('statusorder', $data);
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
}