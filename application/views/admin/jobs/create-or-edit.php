<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?><small></small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
            <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('job'); ?></li>
            <li class="active"><?php echo lang('create'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content job-create-edit">
        <div class="row">
            <?php if (allowedTo('create_jobs') || allowedTo('edit_jobs')) { ?>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo lang('details'); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="admin_job_create_update_form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('title'); ?></label>
                                        <input type="hidden" name="job_id" value="<?php echo esc_output($job['job_id']); ?>" />
                                        <input type="text" class="form-control" placeholder="<?php echo lang('enter_title'); ?>" name="title" 
                                            value="<?php echo esc_output($job['title']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('slug'); ?></label>
                                        <input type="text" class="form-control" placeholder="<?php echo lang('will_auto_generate_if_blank'); ?>" name="slug" value="<?php echo esc_output($job['slug']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>
                                        <?php echo lang('departments'); ?>
                                        <button type="button" class="btn btn-xs btn-warning btn-blue create-or-edit-department" data-id="" 
                                            title="Add New Department">
                                        <i class="fa fa-plus"></i>
                                        </button>
                                        </label>
                                        <select class="form-control select2" id="departments" name="department_id">
                                            <option value=""><?php echo lang('none'); ?></option>
                                            <?php foreach ($departments as $key => $value) { ?>
                                            <option value="<?php echo esc_output($value['department_id']); ?>" <?php sel($job['department_id'], $value['department_id']); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('status'); ?></label>
                                        <select class="form-control">
                                            <option value="1" <?php sel($job['status'], 1); ?>><?php echo lang('active'); ?></option>
                                            <option value="0" <?php sel($job['status'], 0); ?>><?php echo lang('inactive'); ?></option>
                                        </select>
                                        <Br />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('min_salary'); ?></label>
                                        <input type="text" class="form-control" placeholder="1000" name="min_salary" value="<?php echo esc_output($job['min_salary']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('max_salary'); ?></label>
                                        <input type="text" class="form-control" placeholder="1000" name="max_salary" value="<?php echo esc_output($job['max_salary']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('meta_keywords'); ?></label>
                                        <textarea class="form-control" name="meta_keywords" rows="3"><?php echo esc_output($job['meta_keywords'], 'textarea'); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo lang('meta_description'); ?></label>
                                        <textarea class="form-control" name="meta_description" rows="3"><?php echo esc_output($job['meta_description'], 'textarea'); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('is_static_allowed'); ?></label>
                                        <select class="form-control" name="is_static_allowed">
                                            <option value="0" <?php sel($job['is_static_allowed'], 0); ?>><?php echo lang('no'); ?></option>
                                            <option value="1" <?php sel($job['is_static_allowed'], 1); ?>><?php echo lang('yes'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('number_of_positions'); ?></label>
                                        <input type="number" class="form-control" placeholder="10" name="number_of_positions" value="<?php echo esc_output($job['number_of_positions']); ?>">
                                    </div>
                                </div>                                
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('publish_date'); ?></label>
                                        <input type="date" class="form-control" id="published_at" name="published_at" 
                                            value="<?php echo esc_output($job['published_at']) ? date('Y-m-d', strtotime($job['published_at'])) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo lang('expiry_date'); ?></label>
                                        <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                            value="<?php echo esc_output($job['expiry_date']) ? date('Y-m-d', strtotime($job['expiry_date'])) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo lang('description'); ?></label>
                                        <textarea id="description" name="description" rows="10" cols="80">
                                        <?php echo esc_output($job['description'], 'textarea'); ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr />
                                </div>
                                <?php if ($job_filters) { ?>
                                <?php foreach ($job_filters as $filter) { ?>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label><?php echo esc_output($filter['title']); ?></label>
                                        <select class="form-control select2" id="<?php echo esc_output($filter['job_filter_id']); ?>" 
                                            name="filters[<?php echo esc_output($filter['job_filter_id']); ?>][]" multiple="multiple">
                                            <?php foreach ($filter['values'] as $v) { ?>
                                            <?php $sel = sel2($filter['job_filter_id'], $job['job_filter_ids'], $v['id'], $job['job_filter_value_ids']); ?>
                                            <option value="<?php echo esc_output($v['id']); ?>" <?php echo esc_output($sel); ?>><?php echo esc_output($v['title']); ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } else { ?>
                                <div class="row resume-item-edit-box-section">
                                    <div class="col-md-12 col-lg-12">
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('no_job_filters'); ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-12">
                                    <hr />
                                    <div class="form-group">
                                        <label>
                                        <?php echo lang('custom_fields'); ?>
                                        <button type="button" class="btn btn-xs btn-warning btn-blue add-custom-field" title="Add Custom Field">
                                        <i class="fa fa-plus"></i>
                                        </button>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 custom-fields-container">
                                    <?php foreach ($fields as $field) { ?>
                                    <?php include(VIEW_ROOT.'/admin/jobs/custom-field.php'); ?>
                                    <?php } ?>
                                    <div class="row resume-item-edit-box-section no-custom-value-box">
                                        <div class="col-md-12 col-lg-12">
                                            <p><?php echo lang('no_custom_fields'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr />
                                    <div class="form-group">
                                        <label><?php echo lang('traits'); ?></label>
                                        <select class="form-control select2" id="traits[]" name="traits[]" multiple="multiple">
                                            <?php foreach ($traits as $key => $value) { ?>
                                            <?php $jobTraits = $job['traits'] ? explode(',', $job['traits']) : array(); ?>
                                            <option value="<?php echo esc_output($value['trait_id']); ?>" <?php sel($value['trait_id'], $jobTraits); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                                            <?php } ?>
                                        </select>
                                        <br />
                                        <br />
                                        <b><?php echo lang('notes'); ?></b><br />
                                        <ul>
                                            <li><?php echo lang('traits_can_not_be_assigned'); ?></li>
                                            <li><?php echo lang('traits_can_only_be_answerd'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr />
                                    <div class="form-group">
                                        <label><?php echo lang('quizes'); ?></label>
                                        <select class="form-control select2" id="quizes[]" name="quizes[]" multiple="multiple">
                                            <?php foreach ($quizes as $key => $value) { ?>
                                            <?php $jobQuizes = $job['quizes'] ? explode(',', $job['quizes']) : array(); ?>
                                            <option value="<?php echo esc_output($value['quiz_id']); ?>" <?php sel($value['quiz_id'], $jobQuizes); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                                            <?php } ?>
                                        </select>
                                        <br />
                                        <br />
                                        <b><?php echo lang('notes'); ?></b><br />
                                        <ul>
                                            <li><?php echo lang('quizes_can_be_assigned'); ?></li>
                                            <li><?php echo lang('quizes_are_attached_to'); ?></li>
                                            <li><?php echo lang('quizes_assigned_from_here'); ?></li>
                                            <li><?php echo lang('additional_quizes_can_be'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr />
                                    <b><?php echo lang('in_general'); ?></b><br />
                                    <ul>
                                        <li><?php echo lang('traits_can_be_assigned'); ?></li>
                                        <li><?php echo lang('traits_can_be_assigned_before_and_or'); ?></li>
                                        <li><?php echo lang('traits_can_be_assigned_only_after'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="admin_job_create_update_form_button">
                            <?php echo lang('save'); ?>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <?php } ?>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/company.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/department.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job.js"></script>
</body>
</html>