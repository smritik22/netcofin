@extends('dashboard.layouts.master')
@section('title', __('backend.edititems'))
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
                        &#xe02e;</i> {{ __('backend.edititems') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('items') }}">{{ __('backend.items') }}</a> / 
                    <span>{{ __('backend.edititems') }}</span>

                </small>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['item.update',$items[0]->id],'method'=>'POST', 'files' => true,'enctype' => 'multipart/form-data', 'id' => 'userForm' ])}}
                {{ csrf_field() }}
                <div class="personal_informations">

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.topicName') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('name', old('name',urldecode($items[0]->name)), ['class' => 'form-control', 'id' => 'name', 'maxlength' => '100']) !!}
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('name'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('name') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.business_owner') !!}</label>
                        <div class="col-sm-10">
                            <select name="business_owner" id="business_owner" value="" class="form-control">
                                @foreach ($business_owners as $key => $value )
                                    <option value="{{$value->id}}" {{old('business_owner', $items[0]->business_owner_id) == $value->id? "selected" : "" }}>{{$value->full_name}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('business_owner'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('business_owner') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.category') !!}</label>
                        <div class="col-sm-4">
                            <select name="category" id="category" value="" class="form-control">
                                <option value="{{$items[0]->category_id}}" selected>{{$items[0]->category_name}}</option>
                            </select>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('category'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('category') }}</span>
                                @endif
                            </span>
                        </div>
                        <label class="col-sm-2 form-control-label">{!!  __('backend.subCategory') !!}</label>
                        <div class="col-sm-4">
                            <select name="subcategory" id="subcategory" value="" class="form-control">
                                <option value="{{$items[0]->sub_category_id}}" selected>{{$items[0]->subcategory_name}}</option>
                            </select>
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('subcategory'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('subcategory') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!!  __('backend.price') !!}</label>
                        <div class="col-sm-4">
                            {!! Form::text('price', old('price',urldecode($items[0]->price)), ['class' => 'form-control', 'id' => 'price', 'maxlength' => '100']) !!}
                            <span class="help-block">
                                @if(!empty(@$errors) && @$errors->has('price'))
                                    <span  style="color: red;" class='validate'>{{ $errors->first('price') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">{!! __('backend.description') !!}</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="{{ __('backend.description') }}">{{ old('description',$items[0]->description) }}</textarea>

                            <span class="help-block">
                                @if (!empty(@$errors) && @$errors->has('description'))
                                    <span style="color: red;" class='validate'>{{ $errors->first('description') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo_file" class="col-sm-2 form-control-label">{!! __('backend.topicPhoto') !!}</label>
                        <div class="col-sm-10">
                            @if ($items[0]->image != '')
                                <div class="row">
                                    <div class="col-sm-12 images">
                                        <div id="user_photo" class="col-sm-4 box p-a-xs">
                                            <a target="_blank" href="{{ $image_url . $items[0]->image }}"><img
                                                    src="{{ $image_url . $items[0]->image }}" class="img-responsive" style="width:200px; height:200px">
                                            </a>
                                            <br>
                                            <div class="delete">
                                                <a onclick="document.getElementById('user_photo').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                                    class="btn btn-sm btn-default">{!! __('backend.delete') !!}</a>
                                                {{ $items[0]->image }}
                                            </div>
                                        </div>
                                        <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                            <a
                                                onclick="document.getElementById('user_photo').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                                <i class="material-icons">&#xe166;</i> {!! __('backend.undoDelete') !!}
                                            </a>
                                        </div>
    
                                        {!! Form::hidden('photo_delete', '0', ['id' => 'photo_delete']) !!}
                                    </div>
                                </div>
                            @endif
    
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
                            <button type="submit" class="btn btn-primary m-t" id="submitDetail"><i class="material-icons">&#xe31b;</i> {!! __('backend.update') !!}</button>
                            <a href="{{ route('items')}}" class="btn btn-default m-t">
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

            $("#business_owner").change(function()
            {
                var id=$(this).val();
                console.log("1:"+id);

                var dataString = {'id':id};
                console.log("2:"+dataString);
                $.ajax
                ({
                type: "POST",
                url: "{{route('item.categories')}}",
                data: {'id':id},
                cache: false,
                success: function(data)
                {
                console.log("3:"+data);
                    $('#category').empty().append(JSON.parse(data));
                } 
                });

            });
            $("#category").change(function()
            {
                var id=$(this).val();
                var busineowner_id=$('#business_owner').val();
                console.log("1:"+id);

                var dataString = {'busineowner_id':busineowner_id,'id':id};
                console.log("2:"+dataString);
                $.ajax
                ({
                type: "POST",
                url: "{{route('item.subcategories')}}",
                data: {'id':id},
                cache: false,
                success: function(data)
                {
                console.log("3:"+data);
                    $('#subcategory').empty().append(JSON.parse(data));
                } 
                });

            });
        });

    </script>
@endpush
