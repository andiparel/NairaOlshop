<div class="col col2">
    <h2>Table Orderan</h2>
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="row mt-4">
                <div class="col">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Orderan <strong>Sudah</strong> <?= $this->session->flashdata('flash'); ?>
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
                </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($order as $od) : ?>
                    <tr>
                        <td><?= $i ?></td>

                    </tr>
                <?php $i ++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>

</div>