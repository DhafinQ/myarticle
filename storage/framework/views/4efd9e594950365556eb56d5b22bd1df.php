<script>
    $(document).ready(function() {
        getUser();

        function getUser() {
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('listUser')); ?>",
                dataType: "JSON",
                success: function(response) {
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data,
                        columns: [
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?> 
                            {
                                'data': 'id'
                            },
                            <?php endif; ?>
                            <?php if(Gate::check('user_update') || Gate::check('user_read')): ?>
                            {
                                'data': "id",
                                render: function(data, type, row, meta) {
                                    return type === 'display' ?
                                        '<div class="d-flex justify-content-center">' +
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_read')): ?>
                                            '<div class="col-6 me-3">' +
                                            '<button type="button" class="btn btn-primary btn-sm" id="show-btn" data-id="' +
                                            data +
                                            '" data-bs-toggle="modal" data-bs-target="#form-modal-show">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' +
                                            '</button>' +
                                            '</div>' +
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_update')): ?>
                                            '<div class="col-6">' +
                                            '<button type="button" class="btn btn-warning btn-sm" id="update-btn" id="update-btn" data-id="' +
                                            data + '" >' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>' +
                                            '</button>' +
                                            '</div>' +
                                            <?php endif; ?>
                                        '</div>' :
                                        data;
                                }
                            },
                            <?php endif; ?>
                            {
                                'data': 'username'
                            },
                            {
                                'data': 'email'
                            },
                            {
                                'data': 'roles',
                                render: function(data, type, row, meta) {
                                    return type === 'display' ? data[Object.keys(
                                        data)[0]].name : data;
                                }
                            },
                        ]
                    });
                    $table.destroy()
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data, // Get the data object
                        columns: [
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?> 
                            {
                                'data': 'id'
                            },
                            <?php endif; ?>
                            <?php if(Gate::check('user_update') || Gate::check('user_read')): ?>
                            {
                                'data': "id",
                                render: function(data, type, row, meta) {
                                    return type === 'display' ?
                                        '<div class="d-flex justify-content-center">' +
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_read')): ?>
                                            '<div class="col-6 me-3">' +
                                            '<button type="button" class="btn btn-primary btn-sm" id="show-btn" data-id="' +
                                            data +
                                            '" data-bs-toggle="modal" data-bs-target="#form-modal-show">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' +
                                            '</button>' +
                                            '</div>' +
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_update')): ?>
                                            '<div class="col-6">' +
                                            '<button type="button" class="btn btn-warning btn-sm" id="update-btn" id="update-btn" data-id="' +
                                            data + '"  data-bs-toggle="modal" data-bs-target="#form-modal-edit">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>' +
                                            '</button>' +
                                            '</div>' +
                                            <?php endif; ?>
                                        '</div>' :
                                        data;
                                }
                            },
                            <?php endif; ?>
                            {
                                'data': 'username'
                            },
                            {
                                'data': 'email'
                            },
                            {
                                'data': 'roles',
                                render: function(data, type, row, meta) {
                                    return type === 'display' ? data[Object.keys(
                                        data)[0]].name : data;
                                }
                            },
                        ],
                        'columnDefs': [
                        <?php if(Gate::check('user_show') || Gate::check('user_update')): ?>
                            {
                                'targets': [1],
                                'orderable': false,
                            },
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?> 
                            {
                                'targets': [0],
                                'orderable': false,
                                render: function(data, type, row) {
                                    if (type === 'display') {
                                        return '<input type="checkbox" class="del_checkbox" name="del_id[]" value="' +
                                            data + '">';
                                    }
                                    return data;
                                },
                            }
                        <?php endif; ?>]
                    });
                }
            });
        }

        function clearErrorMessages() {
            $(document).find('#form-modal-add').find('#username_error').text("");
            $(document).find('#form-modal-add').find('#name_error').text("");
            $(document).find('#form-modal-add').find('#email_error').text("");
            $(document).find('#form-modal-add').find('#role_error').text("");
            $(document).find('#form-modal-add').find('#password_error').text("");
            $(document).find('#form-modal-add').find('#img_profile_error').text("");
            $(document).find('#form-modal-edit').find('#update_username_error').text("");
            $(document).find('#form-modal-edit').find('#update_name_error').text("");
            $(document).find('#form-modal-edit').find('#update_email_error').text("");
            $(document).find('#form-modal-edit').find('#update_role_error').text("");
            $(document).find('#form-modal-edit').find('#update_password_error').text("");
            $(document).find('#form-modal-edit').find('#update_img_profile_error').text("");
        }

        $('#btn-save-add').on('click', function() {
            var name = $('#name').val();
            var username = $('#username').val();
            var email = $('#email').val();
            var role = $('#role').val();
            var password = $('#password').val();
            var cpassword = $('#confirm_password').val();
            var file = $('#img_profile')[0].files[0];
            var fd = new FormData();
            fd.append('name', name);
            fd.append('username', username);
            fd.append('email', email);
            fd.append('role', role);
            fd.append('password', password);
            fd.append('password_confirmation', cpassword);
            fd.append('img_profile', file);
            fd.append('_token', '<?php echo e(csrf_token()); ?>');
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "<?php echo e(route('users.store')); ?>",
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.message) {
                        $('#name').val(' ');
                        $('#username').val(' ');
                        $('#email').val(' ');
                        $('#role').val(' ');
                        $('#password').val('');
                        $('#confirm_password').val('');
                        $('#img_profile').val(null);
                    }
                    $(document).find('#form-modal-add').find('#btn-close-add').click();
                    getUser();
                    $.each(response.error, function(idx, err) {
                        toastr.error(err, 'Error!', {
                            closeButton: true,
                            tapToDismiss: true
                        });
                    });
                },
                error: function(reject) {
                    if (reject.status === 422) {
                        clearErrorMessages();
                        var message = $.parseJSON(reject.responseText);
                        var errors = message['errors'];
                        $.each(errors, function(key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });
                        $('#btn-close-add').on('click', function() {
                            clearErrorMessages();
                            $('#name').val(' ');
                            $('#username').val(' ');
                            $('#email').val(' ');
                            $('#role').val(' ');
                            $('#password').val('');
                            $('#confirm_password').val('');
                            $('#img_profile').val(null);
                        });
                    }
                }
            });
        });

        $(document).on('click', '#show-btn', function() {
            const thisIs = $(this);
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('users')); ?>/" + id,
                dataType: "JSON",
                success: function(response) {
                    response.data.image_profile == null ? $('#profile_image').attr('src','<?php echo e(asset('images/avatars/01.png')); ?>') : $('#profile_image').attr('src','<?php echo e(asset('storage/img_profile/')); ?>/'+response.data.image_profile);
                    $('#id-user').text(': ' + response.data.id);
                    $('#user-name').text(': ' + response.data.name);
                    $('#user-username').text(': ' + response.data.username);
                    $('#user-email').text(': ' + response.data.email);
                    $('#user-role').text(': ' + response.data.roles[Object.keys(response
                        .data.roles)[0]].name);
                    $('#user-log').text(': ' + response.data.updated_at);
                    $(thisIs).parents(document).find('#btn-close-show').on('click',
                        function() {
                            id = null;
                            $('#profile_image').attr('src','#');
                            $('#id-user').text(': ');
                            $('#user-name').text(': ');
                            $('#user-username').text(': ');
                            $('#user-email').text(': ');
                            $('#user-role').text(': ');
                            $('#user-log').text(': ');
                        });
                }
            });
        });

        $(document).on('click', '#update-btn', function() {
            const thisIs = $(this);
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('users')); ?>/" + id,
                dataType: "JSON",
                success: function(response) {
                    $('#update_name').val(response.data.name);
                    $('#update_username').val(response.data.username);
                    $('#update_email').val(response.data.email);
                    $('#update_role').val(response.data.roles[Object.keys(response.data
                        .roles)[0]].name);
                    $(thisIs).parents(document).find('#btn-close-edit').on('click',
                        function() {
                            console.log("yes");
                            id = null;
                            $('#update_name').val('');
                            $('#update_username').val('');
                            $('#update_email').val('');
                            $('#update_role').val('');
                            $('#update_password').val('');
                            $('#update_confirm_password').val('');
                            $('#update_img_profile').val(null);
                            clearErrorMessages();
                        });
                    $(thisIs).parents(document).find('#btn-save-edit').on('click',
                        function() {
                            var name = $('#update_name').val();
                            var username = $('#update_username').val();
                            var email = $('#update_email').val();
                            var role = $('#update_role').val();
                            var password = $('#update_password').val();
                            var cpassword = $('#update_confirm_password').val();
                            var img = $('#update_img_profile')[0].files[0];
                            var fd = new FormData();
                            fd.append('role', role);
                            fd.append('username', username);
                            fd.append('email', email);
                            fd.append('name', name);
                            fd.append('password', password);
                            fd.append('password_confirmation', cpassword);
                            if(img != undefined){
                                fd.append('img_profile', img);
                            }
                            fd.append('_token', '<?php echo e(csrf_token()); ?>');
                            fd.append('_method', 'PUT');
                            $.ajax({
                                type: "POST",
                                enctype: "multipart/form-data",
                                url: "<?php echo e(url('users')); ?>/" + id,
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    $(thisIs).parents(document).find(
                                        '#form-modal-edit').find(
                                        '#btn-close-edit').click();
                                    clearErrorMessages();
                                    getUser();
                                    if (response.code === 200) {
                                        id = null;
                                    }
                                    $.each(response.error, function(idx,
                                        err) {
                                        toastr.error(err,
                                            'Error!', {
                                                closeButton: true,
                                                tapToDismiss: true
                                            });
                                    });
                                },
                                error: function(reject) {
                                    if (reject.status === 422) {
                                        clearErrorMessages();
                                        var message = $.parseJSON(reject
                                            .responseText);
                                        var errors = message['errors'];
                                        $.each(errors, function(key, val) {
                                            $("#update_" + key +
                                                "_error").text(
                                                val[0]);
                                        });
                                        $('#btn-close-edit').on('click',
                                            function() {
                                                clearErrorMessages();
                                            });
                                    }
                                }
                            });
                        });
                }
            });
        });

        $(document).on('click', '#del-btn', function() {
            Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#28C76F',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                        var del_ids = new Array();
                        $.each($("input[name='del_id[]']:checked"), function() {
                            del_ids.push($(this).val());
                        });
                        $.ajax({
                            'url': '<?php echo e(url('users/deletes')); ?>',
                            'type': 'POST',
                            'data': {
                                '_token': '<?php echo e(csrf_token()); ?>',
                                'id': del_ids
                            },
                            success: function(response) {
                                if (response.message) {
                                    del_ids = [];
                                    getUser();
                                }
                                getUser();
                                return toastr.error('Failed!', 'Failed!', {
                                    closeButton: true,
                                    tapToDismiss: true
                                });
                            }
                        });
                    } else {
                        console.log(`dialog was dismissed by ${result.dismiss}`)
                    }
                });
        });

        $(document).on("click", ".del_checkbox", function() {
            var ids = new Array();
            $.each($("input[name='del_id[]']:checked"), function() {
                ids.push($(this).val());
            });
            if (ids.length < 1) {
                $("#del-btn").attr("disabled", true);
            } else {
                $("#del-btn").attr("disabled", false);
            }
        });
    });
</script><?php /**PATH D:\Project\Laravel\article-website\resources\views/script/user-script.blade.php ENDPATH**/ ?>