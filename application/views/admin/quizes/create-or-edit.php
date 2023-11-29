<form id="admin_quiz_create_update_form">
  <input type="hidden" name="quiz_id" value="<?php echo esc_output($quiz['quiz_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('category'); ?></label>
          <select class="form-control" name="quiz_category_id" id="quizs_category_id">
            <?php if ($quiz_categories) { ?>
            <?php foreach ($quiz_categories as $category) { ?>
            <option value="<?php echo esc_output($category['quiz_category_id']); ?>" <?php sel($quiz['quiz_category_id'], $category['quiz_category_id']); ?>>
              <?php echo esc_output($category['title'], 'html'); ?>
            </option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('title'); ?></label>
          <input type="text" name="title" class="form-control" value="<?php echo esc_output($quiz['title']); ?>">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('allowed_time_in_minutes'); ?></label>
          <input type="number" name="allowed_time" class="form-control" value="<?php echo esc_output($quiz['allowed_time']); ?>">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('description'); ?></label>
          <textarea class="form-control" name="description"><?php echo esc_output($quiz['description'], 'textarea'); ?></textarea>
        </div>
      </div>      
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_quiz_create_update_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
