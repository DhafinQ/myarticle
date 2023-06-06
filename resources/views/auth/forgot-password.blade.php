<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyArticle | Forgot Password</title>

    <link rel="stylesheet" href="{{asset('css/libs.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hope-ui.css?v=1.1.0')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css?v=1.1.0')}}">
    <link rel="stylesheet" href="{{asset('css/dark.css?v=1.1.0')}}">
    <link rel="stylesheet" href="{{asset('css/rtl.css?v=1.1.0')}}">
    <link rel="stylesheet" href="{{asset('css/customizer.css?v=1.1.0')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
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
              <form method="post" action="{{route('forgot-password.send')}}">
                @csrf
                {{-- <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                  <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                  <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                  </button>
      
                  <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                  </button>
      
                  <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-linkedin-in"></i>
                  </button>
                </div> --}}
      
                <div class="divider d-flex align-items-center my-4">
                  <h4 class="text-center fw-bold mx-3 mb-0">Forgot Password</h4>
                </div>
                @if (session('success'))
                <h5 class="text-success my-4">{{session('success')}}</h5>
                @endif
                <div class="form-outline mb-4">
                  @if($errors->has('email'))
                  <span class="text-danger">{{$errors->first('email')}}</span>
                  <br>
                  @endif
                <label class="form-label" for="email">Enter Your Email Address</label>
                  <input type="email" id="email" name="email" class="form-control form-control-lg"
                    placeholder="Email address" />
                </div>
      
                <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Send Email</button>
                  {{-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                      class="link-danger">Register</a></p> --}}
                </div>
      
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
