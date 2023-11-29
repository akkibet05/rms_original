<?php include(VIEW_ROOT.'/front/beta/partials/blogs-search.php'); ?>

<style type="text/css">
:root {
--blog-banner:url(<?php echo $image; ?>);
}   
</style>

<?php if (setting('blog-detail-image-as-full-width') == 'yes') { ?>
<div class="container-fluid section-blogs-detail-alpha-item-image-spreaded"></div>
<?php } ?>
<div class="section-blogs-detail-alpha">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-blogs-detail-alpha-item">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-sm-12">
                            <div class="section-blogs-detail-alpha-item-heading">
                                <h2><?php echo $blog['title']; ?></h2>
                            </div>
                            <?php if($image) { ?>
                            <div class="section-blogs-detail-alpha-item-image"></div>
                            <?php } ?>
                            <div class="section-blogs-detail-alpha-item-detail-info">
                                <div class="section-blogs-detail-alpha-item-date">
                                    <i class="fa fa-calendar"></i> <?php echo dateFormat($blog['created_at']); ?>
                                </div>
                                <div class="section-blogs-detail-alpha-item-detail-info-right">
                                    <?php echo lang('in'); ?> <span><?php echo $blog['category']; ?></span>
                                </div>
                            </div>

                            <div class="section-blogs-detail-alpha-item-content">
                                <?php echo esc_output($blog['description'], 'raw'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>