  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <?php if (setting('enable-multiple-resume') == 'yes') { ?>
        <h2><span><?php echo lang('account'); ?> > <?php echo lang('resumes'); ?> > <?php echo esc_output($resume['title']); ?></span></h2>
        <?php } else { ?>
        <h2><span><?php echo lang('account'); ?> > <?php echo substr(lang('resumes'), 0,-1); ?></span></h2>
        <?php } ?>
      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Account Area Setion
    ============================-->
    <section id="about">
      <div class="container">

        <div class="row mt-10">
          <div class="col-lg-3">
            <div class="account-area-left">
              <ul>
                <?php include(VIEW_ROOT.'/front/alpha/partials/account-sidebar.php'); ?>
              </ul>
            </div>
          </div>
          <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <section class="edit-resume-section" id="process-tab">
                  <div class="col-xs-12"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs resume-process-edit more-icon-resume-edit-process" role="tablist">
                      <li role="presentation" class="active" title="General" id="general-tab">
                        <a href="#resume-general" aria-controls="resume-general" role="tab" data-toggle="tab">
                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li role="presentation" title="Job History" id="experience-tab">
                        <a href="#resume-history" aria-controls="resume-history" role="tab" data-toggle="tab">
                          <i class="fa fa-history" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li role="presentation" title="Qualifications" id="qualification-tab">
                        <a href="#resume-qualification" aria-controls="resume-qualification" role="tab" data-toggle="tab">
                          <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li role="presentation" title="Skills" id="skill-tab">
                        <a href="#resume-skill" aria-controls="resume-skill" role="tab" data-toggle="tab">
                          <i class="fas fa-paint-brush"></i>
                        </a>
                      </li>
                      <li role="presentation" title="Languages" id="language-tab">
                        <a href="#resume-language" aria-controls="resume-language" role="tab" data-toggle="tab">
                          <i class="fa fa-language" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li role="presentation" title="Achievements" id="achievement-tab">
                        <a href="#resume-achievement" aria-controls="resume-achievement" role="tab" data-toggle="tab">
                          <i class="fa fa-trophy" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li role="presentation" title="References" id="reference-tab">
                        <a href="#resume-references" aria-controls="resume-references" role="tab" data-toggle="tab">
                          <i class="fa fa-globe" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="resume-general">
                        <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-general.php'); ?>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="resume-history">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text"><?php echo lang('job_experiences'); ?></span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_experiences_form">
                                    <div class="section-container">
                                    <?php foreach ($resume['experiences'] as $experience) { ?>
                                    <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-experiences.php'); ?>
                                    <?php } ?>
                                    <div class="row resume-item-edit-box-section no-experience-box">
                                      <div class="col-md-12 col-lg-12">
                                        <p><?php echo lang('there_are_no_experiences'); ?>.</p>
                                        <p> Add from <strong>+</strong> button below.</p>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 col-lg-12">
                                        <div class="form-group form-group-account">
                                          <a class="btn btn-primary add-section add-section-experience" title="Add More"
                                            data-id="<?php echo encode($resume['resume_id']); ?>"
                                            data-type="experience">
                                            <i class="fa fa-plus"></i>
                                          </a>
                                          <?php if (count($resume['experiences']) == 0) { ?>
                                          <input type="hidden" id="no_experience_found" value="1" />
                                          <?php } ?>
                                          <button type="submit" class="btn btn-success" title="Save" 
                                          id="resume_edit_experiences_form_button">
                                            <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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
                      <div role="tabpanel" class="tab-pane" id="resume-qualification">
                      <div class="edit-resume-content">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="account-box">
                              <p class="account-box-heading">
                                <span class="account-box-heading-text"><?php echo lang('qualifications'); ?></span>
                                <span class="account-box-heading-line"></span>
                              </p>
                              <div class="container">
                                <form class="form" id="resume_edit_qualifications_form">
                                <div class="section-container">
                                <?php foreach ($resume['qualifications'] as $qualification) { ?>
                                <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-qualifications.php'); ?>
                                <?php } ?>
                                <div class="row resume-item-edit-box-section no-qualification-box">
                                  <div class="col-md-12 col-lg-12">
                                    <p><?php echo lang('there_are_no_qualifications'); ?>.</p>
                                    <p> Add from <strong>+</strong> button below.</p>
                                  </div>
                                </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-lg-12">
                                    <div class="form-group form-group-account">
                                      <a class="btn btn-primary add-section add-section-qualification" title="Add More"
                                        data-id="<?php echo encode($resume['resume_id']); ?>"
                                        data-type="qualification">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                      <?php if (count($resume['qualifications']) == 0) { ?>
                                      <input type="hidden" id="no_qualification_found" value="1" />
                                      <?php } ?>
                                      <button type="submit" class="btn btn-success" title="Save"
                                        id="resume_edit_qualifications_form_button">
                                        <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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
                      <div role="tabpanel" class="tab-pane" id="resume-language">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text"><?php echo lang('languages'); ?></span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_languages_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['languages'] as $language) { ?>
                                  <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-languages.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-language-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p><?php echo lang('there_are_no_languages'); ?>.</p>
                                      <p> Add from <strong>+</strong> button below.</p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section add-section-language" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="language">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <?php if (count($resume['languages']) == 0) { ?>
                                        <input type="hidden" id="no_language_found" value="1" />
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_languages_form_button">
                                          <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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
                      <div role="tabpanel" class="tab-pane" id="resume-skill">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text"><?php echo lang('skills'); ?></span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_skills_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['skills'] as $skill) { ?>
                                  <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-skills.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-skill-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p><?php echo lang('there_are_no_skills'); ?>.</p>
                                      <p> Add from <strong>+</strong> button below.</p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section add-section-skill" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="skill">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <?php if (count($resume['skills']) == 0) { ?>
                                        <input type="hidden" id="no_skill_found" value="1" />
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_skills_form_button">
                                          <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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
                      <div role="tabpanel" class="tab-pane" id="resume-achievement">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text"><?php echo lang('achievements'); ?></span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_achievements_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['achievements'] as $achievement) { ?>
                                  <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-achievements.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-achievement-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p><?php echo lang('there_are_no_achievements'); ?>.</p>
                                      <p> Add from <strong>+</strong> button below.</p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section add-section-achievement" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="achievement">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <?php if (count($resume['achievements']) == 0) { ?>
                                        <input type="hidden" id="no_achievement_found" value="1" />
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_achievements_form_button">
                                          <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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
                      <div role="tabpanel" class="tab-pane" id="resume-references">
                        <div class="edit-resume-content">
                          <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <div class="account-box">
                                <p class="account-box-heading">
                                  <span class="account-box-heading-text"><?php echo lang('references'); ?></span>
                                  <span class="account-box-heading-line"></span>
                                </p>
                                <div class="container">
                                  <form class="form" id="resume_edit_references_form">
                                  <div class="section-container">
                                  <?php foreach ($resume['references'] as $reference) { ?>
                                  <?php include(VIEW_ROOT.'/front/alpha/partials/account-edit-resume-references.php'); ?>
                                  <?php } ?>
                                  <div class="row resume-item-edit-box-section no-reference-box">
                                    <div class="col-md-12 col-lg-12">
                                      <p><?php echo lang('there_are_no_references'); ?></p>
                                      <p> Add from <strong>+</strong> button below.</p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                      <div class="form-group form-group-account">
                                        <a class="btn btn-primary add-section add-section-reference" title="Add More"
                                          data-id="<?php echo encode($resume['resume_id']); ?>"
                                          data-type="reference">
                                          <i class="fa fa-plus"></i>
                                        </a>
                                        <?php if (count($resume['references']) == 0) { ?>
                                        <input type="hidden" id="no_reference_found" value="1" />
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success" title="Save"
                                          id="resume_edit_references_form_button">
                                          <i class="fa fa-floppy-o"></i> <?php echo lang('save'); ?>
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
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>