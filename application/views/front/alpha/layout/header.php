<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo esc_output($page); ?></title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="<?php echo esc_output(isset($meta_keywords) ? $meta_keywords : setting('site-keywords')); ?>" name="keywords">
  <meta content="<?php echo esc_output(isset($meta_description) ? $meta_description : setting('site-description')); ?>" name="description">
  <meta property="route" content="<?php echo base_url(); ?>">
  <meta property="token" content="<?php echo esc_output($this->security->get_csrf_hash()); ?>">

  <!-- Favicon -->
  <link href="<?php echo base_url(); ?>assets/front/alpha/images/<?php echo setting('site-favicon'); ?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- CSS Libraries (For External components/plugins) -->
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/font-awesome-all.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/dropify.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/jquery-ui.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/bootstrap-social.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/bar-rating-pill.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/bootstrap-select.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/flag-icon.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/plugins/iCheck/square/blue.css" rel="stylesheet">

  <!-- Internal Style files -->
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/custom-style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/candidatefinder.css" rel="stylesheet">
  <?php if (candidateLanguage(true) == 'rtl') { ?>
  <link href="<?php echo base_url(); ?>assets/front/alpha/css/rtl-styles.css" rel="stylesheet">
  <?php } ?>
</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">
      <div class="logo float-left">
        <a href="<?php echo base_url(); ?>" class="scrollto">
          <img src="<?php echo base_url(); ?>assets/front/alpha/images/<?php echo setting('site-logo'); ?>" alt="" class="img-fluid">
        </a>
      </div>
      <nav class="main-nav float-right">
        <ul>
          <?php if (setting('enable-front-lang-select') == 'yes') { ?>
          <li>
            <?php echo frontActiveLanguages(); ?>
          </li>
          <?php } ?>
          <li>
            <?php if (candidateSession()) { ?>
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle account-logged-in-btn" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, <?php echo trimString($this->session->userdata('candidate')['first_name'], 7); ?>
              </button>
              <div class="dropdown-menu" aria-labelledby="">
                <a class="dropdown-item" href="<?php echo base_url(); ?>account/profile"><i class="fa fa-user"></i> <?php echo lang('profile'); ?></a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>account">
                  <?php if (setting('enable-multiple-resume') == 'yes') { ?>
                  <i class="fa fa-file"></i> <?php echo lang('my_resumes'); ?>
                  <?php } else { ?>
                  <i class="fa fa-file"></i> <?php echo lang('my_resume'); ?>
                  <?php } ?>
                </a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>account/job-applications"><i class="fa fa-check"></i> <?php echo lang('job_applications'); ?></a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>logout"><i class="fas fa-sign-out-alt"></i> <?php echo lang('logout'); ?></a>
              </div>
            </div>
            <?php } else { ?>
            <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>account"><?php echo lang('account'); ?></a>
            <?php } ?>
          </li>
          <li>

          </li>
        </ul>
      </nav><!-- .main-nav -->
    </div>
  </header><!-- #header -->