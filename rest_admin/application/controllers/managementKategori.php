<?php
defined('BASEPATH') or exit('No direct script access allowed');

class managementKategori extends CI_Controller
{
    var $API="";

    public function __construct()
    {
        parent::__construct();
        $this->API="http://localhost/TUGAS_AKHIR/DenganJWT/rest_server/api/kategori";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->TOKEN= array(
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                            );
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Management Kategori';
        $data['kategori'] = json_decode($this->curl->simple_post($this->API.'/List_Kategori',$this->TOKEN));
        
        //Cek
        if( $data['kategori'] == null ){
            $this->load->view('templates/header2',$data);
            $this->load->view('apigagal');
            $this->load->view('templates/footer');
        }else{
            $this->load->view('templates/header2',$data);
            $this->load->view('kategori/home.php',$data);
            $this->load->view('templates/footer');
        }
      
    }
    //tambah
    public function tambah()
    {
        $data['judul'] = "Form Tambah Kategori";

         // Set Rules untuk validation
         $this->form_validation->set_rules('nama', 'Nama Katgori', 'required');
         // Cek
         if ($this->form_validation->run() == FALSE) {
             // Jika gagal akan tampil
             $this->load->view('templates/header2', $data);
             $this->load->view('kategori/insert_kategori');
             $this->load->view('templates/footer');
         } else {
             // Menjalankan method 
             $data = array(
                'nm_kat'      =>  $this->input->post('nama'),
                'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
            );
            if($data['nm_kat'] == ''){
                $this->session->set_flashdata('flashgagal','Tambah data Kategori');
                redirect('managementKategori');
            }else {
                $insert =  $this->curl->simple_post($this->API.'/Tambah_Kategori', $data, array(CURLOPT_BUFFERSIZE => 10)); 
      
                if($insert)
                {
                    $this->session->set_flashdata('flash','Tambah data Kategori');
                }else
                {
                $this->session->set_flashdata('flashgagal','Tambah data Kategori');
                }
                redirect('managementKategori');
                
            }
         }
    }
    //edit/update
    public function edit($id)
    {
        // 1
        $data['judul'] = "Form Edit Kategori";
        $params = array('id_kat'=> $id,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $data['kategori'] = json_decode($this->curl->simple_post($this->API.'/List_Kategori',$params));
        // Set Rules untuk validation
         $this->form_validation->set_rules('nm_kat', 'Nama Kategori', 'required');
        // Cek
        if ($this->form_validation->run() != FALSE) {
            $data = array(
                'id_kat'       =>  $this->input->post('id_kat'),
                'nm_kat'      =>  $this->input->post('nm_kat'),
                'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
            );
            $update =  $this->curl->simple_post($this->API.'/Update_Kategori', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('flash','Update data Kategori');
            }else
            {
               $this->session->set_flashdata('flashgagal','Update data Kategori');
            }
            redirect('managementKategori');
        } else {
            $this->load->view('templates/header2', $data);
            $this->load->view('kategori/edit_kategori', $data);
            $this->load->view('templates/footer');
        }
    }
       //hapus
       public function hapus($id)
       {
           if(empty($id)){
               redirect('managementKategori');
           }else{
               $data = array('id_kat'=>$id,
               'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                );
               $delete =  $this->curl->simple_post($this->API.'/Delete_Kategori', $data, array(CURLOPT_BUFFERSIZE => 10)); 
               if($delete)
               {
                   $this->session->set_flashdata('flash','Delete data Kategori');
               }else
               {
                  $this->session->set_flashdata('flashgagal','Delete Data Gagal');
               }
               redirect('managementKategori');
           }
       }
}
