<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class a_customer extends REST_Controller {

    // LOGIN USER
	public function login() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                require_once 'utils/koneksi.php';
    
                $sql = "SELECT * FROM customer WHERE email='$email'";
    
                $response = mysqli_query($konek, $sql);
    
                $result = array();
                $result['login']= array();
    
                if( mysqli_num_rows($response) === 1 ){
                    
                    $row = mysqli_fetch_assoc($response);
    
                    if( password_verify($password, $row['password']) ){
    
                        $index['nama'] = $row['nama'];
                        $index['email'] = $row['email'];
                        $index['id_cust'] = $row['id_cust'];
    
                        array_push( $result['login'], $index);
    
                        $result['success'] = "1";
                        $result['message'] = "Login success";
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
    
    // DAFTAR USER
    public function daftar() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $nama   = $_POST['nama'];
                $email   = $_POST['email'];
                $password   = $_POST['password'];
                $notelp   = $_POST['notelp'];

                require_once 'utils/koneksi.php';

                if($nama == '' && $email == '' && $password == '' && $notelp == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'Nama , Email, Password, Notelp harus diinput'));
                }else  if($nama == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'Nama harus diinput'));
                }else if( $email == '') 
                    {
                    echo json_encode(array('kode' => 0,'pesan' => 'email harus diinput'));
                    }else if ( $password == '') {
                        echo json_encode(array('kode' => 0,'pesan' => 'password harus diinput'));
                    }else if ($notelp == '') {
                        echo json_encode(array('kode' => 0,'pesan' => 'notelp harus diinput'));
                    }else {
                        $password = password_hash($password, PASSWORD_DEFAULT);
    
                        $query = "INSERT INTO customer (nama, email, password,notelp) VALUES ('$nama','$email','$password','$notelp')";
            
                        $exeQuery = mysqli_query($konek,$query);

                       echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'Berhasil menambahkan data')):
                        json_encode(array('kode' => 2,'pesan' => 'Data gagal ditambahkan'));
                        return $output;       
                    }
			}
		});
    }

    // DETAIL DATA USER
    public function detailuser() {
		return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cust'];

                require_once 'utils/koneksi.php';
            
                $sql = "SELECT * FROM customer WHERE id_cust='$id'";
            
                $response = mysqli_query($konek, $sql);
            
                $result = array();
                $result['read'] = array();
            
                if( mysqli_num_rows($response) === 1) {
            
                    if ($row = mysqli_fetch_assoc($response)){
            
                        $h['email_cust']  =   $row['email'];
                        $h['notelp'] =   $row['notelp'];
                        $h['nama'] =   $row['nama'];
                        $h['password'] =   $row['password'];
                        $h['id_cust'] =   $row['id_cust'];
            
                        array_push($result["read"], $h);
            
                        $result["success"] = "1";
                        echo json_encode($result);
                        return $output;    
                    }
                }
                    
			}
		});
    }

    //UPDATE AKUN CUSTOMER
    public function edit_akun() {
        return Validation::validate($this, 'user', '', function($token, $output)
		{
			if ( $token == false){
				$output['pesan'] = 'Periksa kembali token';
				return $output;
			}else {
                $id = $_POST['id_cust'];
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $notelp = $_POST['notelp'];
         
                
                require_once 'utils/koneksi.php';
    
                if ( $id == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'id_cust tidak boleh kosong'));
                }else  if($nama == '' && $email == '' && $password == '' && $notelp == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'Nama , Email, Password, Notelp tidak boleh kosong'));
                }else  if($nama == ''){
                    echo json_encode(array('kode' => 0,'pesan' => 'Nama tidak boleh kosong'));
                }else if( $email == '') 
                    {
                    echo json_encode(array('kode' => 0,'pesan' => 'email tidak boleh kosong'));
                    }else if ( $password == '') {
                        echo json_encode(array('kode' => 0,'pesan' => 'password tidak boleh kosong'));
                    }else if ($notelp == '') {
                        echo json_encode(array('kode' => 0,'pesan' => 'notelp tidak boleh kosong'));
                    }else {
                        $password = password_hash($password, PASSWORD_DEFAULT);
    
                        $query = "UPDATE customer SET 
                        nama = '$nama',
                        email = '$email',
                        password = '$password',
                        notelp = '$notelp'
                                    WHERE id_cust = '$id'";
            
                        $exeQuery = mysqli_query($konek, $query);
            
                        echo ($exeQuery) ? json_encode(array('kode' => 1, 'pesan' => 'data berhasil diupdate')) 
                                : json_encode(array('kode' => 2, 'pesan' => 'data gagal diupdate'));

                                return $output;
                    }
			}
		});
    }
}