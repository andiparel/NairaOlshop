<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <!-- <div class="row row-top">
            <div class="col"> -->
        <div class="row  ">
            <div class="col offset-3">
                <h1 class="display-4 align-center">Halaman Login</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col col-6 offset-3">
                <form  class="admin" method="post" action="<?= base_url(); ?>">
                    <div class="form-group">
                        <?= $this->session->flashdata('message');?>
                        <label for="nama">Email </label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email" class="inputLogin" >
                        <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
               
            </div>
        </div>
        <div class="row pb-3">
            <div class="col-3 offset-5">
                <a href="">
                    <button type="submit" class="btn btn-outline-primary btn-group-lg">Masuk</button>
                </a>
                </form>
            </div>
        </div>
            <!-- </div>
        </div> -->
    </div>
</div>