  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_password'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_password'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">
      <!-- Main row Starts-->
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('update_password'); ?></h3>
            </div>
            <form id="admin_password_reset_form">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('old_password'); ?></label>
                    <input type="password" class="form-control" name="old_password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('new_password'); ?></label>
                    <input type="password" class="form-control" name="new_password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('retype_password'); ?></label>
                    <input type="password" class="form-control" name="retype_password">
                  </div>
                </div>
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="admin_password_reset_form_button"><?php echo lang('save'); ?></button>
            </div>
            </form>
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
<script src="<?php echo base_url(); ?>assets/admin/js/cf/user.js"></script>

</body>
</html>
