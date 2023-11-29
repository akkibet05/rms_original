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
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table section-account-alpha-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo lang('title'); ?></th>
                                        <th scope="col"><i class="fa fa-history"></i> <?php echo lang('qualifications'); ?></th>
                                        <th scope="col"><i class="fa fa-graduation-cap"></i> <?php echo lang('experiences'); ?></th>
                                        <th scope="col"><i class="fa fa-trophy"></i> <?php echo lang('achievements'); ?></th>
                                        <th scope="col"><i class="fa fa-language"></i> <?php echo lang('skills'); ?></th>
                                        <th scope="col"><i class="fa fa-language"></i> <?php echo lang('languages'); ?></th>
                                        <th scope="col"><i class="fa fa-globe"></i> <?php echo lang('references'); ?></th>
                                        <th scope="col"><?php echo lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($resumes) { ?>
                                    <?php foreach ($resumes as $key => $resume) { ?>
                                        <?php $id = encode($resume['resume_id']); ?>
                                        <?php if ($resume['type'] == 'detailed') { ?>
                                        <tr>
                                            <td><?php echo esc_output($key+1); ?></td>
                                            <td title="<?php echo esc_output($resume['title']); ?>"><?php echo trimString($resume['title'], 23); ?></td>
                                            <td><?php echo esc_output($resume['qualification']); ?></td>
                                            <td><?php echo esc_output($resume['experience']); ?></td>
                                            <td><?php echo esc_output($resume['achievement']); ?></td>
                                            <td><?php echo esc_output($resume['reference']); ?></td>
                                            <td><?php echo esc_output($resume['skills']); ?></td>
                                            <td><?php echo esc_output($resume['languages']); ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>account/resume/<?php echo esc_output($id); ?>">
                                                    <i class="action-btn fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <tr>
                                            <td><?php echo esc_output($key+1); ?></td>
                                            <td title="<?php echo esc_output($resume['title']); ?>">
                                                <?php echo trimString($resume['title'], 23); ?>
                                            </td>
                                            <td colspan="6">
                                                <?php echo lang('file'); ?>
                                                <?php if(strpos($resume['file'], 'pdf')) { ?>
                                                <i class="far fa-file-pdf resume-item-box-file"></i>
                                                <?php } else { ?>
                                                <i class="far fa-file-word resume-item-box-file"></i>
                                                <?php } ?>                             
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>account/resume/<?php echo esc_output($id); ?>">
                                                    <i class="action-btn fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <tr>
                                        <td colspan="8">
                                            <p><?php echo lang('no_resumes_found'); ?></p>
                                        </td>
                                    </tr>
                                    <?php } ?>                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" 
                                class="btn btn-primary btn-sm add-resume" 
                                title="<?php echo lang('add_new'); ?>">
                            <i class="fa fa-plus"></i>
                        </button>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-beta" class="modal-beta modal fade modal-resume-create">
    <div class="modal-dialog">
        <div class="modal-content modal-body-container">
            <div class="modal-header p-0">              
                <h4 class="modal-title"><?php echo lang('new_resume'); ?></h4>
                <button type="button" class="close close-modal" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="resume_create_form">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                            <label for=""><?php echo lang('title'); ?> *</label>
                            <input type="text" class="form-control" placeholder="Marketing Resume" name="title">
                        </div>
                        <br />
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                            <label for=""><?php echo lang('designation'); ?> *</label>
                            <input type="text" class="form-control" placeholder="Marketing Manager" name="designation">
                        </div>
                        <br />
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                            <label for=""><?php echo lang('type'); ?></label>
                            <select class="form-control" name="type">
                                <option value="detailed"><?php echo lang('detailed'); ?></option>
                                <option value="document"><?php echo lang('document'); ?></option>
                            </select>
                        </div>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group form-group-account">
                            <button type="submit" class="btn btn-cf-general" title="Save" id="resume_create_form_button">
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

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>
