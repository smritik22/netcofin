@extends('businessOwner.dashboard.layouts.header')

			<div class="right-content">
				<div class="right-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="back-to-page">
                        <a href="category-management.php">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8206 18.8894L9.44472 11.9993L15.8206 5.10916C15.9348 4.98605 15.9987 4.8208 15.9987 4.64871C15.9987 4.47663 15.9348 4.31137 15.8206 4.18827C15.7652 4.12866 15.699 4.08131 15.626 4.04898C15.553 4.01665 15.4745 4 15.3953 4C15.3161 4 15.2377 4.01665 15.1646 4.04898C15.0916 4.08131 15.0254 4.12866 14.97 4.18827L8.18577 11.5182C8.06666 11.6469 8 11.8195 8 11.9993C8 12.1791 8.06666 12.3517 8.18577 12.4804L14.9687 19.8103C15.0242 19.8703 15.0905 19.9181 15.1638 19.9506C15.2371 19.9832 15.3158 20 15.3953 20C15.4749 20 15.5536 19.9832 15.6269 19.9506C15.7001 19.9181 15.7665 19.8703 15.8219 19.8103C15.9361 19.6872 16 19.522 16 19.3499C16 19.1778 15.9361 19.0125 15.8219 18.8894L15.8206 18.8894Z" fill="black" stroke="black" stroke-width="0.5"></path>
                            </svg>
                        </a>
                        <h1 class="section-headding">Category Management</h1>
                    </div>
                    <div class="right-content-box-bottom add-category edit-category">
                        
                        <form action="{{route('category.update',$category->id)}}" enctype = "multipart/form-data" method="POST" id= "categoryForm" >
                            <div class="row">
                                <div class="col-12">
                                    <div class="add-category-img edit-category-img">
                                        <div class="yes">
                                            <span class="btn_upload">
                                                <input type="file" id="imag" title="" class="input-img" name="image">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.75 10.75H13.25V3.25C13.25 2.91848 13.1183 2.60054 12.8839 2.36612C12.6495 2.1317 12.3315 2 12 2C11.6685 2 11.3505 2.1317 11.1161 2.36612C10.8817 2.60054 10.75 2.91848 10.75 3.25V10.75H3.25C2.91848 10.75 2.60054 10.8817 2.36612 11.1161C2.1317 11.3505 2 11.6685 2 12C2 12.3315 2.1317 12.6495 2.36612 12.8839C2.60054 13.1183 2.91848 13.25 3.25 13.25H10.75V20.75C10.75 21.0815 10.8817 21.3995 11.1161 21.6339C11.3505 21.8683 11.6685 22 12 22C12.3315 22 12.6495 21.8683 12.8839 21.6339C13.1183 21.3995 13.25 21.0815 13.25 20.75V13.25H20.75C21.0815 13.25 21.3995 13.1183 21.6339 12.8839C21.8683 12.6495 22 12.3315 22 12C22 11.6685 21.8683 11.3505 21.6339 11.1161C21.3995 10.8817 21.0815 10.75 20.75 10.75Z" fill="#4E4E4E"></path>
                                                </svg>
                                            </span>
                                            <img id="ImgPreview" src="{{ $image_url . $category->image }}" class="preview1 it" data-pagespeed-url-hash="2322264633" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                            <div class="removeadd-img-menu">
                                                <input type="button" id="removeImage1" value="x" class="btn-rmv1 rmv">
                                            </div>
                                        </div>
                                        <p>Add Category Image</p>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="floating-label">      
                                        <input class="floating-input form-control edit_icon" type="text"  placeholder=" " name="name" value="{{$category->name}}">
                                        <span class="highlight"></span>
                                        <label>Category Name</label>
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <span style="color: red;" id="error_name" class='validate'>{{ $errors->first('name') }}</span>
                                    </span>
                                @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="floating-label">      
                                        <input class="floating-input form-control" type="text" placeholder=" " name="tax" value="{{$category->tax}}">
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
                                        <button type="submit" class="comman-btn">Update</button>
                                        <a href="{{ route('categories')}}" class="btn btn-default m-t comman-btn">
                                            <i class="material-icons">
                                            &#xe5cd;</i> {!! __('backend.cancel') !!}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
				</div>
				
			</div>
		</div>
@extends('businessOwner.dashboard.layouts.footer')