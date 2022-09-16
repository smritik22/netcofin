@extends('frontEnd.layout')
@section('content')
   <!-- Banner -->
   <style>
       #more {display: none;}
   </style>
   <section class="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="banner_content_cover">
                        <div class="banner_content">
                            <h1>Netco Fintech</h1>
                            <h4>Affordable, Reliable, Flexible <span>Point Of Sale</span> <br> Systems With Payment Processing</h4>
                            <a href="{{ route('frontend.about_us') }}" class="common_btn">VIEW MORE</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="banner_cover">
                        <div class="banner_animation">
                            <img src="{{asset('assets/frontend/images/dot_pattern.svg')}}" alt="banner_animation"/>
                        </div>
                        <div class="banner_video">
                            <button type="button" class="banner_video_img" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <div class="banner_bg_img">
                                    <img src="{{asset('assets/frontend/images/banner_inner_img.jpg')}}" alt="banner_inner_img"/>
                                </div>
                                <div class="video_icon_bg">
                                    <span class="banner_video_icon">
                                        <img src="{{asset('assets/frontend/images/play_icon_small.svg')}}" alt="play_icon"/>
                                    </span>
                                    <span>PLAY VIDEO</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner -->

    <!-- About Us -->
    <section class="common_padding about_us">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="about_left">
                        <img src="{{asset('assets/frontend/images/about_img.jpg')}}" alt="about_img"/>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_right">
                        <h2>ABOUT US</h2>
                        <p>{!! substr($about_us->description, 0, 250) !!}
                                <span id="dots">...</span>
                                <div id="more" style="display:none">
                                    <p>{!! substr($about_us->description, 251) !!}</p>
                                </div>
                        </p>
                        <a href="{{ route('frontend.about_us') }}" class="common_btn">VIEW MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us -->
            
    <!-- Our Features -->
    <section class="our_features">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>OUR FEATURES</h2>
                    </div>
                </div>
            </div>

            <div class="features_line_animation">
                <img src="{{asset('assets/frontend/images/dot_pattern_line_curve.svg')}}" alt="features_line_animation"/>
            </div>

            <div class="row features_row justify-content-between">
                <div class="col-lg-5 features_col">
                    <div class="features_video">
                        <button type="button" class="features_video_img" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="features_video_bg_img">
                                <img src="{{asset('assets/frontend/images/feature_img1.jpg')}}" alt="feature_img1"/>
                            </div>
                            <span class="video_icon">
                                <img src="{{asset('assets/frontend/images/play_icon.svg')}}" alt="play_icon"/>
                            </span>
                        </button>
                        <div class="features_labelbox">
                            <h5>Feature highlight point will be here</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="features_content">
                        
                        <p>{!! substr($features->description, 0, 250) !!}<span id="dots_features">...</span>
                        <div id="more_features" style="display:none"><p>{!! substr($features->description, 251) !!}</p></div></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="bottom_btn">
                        <a href="{{ route('frontend.features') }}" class="common_btn"  id="myBtn_features">VIEW ALL FEATURES</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Features -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/_xs3LYDfiSI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

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
                @foreach ($plans as $key => $value)
                    <div class="col-md-4 col-sm-6">
                        <div class="plan_box">
                            <h3>{!! $value->plan_name !!} </h3>
                            @php
                                    $duration = \Helper::getValidTillDate(date('Y-m-d H:i:s'),$value->plan_duration_value, $value->plan_duration_type);
                            @endphp
                            <div class="plan_type">
                                @if(!$value->is_free_plan && $value->plan_price != '0.00')
                                <h3>{{\Helper::getDefaultCurrency().$value->plan_price }}<span>/{{  $duration['value'] . ' ' . $duration['label_value'] }}</span></h3>
                                @else
                                <h3>Free</h3>
                                @endif
                            </div>
                            <ul>
                                <li>{!! $language_id != 1 && @$value->childdata[0]->plan_description ? $value->childdata[0]->plan_description : $value->plan_description !!}
                                </li>
                            </ul>
                            
                           
                            <div class="bottom_btn">
                                <a href="" class="common_btn transparent">CHOOSE PLAN</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="bottom_btn view_all">
                        <a href="{{ route('frontend.planlist') }}" class="common_btn">VIEW ALL </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Choose Your Plan -->
@endsection
@push('after-scripts')
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "View more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "View less";
    moreText.style.display = "inline";
  }
}

function myFunctionFeatures() {
  var dots = document.getElementById("dots_features");
  var moreText = document.getElementById("more_features");
  var btnText = document.getElementById("myBtn_features");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "View more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "View less";
    moreText.style.display = "inline";
  }
}
</script>
@endpush
