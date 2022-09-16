@extends('dashboard.layouts.master')
@section('title', __('backend.label'))
@section('content')
    {{-- @if(@Auth::user()->permissionsGroup->webmaster_status)
        @include('dashboard.permissions.list')
    @endif --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css" />  
    <div class="padding website-label">
        <div class="box">

            <div class="box-header dker">
                <h3>{{ __('backend.label') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <span>{{ __('backend.label') }}</span>
                </small>
            </div>

            <div class="box-tool">
                <ul class="nav">
                    @if($label > 0)
                        {{-- @if( \Helper::check_permission(5,2) ) --}}
                            <li class="nav-item inline">
                                <a class="btn btn-fw primary" href="{{route('label.create')}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ __('backend.newLabel') }}
                                </a>
                            </li>
                        {{-- @endif --}}
                            
                    @endif
                </ul>
            </div>

               
            @if($label == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center ">
                            {{ __('backend.noData') }}
                            <br>
                            {{-- @if(\Helper::check_permission(5,2)) --}}
                                <br>
                                <a class="btn btn-fw primary" href="{{route('label.create')}}">
                                    <i class="material-icons">&#xe7fe;</i>
                                    &nbsp; {{ __('backend.newLabel') }}
                                </a>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            @endif

            @if($label > 0)
            {{ Form::open(['route' => 'labelUpdateAll', 'method' => 'post', 'id' => 'updateAll']) }}

                <div class="bulk-action">
                    <select name="action" id="action" class="form-control c-select w-sm inline v-middle" required>
                        <option value="no">{{ __('backend.bulkAction') }}</option>
                        <option value="activate">{{ __('backend.activeSelected') }}</option>
                        <option value="block">{{ __('backend.blockSelected') }}</option>
                        <option value="delete">{{ __('backend.deleteSelected') }}</option>
                    </select>
                    <button type="submit" class="btn white">{{ __('backend.apply') }}</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered m-a-0" id="label">
                        <thead class="dker">
                        <tr>
                            <th class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>{{ __('backend.labelKey') }}</th>
                            <th>{{ __('backend.labelValue') }}</th>
                            <th>{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                      

                        </tbody>
                    </table>
                </div>
                {{ Form::close() }}
                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <!-- .modal -->
                            <div id="m-all" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <button type="submit"
                                                    class="btn danger p-x-md">{{ __('backend.yes') }}</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                            {{-- <!-- @if( \Helper::check_permission(5,3) )
                                <select name="action" id="action" class="form-control c-select w-sm inline v-middle"
                                        required>
                                    <option value="">{{ __('backend.bulkAction') }}</option>
                                    <option value="activate">{{ __('backend.activeSelected') }}</option>
                                    <option value="block">{{ __('backend.blockSelected') }}</option>
                                    {{- @if(\Helper::check_permission(5,4)) -}}
                                        <option value="delete">{{ __('backend.deleteSelected') }}</option>
                                    {{- @endif -}}
                                </select>
                                <button type="submit" id="submit_all"
                                        class="btn white">{{ __('backend.apply') }}</button>
                                <button id="submit_show_msg" class="btn white" data-toggle="modal"
                                        style="display: none"
                                        data-target="#m-all" ui-toggle-class="bounce"
                                        ui-target="#animate">{{ __('backend.apply') }}
                                </button>
                            @endif --> --}}
                        </div>

                      
                        <div class="col-sm-6 text-right text-center-xs">
                           
                        </div>
                    </div>
                </footer>
            @endif
        </div>
    </div>
@endsection
@push("after-scripts")
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function() {
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           load_data();
           function load_data() 
           {
        
              var action_url = "{!!  route('label.anyData') !!} ";
            
               $('#label').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ordering: true,
                    columnDefs: [{
                       'bSortable': false,
                       'aTargets': [0,3]
                    }],
                   ajax: {
                       url : action_url,
                       type: 'POST',
                       data:{
                       
                       }
                   },
                   columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false
                    },
                   {
                       data: 'labelname',
                       name: 'labelname',
                       
                   },
                   {
                      data: 'labelvalue',
                      name: 'labelvalue',
                   },
                  
                   {
                       data: 'options',
                       orderable: false,
                       searchable: false
                   }
                   ],
                   order: ['0', 'DESC']
               });
           }
        
        });
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });


        $("#filter_btn").click(function () {
            $("#filter_div").slideToggle();
        });

        $("#find_q").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#doctorTypeTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endpush
