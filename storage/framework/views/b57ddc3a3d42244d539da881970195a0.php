<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyArticle | Login</title>

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
              <form method="post" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                
      
                <div class="divider d-flex align-items-center my-4">
                  <h4 class="text-center fw-bold mx-3 mb-0">Login</h4>
                </div>
                
                <?php if($errors->has('no_record')): ?>
                  <span class="text-danger"><?php echo e($errors->first('no_record')); ?></span>
                <?php endif; ?>
                <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" value="<?php echo e(old('email')); ?>"/>
                    <?php if($errors->has('email')): ?>
                      <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                    <?php endif; ?>
                </div>
      
                <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" />
                    <?php if($errors->has('password')): ?>
                    <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                  <?php endif; ?>
                </div>
      
                <div class="d-flex justify-content-between align-items-center">
                  <a href="<?php echo e(route('forgot-password')); ?>" class="text-body">Forgot password?</a>
                </div>
      
                <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
<?php /**PATH D:\Project\Laravel\article-website\resources\views/auth/login.blade.php ENDPATH**/ ?>