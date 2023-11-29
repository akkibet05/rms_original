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
                    <form class="form" id="profile_update_form">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('first_name'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" name="first_name" 
                                        value="<?php echo esc_output($candidate['first_name']); ?>">
                                    <small class="form-text text-muted"><?php echo lang('enter_first_name'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('last_name'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" name="last_name" 
                                        value="<?php echo esc_output($candidate['last_name']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_last_name'); ?>.</small>
                                </div>                 
                            </div>                   
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('phone'); ?> 1</label>
                                    <input type="text" class="form-control shadow-none border-none" name="phone1" 
                                        value="<?php echo esc_output($candidate['phone1']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_phone'); ?>.</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('email'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" name="email" 
                                        value="<?php echo esc_output($candidate['email']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_email'); ?></small>
                                </div>                     
                            </div>               
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('city'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" 
                                        name="city" value="<?php echo esc_output($candidate['city']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_city'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('phone'); ?> 2</label>
                                    <input type="text" class="form-control shadow-none border-none" 
                                        name="phone2" value="<?php echo esc_output($candidate['phone2']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_phone'); ?> 2.</small>
                                </div>                     
                            </div>               
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('country'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" name="country" 
                                        value="<?php echo esc_output($candidate['country']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_country'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('state'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" name="state" 
                                        value="<?php echo esc_output($candidate['state']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_state'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('gender'); ?></label>
                                    <select name="gender" class="form-control shadow-none border-none">
                                        <option value="male" <?php echo esc_output($candidate['gender']) == 'male' ? 'selected' : '';; ?>>
                                            <?php echo lang('male'); ?>
                                        </option>
                                        <option value="female" <?php echo esc_output($candidate['gender']) == 'female' ? 'selected' : '';; ?>>
                                            <?php echo lang('female'); ?>
                                        </option>
                                        <option value="other" <?php echo esc_output($candidate['gender']) == 'other' ? 'selected' : '';; ?>>
                                            <?php echo lang('other'); ?>
                                        </option>
                                    </select>
                                    <small class="form-text text-muted"><?php echo lang('select_gender'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('address'); ?></label>
                                    <input type="text" class="form-control shadow-none border-none" name="address" 
                                        value="<?php echo esc_output($candidate['address']); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('enter_address'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('date_of_birth'); ?></label>
                                    <input type="date" class="form-control shadow-none border-none datepicker" name="dob" 
                                        value="<?php echo date('Y-m-d', strtotime($candidate['dob'])); ?>" />
                                    <small class="form-text text-muted"><?php echo lang('select_date_of_birth'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('short_biography'); ?></label>
                                    <textarea class="form-control shadow-none border-none" name="bio"><?php echo esc_output($candidate['bio']); ?></textarea>
                                    <small class="form-text text-muted"><?php echo lang('enter_short_biography'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-group-account">
                                    <label for="input-file-now-custom-1"><?php echo lang('image_file'); ?></label>
                                    <?php $thumb = candidateThumb($candidate['image']); ?>
                                    <input type="file" id="input-file-now-custom-1" class="dropify" 
                                            data-default-file="<?php echo esc_output($thumb); ?>" name="image" />                                    
                                    <small class="form-text text-muted"><?php echo lang('only_jpg_or_png_allowed'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 text-center">
                                <div class="form-group form-group-account">
                                    <button type="submit" class="btn btn-general" title="Save" id="profile_update_form_button">
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