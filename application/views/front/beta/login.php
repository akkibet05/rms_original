<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<!-- Section Login Container Starts -->
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12"></div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="section-login-register-form">
                <div class="row">
                    <form action="<?php echo base_url(); ?>post-login" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo esc_output($this->security->get_csrf_hash()); ?>">
                        <?php include(VIEW_ROOT.'/front/beta/partials/messages.php'); ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('email'); ?></label>
                            <input type="email" name="email" class="form-control shadow-none border-none" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label><?php echo lang('password'); ?></label>
                            <input type="password" name="password" class="form-control shadow-none border-none" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-lg-12">
                            <label for="">
                                <input type="checkbox" name="remember" /> <?php echo lang('remember_me'); ?>
                            </label>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <button class="btn" id="front_password_reset_form_button">
                                <i class="fa-regular fa-paper-plane"></i> <?php echo lang('login'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account login-other-btns">
                            <?php if(setting('enable-forgot-password') == 'yes') { ?>
                            <a href="<?php echo base_url(); ?>forgot-password"><?php echo lang('forgot_password'); ?> ?</a>
                            <?php } ?>
                            <?php if(setting('enable-register') == 'yes') { ?>
                            <a href="<?php echo base_url(); ?>register"><?php echo lang('register'); ?></a>
                            <?php } ?>
                        </div>
                        <Br />
                    </div>
                </div>
                <div class="row">
                    <hr />
                    <?php if(setting('enable-google-login') == 'yes') { ?>
                    <div class="col-md-6 col-lg-6">
                        <a href="<?php echo $googleLogin; ?>" class="btn-social btn-google">
                        <span class="fab fa-google"></span> <?php echo lang('sign_in_google'); ?>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if(setting('enable-linkedin-login') == 'yes') { ?>
                    <div class="col-md-6 col-lg-6">
                        <a href="<?php echo $linkedinLogin; ?>" class="btn-social btn-linkedin">
                        <span class="fab fa-linkedin"></span> <?php echo lang('sign_in_linkedin'); ?>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12"></div>
    </div>
</div>
<!-- Section Login Container Ends -->

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>