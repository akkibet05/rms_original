<form id="admin_import_jobs_form">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('file'); ?></label>
                    <input class="form-control" type="file" name="csv" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo lang('template'); ?></label>
                    <a href="<?php echo base_url(); ?>/assets/admin/img/jobs-import-guide.png" target="_blank">
                        <img src="<?php echo base_url(); ?>/assets/admin/img/jobs-import-guide.png" style="width: 100%;" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
        <button type="submit" class="btn btn-primary btn-blue" id="admin_import_jobs_form_button"><?php echo lang('save'); ?></button>
    </div>
</form>