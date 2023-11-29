<?php if ($blogs) { ?>
<!-- Home News Section Starts -->
<div class="section-blogs-alpha">
	<div class="container">
		<div class="row section-blogs-alpha-top">
			<div class="col-md-12 col-sm-12">
				<div class="section-heading-style-gamma">
					<div class="section-heading">
						<h2><?php echo lang('news_announcements'); ?></h2>
					</div>
					<div class="section-intro-text">
						<p><?php echo lang('home_news_msg'); ?></p>
					</div>
					<div class="section-intro-button">
						<a class="btn" href="<?php echo base_url(); ?>blogs"><?php echo lang('view_all'); ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="position-relative"><div class="section-blogs-alpha-pattern pattern-triangle"></div></div>
			<?php foreach ($blogs as $blog) { ?>
			<div class="col-lg-4 col-md-12 col-sm-12">
				<div class="section-blogs-alpha-item">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
							<div class="section-blogs-alpha-item-image">
								<div class="section-blogs-alpha-item-date">
									<i class="fa fa-calendar"></i> <?php echo dateFormat($blog['created_at']); ?>
								</div>
								<?php $thumb = blogThumb($blog['image']); ?>
								<img src="<?php echo $thumb['image']; ?>" onerror="this.src='<?php echo $thumb['error']; ?>'" />
							</div>							
							<div class="section-blogs-alpha-item-heading">
								<a href="<?php echo base_url(); ?>blog/<?php echo encode($blog['blog_id']); ?>">
									<div class="section-blogs-alpha-item-more" title="<?php echo lang('read_more'); ?>">&#62;</div>
								</a>
								<a href="<?php echo base_url(); ?>blog/<?php echo encode($blog['blog_id']); ?>">
									<h2><?php echo esc_output($blog['title'], 'html'); ?></h2>
								</a>
							</div>
							<div class="section-blogs-alpha-item-content">
								<p><?php echo trimString($blog['description'], 100); ?></p>
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
	</div>
</div>
<!-- Home News Section Ends -->
<?php } ?>