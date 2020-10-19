<?php
defined('BASEPATH') or exit('No direct script access allowed');

class managementProduk extends CI_Controller
{
    var $API="";

    public function __construct()
    {
        parent::__construct();
        // $this->API="http://localhost/jwt2/api/user/list_produk";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->TOKEN= array(
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                            );
        $this->API="http://localhost/TUGAS_AKHIR/DenganJWT/rest_server/api/";
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Management Produk';
        $data['barang'] = json_decode($this->curl->simple_post($this->API.'Barang/List_Barang',$this->TOKEN));
        $this->load->view('templates/header2',$data);
        $this->load->view('produk/home.php',$data);
        $this->load->view('templates/footer');
        $this->load->library('upload');
    }
     //tambah
     public function tambah()
     {
        $data['judul'] = "Form Tambah Produk";
       
        $data['kategori'] = json_decode($this->curl->simple_post($this->API.'kategori/List_Kategori',$this->TOKEN));

          // Set Rules untuk validation
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        // $this->form_validation->set_rules('foto', 'Warna', 'required|alpha');
        
        
          // Cek
          if ($this->form_validation->run() == FALSE) {
              // Jika gagal akan tampil
              $this->load->view('templates/header2', $data);
              $this->load->view('produk/insert_produk',$data);
              $this->load->view('templates/footer');
          } else {

            $data2 = $this->Produk_model->upload();
              // Menjalankan method 
            $data = array(
                'nm_brg'      =>  $this->input->post('nama'),
                'harga'      =>  $this->input->post('harga'),
                'foto'      =>  $data2,
                'id_kat'      =>  $this->input->post('kategori'),
                'berat'      =>  $this->input->post('berat'),
                'deskripsi'      =>  $this->input->post('deskripsi'),
                'stok'      =>  $this->input->post('stok'),
                'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
            );
        
                $insert =  $this->curl->simple_post($this->API.'barang/Tambah_Barang', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                if($insert)
                {
                    $this->session->set_flashdata('flash','Tambah Data Berhasil');
                }else
                {
                    $this->session->set_flashdata('flashgagal','Tambah Data Gagal');
                }
                    redirect('managementProduk');
                
          }
     }
     
     //hapus
    public function hapus($id)
    {
        if(empty($id)){
            redirect('managementProduk');
        }else{
            $params = array('kd_brg'=>$id,
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
            );
            $delete =  $this->curl->simple_post($this->API.'barang/Delete_Barang',$params, array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('flash','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('flashgagal','Delete Data Gagal');
            }
            redirect('managementProduk');
        }
      
    }
    //edit/update
    public function edit($id,$id2)
    {
        $data['judul'] = "Form Edit Produk";
        $params = array('kd_brg'=> $id,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $data['barang'] =json_decode($this->curl->simple_post($this->API.'barang/List_Barang',$params));

        // $data['kategori'] = $this->Produk_model->getKategori();
        // $data['kategori2'] = $this->Produk_model->getKategoriByid($id2);
         
        $params2 = array('id_kat'=> $id2,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $data['kategori1'] =json_decode($this->curl->simple_post($this->API.'kategori/List_Kategori',$this->TOKEN));

        $data['kategori2'] = json_decode($this->curl->simple_post($this->API.'kategori/List_Kategori',$params2));
    
          // Set Rules untuk validation
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        // $this->form_validation->set_rules('foto', 'Warna', 'required|alpha');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        
          // Cek
          if ($this->form_validation->run() == FALSE) {
            // Jika gagal akan tampil
            $this->load->view('templates/header2', $data);
            $this->load->view('produk/edit_produk',$data);
            $this->load->view('templates/footer');
        } else {
            $foto =  $_POST['gambarLama'];
        
          
            $namaFile = $_FILES['foto']['name'];
            // var_dump($foto);
            // die;
            if ( empty($namaFile) ){
               
                $data2 = array(
                    'kd_brg'      =>  $id,
                    'nm_brg'      =>  $this->input->post('nama'),
                    'harga'      =>  $this->input->post('harga'),
                    'foto'      =>  $foto ,
                    'id_kat'      =>  $this->input->post('kategori'),
                    'berat'      =>  $this->input->post('berat'),
                    'deskripsi'      =>  $this->input->post('deskripsi'),
                    'stok'      =>  $this->input->post('stok'),
                    'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                    );
                    $update =  $this->curl->simple_post($this->API.'barang/Update_Barang', $data2, array(CURLOPT_BUFFERSIZE => 10)); 
            }else {
                $data2 = $this->Produk_model->upload2();
                $data2 = array(
                    'kd_brg'      =>  $id,
                    'nm_brg'      =>  $this->input->post('nama'),
                    'harga'      =>  $this->input->post('harga'),
                    'foto'      =>  $data2,
                    'id_kat'      =>  $this->input->post('kategori'),
                    'berat'      =>  $this->input->post('berat'),
                    'deskripsi'      =>  $this->input->post('deskripsi'),
                    'stok'      =>  $this->input->post('stok'),
                    'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                );
                    $update =  $this->curl->simple_post($this->API.'barang/Update_Barang', $data2, array(CURLOPT_BUFFERSIZE => 10)); 
            }
            // var_dump($namaFile);
            // die;
            // Menjalankan method 
            //  $data2 = array(
            // 'kd_brg'      =>  $id,
            // 'nm_brg'      =>  $this->input->post('nama'),
            // 'harga'      =>  $this->input->post('harga'),
            // 'foto'      =>  $data2,
            // 'id_kat'      =>  $this->input->post('kategori'),
            // 'berat'      =>  $this->input->post('berat'),
            // 'deskripsi'      =>  $this->input->post('deskripsi'),
            // 'stok'      =>  $this->input->post('stok'));
            // $update =  $this->curl->simple_put($this->API.'/barang', $data2, array(CURLOPT_BUFFERSIZE => 10)); 
            
          if($update)
          {
              $this->session->set_flashdata('flash','Update data Berhasil');
          }else
          {
             $this->session->set_flashdata('flashgagal','Update data Gagal');
          }
            redirect('managementProduk');
        }
    }
    
    // Control Detail
    public function detail($kd_brg,$id_kat)
    {
        $data['judul'] = "Detail data Produk";
        $params = array('kd_brg'=> $kd_brg,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $data['produk'] =json_decode($this->curl->simple_post($this->API.'barang/List_Barang',$params));
      
        $params2 = array('id_kat'=> $id_kat,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $data['kategori'] = json_decode($this->curl->simple_post($this->API.'kategori/List_Kategori',$params2));
        $this->load->view('templates/header2', $data);
        $this->load->view('produk/detail_produk', $data);
        $this->load->view('templates/footer');
    }

    public function gagalupload()
    {
        $this->session->set_flashdata('flash','Anda belum menambahkan Gambar 1');
        redirect('managementProduk/tambah');
    }public function gagalupload1()
    {
        $this->session->set_flashdata('flash','Yang anda upload bukan gambar');
        redirect('managementProduk/tambah');
    }public function gagalupload2()
    {
        $this->session->set_flashdata('flash','Gambar terlalu besar');
        redirect('managementProduk/tambah');
    }
    public function gagalupload3()
    {
        $this->session->set_flashdata('flashgagal','Anda belum menambahkan Gambar 1');
        redirect('managementProduk/edit');
    }
    public function gagalupload4()
    {
        $this->session->set_flashdata('flashgagal','Yang anda upload bukan gambar');
        redirect('managementProduk/edit');
    }public function gagalupload5()
    {
        $this->session->set_flashdata('flashgagal','Gambar terlalu besar');
        redirect('managementProduk/edit');
    }
    
}
