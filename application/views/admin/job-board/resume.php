<div class="row">
<div class="col-md-12">
  <div class="box box-solid">
    <!-- /.box-header -->
    <div class="box-body">      
      <?php if ($type == 'detailed') { ?>
      <?php echo esc_output($resume, 'raw'); ?>
      <?php } else { ?>
        <a class="btn btn-warning"
            href="<?php echo candidateThumb($file); ?>" 
            title="<?php echo lang('download'); ?>">
          <i class="fa fa-file"></i> <?php echo lang('download'); ?>
        </a>
        <br />
        Note : This is static / file based resume.
      <?php } ?>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- ./col -->
</div>