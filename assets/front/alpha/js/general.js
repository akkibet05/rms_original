function General() {

    "use strict";

    var self = this;
    var job_filters = {};
    self.traits = [];

    this.initJobSearch = function () {
        $('.job-search-button').off();
        $('.job-search-button').on('click', function (event) {
            self.doJobSearch();
        });
        $('.job-search-value').on('keypress', function (event) {
            if(event.which == 13) {
                self.doJobSearch();
            }
        });
    };

    this.initSalaryFilterSearch = function () {

        var step = 10;

        $("#min_salary, #max_salary").on('change', function () {
            var min_salary = parseInt($("#min_salary").val());
            var max_salary = parseInt($("#max_salary").val());
            if (min_salary > max_salary) {
                $('#max_salary').val(min_salary);
            }
            $("#slider-range").slider({values: [min_salary, max_salary]});
        });

        $("#min_salary, #max_salary").on("paste keyup", function () {                                        
            var min_salary = parseInt($("#min_salary").val());
            var max_salary = parseInt($("#max_salary").val());
            if (min_salary == max_salary) {
                max_salary = min_salary + step;
                $("#min_salary").val(min_salary);     
                $("#max_salary").val(max_salary);
            }
            $("#slider-range").slider({values: [min_salary, max_salary]});
        });

        $(function () {
            var selected_min_salary = $('#selected_min_salary').val();
            var selected_max_salary = $('#selected_max_salary').val();
            var setting_min_salary = $('#min-salary-setting').val();
            var setting_max_salary = $('#max-salary-setting').val();
            selected_min_salary = selected_min_salary != '' ? selected_min_salary : setting_min_salary;
            selected_max_salary = selected_max_salary != '' ? selected_max_salary : setting_max_salary;
            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: parseInt(setting_min_salary),
                max: parseInt(setting_max_salary) + step,
                values: [selected_min_salary, selected_max_salary],
                step: step,
                slide: function (event, ui) {
                    if (ui.values[0] == ui.values[1]) {
                        return false;
                    }
                    $("#min_salary").val(ui.values[0]);
                    $("#max_salary").val(ui.values[1]);
                }
            });
            $("#min_salary").val($("#slider-range").slider("values", 0));
            $("#max_salary").val($("#slider-range").slider("values", 1));
        });

        $("#slider-range,#salary-range-submit").click(function () {
            self.doJobSearch();
        });

    };

    this.initCompanySearch = function () {
        $('input.company-check').on('ifChecked', function(event){
            self.doJobSearch();            
        });
        $('input.company-check').on('ifUnchecked', function(event){
            self.doJobSearch();            
        });
    };

    this.initDepartmentSearch = function () {
        $('input.department-check').on('ifChecked', function(event){
            self.doJobSearch();            
        });
        $('input.department-check').on('ifUnchecked', function(event){
            self.doJobSearch();            
        });
    };

    this.initJobFilterSearch = function () {
        var selected_job_filters = $('#job_filters_sel').val() ? JSON.parse($('#job_filters_sel').val()) : {};
        $(".job-filter").each(function(i, v) {
            var key = $(this).data("id");
            if (selected_job_filters[key] !== undefined) {
                job_filters[key] = selected_job_filters[key];
            } else {
                job_filters[key] = [];
            }
        });

        $('input.job-filter-check').on('ifChecked', function(event){
            var val = $(this).val();
            var id = $(this).data("id");
            if ($(this).is(':checked') && job_filters[id].includes(val) == false) {
                job_filters[id].push(val);
            }
            self.doJobSearch();            
        });

        $('input.job-filter-check').on('ifUnchecked', function(event){
            var val = $(this).val();
            var id = $(this).data("id");
            const index = job_filters[id].indexOf(val);
            if (index > -1) {
              job_filters[id].splice(index, 1);
            }
            self.doJobSearch();     
        });

        $('.job-filter-dd').on('change', function() {
            var val = $(this).val();
            var id = $(this).data("id");
            job_filters[id] = [];
            job_filters[id].push(val);
            self.doJobSearch();
        });

        $('.home-search-btn').on('click', function() {
            $(".job-filter").each(function(i, v) {
                var key = $(this).data("id");
                var val = $(this).val();
                if (selected_job_filters[key] !== undefined) {
                    job_filters[key] = selected_job_filters[key];
                } else {
                    job_filters[key] = [];
                }
                if (val) {
                    job_filters[key].push(val);
                }
            });
            self.doJobSearch();
        });        
    };

    this.doJobSearch = function () {
        var search = $('.job-search-value').length > 0 ? $('.job-search-value').val() : '';
        var min_salary = '';
        var max_salary = '';
        if ($("#min_salary").length > 0) {
            min_salary = '&min_salary='+parseInt($("#min_salary").val());
        }
        if ($("#max_salary").length > 0) {
            max_salary = '&max_salary='+parseInt($("#max_salary").val());
        }
        var departments = '&departments=';
        var filters = '&filters='+JSON.stringify(job_filters);
        $('.department-check').each(function (i, v) {
            if ($(this).is(':checked')) {
                departments += $(this).val()+',';
            }
        });
        window.location = application.url+'jobs?search='+search+min_salary+max_salary+departments+filters;
    }; 

    this.initBlogSearch = function () {
        $('.blog-search-button').off();
        $('.blog-search-button').on('click', function (event) {
            self.doBlogSearch();
        });
        $('.blog-search-value').on('keypress', function (event) {
            if(event.which == 13) {
                self.doBlogSearch();
            }
        });
    };

    this.initBlogCategorySearch = function () {
        $('input.category-check').on('ifChecked', function(event){
            self.doBlogSearch();            
        });
        $('input.category-check').on('ifUnchecked', function(event){
            self.doBlogSearch();            
        });
    };

    this.doBlogSearch = function () {
        var search = $('.blog-search-value').val();
        var categories = '&categories=';
        $('.category-check').each(function (i, v) {
            if ($(this).is(':checked')) {
                categories += $(this).val()+',';
            }
        });
        window.location = application.url+'blogs?search='+search+categories;
    }; 

    this.initIcheck = function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
        });
    };

    this.initMarkFavorite = function () {
        $('.mark-favorite').off();
        $('.mark-favorite').on('click', function() {
            var item = $(this);
            if (item.hasClass('favorited')) {
                application.load('unmark-favorite/'+$(this).data('id'), '', function (result) {
                    var result = JSON.parse(application.response);
                    if (result.success == 'true') {
                        item.removeClass('favorited');
                        item.attr('title', lang['mark_favorite']);
                    }
                });
            } else {
                application.load('mark-favorite/'+$(this).data('id'), '', function (result) {
                    var result = JSON.parse(application.response);
                    if (result.success == 'true') {
                        item.addClass('favorited');
                        item.attr('title', lang['unmark_favorite']);
                    } else {
                        window.location = application.url+'login';
                    }
                });
            }
        });
    };

    this.initJobRefer = function () {
      $('.refer-job').off();
      $('.refer-job').on('click', function() {
        var modal = '#modal-default';
        $(modal+' .modal-title').html(lang['refer_this_job']);
        $(modal).modal('show');
        var button = $(this);
        application.load('refer-job-view', '.modal-body-container', function (result) {
            $('#job_id').val(button.data('id'));
            self.initSaveJobRefer();
        });
      });
    };

    this.initSaveJobRefer = function () {
        application.onSubmit('#job_refer_form', function (result) {
            application.showLoader('job_refer_form_button');
            application.post('refer-job', '#job_refer_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success == 'false' ) {
                    window.location = application.url+'login';
                } else {
                    if (result.success == 'true') {
                        setTimeout(function() { 
                            $('#modal-default').modal('hide');
                        }, 2000);
                    }
                    application.hideLoader('job_refer_form_button');
                    application.showMessages(result.messages, 'job_refer_form');
                }
            });
        });
    };

    this.initJobApply = function () {
        application.onSubmit('#job_apply_form', function (result) {
            application.showLoader('job_apply_form_button');
            application.post('apply-job', '#job_apply_form', function (res) {
                var result = JSON.parse(application.response);
                application.hideLoader('job_apply_form_button');
                application.showMessages(result.messages, 'job_apply_form');
                if (result.success == 'true') {
                    setTimeout(function() { 
                        window.location = application.url+'account/job-applications';
                    }, 1000);
                }
            });
        });
    };

    this.initPillRating = function () {
        $('.pill-rating').barrating('show', {
            theme: 'bars-pill',
            initialRating: 'A',
            showValues: true,
            showSelectedRating: false,
            allowEmpty: true,
            emptyValue: '-- no rating selected --',
            onSelect: function(value, text) {
                self.traits.push($(this).data('id'))
            }
        });
    };

    this.initLanguageSelector = function () {
        $('#front-language-selector').on('change', function(e) {
            var dir = $('option:selected', this).attr("data-direction");
            dir = dir ? dir : 'ltr';
            application.load('setlanguage/'+$(this).val()+'/'+dir, '', function (result) {
                window.location.reload();
            });            
        });
    }

    this.initJobFunctions = function () {
      self.initJobSearch();
      self.initSalaryFilterSearch();
      self.initCompanySearch();
      self.initDepartmentSearch();
      self.initJobFilterSearch();
      self.initMarkFavorite();
      self.initJobRefer();
    };

    this.initBlogFunctions = function () {
      self.initBlogSearch();
      self.initBlogCategorySearch();
    };

}

$(document).ready(function() {
    var general = new General();
    general.initJobRefer();
    general.initMarkFavorite();
    general.initIcheck();
    general.initBlogFunctions();

    //Job Apply page
    general.initLanguageSelector();
    general.initJobFunctions();
    general.initPillRating();
    general.initJobApply();
});
