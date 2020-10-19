<?php

class Laporan_model extends CI_Model
{
    public function getAllLaporan()
    {
        $this->db->select('*');
        $this->db->from('laporan');
        $this->db->join('order_masuk', 'laporan.id_laporan = order_masuk.id_order');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllOrd()
    {
        return $this->db->get('laporan')->result_array();
    }

}