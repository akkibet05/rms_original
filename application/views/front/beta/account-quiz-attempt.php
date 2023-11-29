<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<div class="section-account-alpha-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="section-account-alpha-navigation">
                    <?php include(VIEW_ROOT.'/front/beta/partials/account-sidebar.php'); ?>
                </div>
            </div>
            <div class="col-md-9">

                <div class="row section-quiz-alpha-container">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="row section-quiz-alpha-item">
                            <div class="col-md-12 box-title">
                                <h6>
                                    <i class="fa-regular fa-circle-question"></i> 
                                    <?php echo lang('question'); ?> : <?php echo esc_output($detail['attempt']); ?>
                                </h6>
                            </div>
                            <div class="col-md-12 section-quiz-alpha-activity-item">
                                <div class="section-quiz-alpha-item-q-images">
                                    <?php echo textToImage($question['title'], candidateSession()); ?>
                                </div>
                                <?php if ($question["image"]) { ?>
                                    <?php $thumb = questionThumb($question['image']); ?>
                                    <img 
                                        class="quiz-attempt-image" 
                                        src="<?php echo esc_output($thumb); ?>" 
                                        onerror="this.src='<?php echo esc_output($thumb); ?>'" 
                                    />
                                <?php } ?>
                                <?php echo form_open(base_url().'account/quiz-attempt', array('method' => 'post')); ?>
                                    <input type="hidden" name="quiz" value="<?php echo encode($detail['candidate_quiz_id']); ?>">
                                    <input type="hidden" name="question" value="<?php echo encode($detail['attempt']); ?>">
                                    <div class="section-quiz-alpha-answers-container">
                                        <?php foreach ($question['answers'] as $key => $answer) { ?>
                                        <span>
                                            <input name="answer[]" 
                                                type="<?php echo esc_output($question['type']); ?>"  
                                                class="" 
                                                id="item_radio<?php echo esc_output($key); ?>" 
                                                value="<?php echo encode($answer['quiz_question_answer_id']); ?>"
                                            />
                                            <label for="item_radio<?php echo esc_output($key); ?>"><?php echo esc_output($answer['title']); ?></label>
                                        </span>
                                        <?php } ?>
                                    </div>
                                    <button type="submit" class="btn btn-general"><?php echo lang('submit_move_to_next'); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <!----- Quiz Timer container starts ------->
                        <div class="row section-quiz-alpha-item">
                            <div class="col-md-12 box-title">
                                <h6><i class="fa-solid fa-hourglass-end"></i> <?php echo lang('time_remaining'); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div id="CDT" class="count-down"></div>
                            </div>
                        </div>
                        <!----- Quiz Timer container ends ------->

                        <!----- Quiz Question Numbers container starts ------->
                        <div class="row section-quiz-alpha-item">
                            <div class="col-md-12 box-title">
                                <?php $progress = count($questions) != 0 ? round((($detail['attempt']-1)/count($questions))*100) : 0; ?>
                                <h6><i class="fa-solid fa-person-running"></i> <?php echo lang('progress'); ?> (<?php echo esc_output($progress); ?>%)</h6>
                            </div>
                            <div class="col-md-12 section-quiz-alpha-item-question-numbers">
                                <?php for($i=1; $i <= count($questions); $i++) { ?>
                                <?php $active = $detail['attempt'] == $i ? 'active' : 'remaining'; ?>
                                <span class="section-quiz-alpha-q-number <?php echo esc_output($active); ?>"><?php echo esc_output($i); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <!----- Quiz Question Numbers container ends ------->

                        <!----- Quiz Description container starts ------->
                        <div class="row section-quiz-alpha-item">
                            <div class="col-md-12 box-title">
                                <h6><i class="fas fa-info-circle"></i> <?php echo lang('description'); ?></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="section-quiz-alpha-item-description">
                                    <p><?php echo esc_output($quiz['description']); ?></p>
                                </div>
                            </div>
                        </div>
                        <!----- Quiz Description container ends ------->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="quiz_attempt_page" value="1">
<input type="hidden" id="now" value="<?php echo esc_output($time['now']); ?>">
<input type="hidden" id="max" value="<?php echo esc_output($time['max']); ?>">
<input type="hidden" id="timesup" value="Timesup">

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>
