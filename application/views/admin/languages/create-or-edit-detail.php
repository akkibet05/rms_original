<form id="admin_language_create_form">
  <input type="hidden" name="language_id" value="<?php echo esc_output($language['language_id']); ?>" />
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('title'); ?></label>
          <input type="text" class="form-control" name="title" value="<?php echo esc_output($language['title']); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo lang('slug'); ?></label>
          <input type="text" class="form-control" name="slug" value="<?php echo esc_output($language['slug']); ?>">
          <small class="red"><?php echo lang('only_english_alphabets_allowed').'<br />'.lang('changing_it_later'); ?></small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for=""><?php echo lang('status'); ?></label>
          <select name="status" class="form-control">
            <option value="1" <?php sel($language['status'], 1); ?>><?php echo lang('active'); ?></option>
            <option value="0" <?php sel($language['status'], 0); ?>><?php echo lang('inactive'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for=""><?php echo lang('direction'); ?></label>
          <select name="direction" class="form-control">
            <option value="ltr" <?php sel($language['direction'], 'ltr'); ?>><?php echo lang('ltr'); ?></option>
            <option value="rtl" <?php sel($language['direction'], 'rtl'); ?>><?php echo lang('rtl'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for=""><?php echo lang('display'); ?></label>
          <select name="display" class="form-control">
            <option value="both" <?php sel($language['display'], 'both'); ?>><?php echo lang('both'); ?></option>
            <option value="only_title" <?php sel($language['display'], 'only_title'); ?>><?php echo lang('only_title'); ?></option>
            <option value="only_flag" <?php sel($language['display'], 'only_flag'); ?>><?php echo lang('only_flag'); ?></option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label><?php echo lang('flag'); ?></label><br />
          <select class="selectpicker form-control" name="flag" data-width="fit">
            <?php foreach (flagCodes() as $code) { ?>
              <option data-content='<?php echo $code; ?>&nbsp;&nbsp;<span class="flag-icon flag-icon-<?php echo esc_output($code); ?>"></span>' <?php sel($language['flag'], $code); ?>><?php echo esc_output($code); ?></option>
            <?php } ?>
          </select>          
        </div>
      </div>

    </div>          
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_language_create_form_button">
      <?php echo lang('save'); ?>
    </button>
  </div>
</form>
