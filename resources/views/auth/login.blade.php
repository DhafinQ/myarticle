<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyArticle | Login</title>

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
              <form method="post" action="{{route('login')}}">
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
                  <h4 class="text-center fw-bold mx-3 mb-0">Login</h4>
                </div>
                {{-- @dd($errors->has('no_record')) --}}
                @if($errors->has('no_record'))
                  <span class="text-danger">{{$errors->first('no_record')}}</span>
                @endif
                <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" value="{{old('email')}}"/>
                    @if($errors->has('email'))
                      <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
      
                <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" />
                    @if($errors->has('password'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                  @endif
                </div>
      
                <div class="d-flex justify-content-between align-items-center">
                  <a href="{{route('forgot-password')}}" class="text-body">Forgot password?</a>
                </div>
      
                <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
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
