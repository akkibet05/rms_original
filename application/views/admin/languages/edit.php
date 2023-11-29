<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-briefcase"></i> <?php echo lang('languages'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('languages'); ?></li>
      <li class="active"><?php echo lang('create'); ?></li>
    </ol>
  </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('details'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="admin_language_update_form">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Language Title</label>
                      <input type="hidden" name="language_id" value="<?php echo esc_output($language['language_id']); ?>" />
                      <input type="text" class="form-control" placeholder="Enter Title" name="language_title" 
                      value="<?php echo esc_output($language['title']); ?>" readonly="readonly">
                    </div>
                  </div>
                  <?php foreach ($default as $key => $d) { ?>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo esc_output($d, 'html'); ?> (<?php echo esc_output($key, 'html'); ?>)</label>
                      <input type="text" class="form-control" placeholder="Enter Title" name="<?php echo esc_output($key, 'html'); ?>" 
                      value="<?php echo esc_output(issetVal($entries,$key,$d)); ?>">
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="admin_language_update_form_button"><?php echo lang('save'); ?></button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>

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

