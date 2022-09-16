@extends('frontEnd.layout')
@section('content')
    <!-- Banner -->
    <section class="internal_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_content">
                        <h1>{{ $labels['subscription_plan'] }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner -->
    <!-- Choose Your Plan -->
    <section class="common_padding choose_plan">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Choose your plan</h2>
                        <h4>I'm a paragraph. I’m a great place for you to tell a story and let your users know a little more about you.</h4>
                    </div>
                </div>
            </div>
            
            <div class="row plan_row">
                @foreach ($subscription_plans as $key => $value)
                    <div class="col-md-4 col-sm-6">
                        <div class="plan_box">
                            <h3>{!! $language_id != 1 && @$value->childdata[0]->plan_name ? $value->childdata[0]->plan_name : $value->plan_name !!} </h3>
                            @php
                                    $duration = \Helper::getValidTillDate(date('Y-m-d H:i:s'),$value->plan_duration_value, $value->plan_duration_type);
                            @endphp
                            <div class="plan_type">

                                @if(!$value->is_free_plan && $value->plan_price != '0.00')
                                <h3>{{\Helper::getDefaultCurrency().$value->plan_price }}<span>/{{ ($duration['value'] == 1) ? 'Monthly' : $duration['value'] . ' ' . $duration['label_value'] }}</span></h3>
                                @else
                                <h3>Free</h3>
                                @endif
                            </div>
                            <p>{!! $language_id != 1 && @$value->childdata[0]->plan_description ? $value->childdata[0]->plan_description : $value->plan_description !!}</p>
                           
                            <div class="bottom_btn">
                                <a class="common_btn transparent" onClick="reply_click(this.id)" id="{{$value->id}}">CHOOSE PLAN</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="bottom_btn view_all">
                        <a class="common_btn" id="pay_now">{{ $labels['pay_now'] }} </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('after-scripts')
    <script>
        function reply_click(clicked_id)
        {
            var url = '{{ route("frontend.register", ":id") }}';
            url = url.replace(':id', clicked_id);
            $('#pay_now').attr("href",url);
        }
        function popup(mylink, windowname) {
            winopened = window.open(mylink, windowname); 
            winopened.onblur = () => winopened.focus();
            {{--  return false;   --}}
        } 

        function resultFetched(response) {
            winopened.close();
            console.info(response);

            if(response.Result == "{{config('constants.UPAY_RESULT.success')}}") {
                $('#PaymentID').val(response.PaymentID);
                $('#TrackID').val(response.TranID);
                {{--  $('#TranID').val(response.TranID);  --}}
                $('#trnUdf').val(response.trnUdf);
                $('#Auth').val(response.Auth);
            } else {
                Swal.fire({
                    icon: 'error',
                    iconColor : '#bb4f4f',
                    text: "{{$labels['payment_failed']}}",
                    showConfirmButton: true,
                    confirmButtonText: "{{$labels['ok']}}",
                });
            }
            // alert('Yes this is called now');
        }

        $().ready(function () {
            // $("#pay_now").click( function(e) {
            //     let subscription_plan = $('input[name="subscription_plan"]:checked').data('price');
            //     var is_renew = $("#is_renew").val();
                
            //     let is_loggedin = "{{(@Auth::guard('web')->check()) ? 1 : 0}}";
                
            //     if(is_loggedin == "1") {
                    
            //         // if(is_renew == 1) {
            //         //     total_amount = ("#renew_plan_submit").data('price');
            //         // } 
            //         // else if( is_renew == 2) {
            //             if( typeof(subscription_plan) != "undefined" && subscription_plan !== null ) {
            //                 $("#subscription_plan_error").text("");
            //                 total_amount = subscription_plan;
            //             } else {
            //                 $("#subscription_plan_error").text("{{$labels['please_select_plan']}}");
            //                 return false;
            //             }
            //         // }
    
            //         $.ajax({
            //             url : "{{route('frontend.payment')}}",
            //             data : {"user_id" : "{{Auth::guard('web')->id()}}", "payable_amount" : total_amount, "language_id" : "{{$language_id}}", "is_web":1},
            //             type : 'post',
            //             dataType : 'json',
            //             success : function (response) {
            //                 if(response[0].code == 1) {
            //                     popup(response[0].redirect_url, '_blank');
            //                 } else {
            //                     Swal.fire({
            //                         icon: 'error',
            //                         iconColor : '#bb4f4f',
            //                         text: "{{$labels['something_went_wrong']}}",
            //                         showConfirmButton: true,
            //                         confirmButtonText: "{{$labels['ok']}}",
            //                     }).then(function (res) {
            //                         location.reload();
            //                     });
            //                     return false;
            //                 }
    
            //                 loader_hide();
            //             },
            //             error : function (err) {
            //                 loader_hide();
            //                 Swal.fire({
            //                     icon: 'error',
            //                     iconColor : '#bb4f4f',
            //                     text: "{{$labels['something_went_wrong']}}",
            //                     showConfirmButton: true,
            //                     confirmButtonText: "{{$labels['ok']}}",
            //                 }).then(function (res) {
            //                     location.reload();
            //                 });
            //                 return false;
            //             }
            //         });
            //     } else {
            //         Swal.fire({
            //             title: "{{$labels['login_required']}}",
            //             showDenyButton: true,
            //             showConfirmButton: true,
            //             confirmButtonText: "{{ $labels['go_to_login'] }}",
            //             denyButtonText: `{{ $labels['cancle'] }}`,
            //             confirmButtonColor: "#2A4B9B",
            //             heightAuto: false,
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 window.location.href = "{{route('frontend.login')}}";
            //             }
            //         });
            //     }
            // });
        });
    </script>
@endpush