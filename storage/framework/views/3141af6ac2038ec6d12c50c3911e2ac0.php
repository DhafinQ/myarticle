
<?php $__env->startSection('title'); ?>
    MyArticle | Role
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Roles</h4>
                    </div>

                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_create')): ?>
                <div class="d-flex justify-content-end my-2 me-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Add New
                    </button>
                </div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="table text-center">
                            <thead class="w-100">
                                <tr>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_delete')): ?>
                                    <th class="text-center" width="10%">
                                        <button type="button" class="btn btn-sm btn-danger" id="del-btn" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </th>
                                    <?php endif; ?>
                                    <?php if(Gate::check('role_update') | Gate::check('role_read')): ?>
                                    <th class="text-center" width="15%">Actions</th>
                                    <?php endif; ?>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Slug</th>
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
    <?php echo $__env->make('script.role-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<div class="modal fade" data-backdrop="static" id="form-modal-show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Role Details</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                       <table class="table table-responsive">
                            <tr>
                                <td>ID</td>
                                <td><b id="id-role"></b></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><b id="role-name"></b></td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td><b id="role-slug"></b></td>
                            </tr>
                            <tr>
                                <td>Permission</td>
                                <td>
                                    <ul id="role_permission">
                                        
                                    </ul>
                                </td>
                            </tr>
                       </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-show" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" data-backdrop="static" id="form-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Role</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-6">
                            <div class="form-group">
                                <div><span class="text-danger" id="role_error"></span></div>
                                <label for="s">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="">
                                <small class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div><span class="text-danger" id="slug_error"></span></div>
                                <label for="s">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="slug" placeholder="">
                                <small class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div><span class="text-danger" id="permission_name_error"></span></div>
                            <label for="s">Permission<span class="text-danger">*</span></label>
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th>Permission</th>
                                    <th>Slug</th>
                                </tr>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" name="name[]" value="<?php echo e($p->name); ?>"></td>
                                        <td><?php echo e($p->name); ?></td>
                                        <td><?php echo e($p->slug); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
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


<div class="modal fade" data-backdrop="static" id="form-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-6">
                            <div class="form-group">
                                <div><span class="text-danger" id="update_role_error"></span></div>
                                <label for="s">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="update_name" placeholder="">
                                <small class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div><span class="text-danger" id="update_slug_error"></span></div>
                                <label for="s">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="update_slug" placeholder="">
                                <small class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div><span class="text-danger" id="update_permission_name_error"></span></div>
                            <label for="s">Permission<span class="text-danger">*</span></label>
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th>Permission</th>
                                    <th>Slug</th>
                                </tr>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" name="update_name[]" value="<?php echo e($p->name); ?>" id="<?php echo e('permission_name_'. $p->name); ?>"></td>
                                        <td><?php echo e($p->name); ?></td>
                                        <td><?php echo e($p->slug); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-edit" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save-edit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/roles/role.blade.php ENDPATH**/ ?>