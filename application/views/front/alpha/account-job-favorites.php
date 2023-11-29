  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('job_favorites'); ?></span></h2>
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
            <?php if ($jobs) { ?>
            <?php foreach ($jobs as $job) { ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-listing">
                  <p class="job-listing-heading">
                    <span class="job-listing-heading-text">
                      <a href="<?php echo base_url(); ?>job/<?php echo encode($job['job_id']); ?>"><?php echo esc_output($job['title'], 'html'); ?></a>
                    </span>
                    <span class="job-listing-heading-line"></span>
                  </p>
                  <p class="job-listing-job-info">
                    <span class="job-listing-job-info-date"><i class="fa fa-clock-o"></i> <?php echo lang('favorited_on'); ?> : <?php echo timeFormat($job['favorited_on']); ?></span>
                    <span class="job-listing-job-info-date"><i class="fa fa-bookmark"></i> <?php echo esc_output($job['department'], 'html'); ?></span>
                    <span class="job-listing-job-info-item refer-job" title="Refer this job"
                      data-id="<?php echo encode($job['job_id']); ?>">
                      <i class="fa fa-user-plus"></i></span>
                  </p>
                  <div class="job-listing-job-description">
                    <?php echo trimString($job['description'], 280); ?>
                    <a href="<?php echo base_url(); ?>job/<?php echo encode($job['job_id']); ?>"><?php echo lang('read_more'); ?></a>
                  </div>
                  <div class="container">
                    <div class="row job-listing-items-container">
                      <?php if ($job['fields']) { ?>
                        <?php foreach ($job['fields'] as $key => $value) { ?>
                          <?php if ($value['label']) { ?>
                          <div class="col-md-4 col-sm-6 job-listing-items">
                            <span class="job-listing-items-title" title="<?php echo esc_output($value['label'], 'html'); ?>">
                              <?php echo trimString(esc_output($value['label'], 'html')); ?>
                            </span>
                            <span class="job-listing-items-value" title="<?php echo esc_output($value['value'], 'html'); ?>">
                              <?php echo trimString(esc_output($value['value'], 'html')); ?>
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
            <?php } ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <?php echo esc_output($pagination, 'raw'); ?>
              </div>
            </div>             
            <?php } else { ?>
              <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <div class="job-detail account-no-content-box">
                    <?php echo lang('no_jobs_found'); ?>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>