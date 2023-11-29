<?php
$success = isset($success) ? $success : $this->session->flashdata('success');
$info = isset($info) ? $info : $this->session->flashdata('info');
$warning = isset($warning) ? $warning : $this->session->flashdata('warning');
$error = isset($error) ? $error : $this->session->flashdata('error');
?>
<?php if ($success || $info || $warning || $error) { ?>
<div class="row errors-container">
    <div class="col-md-12">
        <?php if ($success) { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo esc_output($success, 'raw'); ?>
        </div>
        <?php } ?>
        <?php if ($info) { ?>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo esc_output($info, 'raw'); ?>
        </div>
        <?php } ?>
        <?php if ($warning) { ?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo esc_output($warning, 'raw'); ?>
        </div>
        <?php } ?>
        <?php if ($error) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo esc_output($error, 'raw'); ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
