<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta property="route" content="<?php echo base_url(); ?>">
        <meta property="token" content="<?php echo $this->security->get_csrf_hash(); ?>">
        <title><?php echo setting('site-name'); ?> | <?php echo $page; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Favicon -->
        <link href="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-favicon'); ?>" rel="icon">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/select2.min.css"/ />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css">
        <!-- jQuery Multiselect -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/jquery.multi-select.css" />
        <!-- jQuery UI -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/jquery-ui-timepicker-addon.css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/all.css">
        <!-- dropify for images -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dropify.min.css">
        <!-- css beautify -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/css-beautify.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/skin-black-light.css">
        <!-- Pill Rating -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bar-rating-pill.css">
        <!-- Bootstrap Toggle -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-toggle.min.css" >
        <!-- Bootstrap Select -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-select.min.css" >
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/flag-icon.min.css" >
        <!-- Candidate Finder CSS. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/dashboard-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/team-page-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/candidate-page-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/job-listing-page-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/quiz-page-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/interview-page-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/job-board-styles.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/general-styles.css">
        <?php if (adminLanguage(true) == 'rtl') { ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/cf/rtl-styles.css">
        <?php } ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-black-light sidebar-mini <?php echo $this->session->userdata('sidebar-toggle') == 'off' ? '': 'sidebar-collapse'; ?>">
        <div class="wrapper">
        <?php include(VIEW_ROOT.'/admin/layout/topbar.php'); ?>
        <?php include(VIEW_ROOT.'/admin/layout/sidebar.php'); ?>