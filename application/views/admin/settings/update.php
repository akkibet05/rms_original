  <!-- Content Wrapper Starts -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fas fa-cube"></i> <?php echo lang('update_history'); ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
        <li class="active"><i class="fas fa-cube"></i> <?php echo lang('update_history'); ?></li>
      </ol>
    </section>

    <!-- Main content Starts-->
    <section class="content">

      <!-- Main row Starts-->
      <div class="row">

        <section class="col-lg-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('update_history'); ?></h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <ul>
                  <?php foreach ($updates as $update) { ?>
                    <li>
                      <strong><?php echo lang('version'); ?></strong> : <?php echo $update['version']; ?> 
                      <?php echo $update['is_current'] == 1 ? '<label class="btn-success btn-xs">'.lang('latest').'</label>' : ''; ?><br />
                      <strong><?php echo lang('release_date'); ?></strong> : <?php echo dateLang($update['released_at']); ?><br />
                      <strong><?php echo lang('updated_on'); ?></strong> : <?php echo dateLang($update['created_at']); ?><br />
                      <strong><?php echo lang('details'); ?></strong> :
                      <?php echo $update['details']; ?>
                      <br />
                    </li>
                  <?php } ?>
                  </ul>
                </div>
              </div>
            </div>

            <?php if (allowedTo('update_application')) { ?>
            <?php } ?>
          </div>
          

        </section>

      </div>
      <!-- Main row Ends-->

    </section>
    <!-- Main content Ends-->

  </div>
  <!-- Content Wrapper Ends -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

</body>
</html>
