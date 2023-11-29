        <!-- Modal Refer Job - Globally Accessible -->
        <div id="modal-beta" class="modal-beta modal fade modal-refer-job">
            <div class="modal-dialog">
                <div class="modal-content modal-body-container">
                </div>
            </div>
        </div>

        <?php $footer = footerColumns(); ?>
        <div class="section-footer-alpha">
            <?php if ($footer['columns']) { ?>
            <div class="container">
                <div class="row">
                    <?php foreach ($footer['columns'] as $column) { ?>
                    <div class="col-lg-<?php echo $footer['column_count']; ?> col-md-12 col-sm-12">
                        <div class="section-footer-alpha-col-1">
                            <?php echo esc_output($column['content'], 'raw'); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>

    </body>

    <!-- Bootstrap CSS File -->
    <script src="<?php echo base_url(); ?>assets/front/beta/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/front/beta/js/jquery-3.6.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/beta/js/jquery-ui.min.js"></script>
    <!-- cookie -->
    <script src="<?php echo base_url(); ?>assets/front/beta/js/js.cookie.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/front/beta/plugins/select2/js/select2.min.js"></script>
    <!-- Owl Carousel -->
    <script src="<?php echo base_url(); ?>assets/front/beta/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- Dropify -->
    <script src="<?php echo base_url(); ?>assets/front/beta/plugins/dropify/js/dropify.min.js"></script>
    <!-- JS Language Variables file -->
    <script src="<?php echo base_url(); ?>assets/front/alpha/js/lang.js?ver=<?php echo curRand(); ?>"></script>
    <script src="<?php echo base_url(); ?>assets/front/beta/js/app.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/beta/js/helpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/beta/js/account.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/beta/js/general.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/beta/js/menu.js"></script>

</html>