<div class="row resume-item-edit-box-section reference-box">
  <div class="col-md-12 col-lg-12">
    <div class="resume-item-edit-box-section-remove remove-section" 
      data-type="reference"
      data-id="<?php echo $reference['resume_reference_id'] ? encode($reference['resume_reference_id']) : ''; ?>"
      title="Remove Section">
      <i class="fas fa-trash-alt"></i> <?php echo lang('remove_section'); ?>
    </div>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('title'); ?> *</label>
      <input type="hidden" name="resume_id[]" 
      value="<?php echo $reference['resume_id'] ? encode($reference['resume_id']) : ''; ?>" />
      <input type="hidden" name="resume_reference_id[]" 
      value="<?php echo $reference['resume_reference_id'] ? encode($reference['resume_reference_id']) : ''; ?>" />
      <input type="text" class="form-control" name="title[]" 
        value="<?php echo esc_output($reference['title']); ?>">
      <small class="form-text text-muted"><?php echo lang('enter_person_name'); ?>.</small>
    </div>
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('company'); ?></label>
      <input type="text" class="form-control" name="company[]" 
        value="<?php echo esc_output($reference['company']); ?>">
      <small class="form-text text-muted"><?php echo lang('enter_person_company'); ?></small>
    </div>
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('email'); ?> *</label>
      <input type="text" class="form-control" name="email[]" 
        value="<?php echo esc_output($reference['email']); ?>">
      <small class="form-text text-muted"><?php echo lang('enter_person_email'); ?></small>
    </div>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('relation'); ?> *</label>
      <input type="text" class="form-control" name="relation[]" 
        value="<?php echo esc_output($reference['relation']); ?>">
      <small class="form-text text-muted"><?php echo lang('enter_relation_association'); ?></small>
    </div>
    <div class="form-group form-group-account">
      <label for=""><?php echo lang('phone'); ?></label>
      <input type="text" class="form-control" placeholder="1234567890" name="phone[]" 
        value="<?php echo esc_output($reference['phone']); ?>">
      <small class="form-text text-muted"><?php echo lang('enter_person_phone'); ?></small>
    </div>
  </div>
</div>
