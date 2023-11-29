  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('browse_jobs'); ?></span></h2>
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
          <div class="col-md-3 col-lg-3 col-sm-12">
            <?php include(VIEW_ROOT.'/front/alpha/partials/job-sidebar.php'); ?>
          </div>
          <div class="col-md-9 col-lg-9 col-sm-12">
            <?php if(setting('display-jobs-to-only-logged-in-users') == 'yes' && !candidateSession()) { ?>
            <div class="row">
                <div class="job-detail account-no-content-box">
                    <?php echo lang('login_to_view_jobs'); ?>
                </div>
            </div>
            <?php } else { ?>
            <?php if ($jobs) { ?>
            <?php foreach ($jobs as $job) { ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="job-listing">
                  <p class="job-listing-heading">
                    <span class="job-listing-heading-text">
                      <a href="<?php echo base_url(); ?>job/<?php echo $job['slug'] ? $job['slug'] : encode($job['job_id']); ?>">
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
                    <span class="job-listing-job-info-date">
                      <i class="fa fa-bookmark"></i> <?php echo esc_output($job['department']); ?>
                    </span>
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
                    <?php $favorite = in_array($job['job_id'], $jobFavorites) ? 'favorited' : ''; ?>
                    <span class="job-listing-job-info-item mark-favorite <?php echo $favorite; ?>"
                      title="<?php echo $favorite ? lang('unmark_favorite') : lang('mark_favorite'); ?>"
                      data-id="<?php echo encode($job['job_id']); ?>">
                      <i class="fa fa-heart"></i></span>
                    <span class="job-listing-job-info-item refer-job" title="<?php echo lang('refer_this_job'); ?>"
                      data-id="<?php echo $job['slug']; ?>">
                      <i class="fa fa-user-plus"></i></span>
                  </p>
                  <div class="job-listing-job-description">
                    <?php echo trimString($job['description'], 280); ?>
                    <?php if (isset($job['job_filters'])) { ?>
                    <?php foreach ($job['job_filters'] as $jf) { ?>
                      <div classs="job-filter-title-value-wrap">
                      <span class="job-filter-title"><?php echo esc_output($jf['title']); ?></span>
                      <span class="job-filter-separator"> : </span>
                      <span class="job-filter-value"><?php echo esc_output(implode(', ',$jf['values'])); ?></span>
                      </div>
                    <?php } ?>
                    <?php } ?>
                    <a href="<?php echo base_url(); ?>job/<?php echo $job['slug'] ? $job['slug'] : encode($job['job_id']); ?>">
                      <?php echo lang('read_more'); ?>
                    </a>
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
            <?php } ?>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <?php echo esc_output($pagination, 'raw'); ?>
              </div>
            </div>
            <?php } else { ?>
            <div class="row">
              <div class="job-detail account-no-content-box">
                <?php echo lang('no_jobs_found'); ?>
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
