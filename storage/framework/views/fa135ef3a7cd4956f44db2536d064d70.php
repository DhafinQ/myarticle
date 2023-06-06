
<?php $__env->startSection('title'); ?>
    MyArticle | Article
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Article</h4>
                    </div>
                </div>
                <div class="d-flex justify-content-between my-2 me-4">
                    <div class="text-success ms-4 h5 pt-3">
                    <?php if(session('success')): ?>
                        <?php echo e(session('success')); ?>

                    <?php endif; ?>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_create')): ?>
                    <a href="<?php echo e(url('article/create')); ?>" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Add New
                    </a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="table text-center">
                            <thead class="w-100">
                                <tr>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('article_delete')): ?>
                                    <th class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" id="del-btn" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/> </svg>
                                        </button>
                                    </th>
                                    <?php endif; ?>
                                    <?php if(Gate::check('article_update') || Gate::check('article_read')): ?>
                                    <th class="text-center" width="10%">Actions</th>
                                    <?php endif; ?>
                                    <th class="text-center">Title Article</th>
                                    <th class="text-center">Categories</th>
                                    <th class="text-center">Created Date</th>
                                </tr>
                            </thead>
                            <tbody id='list'>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('script.article-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<!-- Modal Add-->
<div class="modal fade" data-backdrop="static" id="form-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="nama_lengkap_error"></span></div>
                            <label for="jurusan">Category Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-add" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save-add" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/master/article.blade.php ENDPATH**/ ?>