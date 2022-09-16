@extends('frontEnd.layout')
@section('content')

<!-- Banner -->
<section class="internal_banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner_content">
                    <h1>{{ __('backend.register') }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner -->

<!-- Contact Section -->
<section class="common_padding contact_page">
    <div class="container">
        <div>
            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>
        <div class="row">
            @if(count($plans_data)  > 0)
            <div class="col-md-4">
                <div class="plan_box plan_box_register">
                    <h5>{{ __('backend.planinfo') }}</h5>
                    <h3>{{$plans_data[0]->plan_name}}</h3>
                    @php
                            $duration = \Helper::getValidTillDate(date('Y-m-d H:i:s'),$plans_data[0]->plan_duration_value, $plans_data[0]->plan_duration_type);
                    @endphp
                    <div class="plan_type">
                        @if(!$plans_data[0]->is_free_plan && $plans_data[0]->plan_price != '0.00')
                        <h3>{{\Helper::getDefaultCurrency().$plans_data[0]->plan_price }}<span>/{{  $duration['value'] . ' ' . $duration['label_value'] }}</span></h3>
                        @else
                        <h3>Free</h3>
                        @endif
                    </div>
                    <!-- <p>Limited Access</p> -->
                    <ul>
                        <li>{{$plans_data[0]->plan_description}}</li>
                    </ul>
                    <div class="bottom_btn">
                        <a href="{{ route('frontend.planlist') }}" class="common_btn transparent">CHANGE PLAN</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-8">
                <div class="register_form">
                <form name="register_form" enctype="multipart/form-data" method="POST" action="{{URL('/register/submit')}}" class="needs-validation" novalidate id="payment-form" >
                    <div id="hidden_values">
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ __('backend.ownerifo') }}</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group has-validation">
                                <input type="text" name="fullname" id="fullname" placeholder="Full name" required="" value="{{ old('fullname')}}" class="form-control">
                                <div class="invalid-feedback"> Please Enter Full Name.</div>
                                @if(!empty(@$errors) && @$errors->has('fullname'))
                                    <div class='invalid-feedback' style="display:block">{{ $errors->first('fullname') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group has-validation">
                            <input type="email" name="email" id="email" placeholder="Email" required="" value="{{ old('email')}}" class="form-control">
                                <div class="invalid-feedback"> Please Enter Email Address.</div>
                                @if(!empty(@$errors) && @$errors->has('email'))
                                    <div class='invalid-feedback' style="display:block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group has-validation">
                                <input type="text" name="businessOwner" id="businessOwner" placeholder="Business Owner Name" required="" value="{{ old('businessOwner')}}" class="form-control">
                                <div class="invalid-feedback"> Please Enter Owner Name.</div>
                                @if(!empty(@$errors) && @$errors->has('businessOwner'))
                                    <div class='invalid-feedback' style="display:block">{{ $errors->first('businessOwner') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group has-validation">
                            <input type="text" name="mobile" id="mobile" onKeyPress="if(this.value.length==16) return false;"  placeholder="{{$labels['mobile_number']}}" data-error="#mobile_error" required="" value="{{ old('mobile')}}" class="form-control">
                                <div class="invalid-feedback"> Please Enter Phone Number.</div>
                                @if(!empty(@$errors) && @$errors->has('mobile'))
                                    <div class='invalid-feedback' style="display:block">{{ $errors->first('mobile') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="billing">
                                <h3>Billing Information</h3>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <textarea name="address" rows="2" id="address" data-error="#address_error" placeholder="Enter your address" class="form-control">{{ old('address') ?  old('address') : ''}}</textarea>
                                    
                                    <div class="invalid-feedback"> Please Enter Address.</div>
                                    @if(!empty(@$errors) && @$errors->has('address'))
                                        <div class='invalid-feedback' style="display:block">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-select" required="" name="country" id="country">
                                        <option selected disabled value="">Country</option>
                                        @if(count($countries) > 0)
                                            @foreach ($countries as $key => $value )
                                                <option value="{{$value->id}}" {{old('country') ? "selected" : "" }}>{{$value->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!empty(@$errors) && @$errors->has('country'))
                                        <div class='invalid-feedback' style="display:block">{{ $errors->first('country') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-select"  required="" name="state" id="state">
                                        <option selected disabled value="" {{old('state') ? "selected" : "" }}>State</option>
                                        
                                    </select>
                                    @if(!empty(@$errors) && @$errors->has('state'))
                                        <div class='invalid-feedback' style="display:block">{{ $errors->first('state') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                <select class="form-select"  required="" name="city" id="city">
                                        <option selected disabled value="" {{old('city') ? "selected" : "" }}>City</option>
                                        
                                    </select>
                                    @if(!empty(@$errors) && @$errors->has('city'))
                                        <div class='invalid-feedback' style="display:block">{{ $errors->first('city') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group has-validation">
                                    <input type="text" name="zipcode" id="zipcode" placeholder="Zip Code" required="" class="form-control" value="{{ old('zipcode')}}">
                                    <div class="invalid-feedback"> Please Enter Zip Code</div>
                                    @if(!empty(@$errors) && @$errors->has('zipcode'))
                                        <span  style="color: red;" class='validate'>{{ $errors->first('zipcode') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="billing">
                                    <h3>Payment Details</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group has-validation">
                                    <input type="number" name="card_number" id="card_number" placeholder="Card Number" required="" class="form-control" value="{{ old('card_number')}}">
                                    <div class="invalid-feedback"> Please Enter Card Number</div>
                                    @if(!empty(@$errors) && @$errors->has('card_number'))
                                        <span  style="color: red;" class='validate'>{{ $errors->first('card_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group has-validation">
                                    <input type="number" name="cvc" id="cvc" placeholder="CVC" required="" class="form-control" value="{{ old('cvc')}}">
                                    <div class="invalid-feedback"> Please Enter CVC</div>
                                </div>
                                @if(!empty(@$errors) && @$errors->has('cvc'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('cvc') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="input-group has-validation">
                                    <input type="number" name="exp_month" id="exp_month" value="{{ old('exp_month')}}" placeholder="Expiration Month" required="" class="form-control">
                                    <div class="invalid-feedback"> Please Enter Expiration Month</div>
                                </div>
                                    @if(!empty(@$errors) && @$errors->has('exp_month'))
                                        <span  style="color: red;" class='validate'>{{ $errors->first('exp_month') }}</span>
                                    @endif
                            </div>
                            <div class="col-md-6">
                                <div class="input-group has-validation">
                                    <input type="number" name="exp_year" id="exp_year" value="{{ old('exp_year')}}" placeholder="Expiration Year" required="" class="form-control">
                                    <div class="invalid-feedback"> Please Enter Expiration Year</div>
                                    @if(!empty(@$errors) && @$errors->has('exp_year'))
                                        <span  style="color: red;" class='validate'>{{ $errors->first('exp_year') }}</span>
                                    @endif
                                </div>
                            </div>
                        
                        <div class="col-12">
                                <div class="form_checkbox">
                                    <div class="form-check">
                                        <input class="form-check-input" name="privacy_policy" type="checkbox" value="1" id="flexCheckDefault" required="">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <p>I accept the <a href="{{ route('frontend.privacy_policy') }}">Privacy Policy</a> and <a href="{{ route('frontend.terms_and_conditions') }}">Terms &amp; Conditions</a></p>
                                        </label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form_btn">
                                <button type="submit" class="common_btn" id="submit_register" >Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
    </div>
</section>
<!-- Contact Section -->

@endsection
@push('after-scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
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
    // 
    $(document).ready(function() {
        $('#fullname').on("input", function () {
            $(this).val($(this).val().replace(/^\s+/g, ''));
        });
        $('#mobile').on("input", function () {
            this.value = this.value.replace(/[^0-9\.]/g,''); 
            $(this).val($(this).val().replace(/^\s+/g, ''));
        });
        $('#zipcode').on("input", function () {
            this.value = this.value.replace(/[^0-9\.]/g,''); 
            $(this).val($(this).val().replace(/^\s+/g, ''));
        });
        $('#email').on("input", function () {
            $(this).val($(this).val().replace(/^\s+/g, ''));
        });

        $("#country").change(function()
        {
            var id=$(this).val();
            var country_id=$('#country').val();
            console.log("1:"+id);

            var dataString = {'country_id':country_id,'id':id};
            console.log("2:"+dataString);
            $.ajax
            ({
            type: "POST",
            url: "{{route('frontend.getState')}}",
            data: {'id':id},
            cache: false,
            success: function(data)
            {
            console.log("3:"+data);
                $('#state').empty().append(JSON.parse(data));
            } 
            });

        });

        $("#state").change(function()
        {
            var id=$(this).val();
            var country_id=$('#country').val();
            console.log("1:"+id);

            var dataString = {'country_id':country_id,'id':id};
            console.log("2:"+dataString);
            $.ajax
            ({
            type: "POST",
            url: "{{route('frontend.getCity')}}",
            data: {'id':id,'country_id':country_id},
            cache: false,
            success: function(data)
            {
            console.log("3:"+data);
                $('#city').empty().append(JSON.parse(data));
            } 
            });

        });

        // $("#submit_register").click(function(){
        //     if($('#card_number').val() != "" || $('#cvc').val() != "" || $('#exp_month').val() != "" || $('#exp_year').val() != ""){
        //         var $form         = $("#payment-form");
        //         var key = "{{ env('STRIPE_KEY') }}";
        //         Stripe.setPublishableKey(key);
        //             Stripe.createToken({
        //                 number: $('#card_number').val(),
        //                 cvc: $('#cvc').val(),
        //                 exp_month: $('#exp_month').val(),
        //                 exp_year: $('#exp_year').val()
        //             }, stripeResponseHandler);
        
        //         function stripeResponseHandler(status, response) {
        //             if (response.error) {
        //                 console.log(response.error.message);
        //             } else {
        //                 /* token contains id, last4, and card type */
        //                 console.log(response);
        //                 var token = response['id'];
        //                 // $form.find('input[type=text]').empty();
        //                 $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        //                 $form.get(0).submit();
        //             }
        //         }
        //     }
        // // alert("The paragraph was clicked.");
        // });
    });
</script>
@endpush