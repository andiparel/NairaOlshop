<div class="col col2">

    <h2>Table Orderan</h2>
<?php if ($this->session->flashdata('flash')) : ?>
      <div class="row mt-4">
         <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong><br> <?= $this->session->flashdata('flash'); ?>
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
               <strong>Gagal</strong><br> <?= $this->session->flashdata('flashgagal'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
         </div>
      </div>
   <?php endif; ?>

   
    <table  height="200px" width="600px" border="2" class="ml-5">
        <thead>
        <tr header=110px width=100px>
            <th scope="col">No</th>
            <th width="150px"scope="col">Tanggal</th>
            <th width="100px" scope="col">Kode Order</th>
            <th scope="col">Nama Customer</th>

            <th width="400px" scope="col">Alamat</th>
            <th scope="col">Status</th>
            <th width="200px" scope="col">Aksi</th>
        </tr>
        </thead>
        

         <tbody>
           <?php $i = 1; ?>
        
         <?php foreach ($a2 as $od) : ?>
      
      
                <tr>
                    <td header=110px width=100px height=50px><?= $i ?></td>
                    <td header=110px width=100px><?= $od->tgl_jual?></td>
                    <td><?= $od->id_jual?></td>
                    <td header=110px width=100px><?= $od->nama?></td>
                    <td header=110px width=100px><?= $od->alamat?></td>

                    <td header=110px width=100px><?= $od->status?> 
                     </td>
                <td> 

                  <?php if( $od->status == 'Sampai') :?>
                     <a href="<?= base_url(); ?>orderMasuk/detail/<?=$od->id_jual ?>/<?=$od->id_cust ?>" class="badge badge-primary"> Detail </a>

                     <a href="<?= base_url(); ?>orderMasuk/selesai/<?=$od->id_jual ?>/<?=$od->tgl_jual?>/<?=$od->total?>" class="badge badge-success" onclick="return confirm ('Hapus ?')"> Selesai </a>

                  <?php else : ?> 
                  
                     <a href="<?= base_url(); ?>orderMasuk/detail/<?=$od->id_jual ?>/<?=$od->id_cust ?>" class="badge badge-primary"> Detail </a>
                  <?php endif ;?>
  
                    </td> 
                </tr>
                <?php $i ++ ?>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>
</div>