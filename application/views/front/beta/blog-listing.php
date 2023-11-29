<?php include(VIEW_ROOT.'/front/beta/partials/blogs-search.php'); ?>

<div class="section-blogs-alpha">
    <div class="container">
        <?php if(count($blogs) > 0) { ?>
        <div class="row">
            <?php foreach($blogs as $blog) { ?>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="section-blogs-alpha-item">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-sm-12">
                            <div class="section-blogs-alpha-item-image">
                                <div class="section-blogs-alpha-item-date">
                                    <i class="fa-regular fa-calendar"></i> <?php echo dateFormat($blog['created_at']); ?>
                                </div>
                                <?php $thumb = blogThumb($blog['image']); ?>
                                <img src="<?php echo $thumb['image']; ?>" onerror="this.src='<?php echo $thumb['error']; ?>'" />
                            </div>
                            <div class="section-blogs-alpha-item-heading">
                                <a href="<?php echo base_url(); ?>blog/<?php echo encode($blog['blog_id']); ?>"><div class="section-blogs-alpha-item-more" title="<?php echo lang('read_more'); ?>">&#62;</div></a>
                                <a href="<?php echo base_url(); ?>blog/<?php echo encode($blog['blog_id']); ?>">
                                    <h2><?php echo $blog['title']; ?></h2>
                                </a>
                            </div>
                            <div class="section-blogs-alpha-item-content">
                                <p><?php echo trimString($blog['description'], 200); ?></p>
                            </div>
                            <div class="section-blogs-alpha-item-bottom">
                                <div class="section-blogs-alpha-item-bottom-right">
                                    <span><?php echo $blog['category']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p><?php echo lang('no_matching_records_found'); ?></p>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-pagination-alpha">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include(VIEW_ROOT.'/front/beta/layout/footer.php'); ?>