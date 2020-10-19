<?php

class Kategori_model extends CI_Model
{
    public function getAllKategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function TambahKategori()
    {
        $data = array(
            'nama_kategori' => $this->input->post('nama',true),
        );
        $this->db->insert('kategori',$data);
    }
    
    public function getKategoriById($id)
    {
        return $this->db->get_where('kategori',['id_kat' => $id])->row_array();
    }

    public function EditDataKategori($id)
    {
        $data = array(
            'nama_kategori' => $this->input->post('nama',true),
        );
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);
    }
    public function getProdukById($id)
    {
        return $this->db->get_where('produk',['id_produk' => $id])->row_array();
    }
    public function getAllProduk()
    {
        return $this->db->get('produk')->result_array();
    }
}