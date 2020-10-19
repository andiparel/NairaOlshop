<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-4" style="width: 18rem;">
                <div class="card-header">
                    <?= $kategori['nama_kategori']; ?>
                </div>
                <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Nama Barang = <?= $kategori['nama_kategori']; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-4">
        <div class="col">
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Gambar2</th>
                </tr>

            <?php $i = 1; ?>
            <?php foreach ($produk as $p) :?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['nama']; ?></td>
                </tr>
                <?php $i ++ ; ?>
            <?php endforeach ;?>
            </table>
        </div>
    </div> -->
    <div class="row mt-4">
        <div class="col">
            <div class="card" style="width: 25rem;">
                <div class="card-header text-center">
                    <h2>Daftar Kategori</h2>
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($produk as $kt) :?>
                        <li class="list-group-item">
                            <?= $kt['nama_produk']?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>