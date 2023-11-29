  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-clipboard-list"></i> <?php echo lang('interview_designer'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-clipboard-list"></i> <?php echo lang('interview_designer'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">

        <!-- Questions Bank / Left Starts -->
        <section class="col-lg-4">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title interview-page-question-bank-title">
                <i class="fa fa-question-circle"></i> <?php echo lang('questions_bank'); ?>
                &nbsp;
                <?php if (allowedTo('create_questions')) { ?>
                <button type="button" class="btn btn-xs btn-primary btn-blue add-question-btn create-or-edit-question" 
                  title="Add Question" data-id="">
                  <i class="fa fa-plus"></i>
                </button>
                <?php } ?>
              </h3>
              <div class="btn-group pull-right interview-page-question-bank-pagination">
                <button type="button" class="btn btn-xs btn-primary btn-blue previos-button"><</button>
                <button type="button" class="btn btn-xs btn-primary btn-blue disabled" id="pagination-container">
                <?php echo esc_output($pagination, 'html'); ?>
                </button>
                <button type="button" class="btn btn-xs btn-primary btn-blue next-button">></button>
              </div>
              <div class="btn-group pull-right interview-page-question-bank-perpage-btn">
                <button type="button" class="btn btn-xs btn-primary btn-blue dropdown-toggle" 
                        data-toggle="dropdown" aria-expanded="false">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#" class="per_page" data-value="10">10 <?php echo lang('per_page'); ?></a></li>
                  <li><a href="#" class="per_page" data-value="25">25 <?php echo lang('per_page'); ?></a></li>
                  <li><a href="#" class="per_page" data-value="50">50 <?php echo lang('per_page'); ?></a></li>
                  <li><a href="#" class="per_page" data-value="200">200 <?php echo lang('per_page'); ?></a></li>
                </ul>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="input-group question-bank-question-search">
                    <input type="hidden" id="questions_page" value="<?php echo esc_output($questions_page); ?>">
                    <input type="hidden" id="questions_per_page"  value="<?php echo esc_output($questions_per_page); ?>">
                    <input type="hidden" id="total_pages"  value="<?php echo esc_output($total_pages); ?>">
                    <input type="text" class="form-control" placeholder="<?php echo lang('search_questions'); ?>" id="questions_search" 
                    value="<?php echo esc_output($questions_search); ?>">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary btn-blue btn-flat questions-search-button">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div>
                  <div class="btn-group btn-sm pull-right question-bank-question-filter" title="More Filters">
                    <button type="button" class="btn btn-primary btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-filter"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <h4 class="question-bank-filters-heading"><?php echo lang('filters'); ?></h4>
                        <form role="form">
                          <div class="box-body">
                            <div class="form-group">
                              <label><?php echo lang('category'); ?></label>
                              <select class="form-control" id="questions_category_id">
                                <option value=""><?php echo lang('all'); ?></option>
                                <?php if ($question_categories) { ?>
                                <?php foreach ($question_categories as $category) { ?>
                                <option value="<?php echo esc_output($category['question_category_id']); ?>" <?php sel($questions_category_id, $category['question_category_id']); ?>>
                                  <?php echo esc_output($category['title'], 'html'); ?>
                                </option>
                                <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-blue btn-xs question-bank-question-filter-apply-btn">
                              <?php echo lang('apply'); ?>
                            </button>
                          </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if (allowedTo('view_questions')) { ?>
              <ul class="interview-list" id="questions-bank">
                <?php echo esc_output($questions, 'raw'); ?>
              </ul>
              <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- Questions Bank / Left Ends -->

        <!-- Interviews / Right Starts -->
        <section class="col-lg-8">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title interview-page-interviews-title">
                <i class="fas fa-clipboard-list"></i> <?php echo lang('interviews'); ?>
                &nbsp;
                <?php if (allowedTo('add_interviews')) { ?>
                <button type="button" class="btn btn-xs btn-primary btn-blue create-or-edit-interview" title="Add Interview" data-id="">
                  <i class="fa fa-plus"></i>
                </button>
                <?php } ?>
                <?php if (allowedTo('clone_interviews')) { ?>
                <button type="button" class="btn btn-xs btn-primary btn-blue clone-interview" title="Clone Interview">
                  <i class="fa fa-clone"></i>
                </button>
                <?php } ?>
                <?php if (allowedTo('download_interviews')) { ?>
                <button type="button" class="btn btn-xs btn-primary btn-blue download-interview" title="Download Interview AS PDF">
                  <i class="fa fa-download"></i>
                </button>
                <?php } ?>
              </h3>
              <div class="row">
                <div class="col-md-8 col-sm-12">
                  <div class="input-group interview-page-interview-select-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default disabled btn-flat"><?php echo lang('select_interview'); ?></button>
                    </span>
                    <?php if (allowedTo('view_interviews')) { ?>
                    <select class="form-control select2 interview-dropdown">
                    </select>
                    <?php } ?>
                    <?php if (allowedTo('edit_interviews')) { ?>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-interview" 
                        id="edit-interview" title="<?php echo lang('edit_selected_interview'); ?>">
                        <i class="far fa-edit"></i>
                      </button>
                    </span>
                    <?php } ?>
                    <?php if (allowedTo('delete_interviews')) { ?>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-flat delete-interview" title="<?php echo lang('delete_selected_interview'); ?>"
                        id="delete-interview">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </span>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="input-group interview-page-interview-select-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default disabled btn-flat"><?php echo lang('category'); ?></button>
                    </span>
                    <select class="form-control select2" name="interview_category_id" id="interviews_category_id">
                      <option value=""><?php echo lang('all'); ?></option>
                      <?php if ($interview_categories) { ?>
                      <?php foreach ($interview_categories as $key => $category) { ?>
                      <option value="<?php echo esc_output($category['interview_category_id']); ?>" <?php echo esc_output($key) == 0 ? 'selected="selected"' : ''; ?>>
                        <?php echo esc_output($category['title'], 'html'); ?>
                      </option>
                      <?php } ?>
                      <?php } ?>
                    </select>                    
                  </div>
                </div>                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if (allowedTo('view_interview_questions')) { ?>
              <ul class="interview-list" id="interview-questions">
              </ul>
              <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- Interviews / Right Ends -->

      </div>
      <!-- Main row Ends-->

    </section>
    <!-- Main content Ends-->

  </div>
  <!-- Content Wrapper Ends -->

  <!-- Right Modal -->
  <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
        </div>
        <div class="modal-body">
          <p>This is the content</p>
        </div>
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->

<!-- Forms for questions section / left side -->
<form id="questions_form"></form>
<input type="hidden" id="nature" value="interview" />

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page scripts -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/question.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/interview.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/interview_question.js"></script>

</body>
</html>