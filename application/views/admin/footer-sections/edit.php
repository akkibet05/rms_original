<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-table"></i> <?php echo lang('footer_sections'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-table"></i> <?php echo lang('footer_sections'); ?></li>
    </ol>
  </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('columns'); ?></h3>
            </div>
            <!-- /.box-header -->
            <?php if (allowedTo('footer_settings')) { ?>
            <!-- form start -->
            <form role="form" id="admin_footer_section_update_form">
              <div class="box-body">
                <div class="row">
                  <?php foreach ($sections as $key => $section) { ?>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label><?php echo lang('column').' '.($key+1); ?></label>
                      <input type="hidden" name="column[]" value="<?php echo esc_output($section['footer_section_id']); ?>" />
                      <textarea id="column<?php echo esc_output($section['footer_section_id']); ?>" name="content[]"><?php echo esc_output($section['content'], 'textarea'); ?></textarea>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="admin_footer_section_update_form_button">
                  <?php echo lang('save'); ?>
                </button>
              </div>
            </form>
            <?php } ?>
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
<script src="<?php echo base_url(); ?>assets/admin/js/cf/footer_section.js"></script>

</body>
</html>

