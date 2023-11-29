<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<div class="section-sidebar-beta jobs-list-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <?php include(VIEW_ROOT.'/front/beta/partials/job-sidebar.php'); ?>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="section-jobs-alpha">
                    <div class="container">
                        <?php if(setting('display-jobs-to-only-logged-in-users') == 'yes' && !candidateSession()) { ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="section-jobs-alpha-item">
                                    <p><?php echo lang('login_to_view_jobs'); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                            <?php if($jobs) { ?>
                            <div class="row">
                                <?php foreach($jobs as $job) { ?>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="section-jobs-alpha-item">
                                        <div class="row h-100 align-items-center">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="section-jobs-alpha-item-right">
                                                    <div class="section-jobs-alpha-item-right-controls">
                                                        <?php if(in_array($job['job_id'], $jobFavorites)) { ?>
                                                        <i class="fa-solid fa-heart mark-favorite favorited" 
                                                            title="<?php echo lang('unmark_favorite'); ?>"
                                                            data-id="<?php echo encode($job['job_id']); ?>"></i>
                                                        <?php } else { ?>
                                                        <i class="fa-regular fa-heart mark-favorite" 
                                                            title="<?php echo lang('mark_favorite'); ?>" 
                                                            data-id="<?php echo encode($job['job_id']); ?>"></i>
                                                        <?php } ?>
                                                        <i class="fa-regular fa-paper-plane refer-job" data-id="<?php echo encode($job['job_id']); ?>"></i>
                                                    </div>
                                                    <div class="section-jobs-alpha-item-right-heading">
                                                        <a href="<?php echo  base_url() ; ?>job/<?php echo  $job['slug'] ? $job['slug'] : encode($job['job_id']) ; ?>">
                                                            <h2><?php echo esc_output($job['title']); ?></h2>
                                                        </a>
                                                    </div>
                                                    <div class="section-jobs-alpha-item-right-content">
                                                        <?php if (validDate($job['published_at'])) { ?>
                                                        <span>
                                                            <i class="fa-solid fa-calendar"></i> 
                                                            <?php echo lang('published_at'); ?> : <?php echo dateFormat($job['published_at']); ?>
                                                        </span>
                                                        <?php } ?>
                                                        <?php if(issetVal($job, 'quizes_count')) { ?>
                                                        <span><i class="fa-solid fa-list"></i> <?php echo esc_output($job['quizes_count']); ?> <?php echo lang('quizes'); ?></span>
                                                        <?php } ?>
                                                        <?php if(issetVal($job, 'traites_count')) { ?>
                                                        <span><i class="fa-solid fa-star-half-stroke"></i> <?php echo esc_output($job['traites_count']); ?> <?php echo lang('traites').' '.lang('required'); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="section-jobs-alpha-item-right-bottom">
                                                        <?php if($job['department']) { ?>
                                                        <div class="section-jobs-alpha-item-right-bottom-att" title="<?php echo lang('department'); ?>">
                                                            <i class="fa-icon fa fa-briefcase"></i> <?php echo esc_output($job['department']); ?>
                                                        </div>
                                                        <?php } ?>
                                                        <?php if(isset($job['job_filters'])) { ?>
                                                        <?php foreach($job['job_filters'] as $jf) { ?>
                                                        <div class="section-jobs-alpha-item-right-bottom-att" title="<?php echo esc_output($jf['title']); ?>">
                                                            <i class="fa-solid fa-paperclip"></i> 
                                                            <?php foreach($jf['values'] as $jfval) { ?>
                                                                <?php echo esc_output($jfval); ?>
                                                            <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="section-pagination-alpha">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <?php echo esc_output($pagination, 'raw'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="section-jobs-alpha-item">
                                        <?php echo lang('no_jobs_found'); ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>