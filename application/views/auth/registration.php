<!-- About Section Start -->
<div class="register-page">
    <div class="container">
        <h5><a href="<?= base_url() . "home/index"; ?>">Home</a><span>/</span><a href="#"><?= $judul; ?></a>
    </div>
    <hr>
    <div class="container">
        <h3 data-aos="fade-up" data-aos-delay="300">Register</h3>
        <form class="form-horizontal" data-aos="fade-up" data-aos-delay="400"
            action="<?= base_url() . "auth/registrasi"; ?>" method="post">
            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                            value="<?= set_value('email') ?>">
                        <?= form_error('email', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama"
                            value="<?= set_value('nama') ?>">
                        <?= form_error('nama', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="Password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="Password" name="password1"
                            placeholder="Password">
                        <?= form_error('password1', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password2" name="password2"
                            placeholder="Ulang password">
                        <?= form_error('password2', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 button-1">
                    <button type="submit" class="btn btn-success">Register</button>
                    <span>Have been registered? <a href="<?= base_url() . "auth/login"; ?>">Login here</a></span>
                </div>
            </div>

        </form>

    </div>
</div>
<!-- About Section End -->