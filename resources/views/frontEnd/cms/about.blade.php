@extends('frontEnd.layout')
@section('content')
    <style>
        #more  {display:  none;}
    </style>
    <!-- Banner -->
    <section class="internal_banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner_content">
                    <h1>{{ $labels['about_us'] }}</h1>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Banner -->
    <!-- Our Process -->
    <section class="common_padding about_work">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="about_work_img">
                        <img src="{{ $image_url . $cms_data->image }}" class="thumbnail" alt="our_process">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_work_content" id="page">
                        <h2>{{ $language_id != 1 && @$cms_data->childdata[0]->page_name? $cms_data->childdata[0]->page_name: $cms_data->page_name }}</h2>							
                        {{-- <p>{!! $language_id != 1 && @$cms_data->childdata[0]->description ? $cms_data->childdata[0]->description : $cms_data->description !!}
                        </p> --}}
                       {{-- {{dd($cms_data->childdata[0]->description);}}  --}}
                            <p>{!! substr($language_id != 1 && @$cms_data->childdata[0]->description ? $cms_data->childdata[0]->description : $cms_data->description , 0, 500) !!}
                                <span id="dots">...</span>
                                <div id="more" style="display:none">
                                    <p>{!! substr($language_id != 1 && @$cms_data->childdata[0]->description ? $cms_data->childdata[0]->description : $cms_data->description, 500) !!}</p>
                                </div>
                            </p>
                            <a href="#" class="common_btn" onclick="myFunction()" id="myBtn">Explore our process</a>
                </div>
            </div>
            
           <div class="row about_work_capabilitie">
                <div class="col-md-6 order-md-last">
                    <div class="about_work_img">
                        <img src="{{ $image_url . $cms_data->other_image }}" class="thumbnail" alt="our_process">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_work_content" id="capabilities">
                        <h2>{{ $language_id != 1 && @$cms_data->childdata[0]->other_title? $cms_data->childdata[0]->other_title: $cms_data->other_title }}</h2>							
                        
                        {{-- <p>{!! $language_id == 6 && @$cms_data->childdata[0]->other_description ? $cms_data->childdata[0]->other_description : $cms_data->other_description !!}
                        </p> --}}

                        <p>{!! substr($language_id != 1 && @$cms_data->childdata[0]->other_description ? $cms_data->childdata[0]->other_description : $cms_data->other_description , 0, 500) !!}
                            <span id="dots_other">...</span>
                            <div id="more_other" style="display:none">
                                <p>{!! substr($language_id != 1 && @$cms_data->childdata[0]->other_description ? $cms_data->childdata[0]->other_description : $cms_data->other_description, 500) !!}</p>
                            </div>
                        </p>
                        <a href="#" class="common_btn" onclick="myFunctionFeatures()" id="myBtn_other">Explore our process</a>
                </div>
            </div> 
        </div>
    </section>
    <!-- Our Process -->
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
  var dots = document.getElementById("dots_other");
  var moreText = document.getElementById("more_other");
  var btnText = document.getElementById("myBtn_other");

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
