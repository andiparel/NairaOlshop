<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    var $API ="";
    
    public function __construct()
    {
        parent::__construct();
        $this->API="http://localhost/TUGAS_AKHIR/DenganJWT/rest_server/api/user";
        
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('admin_model');
    }
// Menampilkan data user
    public function index()
    {
        
        $data['judul'] = "Halaman Admin";

        $params2 = array(
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                        );
        $data2['a'] = json_decode($this->curl->simple_post($this->API.'/Customer', $params2));
        //Cek apakah ada data yang diterima
        if ( $data2['a'] == null){
            $this->load->view('templates/header2',$data);
            $this->load->view('apigagal');
            $this->load->view('templates/footer');
        }else {
            $this->load->view('templates/header2',$data);
            $this->load->view('admin/home.php',$data2);
            $this->load->view('templates/footer');
        }
    
    } 
    public function hapus($id)
    {
        if(empty($id)){
            redirect('admin');
        }else{
            $params2 = array('id_cust'=>$id,
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako');
            $delete =  $this->curl->simple_post($this->API.'/HapusCustomer', $params2, array(CURLOPT_BUFFERSIZE => 10)); 
            
            if($delete)
            {
                $this->session->set_flashdata('flash','Delete data customer');
                redirect('admin');

            }else
            {
                $data['judul'] = "Halaman Admin";

                $this->load->view('templates/header2',$data);
                $this->load->view('apigagal');
                $this->load->view('templates/footer');
            }
        }
    }

}
