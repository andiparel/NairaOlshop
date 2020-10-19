<?php

class Ordermasuk_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->API="http://localhost/TUGAS_AKHIR/rest_server/index.php/";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->model('Ordermasuk_model');
    }
    
    public function getAllOrderMasuk()
    {
        return $this->db->get('order_masuk')->result_array();
    }

    public function duatable(){
        // $this->db->select('order_masuk.id_order'
        //                     ,'order_masuk.tanggal'
        //                     ,'user.nama_user'
        //                     ,'produk.nama'
        //                     ,'kategori.nama_kategori');
        $this->db->select('*');
        $this->db->from("$this->API.'/jual'");
        $this->db->join($this->API.'/detiljual',$this->API.'/jual.id_jual' .'='.$this->API.'/detiljual.id_jual');
        $query = $this->db->get();
        return $query->result();
    }
    public function selesai2($id,$tanggal,$pendapatan)
    {
        $data = array(
            'id_laporan' => $id,
            'tanggal_history' => $tanggal,
            'pendapatan' => $pendapatan
        );
        $this->db->insert('laporan',$data);
        // $this->db->insert('user_history',$data);
    }
    
}