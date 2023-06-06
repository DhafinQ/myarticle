<script>
    $(document).ready(function() {
        getCategory();


        $('#btn-save-add').on('click', function() {
            var category = $('#category').val();
            var fd = new FormData();
            fd.append('category', category);
            fd.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: "POST",
                enctype: "multipart/form-data",
                url: "{{ route('category.store') }}",
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.message) {
                        $('#category').val(' ');
                    }
                    $(document).find('#form-modal-add').find('#btn-close-add').click();
                    getCategory();
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
                            $('#category').val('');
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
                url: "{{ url('category') }}/"+id,
                dataType: "JSON",
                success: function (response) {
                    $('#id-category').text(': '+response.data.id);
                    $('#category-name').text(': '+response.data.name);
                    $('#category-log').text(': '+response.data.updated_at);
                    $(thisIs).parents(document).find('#btn-close-show').on('click', function(){
                        id = null;
                        $('#id-category').text(': ');
                        $('#category-name').text(': ');
                        $('#category-log').text(': ');
                    });
                }
            }); 
        });

        $(document).on('click', '#update-btn', function() {
            const thisIs = $(this);
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('category') }}/"+id,
                dataType: "JSON",
                success: function (response) {
                    $('#update_category').val(response.data.name);
                    $(thisIs).parents(document).find('#btn-close-edit').on('click', function(){
                        id = null;
                        $('#update_category').val(' ');
                        clearErrorMessages();
                    });
                    $(thisIs).parents(document).find('#btn-save-edit').on('click', function(){
                        var category = $('#update_category').val();
                        var fd = new FormData();
                        fd.append('category',category);
                        fd.append('_token', '{{ csrf_token() }}');
                        fd.append('_method', 'PUT');
                        $.ajax({
                            type: "POST",
                            enctype:"multipart/form-data",
                            url: "{{ url('category') }}/"+id,
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $(thisIs).parents(document).find('#form-modal-edit').find('#btn-close-edit').click();
                                clearErrorMessages();
                                getCategory();
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
                            'url': '{{ url('category/deletes') }}',
                            'type': 'POST',
                            'data': {
                                '_token': '{{ csrf_token() }}',
                                'id': ids
                            },
                            success: function(response) {
                                if (response.message) {
                                    ids = [];
                                    getCategory();
                                }
                                getCategory();
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

        function getCategory() {
            $.ajax({
                type: "GET",
                url: "{{ url('listCategory') }}",
                dataType: "JSON",
                success: function(response) {
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data, // Get the data object
                        columns: [
                            @can('category_delete')
                            {
                                'data': 'id'
                            },
                            @endcan
                            @if (Gate::check('category_update') || Gate::check('category_read'))
                            {
                                'data': "id",
                                render: function(data, type, row, meta) {
                                    return type === 'display' ?
                                            '<div class="d-flex justify-content-center">' +
                                            @can('category_read')
                                            '<div class="col-6 me-3">' +
                                            '<button type="button" class="btn btn-primary btn-sm" id="show-btn" data-id="'+data+'" data-bs-toggle="modal" data-bs-target="#form-modal-show">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' +
                                            '</button>' +
                                            '</div>' +
                                            @endcan
                                            @can('category_update')
                                            '<div class="col-6">' +
                                            '<button type="button" class="btn btn-warning btn-sm" id="update-btn" id="update-btn" data-id="'+data+'" >' +
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
                                'data': 'created_at'
                            },
                        ]
                    });
                    $table.destroy()
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data, // Get the data object
                        columns: [
                            @can('category_delete')
                            {
                                'data': 'id'
                            },
                            @endcan
                            @if (Gate::check('category_update') || Gate::check('category_read'))
                            {
                                'data': "id",
                                render: function(data, type, row, meta) {
                                    return type === 'display' ?
                                        '<div class="d-flex justify-content-center">' +
                                            @can('category_read')
                                            '<div class="col-6 me-3">' +
                                            '<button type="button" class="btn btn-primary btn-sm" id="show-btn" data-id="'+data+'" data-bs-toggle="modal" data-bs-target="#form-modal-show">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>' +
                                            '</button>' +
                                            '</div>' +
                                            @endcan
                                            @can('category_update')
                                            '<div class="col-6">' +
                                            '<button type="button" class="btn btn-warning btn-sm" id="update-btn" id="update-btn" data-id="'+data+'" data-bs-toggle="modal" data-bs-target="#form-modal-edit">' +
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
                                'data': 'created_at'
                            },
                        ],
                        'columnDefs': [
                        @can('category_delete')
                        {
                            'targets': [1],
                            'orderable': false,
                        }, 
                        @endcan
                        @if (Gate::check('category_update') || Gate::check('category_read'))
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
                        @endif
                    ]
                    });
                }
            });
        }

        function clearErrorMessages() {
            $(document).find('#form-modal-add').find('#category_error').text("");
            $(document).find('#form-modal-edit').find('#update_category_error').text("");
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