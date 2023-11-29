  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('quizes'); ?> > <?php echo lang('progress'); ?></span></h2>
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
                      <?php echo esc_output($quiz['title'], 'html');  ?> 
                      <?php echo esc_output($detail['job_title'] ? ' : '.$detail['job_title'] : '', 'html'); ?>
                    </span>
                    <span class="account-box-heading-line"></span>
                  </p>
                  <p class="quiz-attempt-info">
                    <span class="quiz-attempt-info-question-counter">
                      <?php echo lang('question'); ?> <?php echo esc_output($detail['attempt'], 'html'); ?> of 
                      <?php echo esc_output($detail['total_questions'], 'html'); ?>
                    </span>
                    <span class="quiz-attempt-info-timer">
                      <?php echo lang('time_remaining'); ?> : <?php echo esc_output($time['clock'], 'html'); ?></span>
                  </p>
                  <p class="quiz-attempt-description">
                    <?php if (candidateLanguage(true) == 'rtl') { ?>
                    <?php echo esc_output($question['title']); ?>
                    <?php } else { ?>
                    <?php echo textToImage($question['title'], candidateSession()); ?>
                    <?php } ?>
                  </p>
                  <?php if ($question['image']) { ?>
                    <p>
                    <img class="quiz-attempt-image" src="<?php echo questionThumb($question['image']); ?>" />
                    </p>
                  <?php } ?>
                  <?php echo form_open(base_url().'account/quiz-attempt', array('method' => 'post')); ?>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <input type="hidden" name="quiz" value="<?php echo encode($detail['candidate_quiz_id']); ?>">
                        <input type="hidden" name="question" value="<?php echo encode($detail['attempt']); ?>">
                        <ul class="quiz-attempt-list-container">
                          <?php foreach ($question['answers'] as $key => $answer) { ?> 
                          <li>
                            <input name="answer[]" type="<?php echo esc_output($question['type']); ?>" class="minimal" 
                            value="<?php echo encode($answer['quiz_question_answer_id']); ?>">
                            <?php echo esc_output($answer['title'], 'html'); ?>
                          </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                          <button type="submit" class="btn btn-success" title="Save">
                            <?php echo lang('submit_move_to_next'); ?>
                          </button>
                        </div>
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

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>