<div class="banner-absolute-section">
	<div class="container h-100">
		<div class="banner-absolute-section-content h-100 pop-up-small">
    		<div class="row align-items-center h-100">
    			<div class="col-md-12">
    				<div class="banner-absolute-section-top">
			    		<?php echo setting('banner-text'); ?>
		    		</div>
		    		<?php if ($job_filters) { ?>
					<?php 
					$count = count($job_filters); 
					if ($count == 1) {$col1 = '5'; $col2 = '5';} 
					elseif ($count == 2) {$col1 = '4'; $col2 = '3';}
					elseif ($count == 3) {$col1 = '4'; $col2 = '2';}
					elseif ($count == 4) {$col1 = '2'; $col2 = '2';}
					else { $col1 = '1'; $col2 = '1';}
					?>		    			
    				<div class="banner-absolute-section-bottom">
    					<div class="banner-absolute-search shadow">
    						<div class="row">
		    					<div class="col-lg-<?php echo $col1; ?> col-md-4 col-sm-12 banner-absolute-search-input">
		    						<i class="fa-icon fa-solid fa-bullseye"></i> 
		    						<input type="text" class="form-control job-search-value" placeholder="Enter Keywords ...">
		    					</div>
		    					<?php foreach ($job_filters as $filter) { ?>
		    					<div class="col-lg-<?php echo $col2; ?> col-md-3 col-sm-12 banner-absolute-search-select">
		    						<i class="fa-icon-tag fa-solid fa-tag"></i>
				                    <select class="form-control select2 job-listing-filters-dd-home job-filter" 
				                    	data-id="<?php echo encode($filter['job_filter_id']); ?>">
				                        <option value="" disabled selected><?php echo esc_output(trimString($filter['title'])); ?></option>
				                        <?php foreach ($filter['values'] as $v) { ?>
										<option value="<?php echo encode($v['id']); ?>"><?php echo esc_output($v['title']); ?></option>
										<?php } ?>
				                    </select>
		    					</div>
		    					<?php } ?>
		    					<div class="col-lg-2 col-md-12 col-sm-12">
		    						<button class="btn btn-home-search home-search-btn job-search-button">
		    							<i class="fa fa-search"></i>
		    						</button>
		    					</div>
	    					</div>
    					</div>
	            	</div>
	            	<?php } ?>
	    		</div>
    		</div>
		</div>
	</div>    	
	<div class="banner-absolute-section-bg"></div>
</div>