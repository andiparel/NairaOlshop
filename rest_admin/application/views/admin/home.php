<div class="col col2">
   <p><?= $this->session->userdata('admin') ?></p>

   <h1 class="mt-5">Daftar User</h1>
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
   <?php endif; ?><?php if ($this->session->flashdata('flashgagal')) : ?>
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
   <?php endif; ?><?php if ($this->session->flashdata('flashgagal1')) : ?>
      <div class="row">
         <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Request Wrong</strong> <?= $this->session->flashdata('flashgagal1'); ?>
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
              <th> Email </th>
              <th> No telepon </th>
              <th> Aksi </th>
           </tr>
          <!-- Membuat Variabel $i untuk perulangan pada No ditabel -->
          <?php $i = 1; ?>

          <?php foreach ($a as $us) :?>
            <tr>
               <td><?= $i ?></td>
               <td><?= $us->nama?></td>
               <td><?= $us->email?></td>
               <td><?= $us->notelp?></td>
               <td>
                  <a href="<?= base_url(); ?>admin/hapus/<?= $us->id_cust ?>" class="badge badge-danger   " onclick="return confirm('Yakin ?')">Hapus</a>
               </td> 
            </tr>
            <?php $i ++ ?>
          <?php endforeach ;?>
        </table>
        <!-- echo <?= $this->pagination->create_links(); ?> -->

      </div>
      </div>
   </div>