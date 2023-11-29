<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<div class="section-account-alpha-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="section-account-alpha-navigation">
                    <?php include(VIEW_ROOT.'/front/beta/partials/account-sidebar.php'); ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="section-account-alpha-profile">
                    <form class="form" id="password_update_form">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('old_password'); ?></label>
                                    <input type="password" class="form-control shadow-none border-none" 
                                        placeholder="#@$SG2" name="old_password" value="">
                                    <small class="form-text text-muted"><?php echo lang('enter_old_password'); ?></small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('new_password'); ?></label>
                                    <input type="password" class="form-control shadow-none border-none" 
                                        placeholder="#@$SG2" name="new_password" value="">
                                    <small class="form-text text-muted"><?php echo lang('enter_new_password'); ?></small>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('retype_password'); ?></label>
                                    <input type="password" class="form-control shadow-none border-none" 
                                        placeholder="#@$SG2" name="retype_password" value="">
                                    <small class="form-text text-muted"><?php echo lang('enter_password_again'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 text-center">
                                <div class="form-group form-group-account">
                                    <button type="submit" class="btn btn-general" title="Save" id="password_update_form_button">
                                        <i class="fas fa-save"></i> <?php echo lang('save'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>