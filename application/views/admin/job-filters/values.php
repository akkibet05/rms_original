<form id="admin_job_filter_values_update_form">
  <input type="hidden" name="job_filter_id" value="<?php echo esc_output($job_filter_id); ?>" />
  <div class="modal-body">
    <div class="row values-container">
    <?php if ($values) { ?>
    <?php foreach ($values as $val) { ?>
      <?php include(VIEW_ROOT.'/admin/job-filters/value.php'); ?>
    <?php } ?>
    <?php } ?>
    </div>
    <div class="row">
      <div class="col-md-12">
        <a href="#" class="btn btn-primary add-value" 
          data-id="<?php echo esc_output($job_filter_id); ?>">
          <i class="fa fa-plus"></i> <?php echo lang('add'); ?>
        </a>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_job_filter_values_update_form_button">
      <?php echo lang('save'); ?>
    </button>
  </div>
</form>
