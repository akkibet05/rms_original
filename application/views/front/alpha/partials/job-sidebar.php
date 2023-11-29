 <div class="job-listing-left">
  <div class="input-group job-listing-job-search">
    <input type="text" class="form-control job-search-value" placeholder="<?php echo lang('search'); ?>" 
    value="<?php echo esc_output($search); ?>">
    <span class="input-group-btn">
      <button type="button" class="btn btn-primary btn-blue btn-flat job-search-button">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </div>

  <?php if (setting('enable-front-salary-filter') == 'yes') { ?>
  <p class="job-listing-heading">
    <span class="job-listing-heading-text">
      <i class="fa fa-filter"></i> <?php echo lang('salary').' ('.setting('salary-currency').')'; ?>
    </span>
    <span class="job-listing-heading-line"></span>
  </p>
  <div class="input-group job-listing-salary-filter">
    <div class="salary-range-block">
      <input type="hidden" id="min-salary-setting" value="<?php echo setting('front-salary-filter-min-value'); ?>">
      <input type="hidden" id="max-salary-setting" value="<?php echo setting('front-salary-filter-max-value'); ?>">
      <input type="hidden" id="selected_min_salary" value="<?php echo esc_output($min_salary); ?>" />
      <input type="hidden" id="selected_max_salary" value="<?php echo esc_output($max_salary); ?>" />
      <div id="slider-range" class="salary-filter-range" name="rangeInput"></div>
      <div style="">
        <input type="number" id="min_salary" class="salary-range-field" />
        <input type="number" id="max_salary" class="salary-range-field" />
      </div>
      <div id="searchResults" class="search-results-block"></div>
    </div>
  </div>
  <?php } ?>

  <?php if ($departments) { ?>
  <hr />
  <p class="job-listing-heading">
    <span class="job-listing-heading-text"><i class="fa fa-filter"></i> <?php echo lang('departments'); ?></span>
    <span class="job-listing-heading-line"></span>
  </p>
  <ul class="job-listing-filters-list">
    <?php foreach ($departments as $key => $value) { ?>
      <li>
        <input type="checkbox" class="department-check" <?php echo jobsCheckboxSel($departmentsSel, encode($value['department_id'])); ?> value="<?php echo encode($value['department_id']); ?>" />
          <?php echo trimString($value['title']); ?>
      </li>
    <?php } ?>
  </ul>
  <?php } ?>


  <?php if ($job_filters) { ?>
  <input type="hidden" id="job_filters_sel" value='<?php echo $filtersEncoded; ?>' />
  <?php foreach ($job_filters as $filter) { ?>
  <?php if ($filter['type'] == 'checkbox') { ?>

  <hr />
  <p class="job-listing-heading">
    <span class="job-listing-heading-text">
      <i class="fa fa-filter"></i> <?php echo esc_output(trimString($filter['title'])); ?>
    </span>
    <span class="job-listing-heading-line"></span>
  </p>
  <ul class="job-listing-filters-list job-filter" data-id="<?php echo encode($filter['job_filter_id']); ?>">
    <?php foreach ($filter['values'] as $v) { ?>
      <li>
        <?php 
          $job_filter_value_ids = isset($filtersSel[$filter['job_filter_id']]) ? $filtersSel[$filter['job_filter_id']] : array(); 
        ?>
        <?php $selCb = sel3($filter['job_filter_id'], $v['id'], $filtersSel); ?>
        <input type="checkbox" 
          class="job-filter-check" <?php echo esc_output($selCb); ?>
          data-id="<?php echo encode($filter['job_filter_id']); ?>"
          value="<?php echo encode($v['id']); ?>" /> 
        <?php echo trimString($v['title']); ?>
      </li>
    <?php } ?>
  </ul>

  <?php } else { ?>
  <hr />
  <p class="job-listing-heading">
    <span class="job-listing-heading-text">
      <i class="fa fa-filter"></i> <?php echo esc_output(trimString($filter['title'])); ?>
    </span>
    <span class="job-listing-heading-line"></span>
  </p>
  <select class="form-control select2 job-listing-filters-dd job-filter-dd job-filter"
      data-id="<?php echo encode($filter['job_filter_id']); ?>">
    <option value=""><?php echo lang('none'); ?></option>
    <?php foreach ($filter['values'] as $v) { ?>
      <?php $selDd = sel3($filter['job_filter_id'], $v['id'], $filtersSel); ?>
      <option value="<?php echo encode($v['id']); ?>" <?php echo $selDd ? 'selected' : ''; ?>>
        <?php echo esc_output($v['title']); ?>
      </option>
    <?php } ?>
  </select>

  <?php } ?>
  <?php } ?>
  <?php } ?>

</div>
<br /><br /><br />
