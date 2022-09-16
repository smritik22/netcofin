@extends('frontEnd.layout')
@section('content')
     <!-- Banner -->
     <section class="internal_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_content">
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
    </section>
    <!--Privacy Policy-->
@endsection
