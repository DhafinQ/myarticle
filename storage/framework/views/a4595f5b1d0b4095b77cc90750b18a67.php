
<?php $__env->startSection('title'); ?>
MyArticle | User
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Users</h4>
                    </div>

                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_create')): ?>
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
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?>
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
                                    <?php if(Gate::check('user_update') || Gate::check('user_read')): ?>
                                    <th class="text-center" width="15%">Actions</th>
                                    <?php endif; ?>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
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
    <?php echo $__env->make('script.user-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<!-- Modal Add-->
<div class="modal fade" data-backdrop="static" id="form-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="name_error"></span></div>
                            <label for="w">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="username_error"></span></div>
                            <label for="w">Username<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="email_error"></span></div>
                            <label for="w">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="role_error"></span></div>
                            <label for="w">Role<span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control">
                                <option value="">-- Select --</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="password_error"></span></div>
                            <label for="w">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="w">Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm_password" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="img_profile_error"></span></div>
                            <label for="w">Image Profile</label>
                            <input type="file" class="form-control" id="img_profile" placeholder="">
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

<!-- Modal Add-->
<div class="modal fade" data-backdrop="static" id="form-modal-edit" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="update_name_error"></span></div>
                            <label for="w">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_name" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="update_username_error"></span></div>
                            <label for="w">Username<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_username" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="update_email_error"></span></div>
                            <label for="w">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="update_email" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="update_role_error"></span></div>
                            <label for="w">Role<span class="text-danger">*</span></label>
                            <select name="role" id="update_role" class="form-control">
                                <option value="">-- Select --</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="update_password_error"></span></div>
                            <label for="w">Password</label>
                            <input type="password" class="form-control" id="update_password" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="w">Confirm Password</label>
                            <input type="password" class="form-control" id="update_confirm_password" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="update_img_profile_error"></span></div>
                            <label for="w">Image Profile</label>
                            <input type="file" class="form-control" id="update_img_profile" placeholder="">
                            <small class="form-text text-danger"></small>
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


<div class="modal fade" data-backdrop="static" id="form-modal-show" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="text-center">
                            <img src="#" id="profile_image" alt="img_profile" width="192px" height="192px" style="object-fit:cover;">
                        </div>
                        <table class="table table-responsive">
                            <tr>
                                <td>ID</td>
                                <td><b id="id-user"></b></td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td><b id="user-name"></b></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><b id="user-username"></b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><b id="user-email"></b></td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td><b id="user-role"></b></td>
                            </tr>
                            <tr>
                                <td>Log</td>
                                <td><b id="user-log"></b></td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/users/index.blade.php ENDPATH**/ ?>