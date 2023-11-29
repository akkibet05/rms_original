<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-briefcase"></i> <?php echo lang('blogs'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-briefcase"></i> <?php echo lang('blogs'); ?></li>
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
            <form role="form" id="admin_blog_create_update_form">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo lang('title'); ?></label>
                      <input type="hidden" name="blog_id" value="<?php echo esc_output($blog['blog_id']); ?>" />
                      <input type="text" class="form-control" placeholder="<?php echo lang('enter_title'); ?>" name="title" 
                      value="<?php echo esc_output($blog['title']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label><?php echo lang('status'); ?></label>
                      <select class="form-control">
                        <option value="1" <?php sel($blog['status'], 1); ?>><?php echo lang('active'); ?></option>
                        <option value="0" <?php sel($blog['status'], 0); ?>><?php echo lang('inactive'); ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                      <label>
                        <?php echo lang('categories'); ?>
                      </label>
                      <select class="form-control select2" id="categories" name="blog_category_id">
                        <option value=""><?php echo lang('none'); ?></option>
                        <?php foreach ($categories as $key => $value) { ?>
                          <option value="<?php echo esc_output($value['blog_category_id']); ?>" <?php sel($blog['blog_category_id'], $value['blog_category_id']); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo lang('description'); ?></label>
                      <textarea id="description" name="description" rows="10" cols="80"><?php echo esc_output($blog['description'], 'raw'); ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <br />
                      <?php $image = blogThumb($blog['image']); ?>
                      <label><?php echo lang('image'); ?></label>
                      <input type="file" class="form-control dropify" name="image" 
                            data-default-file="<?php echo $image['image']; ?>" />
                    </div>
                  </div>                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="admin_blog_create_update_form_button"><?php echo lang('save'); ?></button>
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
<script src="<?php echo base_url(); ?>assets/admin/js/cf/blog.js"></script>

</body>
</html>

