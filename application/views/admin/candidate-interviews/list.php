<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-gavel"></i> <?php echo lang('candidate_interviews'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-gavel"></i> <?php echo lang('candidate_interviews'); ?></li>
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
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('filter_by_status'); ?></button>
                    </span>
                    <select class="form-control select2" id="status">
                      <option value=""><?php echo lang('all'); ?></option>
                      <option value="0"><?php echo lang('pending'); ?></option>
                      <option value="1"><?php echo lang('done'); ?></option>
                    </select>
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('job'); ?></button>
                    </span>
                    <select class="form-control select2" id="job_id">
                      <option value=""><?php echo lang('all'); ?></option>
                      <?php foreach ($jobs as $job) { ?>
                      <option value="<?php echo esc_output($job['job_id']); ?>"><?php echo esc_output($job['title'], 'html'); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <?php if (allowedTo('all_candidate_interviews')) { ?>
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('assigned_to'); ?></button>
                    </span>
                    <select class="form-control select2" id="user_id">
                      <option value=""><?php echo lang('all'); ?></option>
                      <?php foreach ($users as $user) { ?>
                      <option value="<?php echo esc_output($user['user_id']); ?>"><?php echo esc_output($user['first_name'].' '.$user['last_name'], 'html'); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-striped" id="candidate_interviews_datatable">
              <thead>
              <tr>
                <th><?php echo lang('title'); ?></th>
                <th><?php echo lang('candidate'); ?></th>
                <th><?php echo lang('job'); ?></th>
                <th><?php echo lang('assigned_to'); ?></th>
                <th><?php echo lang('created_on'); ?></th>
                <th><?php echo lang('status'); ?></th>
                <th><?php echo lang('actions'); ?></th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
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

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/candidate_interview.js"></script>

</body>
</html>

