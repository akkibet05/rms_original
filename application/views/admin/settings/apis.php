  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_api_settings'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_api_settings'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">

        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('api_settings'); ?></h3>
            </div>
            <?php if (allowedTo('apis_settings')) { ?>
            <form id="admin_settings_form">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <h2>
                    <a href="https://code.tutsplus.com/tutorials/create-a-google-login-page-in-php--cms-33214" target="_blank">
                      <?php echo lang('google').' '.lang('login'); ?>
                    </a>
                  </h2>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('enable_google_login'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="enable-google-login" value="yes" <?php sel(setting('enable-google-login'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                    <input type="radio" class="minimal" name="enable-google-login" value="no" <?php sel(setting('enable-google-login'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('define_client_id'); ?></label>
                    <input type="text" class="form-control" name="google-client-id" value="<?php echo setting('google-client-id'); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('define_google_client_secret'); ?></label>
                    <input type="text" class="form-control" name="google-client-secret" value="<?php echo setting('google-client-secret'); ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('paste_this_redirect_google'); ?></label>
                    <input type="text" class="form-control" value="<?php echo setting('google-app-redirect'); ?>" readonly />
                  </div>
                </div>
                <div class="col-md-12">
                  <hr />
                </div>
                <div class="col-md-12">
                  <h2>
                    <a href="https://www.linkedin.com/developers/login" target="_blank">
                      <?php echo lang('linkedin').' '.lang('login'); ?>
                    </a>
                  </h2>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('enable_linkedin_login'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="enable-linkedin-login" value="yes" <?php sel(setting('enable-linkedin-login'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                    <input type="radio" class="minimal" name="enable-linkedin-login" value="no" <?php sel(setting('enable-linkedin-login'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('define_linkedin_app_id'); ?></label>
                    <input type="text" class="form-control" name="linkedin-app-id" value="<?php echo setting('linkedin-app-id'); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('define_linkedin_app_secret'); ?></label>
                    <input type="text" class="form-control" name="linkedin-app-secret" value="<?php echo setting('linkedin-app-secret'); ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('enable_google_login'); ?></label>
                    <input type="text" class="form-control" value="<?php echo setting('linkedin-app-redirect'); ?>" readonly />
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
