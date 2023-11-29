<?php include('header.php'); ?>
<section id="contain">
    <div class="login-block-lp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 login-block-in-lp">
                    <div class="login-box-lp">
                        <div class="login-box-in-lp">
                            <form id="login_form">
                                <div class="login-title-lp requirement-heading">Application Requirements</div>
                                <div class="requirement-label">
                                    <?php if (phpversion() >= 5.6) { ?>
                                        <?php sessionVariables('php_version', 'true'); ?>
                                        <img src="images/found.png" title="Found" height="20"/> PHP Version : (version <?php echo phpversion(); ?>)
                                        <br />
                                    <?php } else { ?>
                                        <?php sessionVariables('php_version', 'false'); ?>
                                        <img src="images/not-found.png" title="Found" height="20"/> PHP Version should be 5.6 or greater. (Your version <?php echo phpversion(); ?>)
                                    <?php } ?>
                                    <span class="requirement-info-text">For overall application functioning.</span>
                                </div>
                                <div class="requirement-label">
                                    <?php if (extension_loaded('pdo')) { ?>
                                        <?php sessionVariables('pdo', 'true'); ?>
                                        <img src="images/found.png" title="Found" height="20"/> PDO extension enabled
                                    <?php } else { ?>
                                        <?php sessionVariables('pdo', 'false'); ?>
                                        <img src="images/not-found.png" title="Found" height="20"/> PDO extension disabled
                                    <?php } ?>
                                    <span class="requirement-info-text">For database connections.</span>
                                </div>
                                <div class="requirement-label">
                                    <?php if (extension_loaded('gd')) { ?>
                                        <?php sessionVariables('gd', 'true'); ?>
                                        <img src="images/found.png" title="Found" height="20"/> GD Enabled
                                    <?php } else { ?>
                                        <?php sessionVariables('gd', 'false'); ?>
                                        <img src="images/not-found.png" title="Found" height="20"/> GD Disabled
                                    <?php } ?>
                                    <span class="requirement-info-text">For image manipulation.</span>
                                </div>
                                <div class="requirement-label">
                                    <?php if (extension_loaded('openssl')) { ?>
                                        <?php sessionVariables('openssl', 'true'); ?>
                                        <img src="images/found.png" title="Found" height="20"/> OpenSSL Enabled
                                    <?php } else { ?>
                                        <?php sessionVariables('openssl', 'false'); ?>
                                        <img src="images/not-found.png" title="Found" height="20"/> OpenSSL Disabled
                                    <?php } ?>
                                    <span class="requirement-info-text">For latest security standards.</span>
                                </div>
                                <div class="requirement-label">
                                    <?php if (function_exists('curl_version')) { ?>
                                        <?php sessionVariables('curl', 'true'); ?>
                                        <img src="images/found.png" title="Found" height="20"/> CURL Enabled (version <?php echo curl_version()['version']; ?>)
                                    <?php } else { ?>
                                        <?php sessionVariables('curl', 'false'); ?>
                                        <img src="images/not-found.png" title="Found" height="20"/> CURL Disabled
                                    <?php } ?>
                                    <span class="requirement-info-text">For cross site requests.</span>
                                </div>
                                <div class="requirement-label">
                                    <?php if (is_writable(rootDirectory().'/assets/images/')) { ?>
                                        <?php sessionVariables('uploads_writeable', 'true'); ?>
                                        <img src="images/found.png" title="Found" height="20"/> Uploads folder writeable
                                    <?php } else { ?>
                                        <?php sessionVariables('uploads_writeable', 'false'); ?>
                                        <img src="images/not-found.png" title="Found" height="20"/> Uploads folder not writeable
                                    <?php } ?>
                                    <span class="requirement-info-text">For uploading user, department and other images.</span>
                                </div>
                                <?php if (allVariablesTrue()) { ?>
                                    <div class="login-btn-lp">
                                        <a href="<?php echo base_url(); ?>/database.php" style="color: white" type="submit" class="btn-common">Proceed to database credentials</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="requirement-label">
                                        <img src="images/not-found.png" title="Found" height="20"/> Please make sure all the requirements are fulfilled
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<?php include('footer.php'); ?>
