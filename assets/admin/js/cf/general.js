function General() {

    "use strict";

    var self = this;

    this.initGeneralSave = function () {
        application.onSubmit('#admin_settings_form', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_settings_form_button');
            application.post('admin/settings/save', '#admin_settings_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('admin_settings_form_button');
                application.showMessages(result.messages, 'admin_settings_form');
            });
        });
    };

    this.initCssSave = function () {
        var element = document.getElementById("css-editor");
        if (element) {
            var editor = CodeMirror.fromTextArea(element, {
                lineNumbers: true,
                matchBrackets: true,
                lineWrapping: true,
                tabSize: 4
            });
            application.onSubmit('#admin_settings_form', function (result) {
                $('#editor-hidden').val(editor.getValue());
                application.showLoader('admin_settings_form_button');
                application.post('admin/settings/update-css', '#admin_settings_form', function (res) {
                    var result = JSON.parse(application.response);
                    application.hideLoader('admin_settings_form_button');
                    application.showMessages(result.messages, 'admin_settings_form');
                });
            });
        }
    };

    this.initiCheck = function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    };

    this.initiCheckLogin = function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    };

    this.initCKEditor = function (element) {
        element = element == '' ? 'description' : element;
        var elementExist = document.getElementById(element);
        if (elementExist) {
            CKEDITOR.replace(element, {
                allowedContent : true,
                filebrowserUploadUrl: application.url+'/admin/ckeditor/images/upload?CKEditorFuncNum=1',
                filebrowserUploadMethod: 'form',
                contentsLangDirection: $('#lang-dir').val() == 'rtl' ? 'rtl' : 'ltr',
            });
        }
    };

    this.initSettings = function () {
        self.initGeneralSave();
        self.initiCheck();
        $('.dropify').dropify();
        if ($('div.my-colorpicker2').length) {
            $('.my-colorpicker2').colorpicker();
        }
    };

    this.initSidebarToggle = function () {
        $('.sidebar-toggle').on('click', function () {
            application.load('admin/sidebar-toggle', '', function (result) {});
        });
    }

    this.initLanguageSelector = function () {
        $('#admin-language-selector').on('change', function() {
            var dir = $('option:selected', this).attr("data-direction");
            dir = dir ? dir : 'ltr';
            application.load('admin/languages/set/'+$(this).val()+'/'+dir, '', function (result) {
                window.location.reload();
            });            
        });
    }

}

$(document).ready(function() {
    var general = new General();
    general.initSidebarToggle();
    general.initLanguageSelector();
    general.initSettings();
    general.initiCheckLogin();
    general.initCssSave();
    general.initCKEditor('before-how');
    general.initCKEditor('after-how');
    general.initCKEditor('before-news');
    general.initCKEditor('after-news');
    general.initCKEditor('banner-text');

});
