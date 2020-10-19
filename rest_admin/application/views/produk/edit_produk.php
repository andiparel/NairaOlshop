
<div class="col col2">
   <?php if ($this->session->flashdata('flash')) : ?>
      <div class="row">
         <div class="col">
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
               <strong>Gagal <br></strong> <?= $this->session->flashdata('flash'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
         </div>
      </div>
   <?php endif; ?>

   <!--  -->
   <a href="<?= base_url(); ?>managementProduk">
   <button type="button" class="btn btn-secondary tambah mt-2">Kembali</button>
   </a>
   <!--  -->
   <div class="row">
      <div class="col">
         <div class="card" >
            <div class="card-header">
               <h5>Form Edit Produk</h5>
            </div>
            <ul class="list-group list-group-flush">
            <!-- Pengecekan jika terjadi error, maka alert akan tampil -->
            <?php if( validation_errors() ) :?>
                  <div class="alert alert-danger" role="alert">
                  <!-- Error yang terjadi  -->
                  <?= validation_errors(); ?>
               </div>
            <?php endif ;?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group m-3">
                        <label for="nama">Nama Produk</label>
                           <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama.." autocomplete="off" value="<?= $barang[0]->nm_brg;?>">
                        <label for="kategori">Kategori</label>
                           <select name="kategori" id="kategori" class="form-control" name="kategori">
                              <option value="<?php echo $kategori2[0]->id_kat?>"> <?php echo $kategori2[0]->nm_kat?> </option>
                              <?php foreach($kategori1 as $row) { ?>
                              <option name="kategori" value="<?php echo $row->id_kat?>"><?php echo $row->nm_kat?></option>
                           <?php } ?>
                           </select>
                        <!-- <label for="gambar" class="mt-2">Foto</label>
                           <input type="file" name="gambar" id="gambar"> -->
                        <br><label for="nama">Berat</label>
                           <input type="text" class="form-control" id="nama" name="berat" placeholder="Jumlah berat.." autocomplete="off"value="<?= $barang[0]->berat;?>">
                        <label for="nama">Stok</label>
                           <input type="text" class="form-control" id="nama" name="stok" placeholder="Jumlah stok.." autocomplete="off"value="<?= $barang[0]->stok;?>">
                        <label for="harga" class="mt-2">Harga</label>
                           <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan harga.." autocomplete="off"value="<?= $barang[0]->harga;?>">

                        <label for="deskripsi" class="mt-2">Deskripsi (Optional)</label><br>
                           <!-- <textarea type="text" class="form-control" name="deskripsi" id="deskripsi" rows="3" <?= $barang[0]->deskripsi;?>></textarea> -->
                           <textarea style="width:430px; height:200px" class="ckeditor" id="deskripsi" name="deskripsi"><?php echo $barang[0]->deskripsi; ?></textarea> 
                           <br>
                  </div>
            </ul>
         </div>
      </div>
      <div class="col">
         <div class="card" style="width: 18rem;">
            <div class="card-header">
               <h5>Foto Sebelumnya</h5>
            </div>
            <div class="form-group m-3">
                        <img src="<?= $barang[0]->foto; ?>" width="200" height="200" alt="<?= $barang[0]->foto; ?>">
                        <input type="hidden" name="gambarLama" value="<?= $barang[0]->foto; ?>">
            </div>
            <div class="card-header">
               <h5>Upload Foto Baru</h5>
            </div>
            <div class="form-group m-3">
                     <li class="list-group-item">                  
                        <input type="file" name="foto" id="foto"value="<?= $barang[0]->foto;?>"><br>
                     </li>
                     <button type="edit" class="btn btn-primary mt-3">Edit</button>
                     </form>

            </div>
         </div>
      </div>
   </div>
 
</div>
