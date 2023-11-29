  <!-- Top Modal -->
  <div class="modal fade in" id="modal-default" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header resume-modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title resume-modal-title">Refer Job</h4>
      </div>
      <div class="modal-body-container">
      </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>
  </div> 
  
  <!--==========================
    Footer
  ============================-->
  <?php $footer = footerColumns(); ?>
  <footer id="footer">
    <?php if ($footer['columns']) { ?>
    <div class="footer-top">
      <div class="container">
        <div class="row boxes-container">
          <?php foreach ($footer['columns'] as $column) { ?>
          <div class="col-md-<?php echo esc_output($footer['column_count']); ?> col-sm-12">
            <?php echo esc_output($column['content'], 'raw'); ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </footer><!-- #footer -->

  <input type="hidden" id="lang-dir" value="<?php echo candidateLanguage(true); ?>">
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries (For External components/plugins) -->
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/dropify.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/bar-rating.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/plugins/iCheck/iCheck.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/bootstrap-select.min.js"></script>

  <!-- JS Language Variables file -->
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/lang.js?ver=<?php echo strtotime(date('Y-m-d G:i:s')); ?>"></script>

  <!-- Files For Functionalities -->
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/app.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/main.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/account.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/general.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/alpha/js/dot_menu.js"></script>

  </body>
</html>