<form id="admin_quiz_question_create_update_form">
  <input type="hidden" name="quiz_question_id" value="<?php echo esc_output($question['quiz_question_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('title'); ?></label>
          <textarea class="form-control" name="title"><?php echo esc_output($question['title'], 'html'); ?></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <br />
          <label><?php echo lang('image'); ?></label>
          <input type="file" class="form-control dropify" name="image" data-id="<?php echo esc_output($question['quiz_question_id']); ?>"
                data-default-file="<?php echo questionThumb($question['image']); ?>" />
        </div>
      </div>            
      <hr />
      <div class="col-md-12">
        <input type="hidden" name="type" id="type" value="<?php echo esc_output($type); ?>">
        <div class="row answers-container">
          <div class="col-md-8">
            <div class="form-group">
              <?php $title = $question['type'] == 'radio' ? lang('change_to_multi_correct') : lang('change_to_single_correct'); ?>
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
              value="<?php echo esc_output($answer['quiz_question_answer_id']); ?>" />
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
              <i class="fa fa-trash text-red remove-answer" data-id="<?php echo esc_output($answer['quiz_question_answer_id']); ?>" 
                title="Remove Answer"></i>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php } else { ?>
        <?php $type = $question['type']; ?>
        <?php include(VIEW_ROOT.'/admin/quizes/new-answer-item.php'); ?>
        <?php include(VIEW_ROOT.'/admin/quizes/new-answer-item.php'); ?>
      <?php } ?>
      </div>
      <div class="col-md-12">
        <a href="#" class="btn btn-primary add-answer" 
        data-type="<?php echo esc_output($question['type']); ?>"
        data-id="<?php echo esc_output($question['quiz_question_id']); ?>">
          <i class="fa fa-plus"></i> <?php echo lang('add'); ?>
        </a>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_quiz_question_create_update_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
