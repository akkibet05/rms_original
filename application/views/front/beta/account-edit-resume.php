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
                <div class="section-incremental-form-alpha front-resume-general-section">
                    <h5><i class="fa-solid fa-user"></i> <?php echo ('general'); ?></h5>
                    <a class="box-open-close collapsed" data-bs-toggle="collapse" href="#generalSection" 
                        role="button" aria-expanded="false" aria-controls="generalSection" data-state="closed">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse" id="generalSection" style="">
                        <div class="card card-body collapsed-card">
                            <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-general.php'); ?>
                        </div>
                    </div>
                </div>

                <div class="section-incremental-form-alpha front-resume-experiences-section">
                    <h5 id="experiences_heading">
                        <i class="fa-solid fa-user-tie"></i> <?php echo ('experiences'); ?> (<?php echo count($resume['experiences']); ?>)
                    </h5>
                    <a class="box-open-close" data-bs-toggle="collapse" href="#experiences_section" role="button" 
                        aria-expanded="true" aria-controls="experiences_section" data-state="closed">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <div class="collapse" id="experiences_section" style="">
                        <div class="card card-body collapsed-card">
                            <form class="form" id="resume_edit_experiences_form">
                                <div class="section-container">
                                    <?php foreach ($resume['experiences'] as $experience) { ?>
                                    <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-experiences.php'); ?>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <a class="btn btn-general add-section add-section-experience" 
                                                title="<?php echo ('add_more'); ?>"
                                                data-id="<?php echo encode($resume['resume_id']); ?>"
                                                data-type="experience">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <?php if (count($resume['experiences']) == 0) { ?>
                                            <input type="hidden" id="no_experience_found" value="1" />
                                            <?php } ?>
                                            <button type="submit" class="btn btn-general" title="<?php echo lang('save'); ?>" id="resume_edit_experiences_form_button">
                                                <i class="fa fa-save"></i> <?php echo lang('save'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section-incremental-form-alpha front-resume-qualifications-section">
                    <h5 id="qualifications_heading">
                        <i class="fa-solid fa-graduation-cap"></i> <?php echo ('qualifications'); ?> (<?php echo count($resume['qualifications']); ?>)
                    </h5>
                    <a class="box-open-close" data-bs-toggle="collapse" href="#qualifications_section" role="button" 
                        aria-expanded="false" aria-controls="qualifications_section" data-state="closed">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse" id="qualifications_section">
                        <div class="card card-body collapsed-card">
                            <form class="form" id="resume_edit_qualifications_form">
                                <div class="section-container">
                                    <?php foreach ($resume['qualifications'] as $qualification) { ?>
                                    <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-qualifications.php'); ?>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <a class="btn btn-general add-section add-section-qualification" 
                                                title="<?php echo ('add_more'); ?>"
                                                data-id="<?php echo encode($resume['resume_id']); ?>"
                                                data-type="qualification">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <?php if (count($resume['qualifications']) == 0) { ?>
                                            <input type="hidden" id="no_qualification_found" value="1" />
                                            <?php } ?>
                                            <button type="submit" class="btn btn-general" title="<?php echo lang('save'); ?>" id="resume_edit_qualifications_form_button">
                                                <i class="fa fa-save"></i> <?php echo lang('save'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section-incremental-form-alpha front-resume-achievements-section">
                    <h5 id="achievements_heading"><i class="fa-solid fa-trophy"></i> <?php echo ('achievements'); ?> (<?php echo count($resume['achievements']); ?>)</h5>
                    <a class="box-open-close" data-bs-toggle="collapse" href="#achievements_section" role="button" 
                        aria-expanded="false" aria-controls="achievements_section" data-state="closed">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse" id="achievements_section">
                        <div class="card card-body collapsed-card">
                            <form class="form" id="resume_edit_achievements_form">
                                <div class="section-container">
                                    <?php foreach ($resume['achievements'] as $achievement) { ?>
                                    <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-achievements.php'); ?>
                                    <?php } ?>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <a class="btn btn-general add-section add-section-achievement" title="<?php echo ('add_more'); ?>"
                                                data-id="<?php echo encode($resume['resume_id']); ?>"
                                                data-type="achievement">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <?php if (count($resume['achievements']) == 0) { ?>
                                            <input type="hidden" id="no_achievement_found" value="1" />
                                            <?php } ?>
                                            <button type="submit" class="btn btn-general" title="<?php echo lang('save'); ?>" id="resume_edit_achievements_form_button">
                                                <i class="fa fa-save"></i> <?php echo lang('save'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section-incremental-form-alpha front-resume-skills-section">
                    <h5 id="skills_heading"><i class="fa-solid fa-screwdriver-wrench"></i> <?php echo ('skills'); ?> (<?php echo count($resume['skills']); ?>)</h5>
                    <a class="box-open-close" data-bs-toggle="collapse" href="#skills_section" role="button" 
                        aria-expanded="false" aria-controls="skills_section" data-state="closed">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse" id="skills_section">
                        <div class="card card-body collapsed-card">
                            <form class="form" id="resume_edit_skills_form">
                                <div class="section-container">
                                    <?php foreach ($resume['skills'] as $skill) { ?>
                                    <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-skills.php'); ?>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <a class="btn btn-general add-section add-section-skill" title="<?php echo ('add_more'); ?>"
                                                data-id="<?php echo encode($resume['resume_id']); ?>"
                                                data-type="skill">
                                            <i class="fa fa-plus"></i>
                                            </a>
                                            <?php if (count($resume['skills']) == 0) { ?>
                                            <input type="hidden" id="no_skill_found" value="1" />
                                            <?php } ?>
                                            <button type="submit" class="btn btn-general" title="Save"
                                                id="resume_edit_skills_form_button">
                                            <i class="fa-regular fa-save"></i> <?php echo lang('save'); ?>
                                            </button>                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section-incremental-form-alpha front-resume-languages-section">
                    <h5 id="languages_heading"><i class="fa-solid fa-language"></i> <?php echo ('languages'); ?> (<?php echo count($resume['languages']); ?>)</h5>
                    <a class="box-open-close" data-bs-toggle="collapse" href="#languages_section" role="button" 
                        aria-expanded="false" aria-controls="languages_section" data-state="closed">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse" id="languages_section">
                        <div class="card card-body collapsed-card">
                            <form class="form" id="resume_edit_languages_form">
                                <div class="section-container">
                                    <?php foreach ($resume['languages'] as $language) { ?>
                                    <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-languages.php'); ?>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <a class="btn btn-general add-section add-section-language" title="<?php echo ('add_more'); ?>"
                                                data-id="<?php echo encode($resume['resume_id']); ?>"
                                                data-type="language">
                                            <i class="fa fa-plus"></i>
                                            </a>
                                            <?php if (count($resume['languages']) == 0) { ?>
                                            <input type="hidden" id="no_language_found" value="1" />
                                            <?php } ?>
                                            <button type="submit" class="btn btn-general" title="Save"
                                                id="resume_edit_languages_form_button">
                                                <i class="fa-regular fa-save"></i> <?php echo lang('save'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section-incremental-form-alpha front-resume-references-section">
                    <h5 id="references_heading"><i class="fa-solid fa-link"></i> References (2)</h5>
                    <a class="box-open-close" data-bs-toggle="collapse" href="#references_section" role="button" 
                        aria-expanded="false" aria-controls="references_section" data-state="closed">
                        <i class="fa fa-plus"></i>
                    </a>
                    <div class="collapse" id="references_section">
                        <div class="card card-body collapsed-card">
                            <form class="form" id="resume_edit_references_form">
                                <div class="section-container">
                                    <?php foreach ($resume['references'] as $reference) { ?>
                                    <?php include(VIEW_ROOT.'/front/beta/partials/account-edit-resume-references.php'); ?>
                                    <?php } ?>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                            <a class="btn btn-general add-section add-section-reference" title="<?php echo ('add_more'); ?>"
                                                data-id="<?php echo encode($resume['resume_id']); ?>"
                                                data-type="reference">
                                            <i class="fa fa-plus"></i>
                                            </a>
                                            <?php if (count($resume['references']) == 0) { ?>
                                            <input type="hidden" id="no_reference_found" value="1" />
                                            <?php } ?>
                                            <button type="submit" class="btn btn-general" title="Save"
                                                id="resume_edit_references_form_button">
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
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>
