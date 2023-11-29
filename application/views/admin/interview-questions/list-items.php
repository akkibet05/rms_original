<?php if ($questions) { ?>
<?php foreach ($questions as $question) { ?>
<li class="question-list-item interview-item" data-id="<?php echo esc_output($question['interview_question_id']); ?>">
  <span class="handle" title="Drag to order">
    <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i>
  </span>
  <br />
  <span class="text"><?php echo esc_output($question['title'], 'html'); ?></span>
  <div class="tools">
    <?php if (allowedTo('edit_interview_questions')) { ?>
    <i class="fa fa-edit edit-interview-question" data-id="<?php echo esc_output($question['interview_question_id']); ?>"></i>
    <?php } ?>
    <?php if (allowedTo('delete_interview_questions')) { ?>
    <i class="far fa-trash-alt delete-interview-question" data-id="<?php echo esc_output($question['interview_question_id']); ?>"></i>
    <?php } ?>
  </div>
</li>
<?php } ?>
<?php } else { ?>
  <li class="no-questions-found"><p><?php echo lang('no_questions_found'); ?></p></li>
<?php } ?>
