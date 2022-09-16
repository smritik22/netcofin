@extends('dashboard.layouts.master')
@section('title', __('backend.addGeneralUser'))
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">

    <link rel= "stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

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
                        &#xe02e;</i> {{ __('backend.addGeneralUser') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('generalusers') }}">{{ __('backend.general_user_mngmnt') }}</a> / 
                    <span>{{ __('backend.addGeneralUser') }}</span>

                </small>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['generaluser.store'],'method'=>'POST', 'files' => true,'enctype' => 'multipart/form-data', 'id' => 'userForm' ])}}
                {{ csrf_field() }}
                <div class="personal_informations">

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.full_name') !!}</label>
                        <div class="col-sm-10">
                            <input type="text" name="full_name" id="full_name" class="form-control"
                                placeholder="{{ __('backend.full_name') }}" value="{{ old('full_name') }}" >
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('full_name'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('full_name') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.email') !!}</label>
                        <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control"
                                placeholder="{{ __('backend.email') }}" maxlength="100" value="{{ old('email') }}">
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('email'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('email') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.mobile_number') !!}</label>

                        <div class="col-sm-2">
                            <select name="country_code" id="country_code" value="" class="form-control">
                                {{-- <option value=""></option> --}}
                                @foreach (\Helper::getCountryList() as $key => $value )
                                    <option value="{{$value->country_code}}" >{{$value->country_code}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-8">
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                                placeholder="{{ __('backend.mobile_number') }}" maxlength="15" value="{{ old('mobile_number') }}">
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('mobile_number'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('mobile_number') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo_file" class="col-sm-2 form-control-label">{!! __('backend.topicPhoto') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('photo', ['class' => 'form-control', 'id' => 'photo', 'accept' => 'image/*']) !!}
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!! __('backend.imagesTypes') !!}
                            </small>
                            <br>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('photo'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('photo') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row m-t-md">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary m-t" id="submitDetail"><i class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}</button>
                            <a href="{{ route('generalusers')}}" class="btn btn-default m-t">
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
    <script src="{{ asset('assets/dashboard/js/iconpicker/fontawesome-iconpicker.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/summernote/dist/summernote.js') }}"></script>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets/dashboard/js/inputFilter.js')}}"></script>


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


        $(document).ready(function() {
            $("#mobile_number").inputFilter(function(value) {
              return /^\d*$/.test(value);    // Allow digits only, using a RegExp
            });
        });

    </script>
@endpush
