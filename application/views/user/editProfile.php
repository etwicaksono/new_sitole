<!-- About Section Start -->
<div class="register-page">
    <div class="container">
        <h5><a href="<?= base_url() . "home/index"; ?>">Home</a><span>/</span><a href="#"><?= $judul; ?></a>
    </div>
    <hr>
    <?php $user = $this->session->userdata(); ?>
    <div class="container">
        <h3 data-aos="fade-up" data-aos-delay="300">Edit Profile</h3>
        <form class="form-horizontal" data-aos="fade-up" data-aos-delay="400"
            action="<?= base_url('user/editProfile'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="<?= $user['nama_asli']; ?>">
                        <?= form_error('nama', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group row col-lg-6 ">
                    <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?= base_url('assets/img/profile/') . $user['foto']; ?>" class="img-thumbnail"
                                    alt="">

                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input border" id="image" name="image">
                                    <label for="image"
                                        class="custom-file-label border border-border-primary px-2 py-2">Choose
                                        File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" readonly
                            value="<?= $user['email']; ?>">
                        <?= form_error('email', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="Kontak" class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kontak" name="kontak"
                            value="<?= $user['no_hp']; ?>">
                        <?= form_error('kontak', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="kontak" name="kontak">
                            <?= $user['alamat']; ?>
                        </textarea>
                        <?= form_error('kontak', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>

        </form>

    </div>
</div>
<!-- About Section End -->