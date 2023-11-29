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
                        <div class="table-responsive">
                        <table class="table section-account-alpha-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><?php echo lang('title'); ?></th>
                                    <th scope="col"><?php echo lang('job'); ?></th>
                                    <th scope="col"><?php echo lang('allowed_time'); ?></th>
                                    <th scope="col"><?php echo lang('questions'); ?></th>
                                    <th scope="col"><?php echo lang('result'); ?></th>
                                    <th scope="col"><?php echo lang('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($quizes) { ?>
                                <?php foreach ($quizes as $k => $q) { ?>
                                <?php $d = objToArr(json_decode($q['quiz_data'])); ?>
                                <tr>
                                    <td><?php echo esc_output($k + 1); ?></td>
                                    <td><?php echo esc_output($q['quiz_title']) ? esc_output($q['quiz_title']) : '---'; ?></td>
                                    <td><?php echo esc_output($q['job_title']) ? esc_output($q['job_title']) : ''; ?></td>
                                    <td><?php echo esc_output($q['allowed_time']); ?> minutes</td>
                                    <td><?php echo esc_output($q['total_questions']); ?></td>
                                    <td>
                                        <?php if($q['attempt'] > 0) { ?>
                                        <?php echo esc_output($q['total_questions']) != 0 ? round(($q['correct_answers']/$q['total_questions'])*100).'%' : ''; ; ?>
                                        <?php } else { ?>
                                        <?php echo lang('n_a'); ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>account/quiz/<?php echo encode($q['candidate_quiz_id']); ?>" 
                                            class="view-btn">
                                            <?php echo lang('attempt'); ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="7"><?php echo lang('no_quizes_found'); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>