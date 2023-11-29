<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-users"></i> <?php echo lang('team'); ?><small></small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo lang('home'); ?></a></li>
      <li class="active"><i class="fa fa-users"></i> <?php echo lang('team'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-md-12">
                <div class="datatable-top-controls datatable-top-controls-filter">
                  <?php if (allowedTo('add_team_member')) { ?>
                  <button type="button" class="btn btn-primary btn-blue btn-flat create-or-edit-user">
                    <i class="fa fa-plus"></i> <?php echo lang('add_team_member'); ?>
                  </button>
                  <?php } ?>
                  <?php if (allowedTo('view_roles')) { ?>
                  <button type="button" class="btn btn-primary btn-blue btn-flat view-roles">
                    <i class="fa fa-user"></i>
                      <i class="fa fa-cog role-cog"></i> 
                      <?php echo lang('roles'); ?>
                  </button>
                  <?php } ?>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-blue btn-flat"><?php echo lang('actions'); ?></button>
                    <button type="button" class="btn btn-primary btn-blue btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#" class="bulk-action" data-action="assign-role"><?php echo lang('assign_role'); ?></a></li>
                      <li><a href="#" class="bulk-action" data-action="activate"><?php echo lang('activate'); ?></a></li>
                      <li><a href="#" class="bulk-action" data-action="deactivate"><?php echo lang('deactivate'); ?></a></li>
                    </ul>
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('filter_by_role'); ?></button>
                    </span>
                    <select class="form-control select2" id="role">
                      <option value=""><?php echo lang('all'); ?></option>
                      <?php foreach ($roles as $key => $value) { ?>
                        <option value="<?php echo esc_output($value['role_id']); ?>"><?php echo esc_output($value['title'], 'html'); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="datatable-top-controls datatable-top-controls-dd">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat"><i class="fa fa-filter"></i> <?php echo lang('filter_by_status'); ?></button>
                    </span>
                    <select class="form-control select2" id="status">
                      <option value=""><?php echo lang('all'); ?></option>
                      <option value="1"><?php echo lang('active'); ?></option>
                      <option value="0"><?php echo lang('inactive'); ?></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if (allowedTo('view_team_listing')) { ?>
            <table class="table table-bordered table-striped" id="users_datatable">
              <thead>
              <tr>
                <th><input type="checkbox" class="minimal all-check"></th>
                <th><?php echo lang('image'); ?></th>
                <th><?php echo lang('first_name'); ?></th>
                <th><?php echo lang('last_name'); ?></th>
                <th><?php echo lang('email'); ?></th>
                <th><?php echo lang('username'); ?></th>
                <th><?php echo lang('roles2'); ?></th>
                <th><?php echo lang('created_on'); ?></th>
                <th><?php echo lang('status'); ?></th>
                <th><?php echo lang('actions'); ?></th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <?php } ?>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Right Modal -->
<div class="modal right fade modal-right" id="modal-right" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Roles</h4>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<?php include(VIEW_ROOT.'/admin/layout/footer.php'); ?>

<!-- page script -->
<script src="<?php echo base_url(); ?>assets/admin/js/cf/role.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/cf/user.js"></script>

</body>
</html>

