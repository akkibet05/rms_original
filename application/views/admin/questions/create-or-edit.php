<form id="admin_question_create_update_form">
  <input type="hidden" name="question_id" value="<?php echo esc_output($question['question_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('category'); ?></label>
          <select class="form-control" name="question_category_id" id="questions_category_id">
            <?php if ($question_categories) { ?>
            <?php foreach ($question_categories as $category) { ?>
            <option value="<?php echo esc_output($category['question_category_id']); ?>" <?php sel($question['question_category_id'], $category['question_category_id']); ?>>
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
          <textarea class="form-control" name="title"><?php echo esc_output($question['title'], 'textarea'); ?></textarea>
          <input type="hidden" name="nature" value="<?php echo esc_output($nature); ?>">
        </div>
      </div>
      <?php if ($nature == 'quiz') { ?>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('image'); ?></label>
          <input type="file" class="form-control dropify" name="image" data-id="<?php echo esc_output($question['question_id']); ?>"
                data-default-file="<?php echo questionThumb($question['image']); ?>" />
        </div>
      </div>
      <?php } ?>
      <hr />
      <?php if ($nature == 'quiz') { ?>
      <div class="col-md-12">
        <input type="hidden" name="type" id="type" value="<?php echo esc_output($type); ?>">
        <div class="row answers-container">
          <div class="col-md-8">
            <div class="form-group">
              <?php $title = $question['type'] == 'radio' ? 'Change to multi correct (checkbox)' : 'Change to single correct (radio)'; ?>
              <label><?php echo lang('answers'); ?> <i class="fas fa-exchange-alt change-answer-type" title="<?php echo esc_output($title); ?>"></i></label>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group text-center">
            <label><?php echo lang('correct'); ?> ?</label>
            </div>
          </div>
          <div class="col-md-2 text-center">
            <label><?php echo lang('delete'); ?></label>
          </div>
        </div>
      <?php if ($answers) { ?>
      <?php foreach ($answers as $key => $answer) { ?>
        <div class="row answers-container">
          <div class="col-md-8">
            <div class="form-group">
              <input type="hidden" name="answer_ids[]" class="form-control" 
              value="<?php echo esc_output($answer['question_answer_id']); ?>" />
              <input type="text" name="answer_titles[]" class="form-control" 
              value="<?php echo esc_output($answer['title']); ?>" placeholder="Enter Option Value" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group text-center">
              <?php $checked = $answer['is_correct'] == 1 ? 'checked="checked"' : ''; ?>
              <input type="hidden" class="answer" name="answers[]" value="<?php echo $checked ? 1 : 0; ?>">
              <?php if ($question['type'] == 'checkbox') { ?>
              <input type="checkbox" class="minimal" name="answers2[]" <?php echo $checked; ?>>
              <?php } else { ?>
              <input type="radio" class="minimal" name="answers2[]" <?php echo $checked; ?>>
              <?php } ?>
            </div>
          </div>
          <div class="col-md-2 text-center">
            <div class="form-group">
              <i class="fa fa-trash text-red remove-answer" data-id="<?php echo esc_output($answer['question_answer_id']); ?>" 
                title="Remove Answer"></i>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php } else { ?>
        <?php $type = $question['type']; ?>
        <?php include(VIEW_ROOT.'/admin/questions/new-answer-item.php'); ?>
        <?php include(VIEW_ROOT.'/admin/questions/new-answer-item.php'); ?>
      <?php } ?>
      </div>
      <div class="col-md-12">
        <a href="#" class="btn btn-primary add-answer" 
        data-type="<?php echo esc_output($question['type']); ?>"
        data-id="<?php echo esc_output($question['question_id']); ?>">
          <i class="fa fa-plus"></i> <?php echo lang('add'); ?>
        </a>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_question_create_update_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
