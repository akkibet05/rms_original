<form id="admin_user_create_update_form">
  <input type="hidden" name="user_id" value="<?php echo esc_output($user['user_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('first_name'); ?></label>
          <input type="text" class="form-control" name="first_name" value="<?php echo esc_output($user['first_name']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('last_name'); ?></label>
          <input type="text" class="form-control" name="last_name" value="<?php echo esc_output($user['last_name']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('username'); ?></label>
          <input type="text" class="form-control" name="username" value="<?php echo esc_output($user['username']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('email'); ?></label>
          <input type="text" class="form-control" name="email" value="<?php echo esc_output($user['email']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('phone'); ?></label>
          <input type="text" class="form-control" name="phone" value="<?php echo esc_output($user['phone']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('password'); ?></label>
          <input type="password" class="form-control" name="password">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label><?php echo lang('image'); ?></label>
          <input type="file" class="form-control dropify" name="image" 
                data-default-file="<?php echo userThumb($user['image']); ?>" />
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>
            <?php echo lang('roles'); ?>
            <button type="button" class="btn btn-xs btn-warning btn-blue view-roles" title="Add New Role">
              <i class="fa fa-plus"></i>
            </button>
          </label>
          <select class="form-control" multiple="multiple" name="roles[]" id="roles-dropdown">
            <?php foreach ($roles as $key => $value) { ?>
              <?php $selected = in_array($value['role_id'], $userRoles) ? 'selected="selected"' : ''; ?>
              <option value="<?php echo esc_output($value['role_id']); ?>" <?php echo esc_output($selected); ?>><?php echo esc_output($value['title'], 'html'); ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>          
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_user_create_update_form_button"><?php echo lang('save'); ?></button>
  </div>
</form>
