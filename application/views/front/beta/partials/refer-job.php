<div class="modal-header p-0">              
    <h4 class="modal-title"><?php echo lang('refer_this_job'); ?></h4>
    <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
    <form id="job_refer_form">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="hidden" name="job_id" id="job_id">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control shadow-none border-none" name="name" id="name" 
                        placeholder="<?php echo lang('enter_person_name'); ?>" required="required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control shadow-none border-none" name="email" id="email" 
                        placeholder="<?php echo lang('enter_person_email'); ?>" required="required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control shadow-none border-none" name="phone" id="phone" 
                        placeholder="<?php echo lang('enter_person_phone'); ?>">
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <button id="job_refer_form_button" type="submit" class="btn btn-primary btn-sm">
                    <?php echo lang('refer'); ?></button>
            </div>
        </div>
    </form>
</div>
