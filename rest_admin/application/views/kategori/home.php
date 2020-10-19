<div class="col col2">
   <h1 class="mt-5">Daftar Kategori</h1>
   
   <a class="" href="<?= base_url(); ?>managementKategori/tambah">
            <button type="button" class="btn btn-secondary tambah ml-5 mb-4">Tambah Kategori</button>
    </a>

      <?php if ($this->session->flashdata('flash')) : ?>
      <div class="row">
         <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            </div>
      </div>
   <?php endif; ?>
   <?php if ($this->session->flashdata('flashgagal')) : ?>
      <div class="row">
         <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Gagal</strong> <?= $this->session->flashdata('flashgagal'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            </div>
      </div>
   <?php endif; ?>
     <div class="col">
        <table border="2" cellpadding="10" cellspacing="0">
           <tr>
              <th> No </th>
              <th> Nama </th>
              <th> Aksi </th>
           </tr>
          <!-- Membuat Variabel $i untuk perulangan pada No ditabel -->
          <?php $i = 1; ?>

          <?php foreach ($kategori as $us) :?>
            <tr>
               <td><?= $i ?></td>
               <td><?= $us->nm_kat?></td>
               <td>
                  <a href="<?= base_url(); ?>managementKategori/hapus/<?= $us->id_kat?>" class="badge badge-danger   " onclick="return confirm('Yakin ?')">Hapus</a>
                  <a href="<?= base_url(); ?>managementKategori/edit/<?= $us->id_kat ?>" class="badge badge-success   " >Edit</a>
               </td> 
            </tr>
            <?php $i ++ ?>
          <?php endforeach ;?>
        </table>
      </div>
      </div>
   </div>