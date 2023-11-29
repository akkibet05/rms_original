<!doctype html>
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
        <link href="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-favicon'); ?>" rel="icon">

        <!-- Fontawesome CSS File -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
        <!-- Bootstrap CSS File -->
        <link href="<?php echo base_url(); ?>assets/front/beta/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/front/beta/css/bootstrap-social.css" rel="stylesheet">
        <!-- jQuery UI -->
        <link href="<?php echo base_url(); ?>assets/front/beta/css/jquery-ui.css" rel="stylesheet">
        <!-- Flag Icons -->
        <link href="<?php echo base_url(); ?>assets/front/beta/plugins/flag-icons/flag-icon.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="<?php echo base_url(); ?>assets/front/beta/plugins/select2/css/select2.min.css" rel="stylesheet">
        <!-- Owl Carousel -->
        <link href="<?php echo base_url(); ?>assets/front/beta/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/front/beta/plugins/owl-carousel/owl.theme.default.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/front/beta/plugins/owl-carousel/owl.theme.green.min.css" rel="stylesheet">
        <!-- Dropify -->
        <link href="<?php echo base_url(); ?>assets/front/beta/plugins/dropify/css/dropify.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/front/beta/css/variables.css?ver=<?php echo curRand(); ?>" rel="stylesheet">
        <!-- System CSS -->
        <link href="<?php echo base_url(); ?>assets/front/beta/css/ct-<?php echo selectedColor(); ?>.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/front/beta/css/style.css" rel="stylesheet">
        <?php if (candidateLanguage(true) == 'rtl') { ?>
        <link href="<?php echo base_url(); ?>assets/front/beta/css/style-rtl.css" rel="stylesheet">
        <?php } ?>
        <link href="<?php echo base_url(); ?>assets/front/beta/css/custom-style.css" rel="stylesheet">

        <?php if (isset($job_posting_schema) && setting('enable-jobs-schema') == 'yes') { ?>
        <?php echo esc_output($job_posting_schema, 'raw'); ?>
        <?php } ?>

    </head>
    <body>

        <?php include(VIEW_ROOT.'/front/beta/layout/menu.php'); ?>
