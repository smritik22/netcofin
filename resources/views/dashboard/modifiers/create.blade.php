@extends('dashboard.layouts.master')
@section('title', __('backend.addmodifiers'))
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
                        &#xe02e;</i> {{ __('backend.addmodifiers') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <span>{{ __('backend.addmodifiers') }}</span>

                </small>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['modifier.store'],'method'=>'POST', 'files' => true,'enctype' => 'multipart/form-data', 'id' => 'userForm' ])}}
                {{ csrf_field() }}
                <div class="personal_informations">

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.topicName') !!}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="{{ __('backend.topicName') }}" >
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('name'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('name') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.category') !!}</label>
                        <div class="col-sm-10">
                            <select name="category_id" id="category_id" value="" class="form-control">
                                <option value=>Select Category</option>
                                @foreach ($categories as $key => $value )
                                    <option value="{{$value->id}}" >{{$value->name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('category_id'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('category_id') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.price') !!}</label>
                        <div class="col-sm-4">
                            <input type="text" name="price" id="price" class="form-control"
                                placeholder="{{ __('backend.price') }}" >
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('price'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('price') }}</span>
                                @endif
                            </span>
                        </div>
                        <label class="col-sm-2 form-control-label">{!!  __('backend.discount') !!}</label>
                        <div class="col-sm-4">
                            <input type="text" name="discount" id="discount" class="form-control"
                                placeholder="{{ __('backend.discount') }}" value="{{old('discount')}}">
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('discount'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('discount') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="photo_file" class="col-sm-2 form-control-label">{!! __('backend.image') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'accept' => 'image/*']) !!}
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!! __('backend.imagesTypes') !!}
                            </small>
                            <br>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('image'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('image') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row m-t-md">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary m-t" id="submitDetail"><i class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}</button>
                            <a href="{{ route('modifiers')}}" class="btn btn-default m-t">
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
