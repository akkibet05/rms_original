<div class="col-md-12">
    <div class="form-group">
        <label><?php echo lang('resumes'); ?></label>
        <select class="form-control select2" name="resume_id" id="resume_id">
            <?php if ($resumes) { ?>
            <?php foreach ($resumes as $resume) { ?>
            <option value="<?php echo esc_output($resume['resume_id']); ?>"><?php echo esc_output($resume['title']); ?></option>
            <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
