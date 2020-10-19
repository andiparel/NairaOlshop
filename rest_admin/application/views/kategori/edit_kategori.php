        <div class="col col2">
        <a class="" href="<?= base_url(); ?>managementKategori">
            <button type="button" class="btn btn-secondary tambah mt-3 mb-4">Kembali</button>
            </a>
             <!-- Pengecekan jika terjadi error, maka alert akan tampil -->
          
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    <h5>Form Edit Kategori</h5>
                </div>

                <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <!-- Error yang terjadi  -->
                            <?= validation_errors();?>
                        </div>
                    <?php endif; ?>
                <ul class="list-group list-group-flush">
                    <form action="" method="post">
                        <div class="form-group m-3">
                         <!-- 1 -->
                            <?php echo form_open('kategori/edit_kategori');?>
                            <?php echo form_hidden('id_kat',$kategori[0]->id_kat);?>

                             <label for="nama" class="mr-5">ID</label><br>
                             <?php echo form_input('',$kategori[0]->id_kat,"disabled");?><br>
                             <label for="nama" class="mr-4"> Nama</label><br>
                             <?php echo form_input('nm_kat',$kategori[0]->nm_kat);?><br>
                             <button type="edit" class="btn btn-primary m-2 float-right">Update</button>
                             <br>
                             <?php
                            echo form_close();
                            ?>

                           
                        </div>
                        
                    </form>
                   
                </ul>
            </div>
        </div>
