<div class="section-breadcrumb-beta my-0">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1><?php echo $breadcrumb_title; ?></h1>
            </div>
            <div class="col-md-12">
                <ul>
                    <li><a href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a></li>
                    <li>></li>
                    <li class="active"><a href="<?php echo base_url().$breadcrumb_page; ?>"><?php echo $breadcrumb_title; ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>