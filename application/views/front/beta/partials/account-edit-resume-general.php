<div class="edit-resume-content">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="section-incremental-form-alpha-item">
                <form class="form" id="resume_edit_general_form">
                    <div class="row section-incremental-form-alpha-relative">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group form-group-account">
                                <label for=""><?php echo lang('title'); ?></label>
                                <input type="hidden" name="id" value="<?php echo encode($resume['resume_id']); ?>" />
                                <input type="text" class="form-control" name="title" value="<?php echo esc_output($resume['title']); ?>">
                                <small class="form-text text-muted"><?php echo lang('enter_title'); ?></small>
                            </div>
                            <div class="form-group form-group-account">
                                <label for=""><?php echo lang('designation'); ?></label>
                                <input type="text" class="form-control" name="designation" value="<?php echo esc_output($resume['designation']); ?>">
                                <small class="form-text text-muted"><?php echo lang('enter_designation'); ?></small>
                            </div>
                            <div class="form-group form-group-account">
                                <label for=""><?php echo lang('objective'); ?></label>
                                <textarea class="form-control" name="objective"><?php echo esc_output($resume['objective']); ?></textarea>
                                <small class="form-text text-muted"><?php echo lang('enter_objective'); ?>.</small>
                            </div>
                            <div class="form-group form-group-account">
                                <label for="input-file-now-custom-1">
                                <?php echo lang('file'); ?>
                                <?php if ($resume['file']) { ?>
                                <a target="_blank" href="<?php echo resumeThumb($resume['file']); ?>" title="Download">
                                <?php echo lang('download'); ?>
                                </a>
                                <?php } ?>
                                </label>
                                <input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="" name="file" />
                                <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                            </div>
                            <div class="form-group form-group-account">
                                <label for=""><?php echo lang('status'); ?></label>
                                <select class="form-control" name="status">
                                    <option value="1" <?php echo sel($resume['status'], '1'); ?>><?php echo lang('active'); ?></option>
                                    <option value="0" <?php echo sel($resume['status'], '0'); ?>><?php echo lang('inactive'); ?></option>
                                </select>
                                <small class="form-text text-muted"><?php echo lang('select_status'); ?></small>
                            </div>
                            <div class="form-group form-group-account">
                                <button type="submit" class="btn btn-general" title="Save" id="resume_edit_general_form_button">
                                <i class="fa-regular fa-save"></i> <?php echo lang('save'); ?>
                                </button>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>