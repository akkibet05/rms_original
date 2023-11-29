<form id="admin_roles_bulk_assign_form">
  <input type="hidden" name="user_ids" id="user_ids" value="" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>
            <?php echo lang('select_roles'); ?>
          </label>
          <select class="form-control select2" multiple="multiple" name="roles[]">
            <?php foreach ($roles as $key => $value) { ?>
              <option value="<?php echo esc_output($value['role_id']); ?>"><?php echo esc_output($value['title'], 'html'); ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_roles_bulk_assign_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>