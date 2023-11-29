<div class="section-incremental-form-alpha-item">
    <div class="row section-incremental-form-alpha-relative skill-box">
        <div class="col-md-12 col-lg-12">
            <div class="section-incremental-form-alpha-remove remove-section" 
                data-type="skill" 
                title="<?php echo lang('remove_section'); ?>"
                data-id="<?php echo esc_output($skill['resume_skill_id']) ? encode($skill['resume_skill_id']) : ''; ?>">
                <i class="fas fa-trash-alt"></i>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('skill'); ?> *</label>
                <input type="hidden" name="resume_id[]" 
                    value="<?php echo esc_output($skill['resume_id']) ? encode($skill['resume_id']) : ''; ?>" />
                <input type="hidden" name="resume_skill_id[]" 
                    value="<?php echo esc_output($skill['resume_skill_id']) ? encode($skill['resume_skill_id']) : ''; ?>" />
                <input type="text" class="form-control" name="title[]" value="<?php echo esc_output($skill['title']); ?>">
                <small class="form-text text-muted"><?php echo lang('select_skill'); ?></small>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('select_proficiency'); ?></label>
                <select class="form-control" name="proficiency[]">
                    <option value="beginner" <?php echo sel('beginner', $skill['proficiency']); ?> ><?php echo lang('beginner'); ?></option>
                    <option value="intermediate" <?php echo sel('intermediate', $skill['proficiency']); ?>><?php echo lang('intermediate'); ?></option>
                    <option value="expert" <?php echo sel('expert', $skill['proficiency']); ?>><?php echo lang('expert'); ?></option>
                </select>
                <small class="form-text text-muted"><?php echo lang('select_proficiency'); ?></small>
            </div>
        </div>
    </div>
</div>
