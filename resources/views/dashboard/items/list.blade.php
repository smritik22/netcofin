@extends('dashboard.layouts.master')
@section('title', __('backend.items'))
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css" />
    <div class="padding website-label">
        <div class="box">

            <div class="box-header dker">
                <h3>{{ __('backend.items') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <span>{{ __('backend.items') }}</span>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('item.create') }}">
                            <i class="material-icons">&#xe7fe;</i>
                            &nbsp; {{ __('backend.additems') }}
                        </a>
                    </li>

                </ul>
            </div>
            
            {{ Form::open(['route' => 'item.updateAll', 'method' => 'post', 'id' => 'updateAll']) }}
           
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
                <table class="table table-bordered m-a-0" id="program">
                    <thead class="dker">
                    <tr>
                        <th  class="width20 dker no-sort">
                            <label class="ui-check m-a-0">
                                <input id="checkAll" type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>{{ __('backend.topicName') }}</th>
                        <th>{{ __('backend.image') }}</th>
                        <th>{{ __('backend.category') }}</th>
                        <th>{{ __('backend.price') }}</th>
                        <th>{{ __('backend.discount') }}</th>
                        <th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
                        <th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($items_list) && count($items_list) >0)
                        @foreach($items_list as $type)
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
                                    @if($type->image !="")
                                        <div>
                                            <img src="{{ asset('uploads/items/'.$type->image) }}"
                                                 style="height: 50px; width:50px;" >
                                        </div>
                                    @endif
                                    </td>
                                    <td>
                                        {!! isset($type->category->name) ? urldecode($type->category->name) : '' !!} 
                                    </td>
                                    <td>
                                        {!! isset($type->price) ? $type->price : '' !!} 
                                    </td>
                                    <td>
                                        {!! isset($type->discount) ? $type->discount : '' !!} 
                                    </td>
                                    <td class="text-center">
                                        <i class="fa {{ ($type->status != '0') ? 'fa-check text-success':'fa-times text-danger' }} inline"></i>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm show-eyes list"
                                            href="{{ route('item.show',['id'=>encrypt($type->id)]) }}" title="Show">
                                            
                                        </a>

                                        <a class="btn btn-sm success"
                                           href="{{ route("item.edit",["id"=>encrypt($type->id)]) }}"
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
                                            <a href="{{ route('category.delete',['id'=>$type->id]) }}"
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
            <div id="delete_modal" class="modal fade" data-backdrop="true">
                <div class="modal-dialog" id="animate">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                        </div>
                        <div class="modal-body text-center p-lg">
                            <p>
                                {{ __('backend.confirmationDeleteMsg') }}
                                <br>
                                <strong id="show_name"> </strong>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark-white p-x-md"
                                data-dismiss="modal">{{ __('backend.no') }}</button>
                            <a href="javascript:void(0);"
                                class="btn danger confirmDelete p-x-md">{{ __('backend.yes') }}</a>
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
        $('#program').DataTable({
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
    </script>
@endpush
