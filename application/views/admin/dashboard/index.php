<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fas fa-tachometer-alt"></i> <?php echo lang('dashboard'); ?>
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content dashboard-content-wrap">
    <?php if (allowedTo('view_dashboard_stats')) { ?>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-2 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo esc_output($jobsCount, 'html'); ?></h3>
            <p><?php echo lang('all_jobs'); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-suitcase"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/jobs" class="small-box-footer">
            <?php echo lang('view_all'); ?> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-2 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo esc_output($candidates, 'html'); ?></h3>
            <p><?php echo lang('total_candidates'); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/candidates" class="small-box-footer">
            <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-2 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><?php echo esc_output($applications, 'html'); ?></h3>
            <p><?php echo lang('total_applications'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-hand-paper"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/job-board" class="small-box-footer">
            <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-2 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-maroon">
          <div class="inner">
            <h3><?php echo esc_output($interviews, 'html'); ?></h3>
            <p><?php echo lang('total_interviews'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-gavel"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/candidate-interviews" class="small-box-footer">
            <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-2 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo esc_output($hired, 'html'); ?></h3>
            <p><?php echo lang('total_hired'); ?></p>
          </div>
          <div class="icon">
            <i class="fa fa-check"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/job-board" class="small-box-footer">
            <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-2 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo esc_output($rejected, 'html'); ?></h3>
            <p><?php echo lang('total_rejected'); ?></p>
          </div>
          <div class="icon">
            <i class="fas fa-times-circle"></i>
          </div>
          <a href="<?php echo base_url(); ?>admin/job-board" class="small-box-footer">
            <?php echo lang('more_info'); ?> <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      
      <!-- Left col-->
      <section class="col-lg-6">
        <?php if (allowedTo('view_job_chart')) { ?>
        <!-- DONUT CHART -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('popular_jobs'); ?></h3>
            <div class="box-tools pull-right dashboard-jobs-tools">
              <input class="minimal popular" type="checkbox" checked="checked" id="applied_check" checked="checked" /> 
              <strong><?php echo lang('applied'); ?></strong>
              &nbsp;<input class="minimal popular" type="checkbox" checked="checked" id="favorited_check" checked="checked" /> <strong><?php echo lang('favorited'); ?></strong>
              &nbsp;<input class="minimal popular" type="checkbox" checked="checked" id="referred_check" checked="checked" /> <strong><?php echo lang('referred'); ?></strong>
            </div>
          </div>
          <div class="box-body">
            <div class="chart tab-pane jobs-chart" id="jobs-chart"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php } ?>

        <?php if (allowedTo('view_jobs_status')) { ?>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('job_statuses'); ?></h3>
            <div class="box-tools pull-right dashboard-jobs-list-tools">
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-jobs-previos-button"><</button>
                <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="dashboard_jobs_pagination_container">
                  1 - 10
                </button>
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-jobs-next-button">></button>
              </div>
              <input type="hidden" id="dashboard_jobs_page" value="<?php echo esc_output($dashboard_jobs_page); ?>">
              <input type="hidden" id="dashboard_jobs_total_pages" value="<?php echo esc_output($dashboard_jobs_total_pages); ?>">
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th><?php echo lang('job'); ?></th>
                  <th><?php echo lang('department'); ?></th>
                  <th><?php echo lang('candidates'); ?></th>
                  <th><?php echo lang('status'); ?></th>
                </tr>
                </thead>
                <tbody id="dashboard_jobs_list">
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
        </div>
        <?php } ?>

      </section>
      <!-- /.Left col -->

      <!-- right col chart-->
      <section class="col-lg-6">

        <?php if (allowedTo('view_candidate_chart')) { ?>
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('top_candidates'); ?></h3>
            <div class="box-tools pull-right dashboard-top-candidates-tools">
              <input class="minimal top" id="traits_check" type="checkbox" checked="checked" /> <strong><?php echo lang('traits'); ?></strong>
              &nbsp;<input class="minimal top" id="interviews_check" type="checkbox" checked="checked" /> <strong><?php echo lang('interviews'); ?></strong>
              &nbsp;<input class="minimal top" id="quizes_check" type="checkbox" checked="checked" /> <strong><?php echo lang('quizes'); ?></strong>
              <select class="select2" id="job_id">
                <option value=""><?php echo lang('all_jobs'); ?></option>
                <?php foreach ($jobs as $job) { ?>
                  <option value="<?php echo esc_output($job['job_id']); ?>"><?php echo esc_output($job['title'], 'html'); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="box-body">
            <div class="chart top-candidate-chart-container">
              <canvas id="top-candidate-chart" class="top-candidate-chart"></canvas>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <?php } ?>

        <?php if (allowedTo('to_do_list')) { ?>
        <div class="box box-warning">
          <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title"><?php echo lang('to_do_list'); ?></h3>
            <div class="box-tools pull-right dashboard-todos-tools">

              <div class="btn-group pull-right">
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-todos-previos-button"><</button>
                <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="dashboard_todos_pagination_container">
                  1 - 10
                </button>
                <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-todos-next-button">></button>
              </div>
              <input type="hidden" id="dashboard_todos_page" value="<?php echo esc_output($dashboard_todos_page); ?>">
              <input type="hidden" id="dashboard_todos_total_pages" value="<?php echo esc_output($dashboard_todos_total_pages); ?>">
              <button type="button" class="btn btn-xs btn-primary btn-blue dashboard-add-note-btn create-or-edit-todo">
                <i class="fa fa-plus"></i>
              </button>             
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
            <ul class="todo-list ui-sortable" id="dashboard_todos_list">
            </ul>
          </div>
          <!-- /.box-body -->
        </div>          
        <?php } ?>

      </section>
      <!-- right col -->
      
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Forms for actions -->
<form id="jobs_data_form"></form>
<form id="jobs_list_form"></form>
<form id="todos_list_form"></form>
<form id="candidates_data_form"></form>

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/dashboard.js"></script>

</body>
</html>

