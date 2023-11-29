  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('password'); ?></span></h2>
      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Account Area Setion
    ============================-->
    <section id="about">
      <div class="container">

        <div class="row mt-10">
          <div class="col-lg-3">
            <div class="account-area-left">
              <ul>
                <?php include(VIEW_ROOT.'/front/alpha/partials/account-sidebar.php'); ?>
              </ul>
            </div>
          </div>
          <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="account-box">
                  <p class="account-box-heading">
                    <span class="account-box-heading-text"><?php echo lang('password'); ?></span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                    <form class="form" id="password_update_form">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('old_password'); ?></label>
                          <input type="password" name="old_password" class="form-control" placeholder="!£$AB09">
                          <small class="form-text text-muted"><?php echo lang('enter_old_password'); ?></small>
                        </div>
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('new_password'); ?></label>
                          <input type="password" name="new_password" class="form-control" placeholder="!£$AB09">
                          <small class="form-text text-muted"><?php echo lang('enter_new_password'); ?></small>
                        </div>
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('retype_password'); ?></label>
                          <input type="password" name="retype_password" class="form-control" placeholder="!£$AB09">
                          <small class="form-text text-muted"><?php echo lang('enter_password_again'); ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success" title="Save" id="password_update_form_button">
                            <i class="fa fa-floppy-o"></i> <?php echo lang('update'); ?>
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
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>
