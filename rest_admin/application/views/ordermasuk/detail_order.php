

<div class="col col2">
       <!--  -->
   <a href="<?= base_url(); ?>orderMasuk">
   <button type="button" class="btn btn-secondary tambah mt-2">Kembali</button>
   </a>
   <!--  -->
   <div class="row">
    <div class="col">
       <div class="card mt-1" >
        <div class="card-header"> 
      
  
           <h5>Detail Orderan </h5> 
        </div>
        <ul class="list-group list-group-flush">
   
                <li class="list-group-item" > Kode Transaksi :<br><?= $detilsingle[0]->id_jual; ?></li>
        
                <li class="list-group-item" >Tanggal Pesan :<br> <?= $detilsingle[0]->tgl_jual; ?></li>
                <li class="list-group-item" > Nama Customer :<br><?= $cust[0]->nama; ?></li>
                <div class="card-header">
                    <h5>Barang</h5> </div>
                <!-- <li class="list-group-item" > Nama Barang:<br> <?= $detiljual->data[0]->nm_brg; ?></li>
                <li class="list-group-item" > Qty:<br> <?= $detiljual->data[0]->qty; ?></li>
                <li class="list-group-item" > Harga :<br> Rp.<?= $detiljual->data[0]->harga; ?></li>     -->
            <table class="tables ml-4" border="1" cellpadding="10" cellspacing="0">
           <tr>
              <th> No </th>
              <th> Nama Produk</th>
              <th> Foto Produk</th>
              <th> Qty</th>
              <th> Harga</th>
             </tr>
          <!-- Membuat Variabel $i untuk perulangan pada No ditabel -->
          <?php $i = 1; ?>
        
          <?php foreach ($detiljual as $us) :?>
         
            <tr>
               <td><?= $i ?></td>
               <td><?= $us->nm_brg;?></td>
               <!-- <td><?= $us->foto;?></td> -->
               <td> <img src="<?= $us->foto; ?>" width="200" height="200" alt="<?= $us->foto; ?>"></td>

               <td><?= $us->qty;?></td>
               <td>Rp.<?= $us->hargaplusqty;?></td>
               
            </tr>
            <?php $i ++ ?>
            <?php endforeach ;?>
        
        </table>
        </ul>
    </div>
    <div class="card-header">
                <h5>Total Bayar</h5> </div>
                <li class="list-group-item" > Total :<br> Rp.<?= $us->total; ?></li>    
    </div>
    <div class="col">
       <div class="card mt-1">
        <div class="card-header">
           <h5>Alamat</h5> 
        </div>
        <ul class="list-group list-group-flush">
                <li class="list-group-item" > Alamat:<br> <?= $detilsingle[0]->alamat; ?></li>
                <li class="list-group-item" > Provinsi :<br><?= $detilsingle[0]->provinsi; ?></li>
                <li class="list-group-item" > Kota :<br><?= $detilsingle[0]->kota; ?></li>
                <li class="list-group-item" > Kecamatan :<br> <?= $detilsingle[0]->kecamatan; ?></li>
                <li class="list-group-item" > Kode Pos :<br><?= $detilsingle[0]->kd_pos; ?></li>
                <li class="list-group-item" > Ongkir : <br>Rp.<?= $detilsingle[0]->ongkir; ?></li>
                <li class="list-group-item" > Status:<br><?= $detilsingle[0]->status; ?>
                <?php if ( $detilsingle[0]->status == 'Pesan' ) : ?>
                <a href="<?= base_url(); ?>orderMasuk/UpdateSingle/<?=$detilsingle[0]->id_jual?>" class=" ml-5 badge badge-success p-3"  onclick="return confirm ('Update Status di kirim ?')"> Update Status </a></li>  </li>  
                <?php endif; ?>
               </ul>
    </div>
    </div>
</div>
 


