<?php if ($jobs) { ?>
<?php foreach ($jobs as $job) { ?>
<tr>
  <td>
    <a href="<?php echo base_url(); ?>admin/jobs/create-or-edit/<?php echo esc_output($job['job_id']); ?>">
      <?php echo esc_output($job['title'], 'html'); ?>
    </a>
    <a href="<?php echo base_url(); ?>admin/job-board/<?php echo esc_output($job['job_id']); ?>" target="_blank">
      <i class="fas fa-external-link-alt"></i>
    </a>
  </td>
  <td><?php echo esc_output($job['department'], 'html'); ?></td>
  <td><?php echo esc_output($job['total_count'], 'html'); ?></td>
  <td>
    <span class="label label-info" title="<?php echo esc_output($job['shortlisted_count']); ?> <?php echo lang('shortlisted'); ?>">
      <?php echo esc_output($job['shortlisted_count'], 'html'); ?>
    </span>
    &nbsp;
    <span class="label label-warning" title="<?php echo esc_output($job['interviewed_count']); ?> <?php echo lang('interviewed'); ?>">
      <?php echo esc_output($job['interviewed_count'], 'html'); ?>
    </span>
    &nbsp;
    <span class="label label-success" title="<?php echo esc_output($job['hired_count']); ?> <?php echo lang('hired'); ?>">
      <?php echo esc_output($job['hired_count'], 'html'); ?>
    </span>
    &nbsp;
    <span class="label label-danger" title="<?php echo esc_output($job['rejected_count']); ?> <?php echo lang('rejected'); ?>">
      <?php echo esc_output($job['rejected_count'], 'html'); ?>
    </span>
  </td>
</tr>
<?php } ?>
<?php } ?>