  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php $l = base_url().'admin/'; ?>

        <li <?php selMenu($menu, 'dashboard'); ?>>
          <a href="<?php echo $l; ?>dashboard"><i class="fas fa-tachometer-alt"></i> <span><?php echo lang('dashboard'); ?></span></a>
        </li>

        <?php if (allowedTo('view_job_board')) { ?>
        <li <?php selMenu($menu, 'job_board'); ?>>
          <a href="<?php echo $l; ?>job-board"><i class="fas fa-newspaper"></i> <span><?php echo lang('job_board'); ?></span></a>
        </li>
        <?php } ?>

        <li <?php selMenu($menu, 'candidate_interviews'); ?>>
          <a href="<?php echo $l; ?>candidate-interviews"><i class="fas fa-gavel"></i> <span><?php echo lang('interviews'); ?></span></a>
        </li>

        <?php if (allowedTo(array('view_jobs', 'create_jobs', 'view_companies', 'view_departments'))) { ?>
        <li class="header"><?php echo lang('jobs_management'); ?></li>
        <li class="treeview <?php selMenu($menu, array('job', 'jobs', 'companies', 'departments', 'job_filters')); ?>">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span><?php echo lang('jobs'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('create_jobs')) { ?>
            <li <?php selMenu($menu, 'job'); ?>>
              <a href="<?php echo $l; ?>jobs/create-or-edit"><i class="fas fa-cube"></i> <?php echo lang('create'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('view_jobs')) { ?>
            <li <?php selMenu($menu, 'jobs'); ?>>
              <a href="<?php echo $l; ?>jobs"><i class="fas fa-cube"></i> <?php echo lang('listing'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('view_departments')) { ?>
            <li <?php selMenu($menu, 'departments'); ?>>
              <a href="<?php echo $l; ?>departments"><i class="fas fa-cube"></i> <?php echo lang('departments'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('view_job_filters')) { ?>
            <li <?php selMenu($menu, 'job_filters'); ?>>
              <a href="<?php echo $l; ?>job-filters"><i class="fas fa-cube"></i> <?php echo lang('job_filters'); ?></a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if (allowedTo(array('view_quizes', 'view_interviews', 'view_traits'))) { ?>
        <li class="header"><?php echo lang('scaling_tools_management'); ?></li>

        <?php if (allowedTo('view_quizes')) { ?>
        <li <?php selMenu($menu, 'quizes'); ?>>
          <a href="<?php echo $l; ?>quiz-designer"><i class="far fa-list-alt"></i> <span><?php echo lang('quiz_designer'); ?></span></a>
        </li>
        <?php } ?>

        <?php if (allowedTo('view_interviews')) { ?>
        <li <?php selMenu($menu, 'interviews'); ?>>
          <a href="<?php echo $l; ?>interview-designer"><i class="fas fa-clipboard-list"></i> <span><?php echo lang('interview_designer'); ?></span>
          </a>
        </li>
        <?php } ?>

        <?php if (allowedTo('view_traits')) { ?>
        <li <?php selMenu($menu, 'traits'); ?>>
          <a href="<?php echo $l; ?>traits"><i class="fas fa-star-half-alt"></i> <span><?php echo lang('traits'); ?></span></a>
        </li>
        <?php } ?>

        <?php if (allowedTo(array('view_question_categories', 'view_quiz_categories', 'view_interview_categories'))) { ?>
        <li class="treeview <?php selMenu($menu, array('question_categories', 'quiz_categories', 'interview_categories')); ?>">
          <a href="#">
            <i class="fa fa-list"></i> <span><?php echo lang('categories'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('view_question_categories')) { ?>
            <li <?php selMenu($menu, 'question_categories'); ?>>
              <a href="<?php echo $l; ?>question-categories"><i class="fas fa-cube"></i> <?php echo lang('question_categories'); ?></a>
            </li>
            <?php } ?>

            <?php if (allowedTo('view_quiz_categories')) { ?>
            <li <?php selMenu($menu, 'quiz_categories'); ?>>
              <a href="<?php echo $l; ?>quiz-categories"><i class="fas fa-cube"></i> <?php echo lang('quiz_categories'); ?></a>
            </li>
            <?php } ?>

            <?php if (allowedTo('view_interview_categories')) { ?>
            <li <?php selMenu($menu, 'interview_categories'); ?>>
              <a href="<?php echo $l; ?>interview-categories"><i class="fas fa-cube"></i> <?php echo lang('interview_categories'); ?></a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php } ?>

        <?php if (allowedTo(array('view_team_listing', 'view_candidate_listing'))) { ?>
        <li class="header"><?php echo lang('users_management'); ?></li>
        <?php } ?>

        <?php if (allowedTo('view_team_listing')) { ?>
        <li <?php selMenu($menu, 'team'); ?>>
          <a href="<?php echo $l; ?>users"><i class="fa fa-users"></i> <span><?php echo lang('team'); ?></span></a>
        </li>
        <?php } ?>

        <?php if (allowedTo('view_candidate_listing')) { ?>
        <li <?php selMenu($menu, 'candidates'); ?>>
          <a href="<?php echo $l; ?>candidates"><i class="fa fa-graduation-cap"></i> <span><?php echo lang('candidates'); ?></span></a>
        </li>
        <?php } ?>

        <li class="header"><?php echo lang('others'); ?></li>

        <?php if (allowedTo(array('view_blog_listing', 'view_blog_categories'))) { ?>
        <li class="treeview <?php selMenu($menu, array('blogs', 'blog_categories')); ?>">
          <a href="#">
            <i class="fas fa-blog"></i> <span><?php echo lang('blogs'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('view_blog_listing')) { ?>
            <li <?php selMenu($menu, 'blogs'); ?>>
              <a href="<?php echo $l; ?>blogs"><i class="fas fa-cube"></i> <?php echo lang('listing'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('view_blog_categories')) { ?>
            <li <?php selMenu($menu, 'blog_categories'); ?>>
              <a href="<?php echo $l; ?>blog-categories"><i class="fas fa-cube"></i> <?php echo lang('categories'); ?></a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <li class="treeview <?php selMenu($menu, array('general_settings', 'display_settings', 'api_settings', 'css_settings', 'profile', 'password', 
        'footer_sections', 'languages', 'home_page_settings', 'update_application')); ?>">
          <a href="#">
            <i class="fa fa-cogs"></i> <span><?php echo lang('settings'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if (allowedTo('general_settings')) { ?>
            <li <?php selMenu($menu, 'general_settings'); ?>>
              <a href="<?php echo $l; ?>settings/general"><i class="fas fa-cube"></i> <?php echo lang('general'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('display_settings')) { ?>
            <li <?php selMenu($menu, 'display_settings'); ?>>
              <a href="<?php echo $l; ?>settings/display"><i class="fas fa-cube"></i> <?php echo lang('display'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('home_page_settings')) { ?>
            <li <?php selMenu($menu, 'home_page_settings'); ?>>
              <a href="<?php echo $l; ?>settings/home"><i class="fas fa-cube"></i> <?php echo lang('home_page'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('footer_settings')) { ?>
            <li <?php selMenu($menu, 'footer_sections'); ?>>
              <a href="<?php echo $l; ?>footer-sections"><i class="fas fa-cube"></i> <?php echo lang('footer'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('apis_settings')) { ?>
            <li <?php selMenu($menu, 'api_settings'); ?>>
              <a href="<?php echo $l; ?>settings/apis"><i class="fas fa-cube"></i> <?php echo lang('apis'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('css_settings')) { ?>
            <li <?php selMenu($menu, 'css_settings'); ?>>
              <a href="<?php echo $l; ?>settings/css"><i class="fas fa-cube"></i> <?php echo lang('css'); ?></a>
            </li>
            <?php } ?>
            <?php if (allowedTo('languages_settings')) { ?>
            <li <?php selMenu($menu, 'languages'); ?>>
              <a href="<?php echo $l; ?>languages"><i class="fas fa-cube"></i> <?php echo lang('languages'); ?></a>
            </li>
            <?php } ?>
            <li <?php selMenu($menu, 'profile'); ?>>
              <a href="<?php echo $l; ?>profile"><i class="fas fa-cube"></i> <?php echo lang('profile'); ?></a>
            </li>
            <li <?php selMenu($menu, 'password'); ?>>
              <a href="<?php echo $l; ?>password"><i class="fas fa-cube"></i> <?php echo lang('password'); ?></a>
            </li>
            <?php if (allowedTo('update_application')) { ?>
            <li <?php selMenu($menu, 'update_application'); ?>>
              <a href="<?php echo $l; ?>settings/update-app">
                <i class="fas fa-cube"></i> <?php echo lang('update_history'); ?>
              </a>
            </li>
            <?php } ?>
          </ul>
        </li>        
        
        <li>
          <a href="<?php echo base_url(); ?>" target="_blank">
            <i class="fas fa-external-link-alt"></i> <span><?php echo lang('candidate').' '.lang('site'); ?></span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>