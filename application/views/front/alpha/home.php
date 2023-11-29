  <!--==========================
    Intro Section
  ============================-->
  <?php if (setting('home-banner') == 'yes') { ?>
  <section id="intro" class="clearfix">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <?php echo setting('banner-text'); ?>

        <?php if ($job_filters) { ?>
        <div class="container">
          <div class="row">

          <?php 
            $count = count($job_filters); 
            if ($count == 1) {
              $col = '10';
            } elseif ($count == 2) {
              $col = '5';
            } else {
              $col = '4';
            }
          ?>
          <?php foreach ($job_filters as $filter) { ?>
          
          <div class="col-lg-<?php echo $col; ?>">
          <select class="form-control select2 job-listing-filters-dd-home job-filter"
              data-id="<?php echo encode($filter['job_filter_id']); ?>">
            <option value=""><?php echo esc_output(trimString($filter['title'])); ?></option>
            <?php foreach ($filter['values'] as $v) { ?>
              <option value="<?php echo encode($v['id']); ?>">
                <?php echo esc_output($v['title']); ?>
              </option>
            <?php } ?>
          </select>
          </div>
          <?php } ?>

          <div class="col-lg-2">
            <button class="btn btn-primary btn-sm btn-home-search home-search-btn">
              <i class="fa fa-search" aria-hidden="true"></i> <?php echo lang('search'); ?>
            </button>
          </div>

          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </section><!-- #intro -->
  <?php } ?>

  <main id="main">

    <?php if (setting('before-how')) { ?>
    <section id="home-custom-content">
      <div class="container">
        <div class="row row-eq-height justify-content-center content">
          <div class="col-lg-12 mb-4">
            <?php echo setting('before-how'); ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php if (setting('how-it-works') == 'yes') { ?>
    <!--==========================
      How It Works Section
    ============================-->
    <section id="how-it-works">
      <div class="container">
        <header class="section-header">
          <h3><?php echo lang('how_it_works'); ?></h3>
          <p><?php echo lang('follow_three_simple_steps'); ?></p>
        </header>
        <div class="row row-eq-height justify-content-center boxes-container">
          <div class="col-lg-4 mb-4">
            <div class="card">
                <i class="fa fa-plus"></i>
              <div class="card-body">
                <h5 class="card-title"><?php echo lang('create_account'); ?></h5>
                <p class="card-text"><?php echo lang('simply_login_with_existing'); ?>.</p>
                <a href="<?php echo base_url(); ?>login" class="readmore"><?php echo lang('more'); ?></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="card">
                <i class="fa fa-search"></i>
              <div class="card-body">
                <h5 class="card-title"><?php echo lang('find_job'); ?></h5>
                <p class="card-text"><?php echo lang('find_job_that_best_matches'); ?></p>
                <a href="<?php echo base_url(); ?>jobs" class="readmore"><?php echo lang('more'); ?></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="card">
                <i class="fa fa-check"></i>
              <div class="card-body">
                <h5 class="card-title"><?php echo lang('apply'); ?></h5>
                <p class="card-text"><?php echo lang('fulfill_the_requirements'); ?>.</p>
                <a href="<?php echo base_url(); ?>blogs" class="readmore"><?php echo lang('more'); ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php if (setting('after-how')) { ?>
    <section id="home-custom-content">
      <div class="container">
        <div class="row row-eq-height justify-content-center content">
          <div class="col-lg-12 mb-4">
            <?php echo setting('after-how'); ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>     

    <?php if (setting('department-section') == 'yes') { ?>
    <!--==========================
      Departments Section
    ============================-->
    <?php if ($departments) { ?>
    <section id="departments" class="section-bg">
      <div class="container">
        <header class="section-header">
          <h3><?php echo lang('search_jobs_by_department'); ?></h3>
          <p><?php echo lang('select_any_department_to_view'); ?>.</p>
        </header>
        <div class="row boxes-container">
          <?php foreach ($departments as $department) { ?>
          <div class="col-md-4 col-lg-4 sol-sm-12">
            <div class="box">
              <a href="<?php echo base_url(); ?>jobs?search=&departments=<?php echo encode($department['department_id']); ?>">
              <h4 class="title"><?php echo esc_output($department['title'], 'html'); ?></h4>
              </a>
              <?php if ($department['image']) { ?>
              <a href="<?php echo base_url(); ?>jobs?search=&departments=<?php echo encode($department['department_id']); ?>">
              <img class="department-image" src="<?php echo base_url().'/assets/images/departments/'.$department['image']; ?>" />
              </a>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section><!-- #departments -->
    <?php } ?>
    <?php } ?>

    <?php if (setting('before-news')) { ?>
    <section id="home-custom-content">
      <div class="container">
        <div class="row row-eq-height justify-content-center content">
          <div class="col-lg-12 mb-4">
            <?php echo setting('before-news'); ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>    

    <?php if (setting('news-section') == 'yes') { ?>
    <!--==========================
      Blogs Section
    ============================-->
    <?php if ($blogs) { ?>
    <section id="news-section">
      <div class="container">
        <header class="section-header">
          <h3><?php echo lang('news_announcements'); ?></h3>
        </header>
        <div class="row row-eq-height justify-content-center boxes-container">
          <?php foreach ($blogs as $blog) { ?>
            <div class="col-lg-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo esc_output($blog['title'], 'html'); ?></h5>
                  <p class="card-text"><?php echo trimString($blog['description'], 100); ?>.</p>
                  <a href="<?php echo base_url(); ?>blog/<?php echo encode($blog['blog_id']); ?>" class="readmore"><?php echo lang('more'); ?></a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } ?>
    <?php } ?>

    <?php if (setting('after-news')) { ?>
    <section id="home-custom-content">
      <div class="container">
        <div class="row row-eq-height justify-content-center content">
          <div class="col-lg-12 mb-4">
            <?php echo setting('after-news'); ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>    

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>
