@extends('dashboard.layouts.master')
@section('title', __('backend.cms'))
@section('content')
    {{-- @if(@Auth::user()->permissionsGroup->webmaster_status)
        @include('dashboard.permissions.list')
    @endif --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css" />  
    <div class="padding website-label">
        <div class="box">

            <div class="box-header dker">
                <h3>{{ __('backend.cms') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <span>{{ __('backend.cms') }}</span>
                </small>
            </div>

            {{-- @if( \Helper::check_permission(3,2) ) --}}
                <div class="box-tool">
                    <ul class="nav">
                        {{-- @if(@Auth::user()->permissionsGroup->webmaster_status) --}}
                            <li class="nav-item inline">
                            <a class="btn btn-fw primary" href="{{route('cms.create')}}">
                                        <i class="material-icons">&#xe7fe;</i>
                                        &nbsp; New CMS
                                    </a>
                            </li>
                        {{-- @endif --}}
                    </ul>
                </div>
            {{-- @endif --}}
            
            @if($cmsData == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center ">
                            {{ __('backend.noData') }}
                            <br>
                            {{-- @if(@Auth::user()->permissionsGroup->webmaster_status) --}}
                                <br>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            @endif

            @if($cmsData > 0)
            {{ Form::open(['route' => 'cms.updateAll', 'method' => 'post', 'id' => 'updateAll']) }}

                <div class="bulk-action">
                    <!-- <select name="action" id="action" class="form-control c-select w-sm inline v-middle" required>
                        <option value="no">{{ __('backend.bulkAction') }}</option>
                        <option value="activate">{{ __('backend.activeSelected') }}</option>
                        <option value="block">{{ __('backend.blockSelected') }}</option>
                        <option value="delete">{{ __('backend.deleteSelected') }}</option>
                    </select> -->
                    <!-- <button type="submit" class="btn white">{{ __('backend.apply') }}</button> -->
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0" id="cms">
                        <thead class="dker">
                        <tr>
                            <!-- <th class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th> -->
                            <th>{{ __('backend.topicCommentName') }}</th>
                            {{--  <th >CMS Description</th>  --}}
                            <th>{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                     

                        </tbody>
                    </table>

                </div>
              
            {{Form::close()}}
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
        
              var action_url = "{!!  route('cms.anyData') !!} ";
            
               $('#cms').DataTable({
                   processing: true,
                   serverSide: true,
                   responsive: true,
                   ordering: true,
                   columnDefs: [{
                       'bSortable': false,
                       'aTargets': [0,1]
                   }],
                   ajax: {
                       url : action_url,
                       type: 'POST',
                       data:{
                       
                       }
                   },
                   columns: [
                   {
                       data: 'name',
                       name: 'Name',
                      
                   },
                   {{--  {
                      data: 'description',
                      name: 'description',
                      orderable: false,
                      searchable: false
                   },  --}}
                  
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
