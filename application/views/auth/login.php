<!-- register-page Section Start -->

<div class="login">

    <div class="container">
        <h5><a href="<?= base_url() . "home/index"; ?>">Home</a><span>/</span><a href="#"><?= $judul; ?></a>
    </div>
    <hr>
    <div class="container">
        <h3 data-aos="fade-up" data-aos-delay="300">login</h3>
        <?= $this->session->flashdata('message'); ?>
        <form class="form-horizontal" data-aos="fade-up" data-aos-delay="400" action="<?= base_url() . "auth/login"; ?>"
            method="post">
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
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Password"
                            name="password">
                        <?= form_error('password', '<small class="text-danger pl-4">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="rememberMe" value="on" name="rememberMe">
                <label class="form-check-label" for="rememberMe">Ingat saya</label>
            </div>

            <div class="row">
                <div class="col-md-12 button-1">
                    <button type="submit" class="btn btn-success">Login</button>
                    <span>Not Registered? <a href="<?= base_url() . "auth/registrasi"; ?>">Register Here</a></span>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- register-page Section End -->

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
<!-- Footer -->