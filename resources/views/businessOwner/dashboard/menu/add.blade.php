@include('businessOwner.dashboard.layouts.header')
			<div class="right-content">
				
				<div class="right-content-box">
                    @include('businessOwner.dashboard.layouts.header_with_login')
                    <div class="back-to-page">
                        <a href="menu.php">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8206 18.8894L9.44472 11.9993L15.8206 5.10916C15.9348 4.98605 15.9987 4.8208 15.9987 4.64871C15.9987 4.47663 15.9348 4.31137 15.8206 4.18827C15.7652 4.12866 15.699 4.08131 15.626 4.04898C15.553 4.01665 15.4745 4 15.3953 4C15.3161 4 15.2377 4.01665 15.1646 4.04898C15.0916 4.08131 15.0254 4.12866 14.97 4.18827L8.18577 11.5182C8.06666 11.6469 8 11.8195 8 11.9993C8 12.1791 8.06666 12.3517 8.18577 12.4804L14.9687 19.8103C15.0242 19.8703 15.0905 19.9181 15.1638 19.9506C15.2371 19.9832 15.3158 20 15.3953 20C15.4749 20 15.5536 19.9832 15.6269 19.9506C15.7001 19.9181 15.7665 19.8703 15.8219 19.8103C15.9361 19.6872 16 19.522 16 19.3499C16 19.1778 15.9361 19.0125 15.8219 18.8894L15.8206 18.8894Z" fill="black" stroke="black" stroke-width="0.5"/>
                            </svg>
                        </a>
                        <h1 class="section-headding">Menu</h1>
                    </div>
                    {{-- {{Form::open(['route'=>['menu.store'],'method'=>'POST', 'files' => true,'enctype' => 'multipart/form-data', 'id' => 'menuForm' ])}} --}}
                    
                        <div class="right-content-box-bottom">
                        {{-- <form action="{{route("menu.store")}}" enctype = "multipart/form-data" method="POST" id= "menuForm" > --}}
                            <div class="add-menu-img">
                                <h5>Add Item Image</h5>
                                <div class="yes">
                                    <span class="btn_upload">
                                        <input type="file" id="imag" title="" class="input-img" name="image"/>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.75 10.75H13.25V3.25C13.25 2.91848 13.1183 2.60054 12.8839 2.36612C12.6495 2.1317 12.3315 2 12 2C11.6685 2 11.3505 2.1317 11.1161 2.36612C10.8817 2.60054 10.75 2.91848 10.75 3.25V10.75H3.25C2.91848 10.75 2.60054 10.8817 2.36612 11.1161C2.1317 11.3505 2 11.6685 2 12C2 12.3315 2.1317 12.6495 2.36612 12.8839C2.60054 13.1183 2.91848 13.25 3.25 13.25H10.75V20.75C10.75 21.0815 10.8817 21.3995 11.1161 21.6339C11.3505 21.8683 11.6685 22 12 22C12.3315 22 12.6495 21.8683 12.8839 21.6339C13.1183 21.3995 13.25 21.0815 13.25 20.75V13.25H20.75C21.0815 13.25 21.3995 13.1183 21.6339 12.8839C21.8683 12.6495 22 12.3315 22 12C22 11.6685 21.8683 11.3505 21.6339 11.1161C21.3995 10.8817 21.0815 10.75 20.75 10.75Z" fill="#4E4E4E"/>
                                        </svg>
                                    </span>
                                    <img id="ImgPreview" src="" class="preview1" />
                                    <div class="removeadd-img-menu">
                                        <input type="button" id="removeImage1" value="x" class="btn-rmv1" name="image"/>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-add-iteam-information">
                                <h5>Add Item Information</h5>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <select class="form-select floating-select form-control" onclick="this.setAttribute('value', this.value);" value="1" id="category_id" name="category_id">
                                                <option>Select Category </option>
                                            @foreach ($category as $key => $value )
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                {{-- <input type="hidden" id="category_id" name="category_id" value="{{$value->id}}"> --}}
                                            @endforeach
                                            </select>
                                            <span class="highlight"></span>
                                            <label>Category</label>
                                            @if ($errors->has('category_id'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_category_id" class='validate'>{{ $errors->first('category_id') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <select class="form-select floating-select form-control" onclick="this.setAttribute('value', this.value);" value="1"  id="sub_category_id" name="sub_category_id">
                                            
                                            </select>
                                            <span class="highlight"></span>
                                            <label>Sub Category</label>
                                            @if ($errors->has('sub_category_id'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_sub_category_id" class='validate'>{{ $errors->first('sub_category_id') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <input class="floating-input form-control" type="text" value="#ABC08" placeholder=" " name="item_id">
                                            <span class="highlight"></span>
                                            <label>Item ID</label>
                                            @if ($errors->has('item_id'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_item_id" class='validate'>{{ $errors->first('item_id') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <input class="floating-input form-control" type="text" placeholder=" " name="name">
                                            <span class="highlight"></span>
                                            <label>Item Name</label>
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_name" class='validate'>{{ $errors->first('name') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <input class="floating-input form-control" type="text" placeholder=" " name="price">
                                            <span class="highlight"></span>
                                            <label>Item Price</label>
                                            @if ($errors->has('price'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_price" class='validate'>{{ $errors->first('price') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <input class="floating-input form-control" type="text" placeholder=" " name="item_preparing_time">
                                            <span class="highlight"></span>
                                            <label>Item Preparing Time</label>
                                            @if ($errors->has('item_preparing_time'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_item_preparing_time" class='validate'>{{ $errors->first('item_preparing_time') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <select class="form-select floating-select form-control" onclick="this.setAttribute('value', this.value);" value="" name="tax_name">
                                                <option></option>
                                                <option>Select Tax 1</option>
                                                <option>Select Tax 2</option>
                                                <option>Select Tax 3</option>
                                                <option>Select Tax 4</option>
                                                <option>Select Tax 5</option>
                                            </select>
                                            <span class="highlight"></span>
                                            <label>Select Tax </label>
                                            @if ($errors->has('tax_name'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_tax_name" class='validate'>{{ $errors->first('tax_name') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class=" floating-label">
                                            <input class="floating-input form-control" type="text" placeholder=" " name="tax">
                                            <span class="highlight"></span>
                                            <label>Tax </label>
                                            @if ($errors->has('tax'))
                                            <span class="help-block">
                                                <span style="color: red;" id="error_tax" class='validate'>{{ $errors->first('tax') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="add-menu0item-textarea">
                                            <div class="floating-label textarea">      
                                                <textarea class="floating-input" placeholder=" " name="description"></textarea>
                                                <span class="highlight"></span>
                                                <label>Restaurant Description</label>
                                                @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <span style="color: red;" id="error_description" class='validate'>{{ $errors->first('description') }}</span>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-add-iteam-information me-0">
                                <h5 >Add Item Option</h5>
                                <div class="row">
                                    <div class="col-md-12 " id="table_body">
                                        <div class="right-content-wrapper-date-time mb-0" id="right-content-wrapper-date-time">
                                            <div class="row w-100">
                                                <div class="col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <input class="floating-input form-control" type="text" placeholder=" " name="item_name">
                                                            <span class="highlight"></span>
                                                            <label>Option Name</label>
                                                            @if ($errors->has('item_name'))
                                                            <span class="help-block">
                                                                <span style="color: red;" id="error_item_name" class='validate'>{{ $errors->first('item_name') }}</span>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <input class="floating-input form-control" type="text" placeholder=" " name="item_price">
                                                            <span class="highlight"></span>
                                                            <label>Price</label>
                                                            @if ($errors->has('item_price'))
                                                            <span class="help-block">
                                                                <span style="color: red;" id="error_item_price" class='validate'>{{ $errors->first('item_price') }}</span>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close-date-time close-date-time-btn mb-0 add-section-btn">
                                                <button type="button" onclick="create_tr('table_body')" >
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 12H6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M12 18L12 6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="close-date-time close-date-time-btn mb-0 remove-section-btn" >
                                                <button type="button" onclick="remove_tr(this)">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 12H6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- <form action="{{route("menu.store")}}" enctype = "multipart/form-data" method="POST" id= "menuForm" > --}}
                            <h5 class="menu-add-iteam-information-mt-0 mb-4">Add Item Addons Category</h5>
                            <div class="menu-add-iteam-information me-0" id="table_body1">
                                <div class="right-content-wrapper-date-time mb-0" id="right-content-wrapper-date-time">
                                    <div class="row w-100 add-item-addons-outer">
                                        <div class="col-sm-6 ">
                                            <div class="right-input menu-add-iteam-padding">
                                                <div class=" floating-label">
                                                    <input class="floating-input form-control addons_category" type="text" placeholder=" " name="addons_category[]" id="addons_category">
                                                    <span class="highlight"></span>
                                                    <label>Option Name</label>
                                                    @if ($errors->has('addons_category'))
                                                    <span class="help-block">
                                                        <span style="color: red;" id="error_addons_category" class='validate'>{{ $errors->first('addons_category') }}</span>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 add-item-addons-button">
                                            <div class="close-date-time close-date-time-btn mb-0 add-section-btn">
                                                <button type="button" class="ms-0 item_prices" onclick="create_tr1('table_body1')">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 12H6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M12 18L12 6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="close-date-time close-date-time-btn mb-0 remove-section-btn">
                                                <button type="button" class="ms-0 item_p" onclick="remove_tr1(this)" id="items_pp" >
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 12H6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary m-t">Add</button>
                                </div>
                            </div>
                        {{-- </form> --}}
                            <div class="menu-add-iteam-information me-0">
                                <h5 class="menu-add-iteam-information-mt-0">Add Item Option</h5>
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="right-content-wrapper-date-time mb-0">
                                            <div class="row w-100">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <select class="form-select floating-select" onclick="this.setAttribute('value', this.value);" value="1" name="select_item_name">
                                                                <!-- <option value="" selected="" disabled="" hidden=""></option> -->
                                                                <option selected="" value="1">Toppings-Veg (Giant Slice)</option>
                                                                @foreach ($items as $key => $value )
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="highlight"></span>
                                                            <label>Add on items</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <input class="floating-input form-control" type="text" value="Baby Corns" placeholder=" " name="add_item_name">
                                                            <span class="highlight"></span>
                                                            <label>Add on Item Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <input class="floating-input form-control" type="text" value="$5.02" placeholder=" " name="add_item_price">
                                                            <span class="highlight"></span>
                                                            <label>Add on Item Price</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close-date-time close-date-time-btn mb-0">
                                                <button>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 12H6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M12 18L12 6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="right-content-wrapper-date-time mb-0">
                                            <div class="row w-100">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <select class="form-select floating-select" onclick="this.setAttribute('value', this.value);" value="">
                                                                <!-- <option value="" selected="" disabled="" hidden=""></option> -->
                                                                <option value=""></option>
                                                                @foreach ($category as $key => $value )
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="highlight"></span>
                                                            <label>Select Add on Category</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <input class="floating-input form-control" type="text" placeholder=" " >
                                                            <span class="highlight"></span>
                                                            <label>Add on Item Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="right-input">
                                                        <div class=" floating-label">
                                                            <input class="floating-input form-control" type="text" placeholder=" ">
                                                            <span class="highlight"></span>
                                                            <label>Add on Item Price</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close-date-time close-date-time-btn mb-0">
                                                <button>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 12H6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                        <path d="M12 18L12 6" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button_group">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="button_group">
                                    <button type="submit" class="btn btn-primary m-t">Submit</button>
                                    <a href="{{ route('menu')}}" class="btn btn-default m-t comman-btn">
                                        <i class="material-icons">
                                        &#xe5cd;</i> {!! __('backend.cancel') !!}
                                    </a>
                                </div>
                            </div>
                            </div>
                        </div>
                    {{-- {{Form::close()}} --}}
                    </form>
				</div>
			</div>

@include('businessOwner.dashboard.layouts.footer')
{{-- <script src="{{ asset('js/components/pizza.js')}}"></script> --}}
<script  type="text/javascript">

$("#category_id").change(function()
            {
                var id=$(this).val();
                var category=$('#category_id').val();
                console.log("1:"+id);

                var dataString = {'category':category,'id':id};
                console.log("2:"+dataString);
                $.ajax
                ({
                type: "POST",
                url: "{{route('menu.subcategories')}}",
                data: {'id':id},
                cache: false,
                success: function(data)
                {
                console.log("3:"+data);
                    $('#sub_category_id').empty().append(JSON.parse(data));
                } 
                });

            });
    //         function fetchsub_category_id(){
    //             // alert(123);
    //         var categories = $(this).val();
    //         // alert(123);
    //         console.log(categories)
    //             $.ajax({
    //                 processing : 'true',
    //                 serverSide : 'true',
    //                 url: '{{route('menu')}}',
    //                 type:"GET",
    //                 data : {
    //                     category_id: categories
    //                     // "_token":"{{ csrf_token() }}"
    //                 },
    //                 dataType:"json",

    //                 success:function(data) {
    //                     $("#sub_category_id").html(data);
    //                     console.log(data);
    //                     // if(data){
    //                     //     $.each(data, function(key, value){
    //                     //         $('#select_subCategory').append('<option value="'+value.select_subCategory+'">' + value.sub_category_name + '</option>');

    //                     //     });
    //                     // }else {
    //                     //     $('#labS').empty();
    //                     // }

    //                 },
                

    //             });
           
    //         }
    //     // });
    

      
    // // });
</script>
<script>
    var i = 0;
    $( ".item_prices" ).click(function() {
        ++i;
        console.log(i,"i")
        // $(".addons_category").append('<input type="text" name="addons_category[' + i +
        //     ']" placeholder="Enter subject" class="form-control" />'
        //     );
        // var inputName = 'addons_category' + lineNumber + '';
        // myInput.val('');
        // myInput.attr('name', inputName);
        console.log("test1")
    });
    $("#items_pp").click(function(){
        console.log("test2")
    });
    </script>