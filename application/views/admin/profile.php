  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_profile'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_profile'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('profile'); ?></h3>
            </div>
            <form id="admin_profile_form">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo lang('first_name'); ?></label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo esc_output($profile['first_name']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><?php echo lang('last_name'); ?></label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo esc_output($profile['last_name']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('username'); ?></label>
                    <input type="text" class="form-control" name="username" value="<?php echo esc_output($profile['username']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('email'); ?></label>
                    <input type="text" class="form-control" name="email" value="<?php echo esc_output($profile['email']); ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><?php echo lang('phone'); ?></label>
                    <input type="text" class="form-control" name="phone" value="<?php echo esc_output($profile['phone']); ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label><?php echo lang('image'); ?></label>
                    <input type="file" class="form-control dropify" name="image" 
                          data-default-file="<?php echo userThumb($profile['image']); ?>" />
                  </div>
                </div>
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="admin_profile_form_button"><?php echo lang('save'); ?></button>
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
