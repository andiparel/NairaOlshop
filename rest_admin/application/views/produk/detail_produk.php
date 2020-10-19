
<div class="col col2">
       <!--  -->
   <a href="<?= base_url(); ?>managementProduk">
   <button type="button" class="btn btn-secondary tambah mt-2">Kembali</button>
   </a>
   <!--  -->
   <div class="row">
       <div class="col">
            <div class="card mt-4">
                <div class="card-header">
                <h5> Detail Produk Barang </h5>
           
                </div>
                <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Kategori :<br> </a><?= $kategori[0]->nm_kat; ?></li>
                        <li class="list-group-item"> Nama Barang :<br>  <?= $produk[0]->nm_brg; ?></li>
                        <li class="list-group-item"> Harga : <br> Rp. <?= $produk[0]->harga; ?></li>
                        <li class="list-group-item"> Stok :<br>  <?= $produk[0]->stok;?></li>
                        <li class="list-group-item"> Berat :<br>  <?= $produk[0]->berat;?> kg</li>
                        <li class="list-group-item"> Deskripsi :<br>  <?= $produk[0]->deskripsi; ?></li>
                </ul>
            </div>
       </div>
       <div class="col">
            <div class="card mt-4" style="width: 15rem;">
                <div class="card-header">
                <h5> Foto Barang </h5>
                </div>
                <ul class="list-group list-group-flush">       
                    <li class="list-group-item"> <img src="<?= $produk[0]->foto; ?>" width="200" height="200" alt="<?= $produk[0]->foto; ?>"></li>
                </ul>
            </div>
       </div>
   </div>

</div>
