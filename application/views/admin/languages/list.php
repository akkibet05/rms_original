<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fas fa-cube"></i> <?php echo lang('languages'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fas fa-cube"></i> <?php echo lang('languages'); ?></li>
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
                <?php if (allowedTo('languages_settings')) { ?>
                <div class="datatable-top-controls datatable-top-controls-filter">
                  <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-language">
                    <i class="fa fa-plus"></i> <?php echo lang('add_language'); ?>
                  </button>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if (allowedTo('languages_settings')) { ?>
            <table class="table table-bordered table-striped" id="languages_datatable">
              <thead>
              <tr>
                <th><?php echo lang('title'); ?></th>
                <th><?php echo lang('slug'); ?></th>
                <th><?php echo lang('created_on'); ?></th>
                <th><?php echo lang('default'); ?></th>
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

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/language.js"></script>

</body>
</html>

