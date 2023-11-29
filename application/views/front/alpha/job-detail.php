  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2>
          <span>
            <a href="<?php echo base_url(); ?>jobs">
              <?php echo lang('browse_jobs'); ?></a> : <?php echo esc_output($job['title'], 'html'); ?>
            </span>
          </h2>
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
            <?php include(VIEW_ROOT.'/front/alpha/partials/job-sidebar.php'); ?>
          </div>
          <div class="col-md-9 col-lg-9 col-sm-12">
            <?php if(setting('display-jobs-to-only-logged-in-users') == 'yes' && !candidateSession()) { ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="job-detail account-no-content-box">
                            <?php echo lang('login_to_view_jobs'); ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-detail">
                  <p class="job-listing-heading">
                    <span class="job-listing-heading-text">
                      <a href="<?php echo base_url(); ?>job/<?php echo esc_output($job['slug']); ?>">
                        <?php echo esc_output($job['title'], 'html'); ?>
                      </a>
                    </span>
                    <span class="job-listing-heading-line"></span>
                  </p>
                  <p class="job-listing-job-info">
                    <span class="job-listing-job-info-date"><i class="fa fa-clock-o"></i> 
                      <?php echo lang('posted_on'); ?> : <?php echo dateLang($job['created_at']); ?>
                    </span>
                    <?php if ($job['department']) { ?>
                    <span class="job-listing-job-info-date"><i class="fa fa-bookmark"></i> <?php echo esc_output($job['department'], 'html'); ?></span>
                    <?php } ?>
                    <?php if ($job['quizes_count'] > 0) { ?>
                    <span class="job-listing-job-info-item" 
                      title="Requires <?php echo $job['quizes_count']; ?> <?php echo lang('quizes_to_be_attempted'); ?>">
                      <i class="fa fa-list"></i> <?php echo $job['quizes_count']; ?> <?php echo lang('quizes'); ?></span>
                    <?php } ?>
                    <?php if ($job['traits_count'] > 0) { ?>
                    <span class="job-listing-job-info-item" title="Requires <?php echo $job['traits_count']; ?> <?php echo lang('traits'); ?>">
                      <i class="fa fa-star-half-o"></i> <?php echo $job['traits_count']; ?> <?php echo lang('traits'); ?></span>
                    <?php } ?>
                    <?php $favorite = in_array($job['job_id'], $jobFavorites) ? 'favorite' : ''; ?>
                    <span class="job-listing-job-info-item mark-favorite <?php echo $favorite ? 'favorited' : ''; ?>"
                      title="<?php echo $favorite ? 'Unmark' : 'Mark'; ?> <?php echo lang('favorite'); ?>"
                      data-id="<?php echo encode($job['job_id']); ?>">
                      <i class="fa fa-heart"></i></span>
                    <span class="job-listing-job-info-item refer-job" title="<?php echo lang('refer_this_job'); ?>"
                      data-id="<?php echo encode($job['job_id']); ?>">
                      <i class="fa fa-user-plus"></i></span>
                  </p>
                  <div class="job-detail-job-description">
                    <?php echo esc_output($job['description'], 'raw'); ?>

                    <?php if (isset($job['job_filters'])) { ?>
                    <?php foreach ($job['job_filters'] as $jf) { ?>
                      <div classs="job-filter-title-value-wrap">
                      <span class="job-filter-title"><?php echo esc_output($jf['title']); ?></span>
                      <span class="job-filter-separator"> : </span>
                      <span class="job-filter-value"><?php echo esc_output(implode(', ',$jf['values'])); ?></span>
                      </div>
                    <?php } ?>
                    <?php } ?>


                  </div>
                  <div class="container">
                    <div class="row job-listing-items-container">
                      <?php if ($job['fields']) { ?>
                        <?php foreach ($job['fields'] as $key => $value) { ?>
                          <?php if ($value['label']) { ?>
                            <div class="col-md-4 col-sm-6 job-listing-items">
                              <span class="job-listing-items-title" title="<?php echo esc_output($value['label']); ?>">
                                <?php echo trimString(esc_output($value['label'])); ?>
                              </span>
                              <span class="job-listing-items-value" title="<?php echo esc_output($value['value']); ?>">
                                <?php echo trimString(esc_output($value['value'])); ?>
                              </span>
                            </div>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if (candidateSession()) { ?>
              <?php if (!in_array($job['job_id'], $applied)) { ?>
                <form id="job_apply_form">
                <?php if ($job['traits']) { ?>
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="job-detail">
                      <p class="job-detail-heading">
                        <span class="job-detail-heading-text"><?php echo lang('traits'); ?></span>
                        <span class="job-detail-heading-line"></span>
                      </p>
                      <p class="job-detail-job-description">
                        <?php echo lang('please_rate_yourself'); ?>
                      </p>
                      <div class="row">
                        <?php foreach ($job['traits'] as $trait) { ?>
                          <div class="col-md-6 col-lg-6 col-sm-12">
                            <p class="job-detail-job-trait">
                              <span class="job-detail-job-trait-title"><?php echo esc_output($trait['title'], 'html'); ?></span>
                              <input type="hidden" name="trait_titles[<?php echo encode($trait['id']); ?>]" value="<?php echo esc_output($trait['title']); ?>">
                              <select class="pill-rating" name="traits[<?php echo encode($trait['id']); ?>]" autocomplete="off">
                                <option value="0"><?php echo lang('n_a'); ?></option>
                                <option value="1"><?php echo lang('poor'); ?></option>
                                <option value="2"><?php echo lang('bad'); ?></option>
                                <option value="3"><?php echo lang('average'); ?></option>
                                <option value="4"><?php echo lang('good'); ?></option>
                                <option value="5"><?php echo lang('excellent'); ?></option>
                              </select>
                            </p>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <?php if (setting('enable-multiple-resume') == 'yes') { ?>
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="job-detail">
                      <p class="job-detail-heading">
                        <span class="job-detail-heading-text"><?php echo lang('apply_for_this_job'); ?></span>
                        <span class="job-detail-heading-line"></span>
                      </p>
                      <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                          <p class="job-detail-job-trait">
                            <label><?php echo lang('please_select_one_of_your_resume'); ?></label>
                            <input type="hidden" name="job_id" value="<?php echo encode($job['job_id']); ?>">
                            <select class="form-control" name="resume" autocomplete="off">
                              <?php foreach ($resumes as $resume) { ?>
                                <option value="<?php echo encode($resume['resume_id']); ?>"><?php echo esc_output($resume['title'], 'html'); ?></option>
                              <?php } ?>
                            </select>
                          </p>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                          <p class="job-detail-job-trait">
                            <button href="#" type="submit" class="btn btn-primary" 
                              title="Apply" id="job_apply_form_button"><?php echo lang('apply'); ?></button>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                      <input type="hidden" name="resume" value="<?php echo encode($resume_id); ?>">
                      <input type="hidden" name="job_id" value="<?php echo encode($job['job_id']); ?>">
                      <button href="#" type="submit" class="btn btn-primary" 
                        title="Apply" id="job_apply_form_button"><?php echo lang('apply'); ?></button>
                        <br /><br />
                    </div>
                  </div>
                </div>

                <?php } ?>
                </form>
              <?php } else { ?>
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="job-detail account-no-content-box">
                      <?php echo lang('you_have_already_applied'); ?><br />
                      <a href="<?php echo base_url(); ?>account/job-applications"><?php echo lang('go_to_job_applications'); ?></a>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php } else { ?>
              <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <div class="job-detail account-no-content-box">
                    <?php echo lang('you_need_to_be_logged_in'); ?><br />
                    <a href="<?php echo base_url(); ?>login"><?php echo lang('login'); ?></a>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php } ?>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main> 

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>