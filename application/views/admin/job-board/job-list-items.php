<?php if ($jobs) { ?>
<?php $count = 1; ?>
<?php foreach ($jobs as $job) { ?>
  <div class="job-board-job-wrap">
    <h3 class="job-board-job-title job-<?php echo esc_output($job['job_id']); ?> <?php echo esc_output($count) == 1 ? 'first-job' : ''; ?>" 
        title="Click to select" 
        data-id="<?php echo esc_output($job['job_id']); ?>"
        data-title="<?php echo esc_output($job['title']); ?>">
      <?php if ($job['hired_count']) { ?>
      <i class="fa fa-check-circle text-green" title="<?php echo esc_output($job['hired_count']).' '.lang('candidate_hired'); ?>"></i> 
      <?php } ?>
      <?php echo trimString($job['title']); ?>
    </h3>
    <span class="job-board-job-item job-board-job-item-general">
      <i class="fa fa-bookmark"></i> <?php echo trimString($job['department']); ?>
    </span>
    <span class="job-board-job-item job-board-job-item-general">
      <i class="fa fa-clock-o"></i> <?php echo lang('posted'); ?> : <?php echo dateFormat($job['created_at']); ?>
    </span>
    <span class="job-board-job-item job-board-job-item-general view-job-detail" 
        data-id="<?php echo esc_output($job['job_id']); ?>"
        data-title="<?php echo esc_output($job['title']); ?>">
      <i class="fa fa-eye"></i> <?php echo lang('view'); ?>
    </span>
    <span class="job-board-job-item-separator-line" ></span>
    <span class="job-board-job-item job-board-job-item-yellow">
      <i class="fa fa-list"></i> <?php echo esc_output($job['quizes_count']); ?> <?php echo lang('quizes'); ?>
    </span>
    <span class="job-board-job-item job-board-job-item-yellow">
      <i class="fa fa-star-half-o"></i> <?php echo esc_output($job['traits_count']); ?> <?php echo lang('traits'); ?>
    </span>
  </div>
<?php $count++; ?>
<?php } ?>
<?php } else { ?>
	<p><?php echo lang('no_jobs_found'); ?></p>
<?php } ?>
