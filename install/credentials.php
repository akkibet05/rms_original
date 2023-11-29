<?php include('header.php'); ?>
<?php redirectIfRequirementsNotFulfilled(); ?>
<input type="hidden" id="url" value="<?php echo base_url(true); ?>" />
<section id="contain">
    <div class="login-block-lp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 login-block-in-lp">
                    <div class="login-box-lp">
                        <div class="login-box-in-lp">
                            <form id="user_form">
                                <div class="login-title-lp requirement-heading">Admin Credentials</div>
                                <div class="message-container"></div>
                                <div class="requirement-label">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="hidden" name="username" value="<?php echo strtotime(date('Y-m-d G:i:s')); ?>" />
                                        <input type="text" name="first_name" class="form-control" placeholder="e.g. Adam" />
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="e.g. Smith" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="e.g. example@gmail.com" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="e.g. jVbtgp9Q7R" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label>
                                        <input type="password" name="retype_password" class="form-control" placeholder="e.g. jVbtgp9Q7R" />
                                    </div>
                                </div>
                                <div class="login-btn-lp">
                                    <button type="submit" class="btn-common" id="user_form_button">Create & Finish Installation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<script>
    $(document).ready(function () {
        general.initUserForm();
    });
</script>
<?php include('footer.php'); ?>
