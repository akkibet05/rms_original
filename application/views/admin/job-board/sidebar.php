<!-- Job Board Side Container Starts -->
<div class="col-md-3 job-board-left-container">
  <div class="job-board-left-top">

    <div class="col-xs-12 col-sm-12 col-md-12 job-board-left-top-heading">
      <h3><?php echo lang('jobs'); ?>  <Br /><span class="small"><?php echo lang('select_job_to_view_applications'); ?></span></h3>

      <div class="job-board-jobs-pagination">
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-xs btn-primary btn-blue jobs-previos-button"><</button>
        <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="jobs_pagination_container">
          <?php echo esc_output($jobs_pagination, 'html'); ?>
        </button>
        <button type="button" class="btn btn-xs btn-primary btn-blue jobs-next-button">></button>
      </div>
      <div class="btn-group pull-right job-board-jobs-perpage-btn">
        <button type="button" class="btn btn-xs btn-primary btn-blue dropdown-toggle" 
                data-toggle="dropdown" aria-expanded="false">
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="#" class="jobs-per-page" data-value="10">10 <?php echo lang('per_page'); ?></a></li>
          <li><a href="#" class="jobs-per-page" data-value="25">25 <?php echo lang('per_page'); ?></a></li>
          <li><a href="#" class="jobs-per-page" data-value="50">50 <?php echo lang('per_page'); ?></a></li>
          <li><a href="#" class="jobs-per-page" data-value="200">200 <?php echo lang('per_page'); ?></a></li>
        </ul>
      </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 job-board-left-jobs-container">
      <div class="input-group job-board-job-search">
        <input type="hidden" id="jobs_page" value="<?php echo esc_output($jobs_page); ?>">
        <input type="hidden" id="jobs_per_page" value="<?php echo esc_output($jobs_per_page); ?>">
        <input type="hidden" id="jobs_total_pages" value="<?php echo esc_output($jobs_total_pages); ?>">
        <input type="text" class="form-control" placeholder="<?php echo lang('search').' '.lang('jobs'); ?>" 
          id="jobs_search" value="<?php echo esc_output($jobs_search); ?>">
        <span class="input-group-btn">
          <button type="button" class="btn btn-primary btn-blue btn-flat jobs-search-button">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
      <div class="btn-group btn-sm pull-right job-board-job-filter" title="More Filters">
        <button type="button" class="btn btn-primary btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-filter"></i>
        </button>
        <ul class="dropdown-menu">
          <li>
            <h4 class="job-board-filters-heading"><?php echo lang('filters'); ?></h4>
            <form role="form">
              <div class="box-body">
                <div class="form-group mt5">
                  <label><?php echo lang('Company'); ?></label>
                  <select class="form-control" id="company_id">
                    <option value=""><?php echo lang('all'); ?></option>
                    <?php if ($companies) { ?>
                    <?php foreach ($companies  as $company) { ?>
                    <option value="<?php echo esc_output($company['company_id']); ?>"><?php echo esc_output($company['title'], 'html'); ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group mt5">
                  <label><?php echo lang('department'); ?></label>
                  <select class="form-control" id="department_id">
                    <option value=""><?php echo lang('all'); ?></option>
                    <?php if ($departments) { ?>
                    <?php foreach ($departments  as $department) { ?>
                    <option value="<?php echo esc_output($department['department_id']); ?>"><?php echo esc_output($department['title'], 'html'); ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group mt5">
                  <label><?php echo lang('status'); ?></label>
                  <select class="form-control" id="jobs_status">
                    <option value=""><?php echo lang('all'); ?></option>
                    <option value="1"><?php echo lang('active'); ?></option>
                    <option value="zero"><?php echo lang('inactive'); ?></option>
                  </select>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-blue btn-xs job-board-job-filter-apply-btn">
                <?php echo lang('apply'); ?>
                </button>
              </div>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="job-board-left">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12" id="jobs_list">
        <?php echo esc_output($jobs, 'raw'); ?>
      </div>
    </div>
  </div>
</div>
<!-- Job Board Side Container Ends -->
