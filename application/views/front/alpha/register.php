  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('register'); ?></span></h2>
      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Account Area Setion
    ============================-->
    <section class="main-container">
      <div class="container">
        <div class="row mt-10">
          <div class="col-lg-2">
          </div>
          <div class="col-md-8 col-lg-8 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="account-box">
                  <p class="account-box-heading">
                    <span class="account-box-heading-text"><?php echo lang('register'); ?></span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                    <form class="form" id="register_form">
                    <div class="row">
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('first_name'); ?></label>
                          <div class="input-group mb-3">
                            <input type="text" name="first_name" class="form-control" placeholder="<?php echo lang('first_name'); ?>" 
                            aria-label="First Name" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_first_name'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('last_name'); ?></label>
                          <div class="input-group mb-3">
                            <input type="text" name="last_name" class="form-control" placeholder="<?php echo lang('last_name'); ?>" 
                            aria-label="Last Name" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_last_name'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('gender'); ?></label>
                          <div class="input-group mb-3">
                            <select name="gender" class="form-control">
                              <option value="male"><?php echo lang('male'); ?></option>
                              <option value="femal"><?php echo lang('female'); ?></option>
                              <option value="other"><?php echo lang('other'); ?></option>
                            </select>
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('select_gender'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('email'); ?></label>
                          <div class="input-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="<?php echo lang('email'); ?>" 
                            aria-label="Email" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_email'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('password'); ?></label>
                          <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password'); ?>" 
                            aria-label="Email" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_password'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('retype_password'); ?></label>
                          <div class="input-group mb-3">
                            <input type="password" name="retype_password" class="form-control" placeholder="Password" 
                            aria-label="Email" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                            </div>
                          </div>
                          <small id="" class="form-text text-muted"><?php echo lang('enter_password_again'); ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success" title="Save" id="register_form_button">
                            <?php echo lang('register'); ?>
                          </button>
                        </div>
                      </div>
                    </div>
                    </form>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <a href="<?php echo base_url(); ?>login"><?php echo lang('back_to_login'); ?></a><br />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
          </div>          
        </div>
      </div>
    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>
