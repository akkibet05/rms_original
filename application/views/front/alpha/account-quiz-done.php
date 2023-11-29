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
            <?php echo lang('account'); ?> > 
            <?php echo esc_output($quiz['title'], 'html');  ?> 
            <?php echo esc_output(($detail['job_title'] ? ' : '.$detail['job_title'] : ''), 'html'); ?>
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
                    <span class="account-box-heading-text">
                      <?php echo esc_output($quiz['title']);  ?> 
                      <?php echo esc_output(($detail['job_title'] ? ' : '.$detail['job_title'] : ''), 'html'); ?>
                    </span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <p class="quiz-attempt-info">
                  </p>
                  <p class="quiz-attempt-description">
                    <?php echo lang('quiz_completed'); ?> <br />
                    <?php echo lang('result'); ?> : <strong><?php echo esc_output($detail['total_questions']) != 0 ? round(($detail['correct_answers']/$detail['total_questions'])*100).'%' : '';  ?></strong><br />
                    <a href="<?php echo base_url(); ?>account/quizes"><?php echo lang('back_to_quizes'); ?></a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>