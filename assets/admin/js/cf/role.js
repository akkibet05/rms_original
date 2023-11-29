function Role() {

    "use strict";

    var self = this;

    this.initLoadRoles = function() {
        var modal = '#modal-right';
        $(modal).modal('show');
        $(modal+' .modal-title').html('Roles');
        application.load('admin/roles', modal+' .modal-body', function (result) {
            self.initSelectRoleForEdit();
            self.initRoleSave();
            self.initRoleDelete();
            self.initPermissionsMultiselect($('#selected_role_id').val());
            $('.roles-list .role-title:first').trigger('click');
        });
    };

    this.initViewRoles = function () {
        $('.view-roles').off();
        $('.view-roles').on('click', function () {
            self.initLoadRoles();
        });
    };    

    this.initSelectRoleForEdit = function() {
        $('.roles-list .role-title').click(function() {
            var role_id = $(this).parent().data('role_id');
            $('.roles-list .role-title').parent().removeClass('selected');
            $(this).parent().addClass('selected');
            $('.for-edit-role').text($(this).text());
            $('#selected_role_id').val(role_id);
            application.load('admin/role-permissions/'+role_id, '.edit-permissions-container', function (res) {
                self.initPermissionsMultiselect($('#selected_role_id').val());
            });
        });
    };

    this.initRoleSave = function () {
        application.onSubmit('#admin_role_create_form', function (result) {
            application.showLoader('admin_role_create_form_button');
            application.post('admin/roles/save', '#admin_role_create_form', function (res) {
                var result = JSON.parse(application.response);
                if (result.success === 'true') {
                    self.initLoadRoles();
                    var data = {id: result.data.id, text: result.data.title};
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#roles-dropdown').append(newOption).trigger('change');
                } else {
                    application.hideLoader('admin_role_create_form_button');
                    application.showMessages(result.messages, 'admin_role_create_form');
                }
            });
        });
    };

    this.initRoleDelete = function() {
        $('.delete-role').on('click', function(){
            var id = $(this).data('id');
            var status = confirm(lang['are_u_sure']);
            if (status === true) {
                application.load('admin/roles/delete/'+id, '', function (result) {
                    self.initLoadRoles();
                });
            }
        });
    }

    this.initPermissionsMultiselect = function(role_id) {
        $('#optgroup').multiSelect({ 
            selectableOptgroup: true,
            afterSelect: function(values){
                application.get('admin/roles/add-permission/'+role_id+'/'+values, '', function (res) {});
            },
            afterDeselect: function(values){
                application.get('admin/roles/remove-permission/'+role_id+'/'+values, '', function (res) {});
            }
        });
    }
}

$(document).ready(function() {
    var role = new Role();
    role.initViewRoles();
});
