<script>
    $(document).ready(function() {
        getPermission();


        $('#btn-save-add').on('click', function() {
            var category = $('#permission').val();
            var slug = $('#slug').val();
            var fd = new FormData();
            fd.append('permission', category);
            fd.append('slug', slug);
            fd.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "{{ route('permission.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.message) {
                        $('#permission').val(' ');
                        $('#slug').val(' ');
                    }
                    $(document).find('#form-modal-add').find('#btn-close-add').click();
                    getPermission();
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
                            $('#permission').val(' ');
                            $('#slug').val(' ');
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
                url: "{{ url('permission') }}/"+id,
                dataType: "JSON",
                success: function (response) {
                    $('#id-permission').text(': '+response.data.id);
                    $('#permission-name').text(': '+response.data.name);
                    $('#permission-slug').text(': '+response.data.slug);
                    $('#permission-log').text(': '+response.data.updated_at);
                    $(thisIs).parents(document).find('#btn-close-show').on('click', function(){
                        id = null;
                        $('#id-permission').text(': ');
                        $('#permission-name').text(': ');
                        $('#permission-slug').text(': ');
                        $('#permission-log').text(': ');
                    });
                }
            }); 
        });

        $(document).on('click', '#update-btn', function() {
            const thisIs = $(this);
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('permission') }}/"+id,
                dataType: "JSON",
                success: function (response) {
                    $('#update_permission').val(response.data.name);
                    $('#update_slug').val(response.data.slug);
                    $(thisIs).parents(document).find('#btn-close-edit').on('click', function(){
                        id = null;
                        $('#update_permission').val(' ');
                        $('#update_slug').val(' ');
                        clearErrorMessages();
                    });
                    $(thisIs).parents(document).find('#btn-save-edit').on('click', function(){
                        var permission = $('#update_permission').val();
                        var slug = $('#update_slug').val();
                        var fd = new FormData();
                        fd.append('permission',permission);
                        fd.append('slug',slug);
                        fd.append('_token', '{{ csrf_token() }}');
                        fd.append('_method', 'PUT');
                        $.ajax({
                            type: "POST",
                            enctype:"multipart/form-data",
                            url: "{{ url('permission') }}/"+id,
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $(thisIs).parents(document).find('#form-modal-edit').find('#btn-close-edit').click();
                                clearErrorMessages();
                                getPermission();
                                if(response.code === 200){
                                    id = null;
                                }
                                $.each(response.error, function (idx, err) {
                                    toastr.error(err, 'Error!', {
                                        closeButton: true,
                                        tapToDismiss: true
                                    });
                                });
                            },
                            error:function (reject) {
                                if( reject.status === 422 ) {
                                    clearErrorMessages();
                                    var message = $.parseJSON(reject.responseText);
                                    var errors = message['errors'];
                                    $.each(errors, function (key, val) {
                                        $("#update_" + key + "_error").text(val[0]);
                                    });
                                    $('#btn-close-edit').on('click', function(){
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
                        var ids = new Array();
                        $.each($("input[name='id[]']:checked"), function() {
                            ids.push($(this).val());
                        });
                        $.ajax({
                            'url': '{{ url('permission/deletes') }}',
                            'type': 'POST',
                            'data': {
                                '_token': '{{ csrf_token() }}',
                                'id': ids
                            },
                            success: function(response) {
                                if (response.message) {
                                    ids = [];
                                    getPermission();
                                }
                                getPermission();
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

        function getPermission() {
            $.ajax({
                type: "GET",
                url: "{{ url('listPermission') }}",
                dataType: "JSON",
                success: function(response) {
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data, // Get the data object
                        columns: [
                            @can('permission_delete')
                            {
                                'data': 'id'
                            },
                            @endcan
                            @if (Gate::check('permission_update') || Gate::check('permission_read'))
                            {
                                'data': "id",
                                render: function(data, type, row, meta) {
                                    return type === 'display' ?
                                        '<div class="d-flex justify-content-center">' +
                                        '<div class="col-6 me-3">' +
                                        '<button type="button" class="btn btn-primary btn-sm" id="show-btn" data-id="'+data+'" data-bs-toggle="modal" data-bs-target="#form-modal-show">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' +
                                        '</button>' +
                                        '</div>' +
                                        '<div class="col-6">' +
                                        '<button type="button" class="btn btn-warning btn-sm" id="update-btn" id="update-btn" data-id="'+data+'" >' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>' +
                                        '</button>' +
                                        '</div>' +
                                        '</div>' :
                                        data;
                                }
                            },
                            @endif
                            {
                                'data': 'name'
                            },
                            {
                                'data': 'slug'
                            },
                        ]
                    });
                    $table.destroy()
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data, // Get the data object
                        columns: [
                            @can('permission_delete')
                            {
                                'data': 'id'
                            },
                            @endcan
                            @if (Gate::check('permission_update') || Gate::check('permission_read'))
                            {
                                'data': "id",
                                render: function(data, type, row, meta) {
                                    return type === 'display' ?
                                    '<div class="d-flex justify-content-center">' +
                                        @can('permission_read')
                                        '<div class="col-6">' +
                                        '<button type="button" class="btn btn-primary btn-sm" id="show-btn" data-id="'+data+'" data-bs-toggle="modal" data-bs-target="#form-modal-show">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' +
                                        '</button>' +
                                        '</div>' +
                                        @endcan
                                        @can('permission_update')
                                        '<div class="col-6">' +
                                        '<button type="button" class="btn btn-warning btn-sm" id="update-btn" data-id="'+data+'" data-bs-toggle="modal" data-bs-target="#form-modal-edit">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>' +
                                        '</button>' +
                                        '</div>' +
                                        @endcan
                                        '</div>' :
                                        data;
                                }
                            },
                            @endif
                            {
                                'data': 'name'
                            },
                            {
                                'data': 'slug'
                            },
                        ],
                        'columnDefs': [{
                            'targets': [1],
                            'orderable': false,
                        }, 
                        @can('permission_delete')
                        {
                            'targets': [0],
                            'orderable': false,
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return '<input type="checkbox" class="del_checkbox" name="id[]" value="' +
                                        data + '">';
                                }
                                return data;
                            },
                        }
                        @endcan
                    ]
                    });
                }
            });
        }

        function clearErrorMessages() {
            $(document).find('#form-modal-add').find('#permission_error').text("");
            $(document).find('#form-modal-add').find('#slug_error').text("");
            $(document).find('#form-modal-edit').find('#update_permission_error').text("");
            $(document).find('#form-modal-edit').find('#update_slug_error').text("");
        }

        $(document).on("click", ".del_checkbox", function() {
            var ids = new Array();
            $.each($("input[name='id[]']:checked"), function() {
                ids.push($(this).val());
            });
            if (ids.length < 1) {
                $("#del-btn").attr("disabled", true);
            } else {
                $("#del-btn").attr("disabled", false);
            }
        });


    })
</script>