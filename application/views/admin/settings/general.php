<!-- Content Wrapper Starts -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fas fa-cube"></i> <?php echo lang('update_general_settings'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
            <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_general_settings'); ?></li>
        </ol>
    </section>
    <!-- Main content Starts-->
    <section class="content">
        <!-- Main row Starts-->
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo lang('general_settings'); ?></h3>
                    </div>
                    <?php if (allowedTo('general_settings')) { ?>
                    <form id="admin_settings_form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('define_site_name'); ?></label>
                                        <input type="text" class="form-control" name="site-name" value="<?php echo esc_output(setting('site-name')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('define_admin_email'); ?></label>
                                        <input type="text" class="form-control" name="admin-email" value="<?php echo esc_output(setting('admin-email')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('define_from_email'); ?></label>
                                        <input type="text" class="form-control" name="from-email" value="<?php echo esc_output(setting('from-email')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enter_purchase_code'); ?></label>
                                        <input type="text" class="form-control" name="purchase-code" value="<?php echo esc_output(setting('purchase-code')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('define_site_keywords'); ?></label>
                                        <textarea class="form-control" name="site-keywords"><?php echo esc_output(setting('site-keywords')); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('define_site_description'); ?></label>
                                        <textarea class="form-control" name="site-description"><?php echo esc_output(setting('site-description')); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('no_of_jobs_per_page'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="jobs-limit" value="5" <?php sel(setting('jobs-limit'), 5, 'checked'); ?>> 5
                                        <input type="radio" class="minimal" name="jobs-limit" value="10" <?php sel(setting('jobs-limit'), 10, 'checked'); ?>> 10
                                        <input type="radio" class="minimal" name="jobs-limit" value="25" <?php sel(setting('jobs-limit'), 25, 'checked'); ?>> 25
                                        <input type="radio" class="minimal" name="jobs-limit" value="100" <?php sel(setting('jobs-limit'), 100, 'checked'); ?>> 100
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('no_of_blogs_per_page'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="blogs-limit" value="5" <?php sel(setting('blogs-limit'), 5, 'checked'); ?>> 5
                                        <input type="radio" class="minimal" name="blogs-limit" value="10" <?php sel(setting('blogs-limit'), 10, 'checked'); ?>> 10
                                        <input type="radio" class="minimal" name="blogs-limit" value="25" <?php sel(setting('blogs-limit'), 25, 'checked'); ?>> 25
                                        <input type="radio" class="minimal" name="blogs-limit" value="100" <?php sel(setting('blogs-limit'), 100, 'checked'); ?>> 100
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('chart_elements_on_dashboard'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="charts-limit" value="5" <?php sel(setting('charts-limit'), 5, 'checked'); ?>> 5
                                        <input type="radio" class="minimal" name="charts-limit" value="10" <?php sel(setting('charts-limit'), 10, 'checked'); ?>> 10
                                        <input type="radio" class="minimal" name="charts-limit" value="25" <?php sel(setting('charts-limit'), 25, 'checked'); ?>> 25
                                        <input type="radio" class="minimal" name="charts-limit" value="100" <?php sel(setting('charts-limit'), 100, 'checked'); ?>> 100
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_email_verification'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-email-verification" value="yes" <?php sel(setting('enable-email-verification'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-email-verification" value="no" <?php sel(setting('enable-email-verification'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_forgot_password'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-forgot-password" value="yes" <?php sel(setting('enable-forgot-password'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-forgot-password" value="no" <?php sel(setting('enable-forgot-password'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_new_user'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-register" value="yes" <?php sel(setting('enable-register'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-register" value="no" <?php sel(setting('enable-register'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_admin_language_selector'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-admin-lang-select" value="yes" <?php sel(setting('enable-admin-lang-select'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-admin-lang-select" value="no" <?php sel(setting('enable-admin-lang-select'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_front_language_selector'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-front-lang-select" value="yes" <?php sel(setting('enable-front-lang-select'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-front-lang-select" value="no" <?php sel(setting('enable-front-lang-select'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('display_candidate_interviews'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="display-candidate-interviews" value="no" <?php sel(setting('display-candidate-interviews'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                        <input type="radio" class="minimal" name="display-candidate-interviews" value="description_only" <?php sel(setting('display-candidate-interviews'), 'description_only', 'checked'); ?>> <?php echo lang('description_only'); ?>
                                        <input type="radio" class="minimal" name="display-candidate-interviews" value="description_with_results" <?php sel(setting('display-candidate-interviews'), 'description_with_results', 'checked'); ?>> <?php echo lang('description_with_results'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('display_jobs_to_only_logged_in_users'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="display-jobs-to-only-logged-in-users" value="yes" <?php sel(setting('display-jobs-to-only-logged-in-users'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="display-jobs-to-only-logged-in-users" value="no" <?php sel(setting('display-jobs-to-only-logged-in-users'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('hide_jobs_after_expiry'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="hide-jobs-after-expiry" value="yes" <?php sel(setting('hide-jobs-after-expiry'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="hide-jobs-after-expiry" value="no" <?php sel(setting('hide-jobs-after-expiry'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_jobs_schema'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-jobs-schema" value="yes" <?php sel(setting('enable-jobs-schema'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-jobs-schema" value="no" <?php sel(setting('enable-jobs-schema'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('limit_team_to_view_their_jobs'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="limit-team-members-to-only-view-their-created-jobs" value="yes" <?php sel(setting('limit-team-members-to-only-view-their-created-jobs'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="limit-team-members-to-only-view-their-created-jobs" value="no" <?php sel(setting('limit-team-members-to-only-view-their-created-jobs'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_overall_result_edit'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-overall-result-edit" value="yes" <?php sel(setting('enable-overall-result-edit'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-overall-result-edit" value="no" <?php sel(setting('enable-overall-result-edit'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('departments').' '.lang('home').' '.lang('limit'); ?></label>
                                        <input type="number" class="form-control" name="departments-home-limit" value="<?php echo esc_output(setting('departments-home-limit')); ?>" min="0" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('departments').' '.lang('filters').' '.lang('limit'); ?></label>
                                        <input type="number" class="form-control" name="departments-filters-limit" value="<?php echo esc_output(setting('departments-filters-limit')); ?>" min="0" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('date_format'); ?></label>
                                        <input type="text" class="form-control" name="date-format" value="<?php echo setting('date-format'); ?>">
                                        <small>e.g. "Y-m-d", "M-D", "m-d", "d M, Y", "m, Y", "time ago" etc</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enter_upload_limit'); ?></label>
                                        <input type="number" class="form-control" name="upload-limit" value="<?php echo esc_output(setting('upload-limit')); ?>" min="0" step=".01">
                                    </div>
                                </div>                                                            
                                <div class="col-md-12">
                                    <hr />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_front_salary_filter'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-front-salary-filter" value="yes" <?php sel(setting('enable-front-salary-filter'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-front-salary-filter" value="no" <?php sel(setting('enable-front-salary-filter'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_front_salary_filter_value'); ?></label>
                                        <input type="number" class="form-control" name="front-salary-filter-min-value" value="<?php echo esc_output(setting('front-salary-filter-min-value')); ?>" min="0" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('max_front_salary_filter_value'); ?></label>
                                        <input type="number" class="form-control" name="front-salary-filter-max-value" value="<?php echo esc_output(setting('front-salary-filter-max-value')); ?>" min="0" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('salary_currency'); ?></label>
                                        <input type="text" class="form-control" name="salary-currency" value="<?php echo esc_output(setting('salary-currency')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr />
                                    <h2><?php echo lang('resume').' '.lang('settings'); ?></h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_multiple_resume'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-multiple-resume" value="yes" <?php sel(setting('enable-multiple-resume'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-multiple-resume" value="no" <?php sel(setting('enable-multiple-resume'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('allow_apply_without_static_resume'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="enable-apply-without-static-resume" value="yes" <?php sel(setting('enable-apply-without-static-resume'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="enable-apply-without-static-resume" value="no" <?php sel(setting('enable-apply-without-static-resume'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_qualifications_resume_nos_required'); ?></label>
                                        <input type="number" class="form-control" name="min-qualifications-resume-nos-required" value="<?php echo esc_output(setting('min-qualifications-resume-nos-required')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_experiences_resume_nos_required'); ?></label>
                                        <input type="number" class="form-control" name="min-experiences-resume-nos-required" value="<?php echo esc_output(setting('min-experiences-resume-nos-required')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_achievements_resume_nos_required'); ?></label>
                                        <input type="number" class="form-control" name="min-achievements-resume-nos-required" value="<?php echo esc_output(setting('min-achievements-resume-nos-required')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_skills_resume_nos_required'); ?></label>
                                        <input type="number" class="form-control" name="min-skills-resume-nos-required" value="<?php echo esc_output(setting('min-skills-resume-nos-required')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_languages_resume_nos_required'); ?></label>
                                        <input type="number" class="form-control" name="min-languages-resume-nos-required" value="<?php echo esc_output(setting('min-languages-resume-nos-required')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('min_references_resume_nos_required'); ?></label>
                                        <input type="number" class="form-control" name="min-references-resume-nos-required" value="<?php echo esc_output(setting('min-references-resume-nos-required')); ?>" min="1" step="1">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr />
                                    <h2><?php echo lang('email').' '.lang('settings'); ?></h2>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo lang('enable_external_smtp'); ?></label>
                                        <br />
                                        <input type="radio" class="minimal" name="smtp" value="yes" <?php sel(setting('smtp'), 'yes', 'checked'); ?>> <?php echo lang('yes'); ?>
                                        <input type="radio" class="minimal" name="smtp" value="no" <?php sel(setting('smtp'), 'no', 'checked'); ?>> <?php echo lang('no'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('define_smtp_host'); ?></label>
                                        <input type="text" class="form-control" name="smtp-host" value="<?php echo setting('smtp-host'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('define_smtp_port'); ?></label>
                                        <input type="text" class="form-control" name="smtp-port" value="<?php echo setting('smtp-port'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for=""><?php echo lang('define_smtp_protocol'); ?></label>
                                        <select name="smtp-protocol" class="form-control">
                                            <option value="ssl" <?php echo setting('smtp-protocol') == 'ssl' ? 'selected' : ''; ?>>
                                                <?php echo esc_output('ssl'); ?>
                                            </option>
                                            <option value="tls" <?php echo setting('smtp-protocol') == 'tls' ? 'selected' : ''; ?>>
                                                <?php echo esc_output('tls'); ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('define_smtp_username'); ?></label>
                                        <input type="text" class="form-control" name="smtp-username" value="<?php echo setting('smtp-username'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo lang('define_smtp_password'); ?></label>
                                        <input type="text" class="form-control" name="smtp-password" value="<?php echo setting('smtp-password'); ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.form group -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="admin_settings_form_button"><?php echo lang('save'); ?></button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </section>
        </div>
        <!-- Main row Ends-->
    </section>
    <!-- Main content Ends-->
</div>
<!-- Content Wrapper Ends -->
<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
</body>
</html>