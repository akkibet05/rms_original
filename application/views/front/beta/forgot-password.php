<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12"></div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="section-login-register-form">
                <div class="row">
                    <form id="forgot_form" action="<?php echo base_url(); ?>send-password-link" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo esc_output($this->security->get_csrf_hash()); ?>">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('email'); ?></label>
                            <input type="email" name="email" class="form-control shadow-none border-none" />
                            <small id="" class="form-text text-muted"><?php echo lang('enter_email_to_receive'); ?></small>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <button type="submit" class="btn btn-success" id="forgot_form_button" title="Save"><?php echo lang('send'); ?></button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account login-other-btns">
                            <a href="<?php echo base_url(); ?>login"><?php echo lang('back_to_login'); ?></a><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12"></div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>
