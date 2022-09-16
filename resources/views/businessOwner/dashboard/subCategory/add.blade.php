@extends('businessOwner.dashboard.layouts.header')
<div class="right-content">
				<div class="right-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="back-to-page">
                        <a href="sub-category.php">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8206 18.8894L9.44472 11.9993L15.8206 5.10916C15.9348 4.98605 15.9987 4.8208 15.9987 4.64871C15.9987 4.47663 15.9348 4.31137 15.8206 4.18827C15.7652 4.12866 15.699 4.08131 15.626 4.04898C15.553 4.01665 15.4745 4 15.3953 4C15.3161 4 15.2377 4.01665 15.1646 4.04898C15.0916 4.08131 15.0254 4.12866 14.97 4.18827L8.18577 11.5182C8.06666 11.6469 8 11.8195 8 11.9993C8 12.1791 8.06666 12.3517 8.18577 12.4804L14.9687 19.8103C15.0242 19.8703 15.0905 19.9181 15.1638 19.9506C15.2371 19.9832 15.3158 20 15.3953 20C15.4749 20 15.5536 19.9832 15.6269 19.9506C15.7001 19.9181 15.7665 19.8703 15.8219 19.8103C15.9361 19.6872 16 19.522 16 19.3499C16 19.1778 15.9361 19.0125 15.8219 18.8894L15.8206 18.8894Z" fill="black" stroke="black" stroke-width="0.5"></path>
                            </svg>
                        </a>
                        <h1 class="section-headding">Subcategory Management</h1>
                    </div>
                    <div class="right-content-box-bottom">
                        <div class="view-order-top-bar">
                            <h4>Create New Subcategory</h4>
                        </div>
                        {{Form::open(['route'=>['sub-category.store'],'method'=>'POST', 'files' => true,'enctype' => 'multipart/form-data', 'id' => 'subCategoriesForm' ])}}
                        {{-- <form action="{{route("sub-category.store")}}" enctype = "multipart/form-data" method="POST" id= "categoryForm" > --}}
                        {{-- {{ csrf_field() }} --}}
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class=" floating-label">
                                        <select name="category_id" class="form-select floating-select form-control" onclick="this.setAttribute('value', this.value);" value="">
                                            <option value="" selected="" disabled="" hidden=""></option>
                                            <!-- <option value=>Select Category</option> -->
                                            @foreach ($category as $key => $value )
                                                <option value="{{$value->id}}" >{{$value->name}}</option>
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
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="floating-label">      
                                        <input class="floating-input form-control" type="text" placeholder=" " name="name">
                                        <span class="highlight"></span>
                                        <label>Subcategory Name</label>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <span style="color: red;" id="error_name" class='validate'>{{ $errors->first('name') }}</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="floating-label">      
                                        <input class="floating-input form-control" type="text" placeholder=" " name="tax">
                                        <span class="highlight"></span>
                                        <label>Tax</label>
                                    </div>
                                    @if ($errors->has('tax'))
                                        <span class="help-block">
                                            <span style="color: red;" id="error_tax" class='validate'>{{ $errors->first('tax') }}</span>
                                        </span>
                                    @endif
                                </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="button_group">
                                        <button type="submit" class="comman-btn">Submit</button>
                                        <a href="{{ route('sub-categories')}}" class="btn btn-default m-t comman-btn">
                                            <i class="material-icons">
                                            &#xe5cd;</i> {!! __('backend.cancel') !!}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                        {{Form::close()}}
                    </div>
				</div>
				
</div>
@extends('businessOwner.dashboard.layouts.footer')
