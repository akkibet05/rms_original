function FooterSection() {

    "use strict";

    var self = this;

    this.initFooterSectionSave = function () {
        application.onSubmit('#admin_footer_section_update_form', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_footer_section_update_form_button');
            application.post('admin/footer-sections/save', '#admin_footer_section_update_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('admin_footer_section_update_form_button');
                application.showMessages(result.messages, 'admin_footer_section_update_form');
            });
        });
    };

    this.initCKEditor = function (id) {
        CKEDITOR.replace(id, {
            allowedContent : true,
            filebrowserUploadUrl: application.url+'/admin/ckeditor/images/upload?CKEditorFuncNum=1',
            filebrowserUploadMethod: 'form',
            contentsLangDirection: $('#lang-dir').val() == 'rtl' ? 'rtl' : 'ltr',
        });
    };
}

$(document).ready(function() {
    var footer_section = new FooterSection();
    footer_section.initFooterSectionSave();
    footer_section.initCKEditor('column1');
    footer_section.initCKEditor('column2');
    footer_section.initCKEditor('column3');
    footer_section.initCKEditor('column4');
});
