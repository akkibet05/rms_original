  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_home_page_settings'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_home_page_settings'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">

        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('home_page_settings'); ?></h3>
            </div>
            <?php if (allowedTo('home_page_settings')) { ?>
            <form id="admin_settings_form">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php echo lang('default_landing_page'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="default-landing-page" value="home" <?php sel(setting('default-landing-page'), 'home', 'checked'); ?>> <?php echo lang('home'); ?>
                    <input type="radio" class="minimal" name="default-landing-page" value="jobs" <?php sel(setting('default-landing-page'), 'jobs', 'checked'); ?>> <?php echo lang('jobs'); ?>
                    <input type="radio" class="minimal" name="default-landing-page" value="news" <?php sel(setting('default-landing-page'), 'news', 'checked'); ?>> <?php echo lang('news'); ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php echo lang('display_home_banner'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="home-banner" value="yes" <?php sel(setting('home-banner'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                    <input type="radio" class="minimal" name="home-banner" value="no" <?php sel(setting('home-banner'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php echo lang('enable_how_it_works'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="how-it-works" value="yes" <?php sel(setting('how-it-works'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                    <input type="radio" class="minimal" name="how-it-works" value="no" <?php sel(setting('how-it-works'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php echo lang('enable_department_section'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="department-section" value="yes" <?php sel(setting('department-section'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                    <input type="radio" class="minimal" name="department-section" value="no" <?php sel(setting('department-section'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label><?php echo lang('enable_news_section'); ?></label>
                    <br />
                    <input type="radio" class="minimal" name="news-section" value="yes" <?php sel(setting('news-section'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                    <input type="radio" class="minimal" name="news-section" value="no" <?php sel(setting('news-section'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('banner_text'); ?></label>
                    <textarea class="form-control" id="banner-text" name="banner-text"><?php echo esc_output(setting('banner-text'), 'html'); ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('text_before_how_it_works'); ?></label>
                    <textarea class="form-control" id="before-how" name="before-how"><?php echo esc_output(setting('before-how'), 'html'); ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('text_after_how_it_works'); ?></label>
                    <textarea class="form-control" id="after-how" name="after-how"><?php echo esc_output(setting('after-how'), 'html'); ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('text_before_news'); ?></label>
                    <textarea class="form-control" id="before-news" name="before-news"><?php echo esc_output(setting('before-news'), 'html'); ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('text_after_news'); ?></label>
                    <textarea class="form-control" id="after-news" name="after-news"><?php echo esc_output(setting('after-news'), 'html'); ?></textarea>
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
