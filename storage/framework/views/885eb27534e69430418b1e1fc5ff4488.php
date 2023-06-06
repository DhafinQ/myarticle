
<?php $__env->startSection('title'); ?>
    MyArticle | Edit Profile
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                </div>
                <?php if(session('success')): ?>
                    <h5 class="text-success ms-4 mt-3"><?php echo e(session('success')); ?></h5>
                <?php endif; ?>
            <form action="<?php echo e(route('update-profile',$user->id)); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('PATCH'); ?>
                <?php echo csrf_field(); ?>
                <div class="card-body">
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('name')): ?>
                                <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Full Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" value="<?php echo e($user->name); ?>" id="name" name="name" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('username')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('username')); ?></span>
                                    <br>
                            <?php endif; ?>
                           <label for="s">Username<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" value="<?php echo e($user->username); ?>" id="username" name="username" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('email')): ?>
                                <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Email<span class="text-danger">*</span></label>
                           <input type="email" class="form-control" value="<?php echo e($user->email); ?>" id="email" name="email" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('image_profile')): ?>
                                <span class="text-danger"><?php echo e($errors->first('image_profile')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Image Profile</label>
                           <input type="file" accept="image/*" class="form-control" id="image_profile" name="image_profile" placeholder="">
                       </div>
                   </div> 
                   <hr>
                   <h4 class="mb-3">Security</h4>
                   <div class="col-sm-4">
                       <div class="form-group">
                            <?php if($errors->has('password')): ?>
                                <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                <br>
                            <?php endif; ?>
                           <label for="s">Password</label>
                           <input type="password" class="form-control" id="password" name="password" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                           <label for="s">Confirm Password</label>
                           <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-8 d-flex">
                       <div class="form-group">
                           <button class="btn btn-primary" type="submit">Edit</button>
                       </div>
                       <div class="form-group ms-2">
                           <a class="btn btn-secondary" href="">Cancel</a>
                       </div>
                   </div>
                 </div>
                </div>
            </form>
          </div>
       </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\Laravel\article-website\resources\views/users/profile-edit.blade.php ENDPATH**/ ?>