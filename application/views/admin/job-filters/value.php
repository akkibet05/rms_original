<?php
  $v = isset($val['title']) ? $val['title'] : '';
  $id = isset($val['job_filter_value_id']) ? $val['job_filter_value_id'] : '';
?>
<div>
<div class="col-md-11">
  <div class="form-group">
    <input type="text" name="values[]" class="form-control" value="<?php echo esc_output($v); ?>" placeholder="<?php echo lang('enter_value'); ?>" />
    <input type="hidden" name="ids[]" class="form-control" value="<?php echo esc_output($id); ?>" />
  </div>
</div>
<div class="col-md-1 text-center">
  <div class="form-group">
    <i class="fa fa-trash text-red remove-value" data-id="<?php echo esc_output($id); ?>" title="<?php echo lang('remove_value'); ?>"></i>
  </div>
</div>
</div>