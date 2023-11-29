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
                                    <th scope="col"><?php echo lang('job'); ?></th>
                                    <th scope="col"><?php echo lang('department'); ?></th>
                                    <th scope="col"><?php echo lang('date'); ?> </th>
                                    <th scope="col"><?php echo lang('details'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($jobs) { ?>
                                <?php foreach ($jobs as $key => $job) { ?>
                                <tr>
                                    <td><?php echo esc_output($key + 1); ?></td>
                                    <td><?php echo esc_output($job['title']); ?></td>
                                    <td><?php echo esc_output($job['department']) ? esc_output($job['department']) : '---'; ?></td>
                                    <td><?php echo date('d M, Y', strtotime($job['favorited_on'])); ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>job/<?php echo $job['slug'] ? $job['slug'] : encode($job['job_id']); ?>">
                                            <?php echo lang('view'); ?>
                                        </a>                                                
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="6"><?php echo lang('no_record_found'); ?></td>
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