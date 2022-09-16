@extends('dashboard.layouts.master')
@section('title', __('backend.view_items'))
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">

    <link rel= "stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

@endpush
@section('content')
<?php
use Illuminate\Support\Carbon;
?>
    <div class="padding edit-package website-label-show">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ __('backend.view_items') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                   <a href="{{ route('items') }}">{{ __('backend.items') }}</a> /
                   <span>{{ __('backend.view_items') }}</span>
                </small>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['items'],'method'=>'GET', 'files' => true,'enctype' => 'multipart/form-data' ])}}

                <div class="personal_informations">

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.topicPhoto') !!} :</label>
                        @if ($items[0]->image != '')
                            <div id="user_photo" class="col-sm-4 form-control-label">
                                <a target="_blank" href="{{ $image_url . $items[0]->image }}"><img
                                        src="{{ $image_url . $items[0]->image }}" >
                                </a>
                            </div>
                        @else
                        <div>-</div>
                        @endif

                        <label class="col-sm-2 form-control-label">{!!  __('backend.category') !!} :</label>
                        <div class="col-sm-4 form-control-label">
                           <label>{{$items[0]->category_name}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.topicName') !!} :</label>
                        <div class="col-sm-4 form-control-label">
                           <label>{{urldecode($items[0]->name)}}</label>
                        </div>

                        <label class="col-sm-2 form-control-label">{!!  __('backend.price') !!} :</label>
                        <div class="col-sm-4 form-control-label">
                           <label>{{$items[0]->price}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.subCategory') !!} :</label>
                        <div class="col-sm-4 form-control-label">
                           <label>{{urldecode($items[0]->subcategory_name)}}</label>
                        </div>

                        <label class="col-sm-2 form-control-label">{!!  __('backend.business_owner_name') !!} :</label>
                        <div class="col-sm-4 form-control-label">
                           <label>{{$items[0]->business_owner_name}}</label>
                        </div>
                    </div>

                    
                    <div class="form-group row">
                    <label class="col-sm-2 form-control-label">{!!  __('backend.lastUpdated') !!} :</label>
                        <div class="col-sm-10 form-control-label">
                           <label>{!! Carbon::parse($items[0]->updated_at)->format(env('DATE_FORMAT','Y-m-d') . ' h:i A') !!}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row m-t-md">
                    <div class="offset-sm-2">
                        <a href="{{ route('items') }}" class="btn btn-default m-t" style="margin: 0 0 0 0px">
                            <i class="material-icons">
                            &#xe5cd;</i> {!! __('backend.back') !!}
                        </a>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
@push("after-scripts")
    <script src="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.js") }}"></script>
    <script src="{{ asset("assets/dashboard/js/summernote/dist/summernote.js") }}"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

 

    <script>

        // update progress bar
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                $('progress').attr({value: e.loaded, max: e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value', '0.0');
                }
            }
        }
    </script>
@endpush
