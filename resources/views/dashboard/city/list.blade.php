@extends('dashboard.layouts.master')
@section('title', __('backend.city'))
@section('content')
<style>
    .table.dataTable thead .sorting_asc{
        background-image :  url();
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css" />
    <div class="padding website-label">
        <div class="box">

            <div class="box-header dker">
                <h3>{{ __('backend.city') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <span>{{ __('backend.city') }}</span>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('city.create') }}">
                            <i class="material-icons">&#xe7fe;</i>
                            &nbsp; {{ __('backend.addcity') }}
                        </a>
                    </li>

                </ul>
            </div>
            
            {{ Form::open(['route' => 'city.updateAll', 'method' => 'post', 'id' => 'updateAll']) }}
           
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
                    <table class="table table-bordered m-a-0" id="country">
                        <thead class="dker">
                            <tr>
                                <th  class="width20 dker no-sort">
                                    <label class="ui-check m-a-0">
                                        <input id="checkAll" type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>{{ __('backend.city_name') }}</th>
                                <th>{{ __('backend.country_name') }}</th>
                                <th>{{ __('backend.state') }}</th>
                                <th>{{ __('backend.status') }}</th>
                                <th>{{ __('backend.options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($city_list) && count($city_list) >0)
                                @foreach($city_list as $type)
                                        <tr>
                                            <td class="dker"><label class="ui-check m-a-0">
                                                    <input type="checkbox" name="ids[]" value="{{ $type->id }}" id="checkforall"><i
                                                        class="dark-white"></i>
                                                    {!! Form::hidden('row_ids[]',$type->id, array('class' => 'form-control row_no')) !!}
                                                </label>
                                            </td>
                                            <td class="h6">
                                                {!! isset($type->name) ? urldecode($type->name) : '' !!} 
                                            </td>
                                            <td class="h6">
                                                {!! isset($type->Country->name) ? urldecode($type->Country->name) : '' !!} 
                                            </td>
                                            <td class="h6">
                                                {!! isset($type->State->name) ? urldecode($type->State->name) : '' !!} 
                                            </td>
                                            <td class="text-center">
                                                <i class="fa {{ ($type->status != '0') ? 'fa-check text-success':'fa-times text-danger' }} inline"></i>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-sm show-eyes list"
                                                    href="{{ route('city.show',['id'=>encrypt($type->id)]) }}" title="Show">
                                                    
                                                </a>

                                                <a class="btn btn-sm success"
                                                href="{{ route("city.edit",["id"=>encrypt($type->id)]) }}"
                                                data-toggle="tooltip" data-original-title="{{ __('backend.edit') }}">
                                                    <i class="material-icons">&#xe3c9;</i>
                                                </a>
                                            </td>
                                        </tr>
                                    
                                    <!-- .modal -->
                                    <div id="m-{{ $type->id }}" class="modal fade" data-backdrop="true">
                                        <div class="modal-dialog" id="animate">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                                </div>
                                                <div class="modal-body text-center p-lg">
                                                    <p>
                                                        {{ __('backend.confirmationDeleteMsg') }}
                                                        <br>
                                                        <strong>[ {{ isset($type->name) ? $type->name : '' }} ]</strong>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark-white p-x-md"
                                                            data-dismiss="modal">{{ __('backend.no') }}</button>
                                                    <a href="{{ route('city.delete',['id'=>$type->id]) }}"
                                                        class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div>
                                    </div>
                                    <!-- / .modal -->
                                @endforeach
                            @endif
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
                                        <button type="submit" class="btn danger p-x-md">{{ __('backend.yes') }}</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- .modal -->
            <div id="country_delete_modal" class="modal fade" data-backdrop="true">
                <div class="modal-dialog" id="animate">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                        </div>
                        <div class="modal-body text-center p-lg">
                            <p>
                                {{ __('backend.confirmationDeleteMsg') }}
                                <br>
                                <strong id="show_country_name"> </strong>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark-white p-x-md"
                                data-dismiss="modal">{{ __('backend.no') }}</button>
                            <a href="javascript:void(0);"
                                class="btn danger confrimDeletCountry p-x-md">{{ __('backend.yes') }}</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </div>
            <!-- / .modal -->


        </div>
    </div>
@endsection
@push('after-scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
         $( document ).ready(function() {
            if($('.no-sort').hasClass('sorting_disabled')){
                $('.no-sort').removeClass('sorting_asc')
            }
        });
        function deleteCountry(element) {
            let user_name = $(element).data('name');
            let href = $(element).data('href');

            $('#show_country_name').text(user_name);
            $('.confrimDeletCountry').attr('href', href);
            $("#country_delete_modal").modal('show')
        }
        $('#country').DataTable({
             'columnDefs': [{
                'orderable': false,
                 'targets': [ 0,-1 ]
             }],
        });
       
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function() {
            {{-- if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            } --}}
        });


        $("#filter_btn").click(function() {
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
