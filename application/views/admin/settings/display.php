<!-- Content Wrapper Starts -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fas fa-cube"></i> <?php echo lang('update_display_settings'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
            <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_display_settings'); ?></li>
        </ol>
    </section>
    <!-- Main content Starts-->
    <section class="content">
        <!-- Main row Starts-->
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo lang('display_settings'); ?></h3>
                    </div>
                    <?php if (allowedTo('display_settings')) { ?>
                    <form id="admin_settings_form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('select_site_logo'); ?></label>
                                        <?php $file = setting('site-logo') != '' ? base_url().'assets/images/identities/'.setting('site-logo') : ''; ?>
                                        <input type="file" class="form-control dropify" name="site-logo" data-default-file="<?php echo esc_output($file); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('select_home_banner'); ?></label>
                                        <?php $file = base_url().'assets/images/identities/'.setting('main-banner'); ?>
                                        <input type="file" class="form-control dropify" name="main-banner" data-default-file="<?php echo esc_output($file); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('select_favicon'); ?></label>
                                        <?php $file = setting('site-favicon') != '' ? base_url().'assets/images/identities/'.setting('site-favicon') : ''; ?>
                                        <input type="file" class="form-control dropify" name="site-favicon" data-default-file="<?php echo esc_output($file); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label><?php echo lang('define_body_bg'); ?></label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="body-bg" value="<?php echo setting('body-bg'); ?>">
                                                <div class="input-group-addon">
                                                    <i style="background-color: <?php echo setting('body-bg'); ?>"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label><?php echo lang('define_main_menu_bg'); ?></label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="main-menu-bg" value="<?php echo setting('main-menu-bg'); ?>">
                                                <div class="input-group-addon">
                                                    <i style="background-color: <?php echo setting('main-menu-bg'); ?>"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label><?php echo lang('define_main_banner_bg'); ?></label>
                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="main-banner-bg" value="<?php echo setting('main-banner-bg'); ?>">
                                                <div class="input-group-addon">
                                                    <i style="background-color: <?php echo setting('main-banner-bg'); ?>"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label><?php echo lang('define_main_banner_height'); ?></label>
                                            <input type="text" class="form-control" name="main-banner-height" 
                                                value="<?php echo esc_output(setting('main-banner-height')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('display_front_color_theme_selector_panel'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="display-front-color-theme-selector-panel" value="yes" <?php sel(setting('display-front-color-theme-selector-panel'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="display-front-color-theme-selector-panel" value="no" <?php sel(setting('display-front-color-theme-selector-panel'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_front_dark_mode_button'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-front-dark-mode-button" value="yes" <?php sel(setting('enable-front-dark-mode-button'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-front-dark-mode-button" value="no" <?php sel(setting('enable-front-dark-mode-button'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><?php echo lang('default_front_color_theme'); ?></label>
                                        <select name="default-front-color-theme" class="form-control">
                                            <option value="blue" <?php echo setting('default-front-color-theme') == 'blue' ? 'selected' : ''; ?>>
                                                <?php echo lang('blue'); ?>
                                            </option>
                                            <option value="green" <?php echo setting('default-front-color-theme') == 'green' ? 'selected' : ''; ?>>
                                                <?php echo lang('green'); ?>
                                            </option>
                                            <option value="orange" <?php echo setting('default-front-color-theme') == 'orange' ? 'selected' : ''; ?>>
                                                <?php echo lang('orange'); ?>
                                            </option>
                                            <option value="magenta" <?php echo setting('default-front-color-theme') == 'magenta' ? 'selected' : ''; ?>>
                                                <?php echo lang('magenta'); ?>
                                            </option>
                                            <option value="brown" <?php echo setting('default-front-color-theme') == 'brown' ? 'selected' : ''; ?>>
                                                <?php echo lang('brown'); ?>
                                            </option>
                                            <option value="maldives" <?php echo setting('default-front-color-theme') == 'maldives' ? 'selected' : ''; ?>>
                                                <?php echo lang('maldives'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.form group -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="admin_settings_form_button"><?php echo lang('save'); ?></button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </section>
        </div>
        <!-- Main row Ends-->
    </section>
    <!-- Main content Ends-->
</div>
<!-- Content Wrapper Ends -->
<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
</body>
</html>