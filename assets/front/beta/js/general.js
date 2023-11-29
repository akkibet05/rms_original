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

    this.initJobFilterSearch = function () {
        var selected_job_filters = $('#job_filters_sel').val() ? JSON.parse($('#job_filters_sel').val()) : {};
        $(".job-filter-all").each(function(i, v) {
            var key = $(this).data("id");
            if (selected_job_filters[key] !== undefined) {
                job_filters[key] = selected_job_filters[key];
            } else {
                job_filters[key] = [];
            }
        });

        $('.job-filter-check').on('change', function(e) {
            e.preventDefault();
            var val = $(this).val();
            var id = $(this).data("id");
            if ($(this).is(':checked') && job_filters[id].includes(val) == false) {
                job_filters[id].push(val);
            } else {
                const index = job_filters[id].indexOf(val);
                job_filters[id].splice(index, 1);
            }
            self.doJobSearch();
        });

        $('.job-filter-dd, .job-filter-radio').on('change', function() {
            var val = $(this).val();
            var id = $(this).data("id");
            job_filters[id] = [];
            job_filters[id].push(val);
            //self.doJobSearch();
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
        departments = departments.substring(0,departments.length-1);
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
        var categories = '';
        $('.category-check').each(function (i, v) {
            if ($(this).is(':checked')) {
                categories += $(this).val()+',';
            }
        });
        //Adjusting for alpha and beta view
        categories = categories ? categories : ($('#blog-category-dd').val() ? $('#blog-category-dd').val() : '');
        categories = '&categories='+categories;
        window.location = application.url+'blogs?search='+search+categories;
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
                        item.removeClass('fa-solid');
                        item.addClass('fa-regular');
                        item.attr('title', lang['mark_favorite']);                        
                    }
                });
            } else {
                application.load('mark-favorite/'+$(this).data('id'), '', function (result) {
                    var result = JSON.parse(application.response);
                    if (result.success == 'true') {
                        item.addClass('favorited');
                        item.addClass('fa-solid');
                        item.removeClass('fa-regular');
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
        $('.refer-job').off();
        $('.refer-job').on('click', function() {
            var modal = '.modal-refer-job';
            $(modal).modal('show');
            var button = $(this);
            application.load('/refer-job-view', modal + ' .modal-body-container', function (result) {
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

    this.initLanguageSelector = function () {
        //For Beta view
        $('.front-language-selector').on('click', function(e) {
            e.preventDefault();
            var content = $(this).data('content')
            var dir = $(this).data('direction')
            dir = dir ? dir : 'ltr';
            application.load('setlanguage/'+content+'/'+dir, '', function (result) {
                window.location.reload();
            });
        });
        //For Alpha view
        $('#front-language-selector').on('change', function(e) {
            var dir = $('option:selected', this).attr("data-direction");
            dir = dir ? dir : 'ltr';
            application.load('setlanguage/'+$(this).val()+'/'+dir, '', function (result) {
                window.location.reload();
            });            
        });
    }

    this.initColorsSidePanel = function () {
        $('.section-sidepanel-handle').on('click', function() {
            let spWidth = $('.section-sidepanel').width() + 2;
            let spMarginLeft = parseInt($('.section-sidepanel').css('margin-left'),10);
            let w = (spMarginLeft >= 0 ) ? spWidth * - 1 : 0;
            let cw = (w < 0) ? -w : spWidth-22;
            $('.section-sidepanel').animate({marginLeft:w});
            $('.section-sidepanel-handle').animate({},  function() {});
        });

        $('.section-sidepanel-content-item').on('click', function() {
            var ct = $(this).data('ct');
            let last_ct = Cookies.get('color-theme') ? Cookies.get('color-theme') : 'ct-blue';
            let link = application.url+'assets/front/beta/css/';
            let old_link = application.url+'assets/front/beta/css/'+last_ct+'.css';
            let new_link = application.url+'assets/front/beta/css/ct-'+ct+'.css';
            $('link[href="'+old_link+'"]').attr('href',new_link);
            last_ct = 'ct-'+ct;
            Cookies.set('color-theme', 'ct-'+ct);
            $('.section-dark-mode-switch').find('input[type=checkbox]').prop('checked', false);
            application.load('setcolor/'+ct, '', function (result) {});
        });
    }

    this.initDarkModeSwitch = function () {
        $('.section-dark-mode-switch-handle').on('click', function() {
            var selected = $(this).data('value');
            let last_ct = Cookies.get('color-theme') ? Cookies.get('color-theme') : 'ct-blue';
            let link = application.url+'assets/front/beta/css/';
            let old_link = application.url+'assets/front/beta/css/'+last_ct+'.css';
            let new_link = application.url+'assets/front/beta/css/ct-night.css';
            if (selected == 'light') {
                $('link[href="'+old_link+'"]').attr('href', new_link);
                $(this).data('value', 'night');
                Cookies.set('color-theme', 'ct-night');
                $('.section-dark-mode-switch').find('input[type=checkbox]').prop('checked', false);
                application.load('setcolor/night', '', function (result) {});            
            } else {
                $('link[href="'+old_link+'"]').attr('href',link+'ct-blue.css');
                $(this).data('value', 'light');
                Cookies.set('color-theme', 'ct-blue');
                $('.section-dark-mode-switch').find('input[type=checkbox]').prop('checked', true);
                application.load('setcolor/'+$('#default-color-theme').val(), '', function (result) {});
            }
        });
        if (Cookies.get('color-theme') == 'ct-night') {
            $('.section-dark-mode-switch-handle').data('value', 'night');
            $('.section-dark-mode-switch').find('input[type=checkbox]').prop('checked', true);
        } else if (typeof Cookies.get('color-theme') !== 'undefined') {
            $('.section-dark-mode-switch-handle').data('value', 'light');
            $('.section-dark-mode-switch').find('input[type=checkbox]').prop('checked', false);
        }
    }

    this.mobileMenuLevelAdjustment = function () {
        var mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        const element = document.getElementById("navbar-mobile");
        if (element != null) {        
            if (mobile === true) {
                document.body.style.paddingTop = element.offsetHeight + 'px';
            } else {
                document.body.style.paddingTop = element.offsetHeight + 'px';
            }
        }
        $('.navbar-main li ul li.dropdown').on('click', function(e) {
            if (mobile === true) {
                e.preventDefault();
                var link = $(this).find('.dropdown-item').attr('href');
                return false;
            }
        });
        $('.navbar-main li ul li.dropdown .dropdown-item').on('click', function(e) {
            if (mobile === true) {
                e.preventDefault();
                var link = $(this).attr('href');
                window.location = link;
                return false;
            }
        });        
    }    

    this.initJobFunctions = function () {
      self.initJobSearch();
      self.initSalaryFilterSearch();
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
    general.initBlogFunctions();
    general.initColorsSidePanel();
    general.initDarkModeSwitch();
    general.mobileMenuLevelAdjustment();

    //Job Apply page
    general.initLanguageSelector();
    general.initJobFunctions();
    general.initJobApply();
});
