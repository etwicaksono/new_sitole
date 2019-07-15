<section class="my-profile">
    <div class="container">
        <h5><a href="<?= base_url() . "home/index"; ?>">Home</a><span>/</span><a href="#"><?= $judul; ?></a>
    </div>
    <hr>
    <?php $user = $this->session->userdata(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0" data-aos="fade-up" data-aos-delay="300">
                <h3>My Profile</h3>
                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's printer took a galley of type and scrambled it to make a type specimen book. It has
                    survived not only fiveLorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's printer took a galley of type and scrambled it to make a type
                    specimen book. </p> -->
            </div>
        </div>

        <div class="row " data-aos="fade-up" data-aos-delay="500">
            <div class="col-md-2 col-12">
                <figure class="box-2">
                    <img src="<?= base_url() . "assets/img/profile/" . $user['foto']; ?>" alt="" width="100%"
                        class="img-responsive">
                </figure>
            </div>
            <div class="col-md-10 col-12">
                <div class="row">
                    <div class="col-md-3 col-4">
                        <p>Nama</p>
                    </div>
                    <div class="col-md-9 col-8">
                        <p><span>:</span><?= $user['nama_asli']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-4">
                        <p>Email</p>
                    </div>
                    <div class="col-md-9 col-8">
                        <p><span>:</span><?= $user['email']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-4">
                        <p>Kontak</p>
                    </div>
                    <div class="col-md-9 col-8">
                        <p><span>:</span><?= $user['no_hp']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-4">
                        <p>Alamat</p>
                    </div>
                    <div class="col-md-9 col-8">
                        <p><span>:</span><?= $user['alamat']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-4">
                        <p>Bergabung Sejak</p>
                    </div>
                    <div class="col-md-9 col-8">
                        <p><span>:</span><?= date('m F Y', $user['date_created']); ?></p>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-3 col-4">
                        <p>Social Links</p>
                    </div>
                    <div class="col-md-9 col-8">
                        <p><span>:</span>
                            <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                        </p>
                    </div>
                </div> -->
                <a href="<?= base_url('user/editProfile'); ?>" class="btn btn-primary align-right">Edit Profile</a>
            </div>
        </div>
    </div>
</section>

<section class="blog blog-other">
    <div class="subscribe">
        <div class="gradient"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-2">
                        <h3>Sign up to newsletter - Get in touch with us instantly</h3>
                        <h4>Email letters will be sent in regular monthly basis. We will send you regular emails with
                            our best deals and offers.</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <form class="row form-inline">
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control" placeholder="Enter your name" required />
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control" placeholder="Enter your Email id" required />
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Subscribe now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>