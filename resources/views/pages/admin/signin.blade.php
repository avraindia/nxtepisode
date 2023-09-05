<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> NextEpisode Login </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('backend/css/admin.style.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('backend/css/responsive.css?v=2') }}">
  </head>
  <body>
        <section class="register-bg-form">
        <div class="container">
            <div class="row">
            <div class="col-lg-6 col-sm-12 offset-lg-3">
              <div class="admin-logging-page-logo-image" style="text-align: center;  margin-bottom: 22px;">
                <img src="{{ asset('backend/images/logo.png') }}" class="img-fluid" alt="" style="width:120px;">
              </div>
                <div class="card card-white mt-0">
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <h2 class="reg-title">sign in</h2>
                        
                        <form class="form-register form-position" action="{{route('adminlogin')}}" method="POST">
                        @csrf
                            <div class="row">
                            
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3 form-box form-group">
                                  <img src="{{ asset('backend/images/f-icon-mail.svg') }}" alt="" class="form-icon">
                                  <input type="email" name="email" class="form-control cus-form-control" id="" placeholder="">
                                  <label for="email" class="control-label">Email</label><i class="bar"></i>
                                  @error('email')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3 form-box form-group">
                                  <img src="{{ asset('backend/images/f-icon-lock.svg') }}" alt="" class="form-icon">
                                  <input type="password" name="password" class="form-control cus-form-control" id="" placeholder="">
                                  <label for="password" class="control-label">Password</label><i class="bar"></i>
                                  @error('password')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3 form-box ">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                                    <label class="form-check-label" for="check1"> Remember password</label>
                                </div>
                                </div>
                            </div>
                            

                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                  <button class="btn-green-arrow btn-fil-color"><span> Login Now </span></button>
                                  @if(session()->has('error'))
                                        <span class="text-danger">{{session()->get('error')}}</span>
                                  @endif
                                </div>
                            </div>

                            </div>
                        </form>
                        <a href="{{route('forget_password')}}">Forget Password?</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
      </section>
</body>
</html>