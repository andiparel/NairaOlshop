
      <div class="col col2">
        <h1>History User</h1>
    <?php if ($this->session->flashdata('flash')) : ?>
      <div class="row">
         <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               Data Produk <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
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
              <th> Kode Produk </th>
              <th> Tanggal </th>
              <th> Kode Transaksi </th>
              <th> Aksi </th>
           </tr>
          <!-- Membuat Variabel $i untuk perulangan pada No ditabel -->
          <?php $i = 1; ?>

          <?php foreach ($history as $us) :?>
            <tr>
               <td><?= $i ?></td>
               <td><?= $us->id_produk?></td>
               <td><?= $us->tanggal?></td>
               <td><?= $us->id_order?></td>
               <td><?= $us->id_user?></td>
            </tr>
            <?php $i ++ ?>
          <?php endforeach ;?>
        </table>
      </div>

   </div>