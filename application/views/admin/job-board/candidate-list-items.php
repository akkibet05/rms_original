<?php if ($candidates) { ?>
<?php foreach ($candidates as $candidate) { ?>
<div class="job-board-candidate-wrap">
  <div class="col-md-4 job-board-candidate-profile">
    <div class="row">
      <div class="col-md-4 job-board-candidate-left">
        <input type="checkbox" class="minimal job-board-candidate-select" 
          data-id="<?php echo esc_output($candidate['candidate_id']); ?>"
          data-resume_id="<?php echo esc_output($candidate['resume_id']); ?>">
        <?php if ($candidate['image']) { ?>
        <img src="<?php echo base_url(); ?>assets/images/candidates/<?php echo esc_output($candidate['image']); ?>" 
            onerror="this.src='<?php echo base_url(); ?>assets/images/candidates/not-found.png'"
            class="job-board-candidate-avatar">
        <?php } else { ?>
        <img src="<?php echo base_url(); ?>assets/images/candidates/not-found.png" 
            class="job-board-candidate-avatar">
        <?php } ?>
      </div>
      <div class="col-md-7 job-board-candidate-right">
        <h2 class="job-board-candidate-name view-resume" data-id="<?php echo esc_output($candidate['resume_id']); ?>"
          title="<?php echo esc_output($candidate['first_name'].' '.$candidate['last_name']); ?>">
          <?php echo trimString($candidate['first_name'].' '.$candidate['last_name'], 13); ?>
        </h2>
        <p class="job-board-candidate-profile-item"><?php echo trimString($candidate['designation'], 30); ?></p>
        <p class="job-board-candidate-profile-item"><?php echo lang('applied_on'); ?> : <?php echo dateFormat($candidate['created_at']); ?></p>

        <?php if ($candidate['resume_type'] == 'detailed') { ?>
        <p class="job-board-candidate-profile-item"><?php echo lang('experience'); ?> : <?php echo esc_output($candidate['experience'], 'html'); ?> Months</p>
        <p class="job-board-candidate-profile-item">
          <span class="job-board-resume-item" title="<?php echo esc_output($candidate['experiences']); ?> <?php echo lang('job_experiences'); ?>">
            <i class="fa fa-history"></i> <?php echo esc_output($candidate['experiences'], 'html'); ?>
          </span>
          <span class="job-board-resume-item" title="<?php echo esc_output($candidate['languages']); ?> <?php echo lang('languages'); ?>">
            <i class="fa fa-language"></i> <?php echo esc_output($candidate['languages'], 'html'); ?>
          </span>
          <span class="job-board-resume-item" title="<?php echo esc_output($candidate['qualifications']); ?> <?php echo lang('qualifications'); ?>">
            <i class="fa fa-graduation-cap"></i> <?php echo esc_output($candidate['qualifications'], 'html'); ?>
          </span>
          <span class="job-board-resume-item" title="<?php echo esc_output($candidate['achievements']); ?> <?php echo lang('achievements'); ?>">
            <i class="fa fa-trophy"></i> <?php echo esc_output($candidate['achievements'], 'html'); ?>
          </span>
          <span class="job-board-resume-item" title="<?php echo esc_output($candidate['references']); ?> <?php echo lang('references'); ?>">
            <i class="fa fa-globe"></i> <?php echo esc_output($candidate['references'], 'html'); ?>
          </span>
        </p>
        <?php } else { ?>
        <a class="btn btn-warning btn-xs" target="_blank" href="<?php echo candidateThumb($candidate['file']); ?>" title="<?php echo lang('download'); ?>">
          <i class="fa fa-file"></i> <?php echo lang('download'); ?>
        </a>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="col-md-2 job-board-candidate-self">
    <p class="job-board-candidate-self-heading">
      <i class="fas fa-star-half-alt"></i> <?php echo lang('self_assesment'); ?>
      <?php echo $candidate['traits_result']; ?>%
    </p>
    <ul class="job-board-candidate-item-list">
      <?php if ($candidate['traits']) { ?>
      <?php foreach ($candidate['traits'] as $trait) { ?>
      <li title="<?php echo esc_output($trait['title']); ?>">
      <?php echo trimString(esc_output($trait['title'], 'html'), 20); ?> 
      <br />
      (<?php echo $trait['rating']; ?>/5 - <?php echo $trait['rating'] != 0 ? ($trait['rating']/5)*100 : 0; ?>%)
      </li>
      <?php } ?>
      <?php } else { ?>
      <li><?php echo lang('not_assigned'); ?></li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-2 job-board-candidate-quiz">
    <p class="job-board-candidate-quiz-heading">
      <i class="fa fa-list"></i> <?php echo lang('quizes'); ?> <?php echo $candidate['quizes_result']; ?>%
    </p>
    <ul class="job-board-candidate-item-list">
      <?php if ($candidate['quizes']) { ?>
      <?php foreach ($candidate['quizes'] as $quiz) { ?>
      <li title="<?php echo esc_output($quiz['title']); ?>">
      <i class="far fa-trash-alt text-red delete-candidate-quiz" data-id="<?php echo esc_output($quiz['id']); ?>" title="Delete quiz"></i>
      <?php echo trimString(esc_output($quiz['title'], 'html'), 20); ?>
      <br />
      (<?php echo $quiz['corrects']; ?>/<?php echo $quiz['questions']; ?> - 
      <?php echo $quiz['corrects'] != 0 ? round(($quiz['corrects']/$quiz['questions'])*100) : 0; ?>%)
      </li>
      <?php } ?>
      <?php } else { ?>
      <li><?php echo lang('not_assigned'); ?></li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-2 job-board-candidate-interview">
    <p class="job-board-candidate-interview-heading">
      <i class="fas fa-clipboard-list"></i> <?php echo lang('interviews'); ?> <?php echo $candidate['interviews_result']; ?>%
    </p>
    <ul class="job-board-candidate-item-list">
      <?php if ($candidate['interviews']) { ?>
      <?php foreach ($candidate['interviews'] as $interview) { ?>
      <li title="<?php echo esc_output($interview['title']); ?>">
      <i class="far fa-trash-alt text-red delete-candidate-interview" data-id="<?php echo esc_output($interview['id']); ?>" title="Delete Interview"></i>
      <i class="far fa-edit text-green view-or-conduct-candidate-interview" data-id="<?php echo esc_output($interview['id']); ?>" title="View / Conduct"></i>
      <?php echo trimString(esc_output($interview['title'], 'html'), 20); ?> 
      <br />
      (<?php echo $interview['ratings']; ?>/<?php echo $interview['questions']*10; ?> - 
      <?php echo esc_output($interview['ratings']) != 0 ? round(($interview['ratings']/($interview['questions']*10))*100) : 0; ?>%)
      </li>
      <?php } ?>
      <?php } else { ?>
      <li><?php echo lang('not_assigned'); ?></li>
      <?php } ?>
    </ul>
  </div>
  <div class="col-md-2 job-board-candidate-overall">
    <p class="job-board-candidate-overall-heading"><?php echo lang('overall_result'); ?></p>
    <p class="job-board-candidate-overall-result"><strong><?php 
    echo $candidate['overall_result']; ?>%</strong>
      <br /><span class="job-board-candidate-status job-board-candidate-<?php echo esc_output($candidate['status']); ?>"><?php echo lang($candidate['status']); ?></span>
      <?php if (setting('enable-overall-result-edit') == 'yes') { ?>
      <i class="far fa-edit job-board-edit-overall-result edit-overall-result" data-id="<?php echo esc_output($candidate['job_application_id']); ?>" title="<?php echo lang('edit_overall_result'); ?>"></i>
      <?php } ?>
    </p>
  </div>
</div>
<?php } ?>
<?php } else { ?>
<div class="job-board-candidate-wrap">
  <p class="job-board-candidate-wrap-not"><?php echo lang('no_candidates_found'); ?></p>
</div>
<?php } ?>