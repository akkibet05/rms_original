<div class="section-sidebar-beta-container">
    <div class="row">
        <div class="section-sidebar-beta-item">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-sidebar-beta-item-heading">
                    <i class="fa-icon fa-solid fa-bullseye"></i> <h3><?php echo lang('keywords'); ?></h3>
                </div>
                <div class="section-sidebar-beta-item-content">
                    <input type="hidden" id="jobs-page" value="<?php echo $page; ?>">
                    <input type="text" class="job-search-value" value="<?php echo $search; ?>" />
                </div>
            </div>
        </div>
        <?php if ($departments) { ?>
        <div class="section-sidebar-beta-item">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-sidebar-beta-item-heading">
                    <i class="fa-icon fa fa-briefcase"></i> <h3><?php echo lang('departments'); ?></h3>
                </div>
                <div class="section-sidebar-beta-item-content">
                    <ul>
                        <label for="<?php echo encode(32859, false); ?>"><?php echo lang('all'); ?></label> 
                        <input 
                            class="department-check" 
                            id="<?php echo encode(32859, false); ?>" 
                            value="" 
                            type="radio" 
                            name="department" 
                            <?php departmentCheckboxSel($departmentsSel, ''); ?> 
                        />
                        <?php foreach($departments as $dept) { ?>
                        <li>
                            <label for="<?php echo encode($dept['department_id'], false); ?>"><?php echo $dept['title']; ?></label> 
                            <input 
                                class="department-check" 
                                id="<?php echo encode($dept['department_id'], false); ?>" 
                                value="<?php echo encode($dept['department_id']); ?>" 
                                type="radio" 
                                name="department" 
                                <?php departmentCheckboxSel($departmentsSel, encode($dept['department_id'])); ?> 
                            />
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($job_filters) { ?>
        <input type="hidden" id="job_filters_sel" value='<?php echo $filtersEncoded; ?>' />
        <?php foreach($job_filters as $key => $jf) { ?>
            <?php if ($jf['type'] == 'dropdown') { ?>
            <div class="section-sidebar-beta-item">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-sidebar-beta-item-heading">
                        <i class="fa-icon fa-solid fa-paperclip"></i> 
                        <h3><?php echo $jf['title']; ?></h3>
                    </div>
                    <div class="section-sidebar-beta-item-content">
                        <select class="job-filter-all job-filter-dd" data-id="<?php echo encode($jf['job_filter_id'], false); ?>">
                            <option value=""><?php echo lang('all'); ?></option>
                            <?php foreach($jf['values'] as $k => $jfv) { ?>
                            <?php 
                                $selDd = sel3($jf['job_filter_id'], $jfv['id'], $filtersSel);
                            ?>
                            <option value="<?php echo encode($jfv['id'], false); ?>" <?php echo $selDd ? 'selected' : ''; ?>>
                                <?php echo $jfv['title']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="section-sidebar-beta-item">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-sidebar-beta-item-heading">
                        <i class="fa-icon fa-solid fa-paperclip"></i> 
                        <h3><?php echo $jf['title']; ?></h3>
                    </div>
                    <div class="section-sidebar-beta-item-content">
                        <ul class="job-filter-all job-filter" data-id="<?php echo encode($jf['job_filter_id'], false); ?>">
                            <li>
                                <label for="<?php echo slugify($jf['title']).'-100'; ?>"><?php echo lang('all'); ?></label> 
                                <input 
                                    type="radio" 
                                    class="job-filter-radio" 
                                    id="<?php echo slugify($jf['title']).'-100'; ?>" 
                                    data-id="<?php echo encode($jf['job_filter_id'], false); ?>"
                                    value="" 
                                    name="<?php echo slugify($jf['title']); ?>" 
                                    <?php echo sel3($jf['job_filter_id'], '', $filtersSel); ?>
                                />
                            </li>
                            <?php foreach($jf['values'] as $k => $jfv) { ?>
                            <?php 
                                $job_filter_value_ids = isset($filtersSel[$jf['job_filter_id']]) ? $filtersSel[$jf['job_filter_id']] : array();
                                $selCb = sel3($jf['job_filter_id'], $jfv['id'], $filtersSel);
                            ?>
                            <li>
                                <label for="<?php echo slugify($jf['title']).'-'.$k; ?>"><?php echo $jfv['title']; ?></label>
                                <input 
                                    type="radio" 
                                    class="job-filter-radio" 
                                    id="<?php echo slugify($jf['title']).'-'.$k; ?>" 
                                    data-id="<?php echo encode($jf['job_filter_id'], false); ?>"
                                    name="<?php echo slugify($jf['title']); ?>" 
                                    value="<?php echo encode($jfv['id'], false); ?>" 
                                    <?php echo $selCb; ?>
                                />
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="section-sidebar-beta-item section-sidebar-beta-item-btn-container">
                <div class="section-sidebar-beta-item-button">
                    <button class="btn job-search-button"><?php echo lang('search'); ?></button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
