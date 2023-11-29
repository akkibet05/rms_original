<form id="admin_job_filter_create_update_form">
  <input type="hidden" name="job_filter_id" value="<?php echo esc_output($job_filter['job_filter_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('title'); ?></label>
          <input type="text" class="form-control" name="title" value="<?php echo esc_output($job_filter['title']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('order'); ?></label>
          <input type="number" class="form-control" name="order" value="<?php echo esc_output($job_filter['order']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('admin_filter'); ?></label>
          <select class="form-control" name="admin_filter">
            <option value="1" <?php sel($job_filter['admin_filter'], 1); ?>><?php echo lang('yes'); ?></option>
            <option value="0" <?php sel($job_filter['admin_filter'], 0); ?>><?php echo lang('no'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('front_filter'); ?></label>
          <select class="form-control" name="front_filter">
            <option value="1" <?php sel($job_filter['front_filter'], 1); ?>><?php echo lang('yes'); ?></option>
            <option value="0" <?php sel($job_filter['front_filter'], 0); ?>><?php echo lang('no'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('front_home_filter'); ?></label>
          <select class="form-control" name="front_home_filter">
            <option value="1" <?php sel($job_filter['front_home_filter'], 1); ?>><?php echo lang('yes'); ?></option>
            <option value="0" <?php sel($job_filter['front_home_filter'], 0); ?>><?php echo lang('no'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('front_value'); ?></label>
          <select class="form-control" name="front_value">
            <option value="1" <?php sel($job_filter['front_value'], 1); ?>><?php echo lang('yes'); ?></option>
            <option value="0" <?php sel($job_filter['front_value'], 0); ?>><?php echo lang('no'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('front_filter_type'); ?></label>
          <select class="form-control" name="type">
            <option value="dropdown" <?php sel($job_filter['type'], 'dropdown'); ?>>
              <?php echo lang('dropdown').' ('.lang('single_select').')'; ?>
            </option>
            <option value="checkbox" <?php sel($job_filter['type'], 'checkbox'); ?>>
              <?php echo lang('checkbox').' ('.lang('multi_select').')'; ?>
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('status'); ?></label>
          <select class="form-control" name="status">
            <option value="1" <?php sel($job_filter['status'], 1); ?>><?php echo lang('active'); ?></option>
            <option value="0" <?php sel($job_filter['status'], 0); ?>><?php echo lang('inactive'); ?></option>
          </select>
        </div>
      </div>
    </div>          
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_job_filter_create_update_form_button">
      <?php echo lang('save'); ?>
    </button>
  </div>
</form>
