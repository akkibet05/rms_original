<?php include(VIEW_ROOT.'/front/beta/partials/breadcrumb.php'); ?>

<div class="section-account-alpha-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="section-account-alpha-navigation">
                    <?php include(VIEW_ROOT.'/front/beta/partials/account-sidebar.php'); ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="section-account-alpha-profile">
                    <form class="form" id="resume_update_form">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('title'); ?></label>
                                    <input type="hidden" name="resume_id" value="<?php echo encode($resume['resume_id']); ?>">
                                    <input type="text" class="form-control" placeholder="Marketing Resume" 
                                        name="title" value="<?php echo esc_output($resume['title']); ?>">
                                    <small class="form-text text-muted"><?php echo lang('enter_first_name'); ?></small>
                                </div>
                                <div class="form-group form-group-account">
                                    <label for=""><?php echo lang('status'); ?></label>
                                    <select name="status" class="form-control">
                                        <option value="1" <?php echo esc_output($resume['status']) == '1' ? 'selected' : ''; ?>><?php echo lang('active'); ?></option>
                                        <option value="0" <?php echo esc_output($resume['status']) == '0' ? 'selected' : ''; ?>><?php echo lang('inactive'); ?></option>
                                    </select>
                                    <small class="form-text text-muted"><?php echo lang('select_status'); ?></small>
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
                                    <input type="file" id="input-file-now-custom-1" class="dropify" 
                                        data-default-file="" name="file" />
                                    <small class="form-text text-muted"><?php echo lang('only_doc_docx_pdf_allowed'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-group-account">
                                    <button type="submit" class="btn btn-general" title="Save" id="resume_update_form_button">
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
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>