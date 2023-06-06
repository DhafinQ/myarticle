<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

    <link rel="stylesheet" href="<?php echo e(asset('css/libs.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/hope-ui.css?v=1.1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css?v=1.1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/dark.css?v=1.1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/rtl.css?v=1.1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/customizer.css?v=1.1.0')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post" action="<?php echo e(route('forgot-password.confirm', $token)); ?>">
                        <?php echo csrf_field(); ?>
                        

                        <div class="divider d-flex align-items-center my-4">
                            <h4 class="text-center fw-bold mx-3 mb-0">Change Password</h4>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="hidden" name="token" value="<?php echo e($token); ?>">
                            <?php if(session('error')): ?>
                            <span class="text-danger"><?php echo e(session('error')); ?></span>
                            <br>
                            <?php endif; ?>
                            <?php if($errors->has('email')): ?>
                            <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                            <br>
                            <?php endif; ?>
                            <label class="form-label" for="email">Email Adress</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                placeholder="Enter Your Email..." value="<?php echo e(old('email')); ?>"/>
                        </div>
                        <div class="form-outline mb-4">
                            <?php if($errors->has('password')): ?>
                            <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                            <br>
                            <?php endif; ?>
                            <label class="form-label" for="password">New Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control form-control-lg" />
                        </div>
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control form-control-lg" />
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Change Password</button>
                                
                            </div>
                </div>


                </form>
            </div>
        </div>
        </div>
    </section>
</body>

</html>
<?php /**PATH D:\Project\Laravel\article-website\resources\views/auth/forgetPasswordLink.blade.php ENDPATH**/ ?>