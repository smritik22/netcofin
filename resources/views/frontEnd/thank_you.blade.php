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
    <section class="inner-pading thank-you-outer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="thank-you">
                       
                        <h1>{{$labels['thanks_for_reaching_out']}}</h1>
                        <p>
                            {!! $labels['thank_you_page_message_to_show'] !!}
                        </p>
                        <a href="{{route('frontend.homePage')}}" class="comman-btn">{{$labels['back_to_home']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
