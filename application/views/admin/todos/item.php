<?php if ($todos) { ?>
<?php foreach ($todos as $todo) { ?>
<li>
  <input type="checkbox" 
  	data-id="<?php echo esc_output($todo['to_do_id']); ?>"
  	class="minimal todo" <?php echo esc_output($todo['status']) == 1 ? 'checked="checked"' : ''; ?>>
  <span class="text"><?php echo esc_output($todo['title'], 'html'); ?></span>
  <div class="tools">
    <i class="fa fa-edit create-or-edit-todo" data-id="<?php echo esc_output($todo['to_do_id']); ?>"></i>
    <i class="far fa-trash-alt delete-todo" data-id="<?php echo esc_output($todo['to_do_id']); ?>"></i>
  </div>
</li>
<?php } ?>
<?php } ?>