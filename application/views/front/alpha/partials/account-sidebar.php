<ul>
	<li>
		<a href="<?php echo base_url(); ?>account" <?php echo acActive($page, 'resumes'); ?>>
			<?php if (setting('enable-multiple-resume') == 'yes') { ?>
			<i class="fa fa-file"></i> <?php echo lang('my_resumes'); ?>
			<?php } else { ?>
			<i class="fa fa-file"></i> <?php echo lang('my_resume'); ?>
			<?php } ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/job-applications" <?php echo acActive($page, 'applications'); ?>>
			<i class="fa fa-check"></i> <?php echo lang('job_applications'); ?>
		</a>
	</li>
	<?php if (setting('display-candidate-interviews') != 'no') { ?>
	<li>
		<a href="<?php echo base_url(); ?>account/interviews" <?php echo acActive($page, 'interviews'); ?>>
			<i class="fas fa-gavel"></i> <?php echo lang('interviews'); ?>
		</a>
	</li>
	<?php } ?>
	<li>
		<a href="<?php echo base_url(); ?>account/job-favorites" <?php echo acActive($page, 'favorites'); ?>>
			<i class="fa fa-heart"></i> <?php echo lang('favorite_jobs'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/job-referred" <?php echo acActive($page, 'referred'); ?>>
			<i class="fa fa-user-plus"></i> <?php echo lang('referred_jobs'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/quizes" <?php echo acActive($page, 'quizes'); ?>>
			<i class="fa fa-list"></i> <?php echo lang('quizes'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/profile" <?php echo acActive($page, 'profile'); ?>>
			<i class="fa fa-user"></i> <?php echo lang('profile'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>account/password" <?php echo acActive($page, 'password'); ?>>
			<i class="fa fa-key"></i> <?php echo lang('password'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>blogs">
			<i class="fas fa-blog"></i> <?php echo lang('news_announcements'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>jobs">
			<i class="fa fa-briefcase"></i> <?php echo lang('jobs'); ?>
		</a>
	</li>
	<li>
		<a href="<?php echo base_url(); ?>logout">
			<i class="fas fa-sign-out-alt"></i> <?php echo lang('logout'); ?>
		</a>
	</li>
</ul>