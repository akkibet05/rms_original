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
                                <strong><?php echo esc_output($detail['quiz_title']).' ('.candidateSession().')'; ?> 
                                <?php echo esc_output($detail['job_title']) ? ' : '.esc_output($detail['job_title']) : '';; ?></strong>
                            </p>
                            <p class="quiz-attempt-description">
                                <?php echo lang('quiz_completed'); ?> <br />
                                <?php echo lang('result'); ?> : <strong><?php echo esc_output($detail['total_questions']) != 0 ? round(($detail['correct_answers']/$detail['total_questions'])*100).'%' : '';; ?></strong><br />
                                <a href="<?php echo base_url('/'); ?>account/quizes"><?php echo lang('back_to_quizes'); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>