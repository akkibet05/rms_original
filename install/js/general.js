function GeneralFunctions() {

    var self = this;

    this.initDatabaseForm = function () {
        application.onSubmit('#database_form', function (result) {
            application.showLoader('database_form_button');
            application.post(application.url+'/install/database-connection.php', '#database_form', function (res) {
                var result = JSON.parse(application.response);
                $('.message-container').removeClass('error');
                $('.message-container').removeClass('success');
                $('.message-container').addClass(result.status);
                $('.message-container').html(result.message);
                application.hideLoader('database_form_button');
                if (result.status == 'success') {
                    window.location = application.url+'/install/credentials.php';
                }
            });
        });
    };

    this.initUserForm = function () {
        application.onSubmit('#user_form', function (result) {
            application.showLoader('user_form_button');
            $('.message-container').removeClass('error');
            $('.message-container').removeClass('success');
            application.post(application.url+'/install/create-user.php', '#user_form', function (res) {
                var result = application.response;
                if (result == 'success') {
                    $('.message-container').addClass('success');
                    $('.message-container').html(result);
                    window.location = $('#url').val();
                } else {
                    $('.message-container').addClass('error');
                    $('.message-container').html(result);
                }
                application.hideLoader('user_form_button');
            });
        });
    };

}
var general = new GeneralFunctions();
