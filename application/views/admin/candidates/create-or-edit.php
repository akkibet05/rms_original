<form id="admin_candidate_create_update_form">
    <input type="hidden" name="candidate_id" value="<?php echo esc_output($candidate['candidate_id']); ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('first_name'); ?></label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo esc_output($candidate['first_name']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('last_name'); ?></label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo esc_output($candidate['last_name']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('email'); ?></label>
                    <input type="text" class="form-control" name="email" value="<?php echo esc_output($candidate['email']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('phone'); ?></label>
                    <input type="text" class="form-control" name="phone1" value="<?php echo esc_output($candidate['phone1']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo lang('date_of_birth'); ?></label>
                    <input type="text" class="form-control datepicker" placeholder="1990-10-10" name="dob" 
                        value="<?php echo esc_output($candidate['dob']) ? esc_output(date('Y-m-d', strtotime($candidate['dob'])), 'raw') : ''; ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('address'); ?></label>
                    <input type="text" class="form-control" name="address" value="<?php echo esc_output($candidate['address']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('city'); ?></label>
                    <input type="text" class="form-control" name="city" value="<?php echo esc_output($candidate['city']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('state'); ?></label>
                    <input type="text" class="form-control" name="state" value="<?php echo esc_output($candidate['state']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('country'); ?></label>
                    <input type="text" class="form-control" name="country" value="<?php echo esc_output($candidate['country']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><?php echo lang('gender'); ?></label>
                    <select name="gender" class="form-control">
                        <option value="male" <?php echo esc_output($candidate['gender']) == 'male' ? 'selected' : ''; ?>>
                            <?php echo lang('male'); ?>
                        </option>
                        <option value="female" <?php echo esc_output($candidate['gender']) == 'female' ? 'selected' : ''; ?>>
                            <?php echo lang('female'); ?>
                        </option>
                        <option value="other" <?php echo esc_output($candidate['gender']) == 'other' ? 'selected' : ''; ?>>
                            <?php echo lang('other'); ?>
                        </option>
                    </select>
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
                    <label for=""><?php echo lang('short_biography'); ?></label>
                    <textarea class="form-control" placeholder="Short Bio" name="bio"><?php echo esc_output($candidate['bio'], 'textarea'); ?></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('image'); ?></label>
                    <input type="file" class="form-control dropify" name="image" 
                        data-default-file="<?php echo candidateThumb($candidate['image']); ?>" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
        <button type="submit" class="btn btn-primary btn-blue" id="admin_candidate_create_update_form_button"><?php echo lang('save'); ?></button>
    </div>
</form>