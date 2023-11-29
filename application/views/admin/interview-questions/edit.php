<form id="admin_interview_question_create_update_form">
  <input type="hidden" name="interview_question_id" value="<?php echo esc_output($question['interview_question_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('title'); ?></label>
          <textarea class="form-control" name="title"><?php echo esc_output($question['title'], 'textarea'); ?></textarea>
        </div>
      </div>
      <hr />
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_interview_question_create_update_form_button">
      <?php echo lang('save'); ?>
    </button>
  </div>
</form>
