function Candidate() {

    "use strict";

    var self = this;

    this.initFilters = function () {
        $("#status, #account_type, #gender").off();
        $("#status, #account_type, #gender").change(function () {
            self.initCandidatesDatatable();
        });
        $("#job_title, #experience, #start_age, #end_age, #city, #state, #country, #address, #experiences, #skills, #languages, #qualifications, #achievements, #references").off();
        $("#job_title, #experience, #start_age, #end_age, #city, #state, #country, #address, #experiences, #skills, #languages, #qualifications, #achievements, #references").on('keyup', function() {
            self.initCandidatesDatatable();
        });
 
        $('.select2').select2({dir:$('#lang-dir').val() == 'rtl' ? 'rtl' : 'ltr'});
    };

    this.initCandidatesDatatable = function () {
        $('#candidates_datatable').DataTable({
            "aaSorting": [[ 8, 'desc' ]],
            "columnDefs": [{"orderable": false, "targets": [0,1,6,12]}],
            "lengthMenu": [[10, 25, 50, 100000000], [10, 25, 50, "All"]],
            "searchDelay": 2000,
            "processing": true,
            "serverSide": true,
            "language": {
                "decimal": "",
                "emptyTable": lang['no_data_available_in_table'],
                "info": lang['showing']+" _START_ "+lang['to']+" _END_ "+lang['of']+" _TOTAL_ "+lang['entries'],
                "infoEmpty": lang['showing']+" 0 "+lang['to']+" 0 of 0 "+lang['entries'],
                "infoFiltered": "("+lang['filtered_from']+" _MAX_ "+lang['total_entries']+")",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": lang['show']+" _MENU_ "+lang['entries'],
                "loadingRecords": lang['loading'],
                "processing": lang['processing'],
                "search": lang['search']+":",
                "zeroRecords": lang['no_matching_records_found'],
                "paginate": {
                    "first": lang['first'],
                    "last": lang['last'],
                    "next": lang['next'],
                    "previous": lang['previous']
                },
            },            
            "ajax": {
                "type": "POST",
                "url": application.url+'/admin/candidates/data',
                "data": function ( d ) {
                    d.status = $('#status').val();
                    d.account_type = $('#account_type').val();
                    d.job_title = $('#job_title').val();
                    d.experience = $('#experience').val();
                    d.gender = $('#gender').val();
                    d.start_age = $('#start_age').val();
                    d.end_age = $('#end_age').val();
                    d.city = $('#city').val();
                    d.state = $('#state').val();
                    d.country = $('#country').val();
                    d.address = $('#address').val();
                    d.experiences = $('#experiences').val();
                    d.skills = $('#skills').val();
                    d.languages = $('#languages').val();
                    d.qualifications = $('#qualifications').val();
                    d.achievements = $('#achievements').val();
                    d.references = $('#references').val();
                    d.csrf_token = application.csrf_token;

                },
                "complete": function (response) {
                    self.initiCheck();
                    self.initAllCheck();
                    self.initCandidateCreateOrEditForm();
                    self.initCandidateChangeStatus();
                    self.initCandidateDelete();
                    self.initLoadResume();
                    $('.table-bordered').parent().attr('style', 'overflow:auto'); //For responsive
                },
            },
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'info': true,
            'autoWidth': true,
            'destroy':true,
            'stateSave': true
        });
    };

    this.initCandidateChangeStatus = function () {
        $('.change-candidate-status').off();
        $('.change-candidate-status').on('click', function () {
            var button = $(this);
            var id = $(this).data('id');
            var status = parseInt($(this).data('status'));
            button.html("<i class='fa fa-spin fa-spinner'></i>");
            button.attr("disabled", true);
            application.load('admin/candidates/status/'+id+'/'+status, '', function (result) {
                button.removeClass('btn-success');
                button.removeClass('btn-danger');
                button.addClass(status === 1 ? 'btn-danger' : 'btn-success');
                button.html(status === 1 ? lang['inactive'] : lang['active']);
                button.data('status', status === 1 ? 0 : 1);
                button.attr("disabled", false);
                button.attr("title", status === 1 ? lang['click_to_activate'] : lang['click_to_deactivate']);
            });
        });
    };

    this.initCandidateCreateOrEditForm = function () {
        $('.create-or-edit-candidate').off();
        $('.create-or-edit-candidate').on('click', function () {
            var modal = '#modal-default';
            var id = $(this).data('id');
            id = id ? '/'+id : '';
            var modal_title = id ? lang['edit_candidate'] : lang['create_candidate'];
            $(modal).modal('show');
            $(modal+' .modal-title').html(modal_title);
            application.load('admin/candidates/create-or-edit'+id, modal+' .modal-body-container', function (result) {
                self.initCandidateSave();
                self.initDropifyAndDatepicker();
            });
        });
    };

    this.initCandidateSave = function () {
        application.onSubmit('#admin_candidate_create_update_form', function (result) {
            application.showLoader('admin_candidate_create_update_form_button');
            application.post('admin/candidates/save', '#admin_candidate_create_update_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                    self.initCandidatesDatatable();
                } else {
                    application.hideLoader('admin_candidate_create_update_form_button');
                    application.showMessages(result.messages, 'admin_candidate_create_update_form');
                }
            });
        });
    };

    this.initAllCheck = function () {
        $('input.all-check').on('ifChecked', function(event){
            $('input.single-check').iCheck('check');
        });
        $('input.all-check').on('ifUnchecked', function(event){
            $('input.single-check').iCheck('uncheck');
        });
    };

    this.initCandidateDelete = function () {
        $('.delete-candidate').off();
        $('.delete-candidate').on('click', function () {
            var status = confirm(lang['are_u_sure']);
            var id = $(this).data('id');
            if (status === true) {
                application.load('admin/candidates/delete/'+id, '', function (result) {
                    self.initCandidatesDatatable();
                });
            }
        });
    };

    this.initCandidatesListBulkActions = function () {
        $('.bulk-action').off();
        $('.bulk-action').on('click', function (e) {
            e.preventDefault();
            var ids = [];
            var action = $(this).data('action');
            $('.single-check').each(function (i, v) {
                if ($(this).is(':checked')) {
                    ids.push($(this).data('id'))
                }
            });
            if (ids.length === 0) {
                alert(lang['please_select_some_records_first']);
                $('.bulk-action').val('');
                return false;
            }
            if (action == 'download-resume') {
	        	self.downloadResume(ids);
            } else if (action == 'download-excel') {
                self.downloadCandidateExcel(ids);
            } else if (action == 'email') {
	        	self.initEmailCandidateForm(ids);
            } else {
                application.post('admin/candidates/bulk-action', {ids:ids, action: $(this).data('action')}, function (result) {
                    $('.bulk-action').val('');
                    $('.all-check').prop('checked', false);
                    self.initCandidatesDatatable();
                });
            }
        });
    };

    this.initiCheck = function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        });
    };

    this.initLoadResume = function() {
        $('.view-resume').on('click', function() {
            var modal = '#modal-right';
            $(modal).modal('show');
            $(modal+' .modal-title').html('Resume');
            var button = $(this);
            var id = button.data('id');
            application.load('admin/candidates/resume/'+id, modal+' .modal-body', function (result) {
            });
        });
    };

    this.initEmailCandidateForm = function(ids) {
        var modal = '#modal-default';
        $(modal).modal('show');
        $(modal+' .modal-title').html('Email');
        application.load('admin/candidates/message-view', modal+' .modal-body-container', function (result) {
            $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo('#admin_candidate_message_form');
            self.initCKEditor();
            self.initEmailCandidate();
        });
    };

    this.initEmailCandidate = function () {
        application.onSubmit('#admin_candidate_message_form', function (result) {
            for(var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader('admin_candidate_message_form_button');
            application.post('/admin/candidates/message', '#admin_candidate_message_form', function (res) {
                var result = JSON.parse(application.response);
                console.log(result);
                if (result.success === 'true') {
                    $('#modal-default').modal('hide');
                } else {
                    application.hideLoader('admin_candidate_message_form_button');
                    application.showMessages(result.messages, 'admin_candidate_message_form');
                }
            });
        });
    };        

    this.downloadResume = function (ids) {
        var form = "#resume-form";
        $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "csrf_token").attr("value", application.csrf_token).appendTo(form);
        $(form).submit();
    };

    this.downloadCandidateExcel = function (ids) {
        var form = "#candidates-form";
        $("<input />").attr("type", "hidden").attr("name", "ids").attr("value", ids).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "csrf_token").attr("value", application.csrf_token).appendTo(form);
        $(form).submit();
    };

    this.initCKEditor = function () {
        var elementExists = document.getElementById("msg");
        if (elementExists) {
            CKEDITOR.replace('msg', {
                allowedContent : true,
                filebrowserUploadUrl: application.url+'/admin/ckeditor/images/upload?CKEditorFuncNum=1',
                filebrowserUploadMethod: 'form',
                contentsLangDirection: $('#lang-dir').val() == 'rtl' ? 'rtl' : 'ltr',
            });
        }
    };

    this.initDropifyAndDatepicker =  function () {
      $(".datepicker").datepicker({
        changeMonth: true, 
        changeYear: true, 
        dateFormat: "yy-mm-dd",
        yearRange: "-90:+00"
      });
      $('.dropify').dropify();
    };

}

$(document).ready(function() {
    var candidate = new Candidate();
    candidate.initFilters();
    candidate.initCandidatesListBulkActions();
    candidate.initCandidatesDatatable();
});
