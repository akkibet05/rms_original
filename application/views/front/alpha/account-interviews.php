  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('interviews'); ?></span></h2>
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
            <?php if ($interviews) { ?>
            <?php foreach ($interviews as $q) { ?>
            <?php $d = objToArr(json_decode($q['interview_data'])); ?>
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="interview-item-box">
                <p class="interview-item-box-heading">
                  <?php echo esc_output($d['interview']['title'], 'html'); ?> 
                  <?php echo esc_output(($q['job_title'] ? ' : '.$q['job_title'] : ''), 'html'); ?>
                </p>
                <p class="interview-listing-interview-description">
                  <?php echo esc_output($d['interview']['description'], 'html'); ?>
                </p>
                <?php if (setting('display-candidate-interviews') == 'description_with_results') { ?>
                <div class="container">
                  <div class="row interview-listing-items-container">
                    <div class="col-md-6 col-sm-6 job-detail-items">
                      <span class="job-detail-items-title"><?php echo lang('questions'); ?></span>
                      <span class="job-detail-items-value"><?php echo esc_output($q['total_questions']); ?></span>
                    </div>
                    <div class="col-md-6 col-sm-6 job-detail-items">
                      <span class="job-detail-items-title"><?php echo lang('result'); ?></span>
                      <span class="job-detail-items-value"><?php echo mathDivide($q['overall_rating'], ($q['total_questions']*10), true); ?>%</span>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <div class="job-detail account-no-content-box">
              <?php echo lang('no_interviews_found'); ?>
            </div>
            <?php } ?>
            </div>
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <?php echo esc_output($pagination, 'raw'); ?>
              </div>
            </div>            
          </div>

      </div>
    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>