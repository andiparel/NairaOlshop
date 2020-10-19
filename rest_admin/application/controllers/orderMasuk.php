<?php
defined('BASEPATH') or exit('No direct script access allowed');

class orderMasuk extends CI_Controller
{

    var $API="";

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

        $this->load->model('Ordermasuk_model');
    }
    public function index()
    { 
        $data['judul'] = 'Order Masuk';
        // $params = array('id_jual'=> $this->API.'/jual');
        // $data['orders12'] = $this->Ordermasuk_model->duatable();
        $Sorders['a2'] = json_decode($this->curl->simple_post($this->API.'detiljual/List_Detiljual',$this->TOKEN));
        // $Sorders['a2'] = json_decode($this->curl->simple_post($this->API.'jual/List_Jual',$this->TOKEN));
        // $Sorders['a3'] = json_decode($this->curl->simple_get($this->API.'/detiljualmany'));
    
        
        // $data['order'] = $this->Ordermasuk_model->duatable();
        $this->load->view('templates/header2',$data);
        $this->load->view('ordermasuk/home.php',$Sorders);
        $this->load->view('templates/footer');
    }
    public function detail($id,$idcust)
    {
        $data['judul'] = "Detail data Produk";
     
        $params = array('id_jual'=>$id,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $params2 = array('id_cust'=>$idcust,
        'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );

        $data['detilsingle'] = json_decode($this->curl->simple_post($this->API.'jual/List_Jual',$params));
        $data['detiljual'] = json_decode($this->curl->simple_post($this->API.'detiljual/List_DetilJualPlusBarang',$params));
        // $data['barang'] = json_decode($this->curl->simple_get($this->API.'/barang',$params2));
        $data['cust'] = json_decode($this->curl->simple_post($this->API.'user/Customer',$params2));

        $this->load->view('templates/header2', $data);
        $this->load->view('ordermasuk/detail_order', $data);
        $this->load->view('templates/footer');  
    }
     //hapus
     public function selesai($id,$tgl,$pendapatan)
     {
        $data = array(
            'id'           => 'id',
            'id_jual'      =>  $id,
            'tgl'          => $tgl,
            'pendapatan'   => $pendapatan,
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
            
        $insert =  $this->curl->simple_post($this->API.'laporan/Tambah_Laporan', $data, array(CURLOPT_BUFFERSIZE => 10)); 

        if($insert)
        {
            $data2 = array('id_jual'=>$id,
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
            );

            $deletedetiljual = $this->curl->simple_post($this->API.'detiljual/Delete_DetilJual',  $data2, array(CURLOPT_BUFFERSIZE => 10));
           
            if($deletedetiljual)
             {
                $deletestatusorder = $this->curl->simple_post($this->API.'status_order/Delete_StatusOrder', $data2, array(CURLOPT_BUFFERSIZE => 10));
                if($deletestatusorder)
                {
                    $deletejual = $this->curl->simple_post($this->API.'jual/Delete_Jual', $data2, array(CURLOPT_BUFFERSIZE => 10));

                    if( $deletejual){
                        $this->session->set_flashdata('flash','Data masuk ke Laporan Penjualan');
                        redirect('ordermasuk');
                    }else{
                        $this->session->set_flashdata('flashgagal','Gagal menghapus Jual !');
                        redirect('orderMasuk');
                    }
                }else{
                    $this->session->set_flashdata('flashgagal','Gagal menghapus Status Order !');
                    redirect('orderMasuk');
                }
            }else{
                $this->session->set_flashdata('flashgagal','Gagal menghapus detil jual !');
                redirect('orderMasuk');
            }        
            
        }else
        {
            $this->session->set_flashdata('flashgagal','Data  Gagal masuk ke Laporan Penjualan');
            redirect('ordermasuk');
        }
     }
     
     public function UpdateSingle($id){
        $status='dikirim';
        $data = array(
            'id_jual'      =>  $id,
            'status'       =>   $status,
            'token' =>  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1hIjoiYW5kaUBnbWFpbC5jb20ifQ.J6TgTF8UM4qcHvMvjR8cElvR_F2kARhW2buS7TYQako'
        );
        $update =  $this->curl->simple_post($this->API.'jual/Update_Jual', $data, array(CURLOPT_BUFFERSIZE => 10)); 
        $update1 =  $this->curl->simple_post($this->API.'status_order/Update_Status', $data, array(CURLOPT_BUFFERSIZE => 10)); 

        if( $update)
        {
            if( $update1 )
            {
                $this->session->set_flashdata('flash','Status Orderan Dikirm');
            }
        }else {
            $this->session->set_flashdata('flashgagal','Status Gagal diubah !');
            redirect('orderMasuk');
        }
        redirect('orderMasuk');
     }
}
