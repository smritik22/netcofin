@extends('dashboard.layouts.master')
@section('title', __('backend.topicNew') . " " . __('backend.state'))
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">

    <link rel= "stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <style type="text/css">
        .error {
            color: red;
            margin-left: 5px;
        }
    </style>
@endpush
@section('content')
    <div class="padding edit-package">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">
                        &#xe02e;</i> {{ __('backend.topicNew') }} {{ __('backend.state') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('state') }}">{{ __('backend.state') }}</a> / 
                    <span>{{ __('backend.topicNew') }} {{ __('backend.state') }}</span>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('state') }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['state.store'],'method'=>'POST', 'files' => true,'enctype' => 'multipart/form-data', 'id' => 'stateForm' ])}}

                <div class="personal_informations">
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.state_name') !!}</label>
                        <div class="col-sm-10">
                            <input type="text" name="state_name" id="state_name" class="form-control" placeholder="State Name" value="{{old('state_name')}}" maxlength="100">
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('state_name'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('state_name') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.country') !!}</label>
                        <div class="col-sm-10">
                            <select name="country" id="country" value="" class="form-control">
                                <option value=>Select country</option>
                                @foreach ($country as $key => $value )
                                    <option value="{{$value->id}}" {{old('country') ? "selected" : "" }}>{{$value->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('country'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('country') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>


                    <div class="form-group row m-t-md">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary m-t" id="submitDetail"><i class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}</button>
                            <a href="{{ route('state')}}" class="btn btn-default m-t">
                                <i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}
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
        $(function () {
            $('.icp-auto').iconpicker({placement: '{{ (@Helper::currentLanguage()->direction=="rtl")?"topLeft":"topRight" }}'});
        });

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
    <script type="text/javascript">
       
        
    </script>
@endpush
