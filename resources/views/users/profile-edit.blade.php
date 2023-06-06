@extends('layouts.app')
@section('title')
    MyArticle | Edit Profile
@endsection
@section('content')
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                </div>
                @if (session('success'))
                    <h5 class="text-success ms-4 mt-3">{{session('success')}}</h5>
                @endif
            <form action="{{route('update-profile',$user->id)}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
                @csrf
                <div class="card-body">
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                                <br>
                            @endif
                           <label for="s">Full Name<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('username'))
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                    <br>
                            @endif
                           <label for="s">Username<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" value="{{$user->username}}" id="username" name="username" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('email'))
                                <span class="text-danger">{{$errors->first('email')}}</span>
                                <br>
                            @endif
                           <label for="s">Email<span class="text-danger">*</span></label>
                           <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('image_profile'))
                                <span class="text-danger">{{$errors->first('image_profile')}}</span>
                                <br>
                            @endif
                           <label for="s">Image Profile</label>
                           <input type="file" accept="image/*" class="form-control" id="image_profile" name="image_profile" placeholder="">
                       </div>
                   </div> 
                   <hr>
                   <h4 class="mb-3">Security</h4>
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('password'))
                                <span class="text-danger">{{$errors->first('password')}}</span>
                                <br>
                            @endif
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
@endsection


