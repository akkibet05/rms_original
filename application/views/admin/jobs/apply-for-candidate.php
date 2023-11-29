<form id="admin_apply_for_candidate_form">
    <input type="hidden" name="job_id" value="<?php echo esc_output($job_id); ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p><strong><?php echo lang('job'); ?> : <?php echo esc_output($job['title']); ?></strong></p>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('candidate'); ?></label>
                    <select class="form-control select2" name="candidate_id" id="candidate_id">
                        <?php if ($candidates) { ?>
                        <?php foreach ($candidates as $candidate) { ?>
                        <option value="<?php echo esc_output($candidate['candidate_id']); ?>"><?php echo esc_output($candidate['first_name'].' '.$candidate['last_name'], 'html'); ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="resume-list-container">
            </div>
            <div class="col-md-12">
                <h4><?php echo lang('traits'); ?></h4>
            </div>
            <div class="col-md-12">
            <div class="row">
                <?php foreach($traites as $trait) { ?>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="section-job-detail-alpha-traits-item">
                        <div class="section-job-detail-alpha-traits-item-heading">
                            <label><?php echo esc_output($trait['title']); ?></label>
                        </div>
                        <input type="hidden" name="trait_titles[<?php echo  encode($trait['trait_id']) ; ?>]" value="<?php echo  $trait['title'] ; ?>">
                        <select class="form-control" name="traits[<?php echo  encode($trait['trait_id']) ; ?>]">
                            <option value="1"><?php echo lang('poor'); ?></option>
                            <option value="2"><?php echo lang('bad'); ?></option>
                            <option value="3" selected=""><?php echo lang('average'); ?></option>
                            <option value="4"><?php echo lang('good'); ?></option>
                            <option value="5"><?php echo lang('excellent'); ?></option>
                        </select>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
        <button type="submit" class="btn btn-primary btn-blue" id="admin_apply_for_candidate_form_button"><?php echo lang('save'); ?></button>
    </div>
</form>