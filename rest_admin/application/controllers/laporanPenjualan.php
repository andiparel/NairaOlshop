<?php
defined('BASEPATH') or exit('No direct script access allowed');

class laporanpenjualan extends CI_Controller
{
    var $API ="";

    public function __construct()
    {
        parent::__construct();
        $this->TOKEN= array(
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
                            );
        $this->API="http://localhost/TUGAS_AKHIR/DenganJWT/rest_server/api/"; 
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->model('Laporan_model');
    }
    public function index()
    { 
        $data['judul'] = 'Laporan Penjualan';
        $data['laporan'] = json_decode($this->curl->simple_post($this->API.'laporan/List_Laporan',$this->TOKEN));

        $this->load->view('templates/header2',$data);
        $this->load->view('laporanpenjualan',$data);
        $this->load->view('templates/footer');
    }
   //hapus
   public function selesai($id)
   {
    $params = array('id'=>$id,
    'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
    );
    $delete =  $this->curl->simple_post($this->API.'laporan/Delete_Laporan', $params  , array(CURLOPT_BUFFERSIZE => 10)); 
    if($delete)
    {
        $this->session->set_flashdata('flash','dihapus');
    }else
    {
       $this->session->set_flashdata('flashgagal','dihapus');
    }
      redirect('laporanPenjualan');
   }
 
}
