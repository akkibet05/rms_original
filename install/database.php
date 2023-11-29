<?php include('header.php'); ?>
<?php redirectIfRequirementsNotFulfilled(); ?>
<section id="contain">
    <div class="login-block-lp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 login-block-in-lp">
                    <div class="login-box-lp">
                        <div class="login-box-in-lp">
                            <form id="database_form">
                                <div class="login-title-lp requirement-heading">Database Credentials</div>
                                <div class="message-container"></div>
                                <div class="requirement-label">
                                    <div class="form-group">
                                        <label for="host">Host Name</label>
                                        <input type="text" name="host" class="form-control" placeholder="e.g. localhost or 127.0.0.1" />
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Database Name</label>
                                        <input type="text" name="db_name" class="form-control" placeholder="e.g. storyspot_db" />
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Database User</label>
                                        <input type="text" name="db_user" class="form-control" placeholder="e.g. storyspot_admin" />
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Database Password</label>
                                        <input type="password" name="db_password" class="form-control" placeholder="e.g. jVbtgp9Q7R" />
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Database Type/Driver</label>
                                        <select class="form-control" name="db_type">
                                            <option value="mysql">MYSQL</option>
                                            <option value="mysqlnd">MYSQLND</option>
                                            <option value="mssql">MSSQL</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Database Prefix</label>
                                        <input type="text" name="db_prefix" class="form-control" placeholder="cf_" />
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Import Data</label>
                                        <select class="form-control" name="import_data">
                                            <option value="yes">YES</option>
                                            <option value="no">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="login-btn-lp">
                                    <button type="submit" class="btn-common" id="database_form_button">Create Database & Proceed to admin credentials</button>
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
        general.initDatabaseForm();
    });
</script>
<?php include('footer.php'); ?>
