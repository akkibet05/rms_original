<?php if ($questions) { ?>
<?php foreach ($questions as $question) { ?>
<li class="question-list-item bank-item-<?php echo esc_output($question['question_id']); ?>" 
  data-id="<?php echo esc_output($question['question_id']); ?>">
  <span class="handle" title="Drag to <?php echo esc_output($nature); ?>">
    <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i>
  </span>
  <?php if ($question['nature'] == 'quiz') { ?>
  <?php if ($question['type'] == 'radio') { ?>
  <small class="label label-primary label-green">
  <i class="fa fa-dot-circle-o"></i> <?php echo esc_output($question['answers_count'], 'html'); ?> <?php echo lang('items'); ?>
  </small>
  <?php } else if ($question['type'] == 'checkbox') { ?>
  <small class="label label-primary label-red">
  <i class="fa fa-check-square-o"></i> <?php echo esc_output($question['answers_count'], 'html'); ?> <?php echo lang('items'); ?>
  </small>
  <?php } ?>
  <?php } ?>
  <br />
  <span class="text"><?php echo esc_output($question['title'], 'html'); ?></span>
  <div class="tools">
    <?php if (allowedTo('edit_questions')) { ?>
    <i class="fa fa-edit create-or-edit-question" data-id="<?php echo esc_output($question['question_id']); ?>"></i>
    <?php } ?>
    <?php if (allowedTo('delete_questions')) { ?>
    <i class="far fa-trash-alt delete-question" data-id="<?php echo esc_output($question['question_id']); ?>"></i>
    <?php } ?>
  </div>
</li>
<?php } ?>
<?php } else { ?>
  <li><p><?php echo lang('no_questions_found'); ?></p></li>
<?php } ?>
