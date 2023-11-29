<form id="admin_edit_overall_result_form">
  <input type="hidden" name="job_app_id" value="<?php echo esc_output($job_app_id); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('overall_result'); ?></label>
          <input type="number" class="form-control" name="overall_result" min="0" max="100" />
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_edit_overall_result_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
