function Dashboard() {

    "use strict";

    var self = this;

    this.initiCheck = function () {
        $("input[type='checkbox'].minimal").iCheck('destroy');
        $("input[type='checkbox'].minimal, input[type='radio'].minimal").iCheck({
          checkboxClass: "icheckbox_minimal-blue",
          radioClass   : "iradio_minimal-blue"
        });
    };

    this.initPopularChartCheckboxes = function () {
        $("input.popular").on("ifChecked", function(event){
            $(this).val("on");
            self.loadPopularJobsChart();
        });
        $("input.popular").on("ifUnchecked", function(event){
            $(this).val("");
            self.loadPopularJobsChart();
        });
    };

    this.loadPopularJobsChart = function () {
        var form = "#jobs_data_form";
        $(form).find("input").remove();
        var ac = $("#applied_check").val();
        var fc = $("#favorited_check").val();
        var rc = $("#referred_check").val();
        $("<input />").attr("type", "hidden").attr("name", "applied_check").attr("value", ac).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "favorited_check").attr("value", fc).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "referred_check").attr("value", rc).appendTo(form);
        var existing = document.getElementById('jobs-chart');
        if (existing) {
            application.post("admin/dashboard/popular-jobs-data", form, function (res) {
                var result = JSON.parse(application.response);
                var donut = new Morris.Donut({
                    element  : "jobs-chart",
                    resize   : true,
                    colors   : ["#3c8dbc", "#f56954", "#00a65a", "#d2d6de", "#39CCCC", "#605ca8", "#ff851b", "#001F3F", "#D81B60", "#3c8dbc"],
                    data     : result,
                    hideHover: "auto"
                });
            });
        }
    };

    this.initTopChartCheckboxes = function () {
        $("input.top").off();
        $("input.top").on("ifChecked", function(event){
            $(this).val("on");
            self.loadTopCandidatesChart();
        });
        $("input.top").on("ifUnchecked", function(event){
            $(this).val("");
            self.loadTopCandidatesChart();
        });
        $("#job_id").off();
        $("#job_id").on("change", function(event){
            self.loadTopCandidatesChart();
        });
        $(".select2").select2({dir:$('#lang-dir').val() == 'rtl' ? 'rtl' : 'ltr'});
    };

    this.loadTopCandidatesChart = function () {
        var form = "#candidates_data_form";
        $(form).find("input").remove();
        var tc = $("#traits_check").val();
        var ic = $("#interviews_check").val();
        var qc = $("#quizes_check").val();
        var ji = $("#job_id").val();
        $("<input />").attr("type", "hidden").attr("name", "traits_check").attr("value", tc).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "interviews_check").attr("value", ic).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "quizes_check").attr("value", qc).appendTo(form);
        $("<input />").attr("type", "hidden").attr("name", "job_id").attr("value", ji).appendTo(form);
        application.post("admin/dashboard/top-candidates-data", form, function (res) {
            var result = JSON.parse(application.response);
            self.loadBarChart(result);
        });
    };

    this.loadBarChart = function (result) {
        $("#top-candidate-chart").remove();
        $('.top-candidate-chart-container').append('<canvas id="top-candidate-chart" class="top-candidate-chart"></canvas>');
        var existing = document.getElementById('top-candidate-chart');
        if (existing) {
            var ctx = document.getElementById('top-candidate-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: result.labels,
                    datasets: [{
                        label: 'Result',
                        backgroundColor: '#00C0EF',
                        borderColor: 'rgb(255, 99, 132)',
                        data: result.data
                    }]
                },
                options: {}
            });
        }
    };

    this.loadJobsList = function (ids) {
        var form = "#jobs_list_form";
        $(form).find("input").remove();
        var jp = $("#dashboard_jobs_page").val();
        $("<input />").attr("type", "hidden").attr("name", "dashboard_jobs_page").attr("value", jp).appendTo(form);
        application.post("admin/dashboard/jobs-list", form, function (res) {
            var result = JSON.parse(application.response);
            $("#dashboard_jobs_list").html(result.list);
            $("#dashboard_jobs_total_pages").val(result.total_pages);
            $("#dashboard_jobs_pagination_container").html(result.pagination);
            self.enableDisableJobsPaginationButtons(false);
        });
    };

    this.enableDisableJobsPaginationButtons = function (type) {
        $(".dashboard-jobs-next-button").attr("disabled", type);
        $(".dashboard-jobs-previos-button").attr("disabled", type);
    };

    this.initJobsNextPage = function () {
        $(".dashboard-jobs-next-button").on("click", function (e) {
            e.preventDefault();
            var currentPage = parseInt($("#dashboard_jobs_page").val());
            var totalPages = parseInt($("#dashboard_jobs_total_pages").val());
            if (currentPage < totalPages) {
                currentPage = currentPage + 1;
            } else {
                currentPage = totalPages;
            }
            $("#dashboard_jobs_page").val(currentPage);
            self.loadJobsList();
            self.enableDisableJobsPaginationButtons(true);
        });
    };

    this.initJobsPreviosPage = function () {
        $(".dashboard-jobs-previos-button").on("click", function (e) {
            e.preventDefault();
            var currentPage = parseInt($("#dashboard_jobs_page").val());
            if (currentPage > 1) {
                currentPage = currentPage - 1;
            } else {
                currentPage = 1;
            }
            $("#dashboard_jobs_page").val(currentPage);
            self.loadJobsList();
            self.enableDisableJobsPaginationButtons(true);
        });
    };

    this.loadTodosList = function (ids) {
        var form = "#todos_list_form";
        $(form).find("input").remove();
        var jp = $("#dashboard_todos_page").val();
        $("<input />").attr("type", "hidden").attr("name", "dashboard_todos_page").attr("value", jp).appendTo(form);
        application.post("admin/todos/list", form, function (res) {
            var result = JSON.parse(application.response);
            $("#dashboard_todos_list").html(result.list);
            $("#dashboard_todos_total_pages").val(result.total_pages);
            $("#dashboard_todos_pagination_container").html(result.pagination);
            self.enableDisableTodosPaginationButtons(false);
            self.initTodosiChecks();
            self.initTodoDelete();
            self.initTodoCreateOrEditForm();
            self.initiCheck();
            self.initPopularChartCheckboxes();
            self.initTopChartCheckboxes();
        });
    };

    this.enableDisableTodosPaginationButtons = function (type) {
        $(".dashboard-todos-next-button").attr("disabled", type);
        $(".dashboard-todos-previos-button").attr("disabled", type);
    };

    this.initTodosNextPage = function () {
        $(".dashboard-todos-next-button").on("click", function (e) {
            e.preventDefault();
            var currentPage = parseInt($("#dashboard_todos_page").val());
            var totalPages = parseInt($("#dashboard_todos_total_pages").val());
            if (currentPage < totalPages) {
                currentPage = currentPage + 1;
            } else {
                currentPage = totalPages;
            }
            $("#dashboard_todos_page").val(currentPage);
            self.loadTodosList();
            self.enableDisableTodosPaginationButtons(true);
            self.initTodoCreateOrEditForm();
        });
    };

    this.initTodosPreviosPage = function () {
        $(".dashboard-todos-previos-button").on("click", function (e) {
            e.preventDefault();
            var currentPage = parseInt($("#dashboard_todos_page").val());
            if (currentPage > 1) {
                currentPage = currentPage - 1;
            } else {
                currentPage = 1;
            }
            $("#dashboard_todos_page").val(currentPage);
            self.loadTodosList();
            self.enableDisableTodosPaginationButtons(true);
            self.initTodoCreateOrEditForm();
        });
    };

    this.initTodosiChecks = function () {
        $("input.todo").on("ifChecked", function(event){
            application.load("admin/todo/"+$(this).data("id")+"/"+1, "", function (result) {});
        });
        $("input.todo").on("ifUnchecked", function(event){
            application.load("admin/todo/"+$(this).data("id")+"/"+0, "", function (result) {});
        });
    };

    this.initTodoCreateOrEditForm = function () {
        $(".create-or-edit-todo").off();
        $(".create-or-edit-todo").on("click", function () {
            var modal = "#modal-default";
            var id = $(this).data("id");
            id = id ? "/"+id : "";
            var modal_title = id ? lang["edit_to_do_item"] : lang["create_to_do_item"];
            $(modal).modal("show");
            $(modal+" .modal-title").html(modal_title);
            application.load("admin/todos/create-or-edit"+id, modal+" .modal-body-container", function (result) {
                self.initTodoSave();
                self.initCKEditor();
            });
        });
    };

    this.initTodoSave = function () {
        application.onSubmit("#admin_to_do_create_update_form", function (result) {
            for (var instanceName in CKEDITOR.instances)
                CKEDITOR.instances[instanceName].updateElement();
            application.showLoader("admin_to_do_create_update_form_button");
            application.post("admin/todos/save", "#admin_to_do_create_update_form", function (res) {
                var result = JSON.parse(application.response);
                if (result.success === "true") {
                    $("#modal-default").modal("hide");
                    self.loadTodosList();
                } else {
                    application.hideLoader("admin_to_do_create_update_form_button");
                    application.showMessages(result.messages, "admin_to_do_create_update_form");
                }
            });
        });
    };

    this.initTodoDelete = function () {
        $(".delete-todo").off();
        $(".delete-todo").on("click", function () {
            var status = confirm(lang["are_u_sure"]);
            var id = $(this).data("id");
            if (status === true) {
                application.load("admin/todos/delete/"+id, "", function (result) {
                    self.loadTodosList();
                });
            }
        });
    };

    this.initCKEditor = function () {
        CKEDITOR.replace("description", {
            allowedContent : true,
            filebrowserUploadUrl: application.url+"/admin/ckeditor/images/upload?CKEditorFuncNum=1",
            filebrowserUploadMethod: "form",
            contentsLangDirection: $('#lang-dir').val() == 'rtl' ? 'rtl' : 'ltr',
        });
    };

}

$(document).ready(function() {
    var dashboard = new Dashboard();
    dashboard.initPopularChartCheckboxes();
    dashboard.loadPopularJobsChart();
    dashboard.initTopChartCheckboxes();
    dashboard.loadTopCandidatesChart();
    dashboard.loadJobsList();
    dashboard.initJobsNextPage();
    dashboard.initJobsPreviosPage();
    dashboard.loadTodosList();
    dashboard.initTodosNextPage();
    dashboard.initTodosPreviosPage();
    dashboard.initTodoCreateOrEditForm();
});
