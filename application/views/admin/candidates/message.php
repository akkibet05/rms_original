<form id="admin_candidate_message_form">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <textarea class="form-control" name="msg" id="msg"></textarea>
        </div>
      </div>
    </div>          
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary btn-blue" id="admin_candidate_message_form_button">
      <?php echo lang('send'); ?>
    </button>
  </div>
</form>
