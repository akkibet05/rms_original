<input type="hidden" id="selected_role_id" />
<?php if (allowedTo('add_role')) { ?>
<div class="row roles-create-btn-row">
  <div class="col-sm-12">
    <label>
      <?php echo lang('create_new_role'); ?>
    </label>    
    <form id="admin_role_create_form">
    <div class="input-group">
      <input type="text" name="title" class="form-control" placeholder="Enter Role Title" />
      <span class="input-group-btn">
        <button type="submit" class="btn btn-info btn-blue btn-flat" id="admin_role_create_form_button">
          <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?>
        </button>
      </span>
    </div>
    </form>
  </div>
</div>
<?php } ?>

<?php if (allowedTo('edit_role')) { ?>

<div class="row roles-create-btn-row">
  <div class="col-sm-12">
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <label>
      <?php echo lang('all_roles'); ?>
    </label>
    <ul class="roles-list">
      <?php $cnt = 1; ?>
      <?php foreach ($roles as $role) { ?>
      <li class="<?php echo $cnt == 1 ? 'selected' : ''; ?>" data-role_id="<?php echo esc_output($role['role_id']); ?>">
        <small class="label label-primary label-blue"><?php echo $role['permissions_count']; ?></small>
        <span class="text role-title" title="Select to add/remove role permissions below"><?php echo esc_output($role['title'], 'html'); ?></span>
        <div class="tools">
          <?php if (allowedTo('delete_role')) { ?>
          <i class="far fa-trash-alt delete-role" data-id="<?php echo esc_output($role['role_id']); ?>"></i>
          <?php } ?>
        </div>
      </li>
      <?php $cnt++; ?>
      <?php } ?>
    </ul>
  </div>
</div>

<div class="row roles-create-btn-row">
  <div class="col-sm-12">
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
      <label>
        <?php echo lang('add_remove_permission_for'); ?> <br />"<span class="for-edit-role"></span>"
      </label>
      <div class="edit-permissions-container">
      <select id='optgroup' multiple='multiple'>
        <?php foreach ($permissions as $key => $values) { ?>
          <optgroup label='<?php echo esc_output($key); ?>'>
            <?php foreach ($values as $k => $v) { ?>
              <option value='<?php echo esc_output($v['id']); ?>' <?php echo $v['title'] == 1 ? 'selected="selected"' : ''; ?>>
                <?php echo esc_output($v['title'], 'html'); ?>
              </option>
            <?php } ?>
          </optgroup>
        <?php } ?>
      </select>
      </div>
    </div>
  </div>
</div>

<?php } ?>
