<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->API="http://localhost/TUGAS_AKHIR/DenganJWT/rest_server/api/admin/CekAdmin";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->library('form_validation');
        $this->load->model('admin_model');
    }


    public function index()
    {
        if($this->session->userdata('authenticated')) {// Jika user sudah login (Session authenticated ditemukan)
        redirect('admin'); // Redirect ke page welcome
        }
        $this->page_login();

        
    }
    public function page_login(){
        $this->form_validation->set_rules('email' , 'Email' ,'trim|required|valid_email');
        $this->form_validation->set_rules('password' , 'Password' ,'trim|required');

        if( $this->form_validation->run() == false){
            $data['judul'] = "Login Admin";
            $this->load->view('templates/header',$data);
            $this->load->view('admin/login.php');
            $this->load->view('templates/footer');
        }else{
            // validasi success
            $this->_login();
        }
    }

    private function _login()
    {
     
        $params2 = array('email'=> $this->input->post('email'),
                            'password' =>  $this->input->post('password'),
                            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6bnVsbH0.aGMQBIhBqyq_OoKDUe9w6BHHRdMsSORVkgotaEc1qMg'
                        );
        $data['cek'] = json_decode($this->curl->simple_post($this->API,$params2));
       
        if ($data['cek'] == ['Login Sukses']) {
         
            // cek password
            if($data['cek'] == ['Login Sukses']){
                $session = array(
                    'authenticated'=>true // Buat session authenticated dengan value true
                  );
                $this->session->set_userdata($session);
                redirect('login');

            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"!</div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau Password salah !</div>');
            redirect('login');
        }
    }

    function keluar(){

        $this->session->sess_destroy();
        
        redirect('login');
        
        }
}
