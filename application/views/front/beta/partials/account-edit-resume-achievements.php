<div class="section-incremental-form-alpha-item">
    <div class="row section-incremental-form-alpha-relative achievement-box">
        <div class="col-md-12 col-lg-12">
            <div class="section-incremental-form-alpha-remove remove-section" 
                data-type="achievement" 
                title="Remove Section" 
                data-id="<?php echo esc_output($achievement['resume_achievement_id']) ? encode($achievement['resume_achievement_id']) : ''; ?>">
                <i class="fas fa-trash-alt"></i>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('title'); ?> *</label>
                <input type="hidden" name="resume_id[]" 
                    value="<?php echo esc_output($achievement['resume_id']) ? encode($achievement['resume_id']) : ''; ?>" />
                <input type="hidden" name="resume_achievement_id[]" 
                    value="<?php echo esc_output($achievement['resume_achievement_id']) ? encode($achievement['resume_achievement_id']) : ''; ?>" />
                <input type="text" class="form-control" name="title[]" value="<?php echo esc_output($achievement['title']); ?>">
                <small class="form-text text-muted"><?php echo lang('enter_title'); ?></small>
            </div>
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('date'); ?></label>
                <input type="date" class="form-control datepicker" placeholder="29-12-1985" name="date[]" 
                    value="<?php echo dateOnly($achievement['date']); ?>" />
                <small class="form-text text-muted"><?php echo lang('enter_date'); ?></small>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('link'); ?></label>
                <input type="text" class="form-control" placeholder="http://www.example.com" name="link[]" 
                    value="<?php echo esc_output($achievement['link']); ?>">
                <small class="form-text text-muted"><?php echo lang('enter_link'); ?></small>
            </div>
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('select_type'); ?> *</label>
                <select class="form-control" name="type[]">
                    <option value="certificate" <?php echo sel('certificate', $achievement['type']); ?>><?php echo lang('certificate'); ?></option>
                    <option value="portfolio" <?php echo sel('portfolio', $achievement['type']); ?>><?php echo lang('portfolio'); ?></option>
                    <option value="publication" <?php echo sel('publication', $achievement['type']); ?>><?php echo lang('publication'); ?></option>
                    <option value="award" <?php echo sel('award', $achievement['type']); ?>><?php echo lang('award'); ?></option>
                    <option value="other" <?php echo sel('other', $achievement['type']); ?>><?php echo lang('other'); ?></option>
                </select>
                <small class="form-text text-muted"><?php echo lang('select_type'); ?></small>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="form-group form-group-account">
                <label for=""><?php echo lang('description'); ?> *</label>
                <textarea class="form-control" placeholder="Description" name="description[]"><?php echo esc_output($achievement['description']); ?></textarea>
                <small class="form-text text-muted"><?php echo lang('enter_description'); ?></small>
            </div>
        </div>
    </div>
</div>
