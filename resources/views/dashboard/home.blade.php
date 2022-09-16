@extends('dashboard.layouts.master')
@section('title','Dashboard')
@push("after-styles")
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/flags.css') }}" type="text/css"/>
    <style>
        .upskild-dashboard .card-graphs canvas.chartjs-render-monitor {
            height: 400px !important;
        }
    </style>
@endpush
@section('content')
<?php 
use App\Models\User;
?>
    <div class="padding p-b-0 upskild-dashboard">
        <div class="margin">
            <div class="row">
                 <div class="col-xs-6">
                <h5 class="m-b-0 _300">{{ __('backend.hi') }} <span
                        class="text-primary">{{ Auth::user()->name }}</span>, {{ __('backend.welcomeBack') }}
                </h5>
                </div>
                 <div class="col-xs-6">
                <form action="{{ route('dashboardfilter')}}" method="post" style="padding-left: %;">
                    @csrf
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Start Date" required="required" value="{!! isset($start) ? $start : '' !!}" style="color: #001645;font-weight:500;width: 200px;margin-right: 8px;">
                        <input type="text" name="end_date" id="end_date" class="form-control" placeholder="End Date" required="required" value="{!! isset($end) ? $end : '' !!}" style="color: #001645;font-weight:500;width: 200px;margin-right: 8px;" >    
                       
                        <input type="submit" name="filter_submit" class="btn btn-primary" value="Filter" />
                        <a href="{{ route('adminHome')}}"><input type="button" name="clear" class="btn btn-danger" value="Clear"  /></a>
                </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                
                    <div class="col-xs-4">
                        <div class="box p-a" style="cursor: pointer">
                            <a href="{{route('generalusers')}}">
                                <div class="pull-left m-r">
                                   <i class="fa fa-users material-icons text-2x m-y-sm" aria-hidden="true"></i>
                                </div>
                                <div class="clear">
                                    <div class="text-muted">Users Registered</div>
                                        <h4 class="m-a-0 text-md _600">{{ isset($total_users) ? $total_users : '' }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="box p-a" style="cursor: pointer">
                            <a href="{{route('subscription_plans')}}">
                                <div class="pull-left m-r">
                                    <i class="fa fa-rocket material-icons  text-2x m-y-sm" aria-hidden="true"></i>
                                </div>
                                <div class="clear">
                                    <div class="text-muted">Total Subscription Plans</div>
                                        <h4 class="m-a-0 text-md _600">{{ isset($subscriptions_number) ? $subscriptions_number : '' }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="box p-a" style="cursor: pointer">
                            <a href="{{route('revenue_report')}}">
                                <div class="pull-left m-r">
                                    <i class="fa fa-money-bill-wave material-icons  text-2x m-y-sm" aria-hidden="true"></i>
                                </div>
                                <div class="clear">
                                    <div class="text-muted">Total Revenue Generated</div>
                                        <h4 class="m-a-0 text-md _600">{{ (isset($revenue_generated) && $revenue_generated > 0) ? $revenue_generated : '0' . ' ' . Helper::getDefaultCurrency() }}$</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-xs-12">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                
                    <div class="col-xs-4">
                        <div class="box p-a" style="cursor: pointer">
                            <a href="{{route('businessOwners')}}">
                                <div class="pull-left m-r">
                                   <i class="fa fa-users material-icons text-2x m-y-sm" aria-hidden="true"></i>
                                </div>
                                <div class="clear">
                                    <div class="text-muted">{{ __('backend.business_owner') }}</div>
                                        <h4 class="m-a-0 text-md _600">{{ isset($total_busineowners) ? $total_busineowners : '' }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="box p-a" style="cursor: pointer">
                            <a href="{{route('admin.categories')}}">
                                <div class="pull-left m-r">
                                    <i class="fa fa-rocket material-icons  text-2x m-y-sm" aria-hidden="true"></i>
                                </div>
                                <div class="clear">
                                    <div class="text-muted">{{ __('backend.categories') }}</div>
                                        <h4 class="m-a-0 text-md _600">{{ isset($total_categories) ? $total_categories : '' }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="box p-a" style="cursor: pointer">
                            <a href="{{route('admin.sub-categories')}}">
                                <div class="pull-left m-r">
                                    <i class="fa fa-money-bill-wave material-icons  text-2x m-y-sm" aria-hidden="true"></i>
                                </div>
                                <div class="clear">
                                    <div class="text-muted">{{ __('backend.subCategory') }}</div>
                                        <h4 class="m-a-0 text-md _600">{{ isset($total_subcategories) ? $total_subcategories : '' }}</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-xs-12">
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="card-head">
                            <h6>Users</h6>
                        </div>
                         <div  style="width: 300px; height: 300px; " class="card-graphs">
                           {!! $userProfileGraph->container() !!}
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                            {!! $userProfileGraph->script() !!}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="card-head">
                            <h6>Total Revenue</h6>
                        </div>
                         <div  style="width: 600px; height: 300px; " class="card-graphs card-cart">
                           {!! $revenueChart->container() !!}
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                            {!! $revenueChart->script() !!}
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="card-head">
                        <h6>Registered {{ __('backend.business_owner') }}</h6>
                    </div>
                        <div  style="width: 600px; height: 300px; " class="card-graphs card-cart">
                           {!! $businessownerChart->container() !!}
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                            {!! $businessownerChart->script() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("after-scripts")


<link href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        $("#start_date").datepicker({
            format: 'dd-mm-yyyy',
        });

        $("#end_date").datepicker({
            format: 'dd-mm-yyyy',
        });
    </script>  
@endpush