<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<!-- Section Register Container Starts -->
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12"></div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="section-login-register-form">
                <form id="register_form">
                <input type="hidden" name="csrf_token" value="<?php echo esc_output($this->security->get_csrf_hash()); ?>">
                <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('first_name'); ?></label>
                            <input type="text" name="first_name" class="form-control" />
                            <small id="" class="form-text text-muted"><?php echo lang('enter_first_name'); ?>.</small>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('last_name'); ?></label>
                            <input type="text" name="last_name" class="form-control" />
                            <small id="" class="form-text text-muted"><?php echo lang('enter_last_name'); ?>.</small>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('gender'); ?></label>
                            <select name="gender" class="form-control">
                                <option value="male"><?php echo lang('male'); ?></option>
                                <option value="femal"><?php echo lang('female'); ?></option>
                                <option value="other"><?php echo lang('other'); ?></option>
                            </select>
                            <small id="" class="form-text text-muted"><?php echo lang('select_gender'); ?></small>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('email'); ?></label>
                            <input type="email" name="email" class="form-control shadow-none border-none" />
                            <small id="" class="form-text text-muted"><?php echo lang('enter_email'); ?>.</small>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('password'); ?></label>
                            <input type="password" name="password" class="form-control shadow-none border-none" />
                            <small id="" class="form-text text-muted"><?php echo lang('enter_password'); ?></small>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for=""><?php echo lang('retype_password'); ?></label>
                            <input type="password" name="retype_password" class="form-control shadow-none border-none" />
                            <small id="" class="form-text text-muted"><?php echo lang('enter_password_again'); ?>.</small>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                            <button class="btn" id="register_form_button">
                            <?php echo lang('register'); ?>
                            </button>                                
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
<!-- Section Register Container Ends -->

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>
