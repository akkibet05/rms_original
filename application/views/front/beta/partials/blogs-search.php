<div class="section-breadcrumb-delta my-0">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1><?php echo lang('blogs'); ?></h1>
            </div>
            <div class="col-md-12">
                <ul>
                    <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
                    <li>></li>
                    <li class="active"><a href="<?php echo base_url(); ?>blogs"><?php echo lang('blogs'); ?></a></li>
                    <?php if(isset($blog)) { ?>
                    <li>></li>
                    <li class="active">
                        <a href="<?php echo base_url(); ?>blogs/<?php echo encode($blog['blog_id']) ; ?>">
                            <?php echo esc_output($blog['title']); ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="section-search-alpha">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12"></div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="section-search-alpha-container">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12 section-search-alpha-container-input">
                            <input type="hidden" id="blog-page" value="<?php echo esc_output($page); ?>">                            
                            <i class="fa-icon fa-solid fa-bullseye"></i> 
                            <input type="text" class="form-control blog-search-value" 
                                placeholder="<?php echo lang('keywords'); ?>" value="<?php echo esc_output($search); ?>">
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12 section-search-alpha-container-select">
                            <i class="fa-icon-tag fa-solid fa-tag"></i>
                            <select class="form-control select2" id="blog-category-dd">
                                <option value="" selected><?php echo lang('all'); ?></option>
                                <?php foreach($categories as $item) { ?>
                                <option value="<?php echo encode($item['blog_category_id']); ?>" class="sel-opt" <?php echo sel(encode($item['blog_category_id']), $categoriesSel) ? 'selected' : ''; ?>><?php echo esc_output($item['title']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            <button class="btn blog-search-button" type="button" id="blog-search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12"></div>
        </div>
    </div>
</div>
