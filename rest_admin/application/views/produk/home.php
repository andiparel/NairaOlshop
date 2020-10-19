
<div class="col col2">
<h2>Daftar Produk</h2>
<section>
    <?php if ($this->session->flashdata('flash')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
    <?php endif; ?>
</section>
<section>
    <?php if ($this->session->flashdata('flashgagal')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal</strong> <?= $this->session->flashdata('flashgagal'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
    <?php endif; ?>
</section>
   
        <a href="<?= base_url(); ?>managementProduk/tambah">
        <button type="button" class="btn btn-secondary tambah">Tambah Produk</button>
        </a>
        <!-- Table -->
        <div class="col">
        <table class="tables" border="2" cellpadding="10" cellspacing="0" class="ml-5">
           <tr>
              <th> No </th>
              <th> Nama Produk</th>
              <th> Stok</th>
              <th> Harga</th>
              
              <th> Aksi </th>
           </tr>
          <!-- Membuat Variabel $i untuk perulangan pada No ditabel -->
          <?php $i = 1; ?>


          <?php foreach ($barang as $us) :?>
            <tr>
               <td><?= $i ?></td>
               <td><?= $us->nm_brg;?></td>
               <td><?= $us->stok;?></td>
               <td>Rp.<?= $us->harga;?></td>
               
               <td>
                    <a href="<?= base_url(); ?>managementProduk/detail/<?= $us->kd_brg ?>/<?= $us->id_kat ?>" class="badge badge-primary  ">detail</a>
                    <a href="<?= base_url(); ?>managementProduk/edit/<?= $us->kd_brg ?>/<?= $us->id_kat ?>" class="badge badge-success ">Edit</a>
                    <a href="<?= base_url(); ?>managementProduk/hapus/<?= $us->kd_brg; ?>" class="badge badge-danger   " onclick="return confirm('Yakin ?')">Hapus</a>
               </td> 
            </tr>
            <?php $i ++ ?>
          <?php endforeach ;?>
        </table>
      </div>

        <!-- Akhir Table -->
        <!-- <div class="col">
            <div class="card" style="width: 40rem;">
                <div class="card-header">
                    <h2>Daftar Nama Produk</h2>
                </div>
                <ul class="list-group list-group-flush">
                <?php foreach ($produk as $pd) :?>
                        <li class="list-group-item">
                            <?= $pd['nama']?>
                            <a href="<?= base_url(); ?>/managementProduk/edit/<?= $pd['id_produk'] ?>" class="badge badge-success ml-2 float-right">Edit</a>
                            <a href="<?= base_url(); ?>/managementProduk/hapus/<?= $pd['id_produk']; ?>" class="badge badge-danger  ml-2 float-right " onclick="return confirm('Yakin ?')">Hapus</a>
                            <a href="<?= base_url(); ?>/managementProduk/detail/<?= $pd['id_produk']; ?>" class="badge badge-primary  ml-2 float-right">detail</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div> -->
    </div>