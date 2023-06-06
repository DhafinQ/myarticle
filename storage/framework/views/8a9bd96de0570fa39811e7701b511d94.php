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
              <form>
                
      
                <div class="divider d-flex align-items-center my-4">
                  <h4 class="text-center fw-bold mx-3 mb-0">Success</h4>
                </div>
      
                <div class="form-outline mb-4">
                <h6 class="text-center">Your Account Password has Changed!</h6>
                </div>
      
                <div class="divider d-flex align-items-center">
                    <div class="text-center text-lg-start pt-2">
                      <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login Page</a>
                      
                    </div>
                  </div>
      
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
<?php /**PATH D:\Project\Laravel\article-website\resources\views/auth/fg-success.blade.php ENDPATH**/ ?>