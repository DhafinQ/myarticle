<script>
    $(document).ready(function () {
        getArticle();

        $(document).on('click', '#del-btn', function () {
            var id = $(this).data('id');
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
                        'url': '<?php echo e(url('article/deletes')); ?>',
                        'type': 'POST',
                        'data': {
                            '_token': '<?php echo e(csrf_token()); ?>',
                            'id' : ids
                        },
                        success: function (response) {
                            if (response.message) {
                                ids = [];
                                getArticle();
                                return toastr.success(response.message, 'Success!', {
                                    closeButton: true,
                                    tapToDismiss: true
                                });
                            }
                                getArticle();
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

        
        function getArticle() {
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('listArticle')); ?>",
                dataType: "JSON",
                success: function (response) {
                    console.log(response.data);
                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data,  // Get the data object
                        columns: [
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_delte')): ?>
                            {'data' : 'title'},
                            <?php endif; ?>
                            <?php if(Gate::check('article_update') || Gate::check('article_read')): ?>
                            {'data' : 'title'},
                            <?php endif; ?>
                            {'data' : 'title'},
                            {'data' : 'title'},
                            {'data' : 'title'},
                        ]
                    });

                    $table.destroy();

                    $table = $('#datatable2').DataTable({
                        retrieve: true,
                        data: response.data,  // Get the data object
                        columns: [
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_delete')): ?>
                            { 'data': 'id' },
                            <?php endif; ?>
                            <?php if(Gate::check('article_update') || Gate::check('article_read')): ?>
                            {'data' : "id" , render : function ( data, type, row, meta ) {
                            return type === 'display'  ?
                            '<div class="d-flex justify-content-center">'+
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_read')): ?>
                                '<div class="col-6 me-1">'+
                                    '<a class="btn btn-primary btn-sm" id="show-btn" href="<?php echo e(url('article/show/')); ?>/'+data+'">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>'+
                                    '</a>'+
                                '</div>'+
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_update')): ?>
                                '<div class="col-6">'+
                                    '<a class="btn btn-warning btn-sm" id="update-btn" href="<?php echo e(url('article/edit')); ?>/'+data+'">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>'+
                                    '</a>'+
                                '</div>'+
                                <?php endif; ?>
                            '</div>' :
                                data;
                            }}, 
                            <?php endif; ?>
                            { 'data': 'title' },
                            { 'data': 'category.name' },
                            { 'data': 'created_at' },
                                                        
                        ],
                        'columnDefs': [ 
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_delete')): ?>
                        {
                            'targets': [1], 
                            'orderable': false,
                        },  
                        <?php endif; ?>
                        <?php if(Gate::check('article_update') || Gate::check('article_read')): ?>
                        {
                            'targets': [0],
                            'orderable': false, 
                                render: function (data, type, row) {
                                    if (type === 'display') {
                                        return '<input type="checkbox" class="del_checkbox" name="id[]" value="'+data+'">';
                                    }
                                    return data;
                                },
                        }
                        <?php endif; ?>
                    ]
                    });
                }
            });
        }

        $(document).on("click", ".del_checkbox", function() {
            var ids = new Array();
            $.each($("input[name='id[]']:checked"), function() {
                ids.push($(this).val());
            });
            if(ids.length < 1){
                $("#del-btn").attr("disabled", true);
            }else{
                $("#del-btn").attr("disabled", false);
            }
        });
    });

</script><?php /**PATH D:\Project\Laravel\article-website\resources\views/script/article-script.blade.php ENDPATH**/ ?>