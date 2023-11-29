<div class="section-job-detail-alpha-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?php echo esc_output($job['title']); ?></h1>
                    </div>
                    <div class="col-md-12">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
                            <li>></li>
                            <li><a href="<?php echo base_url(); ?>jobs"><?php echo lang('jobs'); ?></a></li>
                            <li>></li>
                            <li class="active"><a href="<?php echo base_url(); ?><?php echo esc_output($breadcrumb_page); ?>"><?php echo esc_output($job['title']); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="section-job-detail-alpha-breadcrumb-att-container">
                            <?php if (validDate($job['published_at'])) { ?>
                            <div class="section-job-detail-alpha-breadcrumb-att">
                                <i class="fa-regular fa-calendar"></i> <?php echo lang('published_at'); ?> : <?php echo dateFormat($job['published_at']); ?>
                            </div>
                            <?php } ?>
                            <?php if($job['department']) { ?>
                            <div class="section-job-detail-alpha-breadcrumb-att">
                                <i class="fa-icon fa fa-briefcase"></i> <?php echo lang('department'); ?> : <?php echo esc_output($job['department']); ?>
                            </div>
                            <?php } ?>
                        </div>                
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="section-job-detail-alpha-breadcrumb-btns">
                    <button class="btn">
                        <?php if(in_array($job['job_id'], $jobFavorites)) { ?>
                        <i class="fa-solid fa-heart mark-favorite favorited" data-id="<?php echo encode($job['job_id']); ?>"></i>
                        <?php echo lang('unmark_favorite'); ?>
                        <?php } else { ?>
                        <i class="fa-regular fa-heart mark-favorite" data-id="<?php echo encode($job['job_id']); ?>"></i>
                        <?php echo lang('mark_favorite'); ?>
                        <?php } ?>             
                    </button>
                    <button class="btn refer-job" data-id="<?php echo encode($job['job_id']); ?>">
                        <i class="fa-regular fa-paper-plane"></i> <?php echo lang('refer_this_job'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-job-detail-alpha-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php if(isset($job['job_filters'])) { ?>
                <div class="section-job-detail-alpha-filters-container">
                    <div class="row">
                        <?php foreach($job['job_filters'] as $jf) { ?>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="section-job-detail-alpha-filters-item" title="<?php echo esc_output($jf['title']); ?>">
                                <div class="section-job-detail-alpha-filters-item-icon">
                                    <i class="fa-solid fa-paperclip"></i> 
                                </div>
                                <div class="section-job-detail-alpha-filters-item-title">
                                    <?php echo esc_output($jf['title']); ?>
                                </div> 
                                <div class="section-job-detail-alpha-filters-item-value">
                                    <?php $all = ''; ?>
                                    <?php foreach($jf['values'] as $jfval) { ?>
                                        <?php $all .= $jfval.', '; ?> 
                                    <?php } ?>
                                    <?php echo esc_output(substr($all, 0, -2)); ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($job['quizes_count'] > 0) { ?>
                <div class="section-job-detail-alpha-quizes-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="section-job-detail-alpha-quizes-item">
                                <i class="fa-solid fa-list"></i> 
                                <strong><?php echo esc_output($job['quizes_count']); ?> <?php echo lang('quizes'); ?></strong> : 
                                <?php echo lang('quizes_to_be_attempted'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="section-job-detail-alpha-job-description">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php echo esc_output($job['description'], 'raw'); ?>
                        </div>
                    </div>
                </div>

                <?php if(candidateSession() && !in_array($job['job_id'], $applied)) { ?>
                <form id="job_apply_form">
                    <input type="hidden" name="job_id" value="<?php echo  encode($job['job_id']) ; ?>">

                    <?php if(count($job['traits']) > 0) { ?>
                    <div class="section-job-detail-alpha-traites-container">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 p-0">
                                    <div class="section-heading-style-alpha">
                                        <div class="section-heading">
                                            <h2><?php echo lang('self_assesment'); ?></h2>
                                        </div>
                                        <div class="section-intro-text">
                                            <p><?php echo lang('please_rate_yourself'); ?></p>
                                        </div>                  
                                        <div class="section-intro-button"></div>
                                    </div>
                                </div>
                            </div>                    
                            <div class="row">
                                <?php foreach($job['traits'] as $traite) { ?>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="section-job-detail-alpha-traites-item">
                                        <div class="section-job-detail-alpha-traites-item-heading">
                                            <h4><?php echo esc_output($traite['title']); ?></h4>
                                        </div>
                                        <input type="hidden" name="traite_titles[<?php echo  encode($traite['id']) ; ?>]" value="<?php echo  $traite['title'] ; ?>">
                                        <select class="form-control" name="traites[<?php echo  encode($traite['id']) ; ?>]">
                                            <option value="1"><?php echo lang('poor'); ?></option>
                                            <option value="2"><?php echo lang('bad'); ?></option>
                                            <option value="3" selected=""><?php echo lang('average'); ?></option>
                                            <option value="4"><?php echo lang('good'); ?></option>
                                            <option value="5"><?php echo lang('excellent'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="section-job-detail-alpha-apply-container">
                        <div class="container">
                            <?php if(setting('enable-multiple-resume') == 'yes') { ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 p-0">
                                    <label><strong><?php echo lang('please_select_one_of_your_resume'); ?></strong></label>
                                    <select class="form-control" name="resume" autocomplete="off">
                                        <?php foreach ($resumes as $resume) { ?>
                                        <option value="<?php echo  encode($resume['resume_id']) ; ?>"><?php echo  $resume['title'] ; ?></option>
                                        <?php } ?>
                                    </select>
                                    <br />
                                </div>
                            </div>
                            <?php } else { ?>
                            <input type="hidden" name="resume" value="<?php echo encode($resume_id) ; ?>">
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 p-0">
                                    <button class="btn" id="job_apply_form_button">
                                        <i class="fa-solid fa-hand-pointer"></i> <?php echo lang('apply_for_this_job'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php } else { ?>
                
                    <div class="section-job-detail-alpha-apply-container">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 p-0">
                                    <?php if(candidateSession() && in_array($job['job_id'], $applied)) { ?>
                                    <a href="<?php echo  base_url() ; ?>account/job-applications" class="btn">
                                        <?php echo lang('you_have_already_applied'); ?>
                                    </a>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>account" class="btn global-login-btn">
                                        <i class="fa-solid fa-hand-pointer"></i> <?php echo lang('signup_to_apply'); ?>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <?php } ?>

            </div>

        </div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>