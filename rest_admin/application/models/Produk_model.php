<?php

class Produk_model extends CI_Model
{
    public function getAllProduk()
    {
        return $this->db->get('produk')->result_array();
    }

    public function TambahProduk($gambar ,$gambar2 )
    {
      
       
        $data = array(
            'nama' => $this->input->post('nama',true),
            'nama_Pkategori' => $this->input->post('kategori',true),
            'harga' => $this->input->post('harga',true),
            'warna' => $this->input->post('warna',true),
            'gambar' => $gambar,
            'gambar2' => $gambar2,
            'deskripsi' => $this->input->post('deskripsi',true)

        ); 
       
        $this->db->insert('produk',$data);
    }

    public function upload(){

        $namaFile = $_FILES['foto']['name'];
        $ukurangFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        // //cek apakah tidak ada foto yang diupload
        if ( $error === 4 ){
            // redirect('managementProduk/gagalupload');
            redirect('managementProduk/gagalupload');

        }else{
            //cek apakah yang diupload adalah foto
            $ekstensifotoValid = ['jpg','jpeg','png'];
            $ekstensifoto = explode('.', $namaFile);
            $ekstensifoto = strtolower (end($ekstensifoto));

            if( in_array($ekstensifoto, $ekstensifotoValid) ){
                //cek jika ukurannya terlalu besar
                if( $ukurangFile < 1000000){
                    

                }else{
                    redirect('managementProduk/gagalupload2');
                }

            }else{
                redirect('managementProduk/gagalupload1');
            }
        }

        //cek apakah user pilih foto baru atau tidak
        //  if ( $_FILES['foto']['error'] === 4 ){
        //      $foto = $fotoLama;
        //  }else {
        //      $foto = upload();
        //  }

        //Lolos pengecekan, foto siap diupload
        //generate nama foto baru
        
        $nama = $namaFile;

        $namaFileBaru = 'http://';
        $namaFileBaru .= '192.168.43.245/TUGAS_AKHIR/DenganJWT/rest_admin/assets/img/';
        $namaFileBaru .= $nama ;

        $namabaru = $nama ;

        move_uploaded_file($tmpName, './assets/img/'. $namabaru);
        return $namaFileBaru;
  
    }

    public function upload2(){

        $namaFile = $_FILES['foto']['name'];
        $ukurangFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

            $ekstensifotoValid = ['jpg','jpeg','png'];
            $ekstensifoto = explode('.', $namaFile);
            $ekstensifoto = strtolower (end($ekstensifoto));

            if( in_array($ekstensifoto, $ekstensifotoValid) ){
                //cek jika ukurannya terlalu besar
                if( $ukurangFile < 1000000){
                    $nama = $namaFile;

                    $namaFileBaru = 'http://';
                    $namaFileBaru .= '192.168.43.245/TUGAS_AKHIR/DenganJWT/rest_admin/assets/img/';
                    $namaFileBaru .= $nama ;
            
                    $namabaru = $nama ;
            
                    move_uploaded_file($tmpName, './assets/img/'. $namabaru);
                    return $namaFileBaru;
                }else{
                    redirect('managementProduk/gagalupload5');
                }

            }else{
                redirect('managementProduk/gagalupload4');
            }
        
    }



    function getKategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    function getKategoriByid($id_kategori)
    {
        return $this->db->get_where('kategori',['id_kat' => $id_kategori])->row_array();

    }


    public function getProdukById($id_produk)
    {
        // return $this->db->get_where('barang',['kd_brg' => $id_produk])->row_array();

        $this->db->select('*');
        $this->db->join('kategori', 'barang.id_kat = kategori.id_kat');
        return $this->db->get_where('barang',['kd_brg' => $id_produk])->row_array();



    } public function getProdukByGambar($gambar)
    {
        return $this->db->get_where('produk',['gambar' => $gambar])->result_array();
        // $query =$this->db->get_where('produk',['id_produk' => $id]);
        // $query =$this->db->get_where('kategori',['id_kategori' => $id]);
        // return $query->result_array();
    }


    public function EditDataProduk($id,$gambar,$gambar2)
    {
        $data = array(
            'nama' => $this->input->post('nama',true),
            // 'id_kategori' => $this->input->post('nama_kateg',true),
            'harga' => $this->input->post('harga',true),
            'warna' => $this->input->post('warna',true),
            'nama_Pkategori' => $this->input->post('nama_Pkategori',true),
            'gambar' => $gambar,
            'gambar2' => $gambar2
        );
       
        $this->db->where('id_produk', $id);
        $this->db->update('produk', $data);
    }
    
}