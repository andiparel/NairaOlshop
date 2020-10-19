
 
      <div class="col col2">
      <a class="" href="<?= base_url(); ?>managementKategori/">
            <button type="button" class="btn btn-secondary tambah mt-2">Kembali</button>
            </a>
         <div class="card" style="width: 18rem;">
               <div class="card-header">
                  <h5>Form Tambah Kategori</h5>
               </div>
               <ul class="list-group list-group-flush">
               <!-- Pengecekan jika terjadi error, maka alert akan tampil -->
                  <?php if( validation_errors() ) :?>
                     <div class="alert alert-danger" role="alert">
                     <!-- Error yang terjadi  -->
                     <?= validation_errors(); ?>
                  </div>
               <?php endif ;?>
                  <form action="" method="post">
                     <div class="form-group m-3">
                           <label for="nama">Nama Kategori</label>
                              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama..">
                              <!-- <label for="gambar" class="mt-2">Gambar </label>
                              <input type="file" name="gambar" id="gambar"> -->
                              <button type="submit" class="btn btn-primary m-2 float-right">Tambah</button>
                     </div>
                  </form>
               </ul>
         </div>
      </div>
