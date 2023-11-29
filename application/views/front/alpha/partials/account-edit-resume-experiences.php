<div class="row resume-item-edit-box-section experience-box">
    <div class="col-md-12 col-lg-12">
      <div class="resume-item-edit-box-section-remove remove-section" 
        data-type="experience"
        data-id="<?php echo $experience['resume_experience_id'] ? encode($experience['resume_experience_id']) : ''; ?>"
        title="Remove Section">
        <i class="fas fa-trash-alt"></i> <?php echo lang('remove_section'); ?>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('job_title'); ?> *</label>
        <input type="hidden" name="resume_id[]" 
        value="<?php echo $experience['resume_id'] ? encode($experience['resume_id']) : ''; ?>" />
        <input type="hidden" name="resume_experience_id[]" 
        value="<?php echo $experience['resume_experience_id'] ? encode($experience['resume_experience_id']) : ''; ?>" />
        <input type="text" class="form-control" name="title[]" 
          value="<?php echo esc_output($experience['title']); ?>">
        <small class="form-text text-muted"><?php echo lang('enter_job_title'); ?></small>
      </div>
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('from'); ?> *</label>
        <input type="text" class="form-control datepicker" placeholder="29-12-1985" name="from[]"
        value="<?php echo dateOnly($experience['from']); ?>">
        <small class="form-text text-muted"><?php echo lang('start_date_of_job'); ?>.</small>
      </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('company'); ?> *</label>
        <input type="text" class="form-control" name="company[]"
        value="<?php echo esc_output($experience['company']); ?>">
        <small class="form-text text-muted"><?php echo lang('enter_company'); ?></small>
      </div>
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('to'); ?> *</label>
        <input type="text" class="form-control datepicker" placeholder="29-12-1985" name="to[]"
        value="<?php echo dateOnly($experience['to']); ?>">
        <small class="form-text text-muted"><?php echo lang('enter_date_of_job'); ?></small>
      </div>
    </div>
    <div class="col-md-12 col-lg-12">
      <div class="form-group form-group-account">
        <label for=""><?php echo lang('job_description'); ?> *</label>
        <textarea class="form-control" name="description[]"><?php echo esc_output($experience['description'], 'textarea'); ?></textarea>
        <small class="form-text text-muted"><?php echo lang('enter_job_description'); ?>.</small>
      </div>
    </div>
</div>
