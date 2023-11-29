          <div class="blog-listing-left">
            <div class="input-group blog-listing-blog-search">
              <input type="text" class="form-control blog-search-value" placeholder="Search Posts" 
              value="<?php echo esc_output($search); ?>">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-blue btn-flat blog-search-button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
            <hr />
            <?php if ($categories) { ?>
            <p class="blog-listing-heading">
              <span class="blog-listing-heading-text"><i class="fa fa-filter"></i> <?php echo lang('categories'); ?></span>
              <span class="blog-listing-heading-line"></span>
            </p>
            <ul class="blog-listing-filters-list">
              <?php foreach ($categories as $key => $value) { ?>
              <li><input type="checkbox" class="category-check" <?php echo jobsCheckboxSel($categoriesSel, encode($value['blog_category_id'])); ?> value="<?php echo encode($value['blog_category_id']); ?>" /> <?php echo trimString($value['title']); ?></li>
              <?php } ?>
            </ul>
            <?php } ?>
          </div>
