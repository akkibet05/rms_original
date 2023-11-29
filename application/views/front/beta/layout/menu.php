    <!-- Menu Section Starts -->
    <span class="screen-darken"></span>
    <div id="navbar-mobile" class="container-fluid d-lg-none fixed-top navbar-mobile">
        <div class="row">
            <div class="col-md-12 mobile-menu">
                <a href="<?php echo base_url(); ?>" class="scrollto">
                    <img src="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-logo'); ?>" class="logo-main-menu">
                </a>
                <a data-trigger="navbar-main" class="mobile-menu-trigger"><i class="fa-solid fa-bars"></i></a>
            </div>
        </div>
    </div>
    <nav id="navbar-main" class="mobile-offcanvas navbar navbar-expand-lg navbar-main">
        <div class="container">
            <div class="offcanvas-header">  
                <button class="btn-close mobile-menu-btn-close float-end"><i class="fa fa-close"></i></button>
            </div>
            <!-- me-auto : for left, ms-auto : for right, ml-auto : for middle -->
            <ul class="navbar-nav align-items-lg-center ml-auto">
                <li class="nav-item">
                    <a class="" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>assets/images/identities/<?php echo setting('site-logo'); ?>" class="logo-main-menu">
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav me-auto navbar-left">            
            </ul>
            <ul class="navbar-nav ml-auto navbar-left">
            </ul>
            <ul class="navbar-nav ms-auto navbar-right">
                <?php if (setting('enable-front-lang-select') == 'yes') { ?>
                <?php echo frontActiveLanguages(); ?>
                <?php } ?>                
                <?php if (candidateSession()) { ?>
                    <?php $img = candidateThumb3(candidateSession('image')); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link user-dropdown" href="#" data-bs-toggle="dropdown">
                            <img class="menu-avatar" src="<?php echo esc_output($img, 'raw'); ?>" alt="<?php echo lang('user'); ?>" />
                        </a>
                        <ul class="dropdown-menu shadow user-dropdown-list">
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>account/profile">
                                    <i class="fa-solid fa-user"></i> <?php echo lang('profile'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>account/password">
                                    <i class="fa-solid fa-key"></i> <?php echo lang('password'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>logout">
                                    <i class="fa-solid fa-sign-out"></i> <?php echo lang('logout'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link btn header-btn-login main-navbar-btn navbar-main-btn global-login-btn" 
                            href="<?php echo base_url(); ?>account">
                            <i class="fa fa-sign-in"></i> <?php echo lang('login'); ?>
                        </a>
                    </li>            
                <?php } ?>
                <?php if (setting('enable-front-dark-mode-button') == 'yes') { ?>
                <li class="nav-item">
                    <div class="section-dark-mode-switch">
                        <label class="switch">
                            <input type="checkbox" <?php echo $this->session->userdata('selected_color_theme') == 'night' ? 'checked="checked"' : ''; ?>>
                            <span class="section-dark-mode-switch-handle slider round" data-value="light"></span>
                        </label>
                        <div class="section-dark-mode-switch-labels"><i class="dark fa-solid fa-moon"></i></div>
                    </div>        
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <!-- Menu Section Ends -->
    <input type="hidden" id="default-color-theme" value="<?php echo setting('default-front-color-theme'); ?>">
    <input type="hidden" id="color-panel-allowed" value="<?php echo setting('display-front-color-theme-selector-panel'); ?>">
    <input type="hidden" id="main-url" value="<?php echo base_url(); ?>">

    <?php if (setting('display-front-color-theme-selector-panel') == 'yes') { ?>
    <!-- Sidepanel Section Starts -->
    <div class="section-sidepanel">
        <div class="section-sidepanel-handle"><i class="fa-solid fa-palette"></i></div>
        <div class="section-sidepanel-content">
            <p><?php echo lang('select').' '.lang('color'); ?></p>
            <div class="section-sidepanel-content-item" data-ct="blue"></div>
            <div class="section-sidepanel-content-item" data-ct="green"></div>
            <div class="section-sidepanel-content-item" data-ct="orange"></div>
            <div class="section-sidepanel-content-item" data-ct="magenta"></div>
            <div class="section-sidepanel-content-item" data-ct="brown"></div>
            <div class="section-sidepanel-content-item" data-ct="maldives"></div>
        </div>
    </div>
    <!-- Sidepanel Section Ends -->
    <?php } ?>
