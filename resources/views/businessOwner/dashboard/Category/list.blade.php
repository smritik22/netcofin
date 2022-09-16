@extends('businessOwner.dashboard.layouts.header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css" integrity="sha512-RvQxwf+3zJuNwl4e0sZjQeX7kUa3o82bDETpgVCH2RiwYSZVDdFJ7N/woNigN/ldyOOoKw8584jM4plQdt8bhA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="text/css" /> -->
    <div class="right-content">
        <div class="right-content-box">
        @include('businessOwner.dashboard.layouts.header_with_login')
            <div class="right-content-box2">
                <div class="row">
                    <div class="col-12">
                        <div class="section-headding-box sub_pages_box back-to-page menu-main-heading">
                            <h1 class="section-headding mb-0">Category</h1>
                            <a class="comman-btn" href="{{route('category.create')}}">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8.5H4" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M8 12.5L8 4.5" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                            Add Category
                        </a>
                        </div>
                    </div>
                </div>
                <div class="new-order-tabel-outer category-management">
                    <div class="manage-order-header">
                        <div class="manage-order-search">
                            
                        </div>
                    </div>
                    <div class="order-summary-preparing manage-order subcategory_order">
                        <div class="row">
                            <div class="col-12">
                                <div class="order-summary">
                                    <div class="new-order ">
                                        {{-- {{ Form::open(['route' => 'sub-category.updateAll', 'method' => 'post', 'id' => 'updateAll']) }} --}}

                                        
                                        {{-- <div class="new-order"> --}}
                                            <div class="">
                                                <table class="table student-list-table program-manage" id="general_users">
                                                    <thead>
                                                        <tr>
                                                            <th class="width20 dker">
                                                                <label class="ui-check m-a-0">
                                                                    <input id="checkAll"  type="checkbox"><i></i>
                                                                </label>
                                                            </th>
                                                            <th><p>&#9650;&#9660;{{ __('backend.category') }}</p></th>
                                                            <th><p>{{ __('backend.image') }}</p></th>
                                                            <th><p>&#9650;&#9660;{{ __('backend.tax') }}</p></th>
                                                            <th class="toggle_btn_head"><p>{{ __('backend.active/deactive') }}</p></th>
                                                            <th><p>{{ __('backend.action') }}</p></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        {{-- </div> --}}
                                        {{-- {{ Form::close() }} --}}
                            
                            
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
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        
    </div>
</div>
@extends('businessOwner.dashboard.layouts.footer')
<!-- <script>
    $(function() {
      $('.toggle').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var id = $(this).data('id'); 
           
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus',
              data: {'status': status, 'id': id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script> -->

<script type="text/javascript">
      $( document ).ready(function() {

$('.toggle').change(function() {

// console.log("data");
var status = $(this).prop('checked') == true ? 1 : 2; 
if($(this).prop('checked') == true){
    console.log("yes")
 }else{
    console.log("no")
 }
var user_id = $(this).data('id'); 
console.log(status,"status");
console.log(user_id,"user_id");
//     $.ajax({
//         type: "GET",
//         dataType: "json",
//         url: "{{ route('sub-category.statusUpdate')}}",
//         data: {'status': status, 'user_id': user_id},
//         success: function(data){
//             console.log(data.success)
//         }
});
});
// });



function deleteData(element) {
    let user_name = $(element).data('name');
    let href = $(element).data('href');

    $('#show_name').text(user_name);
    $('.confirmDelete').attr('href', href);
    $("#delete_modal").modal('show')
}
var csrf = "{{csrf_token()}}";
       
$(function() {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    load_data();

    function load_data() {
        var action_url = "{!! route('category.anyData') !!} ";
        // console.log(action_url)
        $("#general_users").DataTable().destroy()
        $('#general_users').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: true,
            columnDefs: [{
                'bSortable': false,
                'aTargets': [0,5]
            }],
            ajax: {
                url: action_url,
                type: 'POST',
                //data: { '_token' : "{{csrf_token()}}"},
               
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',

                },
                {
                    data: 'image',
                    name: 'image',

                },
                {
                    data: 'tax',
                    name: 'tax',

                },
                
                {
                    data: 'status',
                    name: 'status',

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
    $("#order_status_check").on('change', function(e) {
        console.log(e)
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        load_data();
    });
});


$(document).on('submit', '#updateAll', function(e) {

    e.preventDefault();
    var allVals = [];
    var check = false;

    var select_row = "{{ __('backend.select_row') }}";

    var select_status = "{{ __('backend.select_status') }}";

    var type = $(document).find('#action').val();

    if (type == 'no') {
        // alert('hello2')
        $(document).find('#alert_confirm').modal('show');
        $(document).find('#alert_confirm').find('.alert_dynamic_message').text(select_status);

    } else {
        // alert('hello')
        $(".has-value:checked").each(function() {

            var idvalue = $(this).attr('data-id');
            if (typeof idvalue === "undefined") {

            } else {
                allVals.push(idvalue);
            }
        });

        if (allVals.length <= 0) {

            $(document).find('#alert_confirm').modal('show');
            $(document).find('#alert_confirm').find('.alert_dynamic_message').text(select_row);
        } else {
            var msg = "";

            if (type == 0) {
                msg = "Are you sure you want to inactive this passenger?";

            } else if (type == 1) {
                msg = "Are you sure you want to active this passenger?";
            }else if (type == 2) {
                msg = "Are you sure you want to delete this passenger?";
            }
             else {
                msg = "Are you sure you want to delete this passenger?";
            }

            $(document).find('#default_confirm').modal('show');
            $(document).find('#default_confirm').find('.dynamic_message').text(msg);
            var join_selected_values = allVals.join(",");
            $(document).find('#default_confirm').find('.checkbox_data').val(join_selected_values);
            $(document).find('#default_confirm').find('.checkbox_type').val(type);

        }

    }
});

 $(document).on('click', '.yes_click', function(e) {
    var join_selected_values = $(document).find('#default_confirm').find('.checkbox_data').val();
    var type = $(document).find('#default_confirm').find('.checkbox_type').val();
    var csrf = "{{ csrf_token() }}";
    ajaxUpdateAll(csrf, join_selected_values, type);
});
$(document).on('click', '.delete-package', function(e) {
    e.preventDefault();
    var package_id = $(this).attr('data-id');
    var allVals = [];
    allVals.push(package_id);
    var type = 3;
    var msg = "Are you sure you want to delete?";

    $(document).find('#default_confirm').modal('show');
    $(document).find('#default_confirm').find('.dynamic_message').text(msg);
    var join_selected_values = allVals.join(",");
    $(document).find('#default_confirm').find('.checkbox_data').val(join_selected_values);
    $(document).find('#default_confirm').find('.checkbox_type').val(type);
});

function ajaxUpdateAll(csrf, join_selected_values, type) {
    // alert(join_selected_values);
    $.ajax({
        url: "{{ route('category.updateAll') }}",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: 'ids=' + join_selected_values + '&status=' + type,
        success: function(data) {

            if (data.success == true) {
                $('#success_file_popup').append(messages('alert-success', data.msg));
                setTimeout(function() {
                    $('#success_file_popup').empty();
                }, 5000);


                $(document).find('#default_confirm').modal('hide');
                var tabe = $('#general_users').DataTable();
                $(document).find('#action').prop('selectedIndex', 0);
                tabe.ajax.reload(null, false);
                $("#checkAll").prop('checked', false);

            } else {

                $('#success_file_popup').append(messages('alert-danger', data.error));

                setTimeout(function() {
                    $('#success_file_popup').empty();
                }, 5000);
            }
        },
        error: function(data) {

            alert(data.responseText);
        }
    });
}

function messages(classname, msg) {
    return '<div class="alert ' + classname +
        ' m-b-0"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>' +
        msg + '</div>';
}

            

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

function changeStatus(obj,status) {
                //  
                console.log("data",obj);
                console.log("status",status);
                var status = status != 1 ? 1 : 2;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('category.statusUpdate')}}",
                    data: {'status': status, 'id': obj},
                    success: function(data){
                        console.log(data.success)
                    }
                });

        }
</script>
