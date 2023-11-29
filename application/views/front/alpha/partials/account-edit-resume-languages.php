<div class="row resume-item-edit-box-section language-box">
    <div class="col-md-12 col-lg-12">
      <div class="resume-item-edit-box-section-remove remove-section" 
        data-type="language"
        data-id="<?php echo $language['resume_language_id'] ? encode($language['resume_language_id']) : ''; ?>"
        title="Remove Section">
        <i class="fas fa-trash-alt"></i> <?php echo lang('remove_section'); ?>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('language'); ?> *</label>
        <input type="hidden" name="resume_id[]" 
        value="<?php echo $language['resume_id'] ? encode($language['resume_id']) : ''; ?>" />
        <input type="hidden" name="resume_language_id[]" 
        value="<?php echo $language['resume_language_id'] ? encode($language['resume_language_id']) : ''; ?>" />
        <input type="text" class="form-control" placeholder="French" name="title[]"
        value="<?php echo esc_output($language['title']); ?>">        
        <small class="form-text text-muted"><?php echo lang('select_language'); ?></small>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('select_proficiency'); ?></label>
        <select class="form-control" name="proficiency[]">
          <option value="beginner" <?php sel('beginner', $language['proficiency']); ?> ><?php echo lang('beginner'); ?></option>
          <option value="intermediate" <?php sel('intermediate', $language['proficiency']); ?>><?php echo lang('intermediate'); ?></option>
          <option value="expert" <?php sel('expert', $language['proficiency']); ?>><?php echo lang('expert'); ?></option>
          <option value="native" <?php sel('native', $language['proficiency']); ?>><?php echo lang('native'); ?></option>
        </select>
        <small class="form-text text-muted"><?php echo lang('select_proficiency'); ?></small>
      </div>
    </div>
</div>
