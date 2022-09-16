@extends('frontEnd.layout')
@section('content')

    <!-- Banner -->
    <section class="internal_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_content">
                        <h1>{{$labels['contact_us']}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner -->
   
    <!-- Contact Section -->
    <section class="common_padding contactus_wraper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8">
                    <div class="contact_left">
                        <h2>Get in Touch</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                        <p>We would be happy to answer your questions.</p>
                        <div class="contact_left_form">
                            <form id="contact_us_form" name="contact_us_form" enctype="multipart/form-data" method="POST" action="{{URL('/contact-us/submit')}}" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="input-group has-validation">
                                            <input type="text" name="firstname" id="firstname" placeholder="{{$labels['firstname']}}" required="" value="{{ old('firstname')}}" class="form-control">
                                            <div class="invalid-feedback"> Please Enter First Name.</div>
                                            @if(!empty(@$errors) && @$errors->has('firstname'))
                                                <div class='invalid-feedback' style="display:block">{{ $errors->first('firstname') }}</div>
                                            @endif
                                           
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="input-group has-validations">
                                            <input type="text" name="lastname" id="lastname" placeholder="{{$labels['lastname']}}" required="" value="{{ old('lastname')}}" class="form-control">
                                            <div class="invalid-feedback"> Please Enter Last Name.</div>
                                            @if(!empty(@$errors) && @$errors->has('lastname'))
                                                <div class='invalid-feedback' style="display:block">{{ $errors->first('lastname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" id="email" placeholder="{{$labels['your_email']}}" data-error="#email_error" required="" value="{{ old('email')}}" class="form-control">
                                            
                                            <div class="invalid-feedback"> Please Enter Email Address.</div>
                                            @if(!empty(@$errors) && @$errors->has('email'))
                                                <div class='invalid-feedback' style="display:block">{{ $errors->first('email') }}</div>
                                            @endif
                                            <span class="error-login" id="email_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="input-group has-validation">
                                            <input type="text" name="mobile" id="mobile" onKeyPress="if(this.value.length==16) return false;"  placeholder="{{$labels['mobile_number']}}" data-error="#mobile_error" required="" value="{{ old('mobile')}}" class="form-control">
                                            <div class="invalid-feedback"> Please Enter Phone.</div>
                                            @if(!empty(@$errors) && @$errors->has('mobile'))
                                                <div class='invalid-feedback' style="display:block">{{ $errors->first('mobile') }}</div>
                                            @endif
                                            <span class="error-login" id="mobile_error"></span>
                                            <input type="hidden" name="country_code" value="+1">
                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="input-group has-validation">
                                            <textarea name="message" id="message" data-error="#message_error" placeholder="{{$labels['enter_your_message']}}" class="form-control">{{ old('message') ?  old('message') : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form_btn">
                                            <button type="submit" class="common_btn">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="contact_right">
                        <ul>
                            <li>
                                <div class="contact_right_box">
                                    <h4 class="contactus_title">Follow us</h4>
                                    <ul class="contus_media_list">
                                        <li>
                                            <a href="" target="_blank"><img src="{{asset('assets/frontend/images/fb_icon.svg')}}" alt="fb_icon"/></a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><img src="{{asset('assets/frontend/images/twitter_icon.svg')}}" alt="twitter_icon"/></a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><img src="{{asset('assets/frontend/images/youtube_icon.svg')}}" alt="youtube_icon"/></a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><img src="{{asset('assets/frontend/images/insta_icon.svg')}}" alt="insta_icon"/></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="contact_right_box">
                                    <h4 class="contactus_title">{{$labels['email_address']}}</h4>
                                    <div class="inner_contact_right">
                                        <div class="icr_right">
                                            <a href="mailto:info@netcofintech.com">{{$WebmasterSettings->mail_no_replay}}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact_right_box">
                                    <h4 class="contactus_title">{{$labels['mobile_number']}}</h4>
                                    <div class="inner_contact_right">
                                        <div class="icr_right">
                                            <a href="tel:+1512251-6763">{{$setting->phone}}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact_right_box">
                                    <h4 class="contactus_title">{{$labels['address']}}</h4>
                                    <div class="inner_contact_right">
                                        <div class="icr_right">
                                            <p>{{$setting->address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--  -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
@endsection

@push('after-scripts')
    <script src="{{asset('assets/frontend/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/additional.min.js')}}"></script>


    <script>
        (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
        }
        form.classList.add('was-validated')
        }, false)
        })
        })()
        $(document).ready(function() {
            $('#firstname').on("input", function () {
                $(this).val($(this).val().replace(/^\s+/g, ''));
            });
            $('#lastname').on("input", function () {
                $(this).val($(this).val().replace(/^\s+/g, ''));
            });
            $('#mobile').on("input", function () {
                this.value = this.value.replace(/[^0-9\.]/g,''); 
                $(this).val($(this).val().replace(/^\s+/g, ''));
            });
            $('#email').on("input", function () {
                $(this).val($(this).val().replace(/^\s+/g, ''));
            });
        });
    </script>
@endpush
