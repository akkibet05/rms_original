<?php if ($departments) { ?>
<!-- Home Departments Section Starts -->
<div class="section-icon-boxes-beta">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="section-heading-style-alpha">
					<div class="section-heading">
						<h2><?php echo lang('departments'); ?></h2>
					</div>
					<div class="section-intro-text">
						<p><?php echo lang('search_jobs_by_department'); ?></p>
					</div>
				</div>				
			</div>
		</div>
		<div class="row">
			<?php foreach ($departments as $department) { ?>
			<div class="col-lg-3 col-md-12 col-sm-12">
				<a href="<?php echo base_url(); ?>jobs?search=&departments=<?php echo encode($department['department_id']); ?>">
				<div class="section-icon-boxes-beta-item" title="<?php echo esc_output($department['title']).' '.lang('message.jobs'); ?>">
					<div class="section-icon-boxes-beta-item-heading">
						<h2><?php echo esc_output($department['title']); ?></h2>
					</div>
					<div class="section-icon-boxes-beta-item-highlight">
						<p><?php echo esc_output($department['jobs_count']); ?> <?php echo lang('jobs'); ?></p>
					</div>							
					<div class="section-icon-boxes-beta-item-icon">
						<?php $thumb = departmentThumb($department['image']); ?>
						<img src="<?php echo esc_output($thumb); ?>" />
					</div>
				</div>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- Home Departments Section Ends -->
<?php } ?>