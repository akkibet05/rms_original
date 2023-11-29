<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12"></div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="section-login-register-form">
                <form id="reset_form">
                <input type="hidden" name="csrf_token" value="<?php echo esc_output($this->security->get_csrf_hash()); ?>">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label><?php echo lang('new_password'); ?></label>
                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                        <input type="password" name="password" class="form-control shadow-none border-none" />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label><?php echo lang('enter_password_again'); ?></label>
                        <input type="password" name="retype_password" class="form-control shadow-none border-none" />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="reset_form_button"><?php echo lang('reset'); ?></button>
                    </div>
                </div>
                </form>
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
