  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-favicon'); ?>">
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-logo'); ?>" alt="" class="img-fluid">
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <i class="fas fa-align-justify"></i>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <?php if (setting('enable-admin-lang-select') == 'yes') { ?>
          <li class="dropdown">
            <?php echo adminActiveLanguages(); ?>
          </li>
          <?php } ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo userThumb($this->session->userdata('admin')['image']); ?>" 
                  onerror='this.src="<?php echo base_url(); ?>assets/images/not-found.png"'
                  class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo esc_output($this->session->userdata('admin')['first_name'], 'html'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo userThumb($this->session->userdata('admin')['image']); ?>" 
                    onerror='this.src="<?php echo base_url(); ?>assets/images/not-found.png"'
                    class="img-circle" alt="User Image">
                <p>
                  <?php echo esc_output($this->session->userdata('admin')['first_name'].' '.$this->session->userdata('admin')['last_name'], 'html'); ?>
                  <small></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>admin/profile" class="btn btn-default btn-flat"><?php echo lang('profile'); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>admin/logout" class="btn btn-default btn-flat"><?php echo lang('logout'); ?></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
