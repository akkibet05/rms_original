  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix front-intro-section">
    <div class="container">
      <div class="intro-img">
      </div>
      <div class="intro-info">
        <h2>
          <span>
            <a href="<?php echo base_url(); ?>blogs"><?php echo lang('blog_posts'); ?></a> 
            > <?php echo esc_output($blog['title'], 'html'); ?>
          </span>
        </h2>
      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Account Area Setion
    ============================-->
    <section id="about">
      <div class="container">

        <div class="row mt-10">
          <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="row">
              <?php if ($blog['title']) { ?>
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="blog-listing">
                  <p class="blog-listing-heading">
                    <span class="blog-listing-heading-text" title="<?php echo esc_output($blog['title']); ?>">
                      <?php echo trimString($blog['title'], 50); ?>
                    </span>
                    <span class="blog-listing-heading-line"></span>
                  </p>
                  <div class="blog-listing-blog-description">
                    <?php echo esc_output($blog['description'], 'raw'); ?>
                  </div>
                </div>
              </div>
              <?php } else { ?>
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="blog-listing">
                  <p class="blog-listing-heading">
                    <?php echo lang('no_post_found'); ?>!
                  </p>
                </div>
              </div>                
              <?php } ?>
            </div>
          </div>
          <div class="col-lg-3">
            <?php include(VIEW_ROOT.'/front/alpha/partials/blog-sidebar.php'); ?>
          </div>
        </div>

      </div>

    </section><!-- #account area section ends -->

  </main>

  <?php include(VIEW_ROOT.'/front/alpha/layout/footer.php'); ?>
