<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?><small></small></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
            <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="datatable-top-controls datatable-top-controls-filter">
                                    <?php if (allowedTo('create_jobs')) { ?>
                                    <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-job">
                                    <i class="fa fa-plus"></i> <?php echo lang('add_job'); ?>
                                    </button>
                                    <?php } ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-blue btn-flat"><?php echo lang('actions'); ?></button>
                                        <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" class="job-bulk-action" data-action="apply-for-candidate"><?php echo lang('apply_for_candidate'); ?></a></li>
                                            <li><a href="#" class="job-bulk-action" data-action="download-excel"><?php echo lang('download_jobs'); ?></a></li>
                                            <li><a href="#" class="job-bulk-action" data-action="import-jobs"><?php echo lang('import_jobs'); ?></a></li>
                                            <li><a href="#" class="job-bulk-action" data-action="activate"><?php echo lang('activate'); ?></a></li>
                                            <li><a href="#" class="job-bulk-action" data-action="deactivate"><?php echo lang('deactivate'); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="datatable-top-controls datatable-top-controls-dd">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('department'); ?></button>
                                        </span>
                                        <select class="form-control select2" id="department">
                                            <option value=""><?php echo lang('all'); ?></option>
                                            <?php foreach ($departments as $key => $value) { ?>
                                            <option value="<?php echo esc_output($value['department_id']); ?>"><?php echo esc_output($value['title'], 'html'); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="datatable-top-controls datatable-top-controls-dd">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('status'); ?></button>
                                        </span>
                                        <select class="form-control select2" id="status">
                                            <option value=""><?php echo lang('all'); ?></option>
                                            <option value="1"><?php echo lang('active'); ?></option>
                                            <option value="0"><?php echo lang('inactive'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($job_filters) { ?>
                                <?php foreach ($job_filters as $filter) { ?>
                                <?php if ($filter['admin_filter'] == 1) { ?>
                                <div class="datatable-top-controls datatable-top-controls-dd">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-flat">
                                        <i class="fa fa-filter"></i> <?php echo esc_output($filter['title']); ?></button>
                                        </span>
                                        <select class="form-control select2 job-filter" 
                                            id="<?php echo esc_output($filter['job_filter_id']); ?>">
                                            <option value=""><?php echo lang('all'); ?></option>
                                            <?php foreach ($filter['values'] as $v) { ?>
                                            <option value="<?php echo esc_output($v['id']); ?>"><?php echo esc_output($v['title']); ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if (allowedTo('view_jobs')) { ?>
                        <table class="table table-bordered table-striped" id="jobs_datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="minimal all-check"></th>
                                    <th><?php echo lang('title'); ?></th>
                                    <th><?php echo lang('department'); ?></th>
                                    <th><?php echo lang('job_filters'); ?></th>
                                    <th><?php echo lang('applications'); ?></th>
                                    <th><?php echo lang('favorites'); ?></th>
                                    <th><?php echo lang('referred'); ?></th>
                                    <th><?php echo lang('traits'); ?></th>
                                    <th><?php echo lang('created_on'); ?></th>
                                    <th><?php echo lang('status'); ?></th>
                                    <th><?php echo lang('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Right Modal -->
<div class="modal right fade modal-right" id="modal-right" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Departments</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
<!-- modal -->
<!-- Forms for actions -->
<form id="jobs-form" method="POST" action="<?php echo base_url(); ?>admin/jobs/excel" target='_blank'></form>
<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>
<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/company.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/department.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/job.js"></script>
</body>
</html>