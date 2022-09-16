@extends('frontEnd.layout')
@section('content')

<section class="common_padding our_features">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>{{ $language_id != 1 && @$cms_data->childdata[0]->page_name? $cms_data->childdata[0]->page_name: $cms_data->page_name }}</h2>
                    <h4>{!! $language_id != 1 && @$cms_data->childdata[0]->description ? $cms_data->childdata[0]->description : $cms_data->description !!}</h4>
                </div>
            </div>
        </div>

        <div class="features_line_animation">
            <img src="images/dot_pattern_line_curve.svg" alt="features_line_animation"/>
        </div>

        <div class="row features_row justify-content-between">
            <div class="col-lg-5 features_col">
                <div class="features_video">
                    <button type="button" class="features_video_img" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="features_video_bg_img">
                            <img src="{{ $image_url . $cms_data->other_image }}" class="thumbnail" alt="our_process">
                        </div>
                        <span class="video_icon">
                            <img src="{{ asset('assets/frontend/images/play_icon.svg') }}" alt="play_icon"/>
                        </span>
                    </button>
                    <div class="features_labelbox">
                        <h5>{{ $language_id != 1 && @$cms_data->childdata[0]->other_highlight? $cms_data->childdata[0]->other_highlight: $cms_data->other_highlight }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="features_content">
                    <h3>{{ $language_id != 1 && @$cms_data->childdata[0]->other_title? $cms_data->childdata[0]->other_title: $cms_data->other_title }}</h3>
                    <p>{!! $language_id != 1 && @$cms_data->childdata[0]->other_description? $cms_data->childdata[0]->other_description: $cms_data->other_description!!}</p>

                    {{-- <ul>
                        <li>I'm a paragraph. I’m a great place for you to tell a story.</li>
                        <li>I'm a paragraph. I’m a great place for you to tell a story.</li>
                    </ul> --}}
                </div>
            </div>
        </div>

        <div class="row features_row justify-content-between">
            <div class="col-lg-5 order-lg-last features_col">
                <div class="features_video">
                    <button type="button" class="features_video_img" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="features_video_bg_img">
                            <img src="{{ $image_url . $cms_data->other_image1 }}" class="thumbnail" alt="our_process">
                        </div>
                        <span class="video_icon">
                            <img src="{{ asset('assets/frontend/images/play_icon.svg') }}" alt="play_icon"/>
                        </span>
                    </button>
                    <div class="features_labelbox left">
                        <h5>{{ $language_id != 1 && @$cms_data->childdata[0]->other_highlight1? $cms_data->childdata[0]->other_highlight1: $cms_data->other_highlight1 }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="features_content">
                    <h3>{{ $language_id != 1 && @$cms_data->childdata[0]->other_title1? $cms_data->childdata[0]->other_title1: $cms_data->other_title1 }}</h3>
                    <p>{!! $language_id != 1 && @$cms_data->childdata[0]->other_description1? $cms_data->childdata[0]->other_description1: $cms_data->other_description1 !!}</p>

                    {{-- <ul>
                        <li>I'm a paragraph. I’m a great place for you to tell a story.</li>
                        <li>I'm a paragraph. I’m a great place for you to tell a story.</li>
                    </ul> --}}
                </div>
            </div>
        </div>

        <div class="row features_row justify-content-between">
            <div class="col-lg-5 features_col">
                <div class="features_animation">
                    <img src="images/dot_pattern_left.svg" alt="features_animation"/>
                </div>
                <div class="features_video">
                    <button type="button" class="features_video_img" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="features_video_bg_img">
                            <img src="{{ $image_url . $cms_data->other_image2 }}" class="thumbnail" alt="our_process">
                        </div>
                        <span class="video_icon">
                            <img src="{{ asset('assets/frontend/images/play_icon.svg') }}" alt="play_icon"/>
                        </span>
                    </button>
                    <div class="features_labelbox bottom">
                        <h5>{{ $language_id != 1 && @$cms_data->childdata[0]->other_highlight2? $cms_data->childdata[0]->other_highlight2: $cms_data->other_highlight2 }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="features_content">
                    <h3>{{ $language_id != 1 && @$cms_data->childdata[0]->other_title2? $cms_data->childdata[0]->other_title2: $cms_data->other_title2 }}</h3>
                    <p>{!! $language_id != 1 && @$cms_data->childdata[0]->other_description2? $cms_data->childdata[0]->other_description2: $cms_data->other_description2 !!}</p>

                    {{-- <ul>
                        <li>I'm a paragraph. I’m a great place for you to tell a story.</li>
                        <li>I'm a paragraph. I’m a great place for you to tell a story.</li>
                    </ul> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="bottom_btn">
                    <a href="#" class="common_btn">VIEW ALL FEATURES</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
     <!-- Banner -->
     {{-- <section class="internal_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_content">
                        hhhhh
                        <h1>{{ $language_id != 1 && @$cms_data->childdata[0]->page_name? $cms_data->childdata[0]->page_name: $cms_data->page_name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner -->
   <!--Privacy Policy-->
   <section class="common_padding content_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>
                        {{ $language_id != 1 && @$cms_data->childdata[0]->page_name? $cms_data->childdata[0]->page_name: $cms_data->page_name }}
                    </h2>
                    <div class="about-us-content">
                        {!! $language_id != 1 && @$cms_data->childdata[0]->description ? $cms_data->childdata[0]->description : $cms_data->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--Privacy Policy-->
@endsection
