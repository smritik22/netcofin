@extends('dashboard.layouts.master')
@section('title', __('backend.add_featured_addons'))
@push('after-styles')
    <link href="{{ asset('assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />

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
                        &#xe02e;</i> {{ __('backend.add_featured_addons') }}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('featured_addons') }}">{{ __('backend.featured_addons') }}</a> /
                    <span>{{ __('backend.add_featured_addons') }}</span>
                </small>
            </div>

            <div class="box-body">
                {{ Form::open(['route' => ['featured_addon.store'],'method' => 'POST','files' => true,'enctype' => 'multipart/form-data','id' => 'featured_addonForm']) }}

                @csrf
                <div class="personal_informations">

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">{!! __('backend.no_of_extra_featured_post') !!}</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_of_extra_featured_post" id="no_of_extra_featured_post" class="form-control" onkeydown="return restrictInput(this,event,'digits')"
                                placeholder="{{ __('backend.no_of_extra_featured_post') }}" value="{{ old('no_of_extra_featured_post') }}"
                                maxlength="5">

                            <span class="help-block">
                                @if (!empty(@$errors) && @$errors->has('no_of_extra_featured_post'))
                                    <span style="color: red;" class='validate'>{{ $errors->first('no_of_extra_featured_post') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">{!! __('backend.extra_each_featured_post_price') !!}</label>
                        <div class="col-sm-9">
                            <input type="text" name="extra_each_featured_post_price" id="extra_each_featured_post_price" class="form-control decimal"
                                placeholder="{{ __('backend.extra_each_featured_post_price') }}" value="{{ old('extra_each_featured_post_price') }}"
                                maxlength="15">

                            <span class="help-block">
                                @if (!empty(@$errors) && @$errors->has('extra_each_featured_post_price'))
                                    <span style="color: red;" class='validate'>{{ $errors->first('extra_each_featured_post_price') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">{!! __('backend.subscription_plan_duration') !!}</label>
                        <div class="col-sm-6">
                            <input type="text" name="plan_duration_value" id="plan_duration_value" class="form-control"
                                placeholder="{{ __('backend.subscription_plan_duration') }}" value="{{ old('plan_duration_value', @$subscription_plan->plan_duration_value) }}"
                                maxlength="4" onkeydown="return restrictInput(this,event,'digits')">

                            <span class="help-block">
                                @if (!empty(@$errors) && @$errors->has('plan_duration_value'))
                                    <span style="color: red;" class='validate'>{{ $errors->first('plan_duration_value') }}</span>
                                @endif
                            </span>
                        </div>
                        <div class="col-sm-3">
                            <select name="plan_duration_type" id="plan_duration_type" class="form-control" value="{{old('plan_duration_type', @$subscription_plan->plan_duration_type)}}">
                                @foreach (config('constants.PLAN_DURATION_TYPE') as $key => $item)
                                    <option value="{{$key}}" {{old('plan_duration_type', @$subscription_plan->plan_duration_type) == $key? "selected" : "" }}>{{Helper::getLabelValueByKey($item['label_key'])}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--  <div class="col-sm-10">
                            <select name="duration_type" id="duration_type" class="form-control" value="{{old('duration_type')}}">
                                <option value="1">1 Day</option>
                                <option value="2">1 Week</option>
                                <option value="3">1 Month</option>
                                <option value="4">3 Months</option>
                                <option value="5">6 Months</option>
                                <option value="6">1 Year</option>
                            </select>
                        </div>  --}}
                    </div>

                </div>

                <div class="form-group row m-t-md">
                    <div class="offset-sm-3 col-sm-9">
                        <button type="submit" class="btn btn-primary m-t" id="submitDetail"><i
                                class="material-icons">&#xe31b;</i> {!! __('backend.add') !!}</button>
                        <a href="{{ route('featured_addons') }}" class="btn btn-default m-t">
                            <i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}
                        </a>
                    </div>
                </div>


                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script src="{{ asset('assets/dashboard/js/iconpicker/fontawesome-iconpicker.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/summernote/dist/summernote.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



    <script>
        $(function() {
            $('.icp-auto').iconpicker({
                placement: '{{ @Helper::currentLanguage()->direction == 'rtl' ? 'topLeft' : 'topRight' }}'
            });
        });

        // update progress bar
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                $('progress').attr({
                    value: e.loaded,
                    max: e.total
                });
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
