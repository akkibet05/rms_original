<form id="admin_interview_clone_form">
  <input type="hidden" name="interview_id" value="<?php echo esc_output($interview['interview_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('category'); ?></label>
          <select class="form-control" name="interview_category_id" id="interviews_category_id">
            <?php if ($interview_categories) { ?>
            <?php foreach ($interview_categories as $category) { ?>
            <option value="<?php echo esc_output($category['interview_category_id']); ?>" <?php sel($interview['interview_category_id'], $category['interview_category_id']); ?>>
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
          <input type="text" name="title" class="form-control" value="<?php echo esc_output($interview['title']); ?> - cloned">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('description'); ?></label>
          <textarea class="form-control" name="description"><?php echo esc_output($interview['description'], 'textarea'); ?></textarea>
        </div>
      </div>      
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_interview_clone_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
