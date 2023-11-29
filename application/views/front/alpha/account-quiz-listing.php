  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('quizes'); ?></span></h2>
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
            <?php if ($quizes) { ?>
            <?php foreach ($quizes as $q) { ?>
            <?php $d = objToArr(json_decode($q['quiz_data'])); ?>
            <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="quiz-item-box">
                <div class="dotmenu">
                  <ul class="dotMenudropbtn dotmenuicons dotmenuShowLeft" 
                      onclick="showDotMenu('<?php echo 'dot-'.$q['candidate_quiz_id']; ?>')">
                      <li></li><li></li><li></li>
                  </ul>
                  <div id="<?php echo 'dot-'.$q['candidate_quiz_id']; ?>" class="dotmenu-content">
                    <a href="<?php echo base_url(); ?>account/quiz/<?php echo encode($q['candidate_quiz_id']); ?>"><?php echo lang('attempt'); ?></a>
                  </div>
                </div>
                <p class="quiz-item-box-heading">
                  <?php echo esc_output($d['quiz']['title'], 'html'); ?> 
                  <?php echo esc_output(($q['job_title'] ? ' : '.$q['job_title'] : ''), 'html'); ?>
                </p>
                <p class="quiz-listing-quiz-description">
                  <?php echo esc_output($d['quiz']['description'], 'html'); ?>
                </p>
                <div class="container">
                  <div class="row quiz-listing-items-container">
                    <div class="col-md-4 col-sm-4 quiz-listing-items">
                      <span class="job-detail-items-title"><?php echo lang('allowed_time'); ?></span>
                      <span class="job-detail-items-value"><?php echo esc_output($q['allowed_time']); ?> minutes</span>
                    </div>
                    <div class="col-md-4 col-sm-4 job-detail-items">
                      <span class="job-detail-items-title"><?php echo lang('questions'); ?></span>
                      <span class="job-detail-items-value"><?php echo esc_output($q['total_questions']); ?></span>
                    </div>
                    <div class="col-md-4 col-sm-4 job-detail-items">
                      <span class="job-detail-items-title"><?php echo lang('result'); ?></span>
                      <span class="job-detail-items-value">
                        <?php if ($q['attempt'] > 0) { ?>
                          <?php echo esc_output($q['total_questions']) != 0 ? round(($q['correct_answers']/$q['total_questions'])*100).'%' : '';  ?>
                        <?php } else { ?>
                          <?php echo lang('n_a'); ?>
                        <?php } ?>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <div class="job-detail account-no-content-box">
              <?php echo lang('no_quizes_found'); ?>
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