<div class="col col2">
<h2>Laporan Penjualan</h2>
<?php if ($this->session->flashdata('flash')) : ?>
      <div class="row mt-4">
         <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               Laporan <strong>Sudah</strong> <?= $this->session->flashdata('flash'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
         </div>
      </div>
   <?php endif; ?>
   <?php if ($this->session->flashdata('flashgagal')) : ?>
      <div class="row mt-4">
         <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               Laporan <strong>Gagal</strong> <?= $this->session->flashdata('flashgagal'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
         </div>
      </div>
   <?php endif; ?>
<table class="table mt-3">
        <thead>
            <th scope="col">No</th>
            <th scope="col">Kode Laporan</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Pendapatan</th>
            <th scope="col">Keterangan</th>
  
        </tr>
        </thead>
        <tbody>
       
          
        <?php $i = 1; ?>
        <?php foreach ($laporan as $od) : ?>
            <tr>
                 <td><?= $i ?></td>
                <td><?= $od->id?></td>
                <td><?= $od->tgl  ?></td>

              
                <td>Rp.<?= $od->pendapatan?></td>

                <td> <a href="<?= base_url(); ?>laporanPenjualan/selesai/<?= $od->id ?>" class="badge badge-success" onclick="return confirm ('Hapus ?')"> Selesai </a>
                </td> 
                </tr> 
            <?php $i ++ ?>
        <?php endforeach; ?>
        </tbody>
    </table>
   
</div></div>