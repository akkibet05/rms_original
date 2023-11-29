  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_css'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_css'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">

        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">CSS</h3>
            </div>
            <?php if (allowedTo('css_settings')) { ?>
            <form id="admin_settings_form">
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                <input type="hidden" name="css-editor" id="editor-hidden" />
                <textarea id="css-editor"><?php echo esc_output($css, 'raw'); ?></textarea>
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

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cssbeautify.codemirror.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cssbeautify.css.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cssbeautify.js"></script>

</body>
</html>
