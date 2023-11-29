<!-- Candidate Section Sidebar Starts -->
<ul>
    <li>
        <a href="<?php echo base_url(); ?>account" <?php echo acActive($page, 'resumes'); ?>>
            <i class="fa-regular fa-file"></i> &nbsp; 
            <?php if (setting('enable_multiple_resume') == 'yes') { ?>
                <?php echo lang('my_resumes'); ?>
            <?php } else { ?>
                <?php echo lang('my_resume'); ?>
            <?php } ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>account/profile" <?php echo acActive($page, 'profile'); ?>>
            <i class="fa-regular fa-user"></i> &nbsp; <?php echo lang('profile'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>account/password" <?php echo acActive($page, 'password'); ?>>
            <i class="fa fa-key"></i> &nbsp; <?php echo lang('password'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>account/quizes" <?php echo acActive($page, 'quizes'); ?>>
            <i class="fa fa-list"></i> &nbsp; <?php echo lang('quizes'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>account/job-applications" <?php echo acActive($page, 'applications'); ?>>
            <i class="fa fa-check"></i> &nbsp; <?php echo lang('job_applications'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>account/job-referred" <?php echo acActive($page, 'referred'); ?>>
            <i class="fa fa-user-plus"></i> &nbsp; <?php echo lang('referred_jobs'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>account/job-favorites" <?php echo acActive($page, 'favorites'); ?>>
            <i class="fa-regular fa-heart"></i> &nbsp; <?php echo lang('favorite_jobs'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>jobs">
            <i class="fa-icon fa fa-briefcase"></i> &nbsp; <?php echo lang('jobs'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>logout" <?php echo acActive($page, ''); ?>>
            <i class="fas fa-sign-out-alt"></i> &nbsp; <?php echo lang('logout'); ?>
        </a>
    </li>
</ul>
<!-- Candidate Section Sidebar Ends -->