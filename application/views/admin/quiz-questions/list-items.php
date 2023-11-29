<?php if ($questions) { ?>
<?php foreach ($questions as $question) { ?>
<li class="question-list-item quiz-item" data-id="<?php echo esc_output($question['quiz_question_id']); ?>">
  <span class="handle" title="Drag to order">
    <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i>
  </span>
  <?php if ($question['type'] == 'radio') { ?>
  <small class="label label-primary label-green">
  <i class="fa fa-dot-circle-o"></i> <?php echo esc_output($question['answers_count']); ?> <?php echo lang('items'); ?>
  </small>
  <?php } else if ($question['type'] == 'checkbox') { ?>
  <small class="label label-primary label-red">
  <i class="fa fa-check-square-o"></i> <?php echo esc_output($question['answers_count']); ?> <?php echo lang('items'); ?>
  </small>
  <?php } ?>
  <br />
  <span class="text"><?php echo esc_output($question['title'], 'html'); ?></span>
  <div class="tools">
    <i class="fa fa-edit edit-quiz-question" data-id="<?php echo esc_output($question['quiz_question_id']); ?>"></i>
    <i class="far fa-trash-alt delete-quiz-question" data-id="<?php echo esc_output($question['quiz_question_id']); ?>"></i>
  </div>
</li>
<?php } ?>
<?php } else { ?>
  <li class="no-questions-found"><p><?php echo lang('no_questions_found'); ?></p></li>
<?php } ?>
