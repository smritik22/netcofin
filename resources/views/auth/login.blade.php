@extends('dashboard.layouts.auth')
@section('title', __('backend.signedInToControl'))
@section('content')
    <div class="center-block w-xxl p-t-3">
        <div class="p-a-md box-color r box-shadow-z4 text-color m-b-0">
            <div class="text-center">
                <img class="logo-img" alt="" src="{{ asset('assets/frontend/logo/Logo_White.jpg') }}">
            </div>
            <div class="m-y text-muted text-center">
                {{ __('backend.signedInToControl') }}
            </div>
            <form name="form" method="POST" action="{{ route('adminLogin') }}">
                {{ csrf_field() }}
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block validate">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (@$errors->any())
                    <div class="alert alert-danger m-b-0">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <?php
                if (Cookie::get('admin_email') !== null) {
                    $email = Cookie::get('admin_email');
                }
                if (Cookie::get('admin_password') !== null) {
                    $password = Cookie::get('admin_password');
                }
                ?>
                <div class="md-form-group float-label {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="text" oninput="validate(this)" name="email" value="{{ isset($email) ? $email : '' }}" class="md-input"
                        required>
                        
                    <label>{{ __('backend.connectEmail') }}</label>
                </div>
               
                <div class="md-form-group float-label {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" value="{{ isset($password) ? $password : '' }}"
                        class="md-input" required>
                    <label>{{ __('backend.connectPassword') }}</label>
                </div>
                
                <!-- <div class="m-b-md text-left">
                    <label class="md-check">
                        <input type="checkbox" name="remember_me" {{ isset($password) ? 'checked' : '' }} value="true"><i
                            class="primary"></i> {{ __('backend.keepMeSignedIn') }}
                    </label>
                </div> -->
                <button type="submit" class="btn primary btn-block p-x-md m-b">{{ __('backend.signIn') }}</button>
            </form>

            <div class="p-v-lg text-center">
                <div class="m-t"><a href="{{ url('/' . env('BACKEND_PATH') . '/forgot-password') }}"
                        class="text-primary _600">{{ __('backend.forgotPassword') }}</a></div>
            </div>

        </div>


    </div>
@endsection
@push('after-scripts')
    <script>
        function validate(input){
            console.log(input,"input ")
            if(/^\s/.test(input.value))
                input.value = '';
        }
        $(document).ready(function (){
            $('.close').on('click', function (e) {
                $(this).parents('.alert').hide();
            });

            
        });
    </script>
@endpush