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
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="quiz-detail-box">
                            <p class="quiz-detail-box-heading">
                                <strong><?php echo esc_output($detail['quiz_title']); ?> 
                                <?php echo esc_output($detail['job_title']) ? ' : '.esc_output($detail['job_title']) : '';; ?></strong>
                            </p>
                            <p>
                                <i class="fa-solid fa-list-ol"></i> <?php echo lang('total'); ?> <?php echo esc_output($detail['total_questions']); ?> 
                                <?php echo lang('questions'); ?>
                                <i class="fa-regular fa-clock"></i> <?php echo lang('max_time'); ?> : 
                                <?php echo esc_output($detail['allowed_time']); ?> <?php echo lang('minutes'); ?>
                            </p>
                            <p class="quiz-attempt-description">
                                <?php echo esc_output($quiz['description']); ?>
                            </p>
                            <?php echo form_open(base_url().'account/quiz-attempt', array('method' => 'post')); ?>
                                <input type="hidden" name="quiz" value="<?php echo encode($detail['candidate_quiz_id']); ?>">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <button type="submit" class="btn btn-general" id="quiz_start_form_button">
                                            <?php echo lang('start_quiz'); ?>
                                            </button>
                                            <br /><br />
                                            <small><strong><?php echo lang('note_once_started'); ?></strong></small>
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

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>