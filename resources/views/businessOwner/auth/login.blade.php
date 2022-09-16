<!DOCTYPE html>
<html lang="en">
<head>
    <!--meta-links-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS</title>

    <!--links-->
    <link rel="icon" href="{{ asset('assets/pos/images/favicon.png') }}" type="image/gif">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/pos/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pos/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/pos/css/responsive.css') }}">
</head>
    <body>
        <div class="login" style="background-image:url({{ asset('assets/pos/images/login-bg.png') }}) ;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="login-logo">
                            <img src="{{ asset('assets/pos/images/login-logo.svg')}}" alt="logn-logo" />
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="login-form book-table login-page">
                            <h2>Login</h2>
                            <p>Hello, Welcome Back!</p>
                            <form name="form" method="POST" action="{{ route('businessOwnerLogin') }}">
                                {{ csrf_field() }}
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-block validate">
                                        <!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                @if (@$errors->any())
                                    <div class="alert alert-danger m-b-0">
                                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button> -->
                                        @foreach ($errors->all() as $error)
                                            <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="login-form-box">
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email Address">
                                </div>
                                <div class="login-form-box">
                                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                    <div class="password-show password hide toggle-password">
                                        <img class="eye-open" src="{{ asset('assets/pos/images/icon-eye.svg')}}" alt="ico-eye.svg">
                                        <img class="eye-close" src="{{ asset('assets/pos/images/icon-eye.svg')}}" alt="icon-eye_lose.svg">
                                    </div>
                                </div>
                                <div class="login-forget">
                                    <div class="login-form-box form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Keep me logged in</label>
                                    </div>
                                    <a class="forget-link" href="#">Forgot Password?</a>
                                </div>
                                <div class="login-btn">
                                    <button type="submit" class="comman-btn">LOGIN</button>
                                </div>
                            </form>
                        </div>
                        <div class="login-form book-table forgot-page">
                            <h2>Forgot Password</h2>
                            <p>Hello, Welcome Back!</p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('assets/pos/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/pos/js/popper.min.js')}}"></script>
        <script src="{{ asset('assets/pos/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/pos/js/custom.js')}}"></script>

    </body>

    
</html>