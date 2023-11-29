<div class="row resume-item-edit-box-section skill-box">
    <div class="col-md-12 col-lg-12">
      <div class="resume-item-edit-box-section-remove remove-section" 
        data-type="skill"
        data-id="<?php echo $skill['resume_skill_id'] ? encode($skill['resume_skill_id']) : ''; ?>"
        title="Remove Section">
        <i class="fas fa-trash-alt"></i> <?php echo lang('remove_section'); ?>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('skill'); ?> *</label>
        <input type="hidden" name="resume_id[]" 
        value="<?php echo $skill['resume_id'] ? encode($skill['resume_id']) : ''; ?>" />
        <input type="hidden" name="resume_skill_id[]" 
        value="<?php echo $skill['resume_skill_id'] ? encode($skill['resume_skill_id']) : ''; ?>" />
        <input type="text" class="form-control" placeholder="Presentation" name="title[]"
        value="<?php echo esc_output($skill['title']); ?>">        
        <small class="form-text text-muted"><?php echo lang('select_skill'); ?></small>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('select_proficiency'); ?></label>
        <select class="form-control" name="proficiency[]">
          <option value="beginner" <?php sel('beginner', $skill['proficiency']); ?> ><?php echo lang('beginner'); ?></option>
          <option value="intermediate" <?php sel('intermediate', $skill['proficiency']); ?>><?php echo lang('intermediate'); ?></option>
          <option value="expert" <?php sel('expert', $skill['proficiency']); ?>><?php echo lang('expert'); ?></option>
        </select>
        <small class="form-text text-muted"><?php echo lang('select_proficiency'); ?></small>
      </div>
    </div>
</div>
