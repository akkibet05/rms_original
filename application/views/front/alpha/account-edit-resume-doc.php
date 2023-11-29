  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('resumes'); ?> > <?php echo esc_output($resume['title']); ?></span></h2>
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
                    <span class="account-box-heading-text"><?php echo lang('update_resume'); ?></span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <div class="container">
                  <form class="form" id="resume_update_form">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('title'); ?></label>
                          <input type="hidden" name="resume_id" value="<?php echo encode($resume['resume_id']); ?>">
                          <input type="text" class="form-control" placeholder="Marketing Resume" 
                          name="title" value="<?php echo esc_output($resume['title']); ?>">
                          <small class="form-text text-muted"><?php echo lang('enter_first_name'); ?></small>
                        </div>
                        <div class="form-group form-group-account">
                          <label for=""><?php echo lang('status'); ?></label>
                          <select name="status" class="form-control">
                            <option value="1" <?php echo esc_output($resume['status']) == '1' ? 'selected' : ''; ?>><?php echo lang('active'); ?></option>
                            <option value="0" <?php echo esc_output($resume['status']) == '0' ? 'selected' : ''; ?>><?php echo lang('inactive'); ?></option>
                          </select>
                          <small class="form-text text-muted"><?php echo lang('select_status'); ?></small>
                        </div>                        
                        <div class="form-group form-group-account">
                          <label for="input-file-now-custom-1">
                            <?php echo lang('file'); ?>
                            <?php if ($resume['file']) { ?>
                            <a target="_blank" href="<?php echo candidateThumb($resume['file']); ?>" title="Download">
                              <?php echo lang('download'); ?>
                            </a>
                            <?php } ?>
                          </label>
                          <input type="file" id="input-file-now-custom-1" class="dropify" 
                          data-default-file="" name="file" />
                          <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                        </div>                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success" title="Save" id="resume_update_form_button">
                            <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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