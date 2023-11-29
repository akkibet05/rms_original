<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta property="route" content="<?php echo base_url(); ?>">
        <meta property="token" content="<?php echo $this->security->get_csrf_hash(); ?>">
        <title><?php echo setting('site-name'); ?> | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">
        <!-- Favicon -->
        <link href="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-favicon'); ?>" rel="icon">        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-logo'); ?>" />
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg"><?php echo lang('sign_in_to_start'); ?></p>
                <?php include('partials/messages-3.php'); ?>
                <?php echo form_open(base_url()."admin/login-post", array('method' => 'post')); ?>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                            <input name="rememberme" type="checkbox" class="minimal" /> <?php echo lang('remember_me'); ?>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('sign_in'); ?></button>
                    </div>
                    <!-- /.col -->
                </div>
                </form>
                <a href="<?php echo base_url(); ?>admin/forgot-password"><?php echo lang('i_forgot_password'); ?></a><br>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.js"></script>
        <!-- dropify -->
        <script src="<?php echo base_url(); ?>assets/admin/js/dropify.min.js"></script>
        <!-- Site -->
        <script src="<?php echo base_url(); ?>assets/admin/js/cf/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/cf/general.js"></script>
    </body>
</html>