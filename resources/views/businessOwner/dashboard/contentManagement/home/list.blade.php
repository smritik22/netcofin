
@include('businessOwner.dashboard.layouts.header')
<div class="right-content">
				
				<div class="right-content-box">
                    @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="row">
						<div class="col-12">
							<h1 class="page-heading">Home</h1>
						</div>
					</div>
					<div class="bulid-form-outer">
						<form>
							<h2 class="section-headding"><span>Banner Information</span></h2>
							<div class="right-content-wrapper banner-information">
								<div class="row">
									<div class="col-md-6">
										<div class="avatar-upload">
											<div class="avatar-edit">
												<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
												<label for="imageUpload"><img src="{{asset('assets/frontend/images/edit.svg')}}" alt="image" /></label>
											</div>
											<div class="avatar-preview">
												<div id="imagePreview" style="background-image: url(assets/images/store-profile.png);">
												</div>
											</div>
										</div>
										<div class="right-input">
											<div class="floating-label">      
												<input type="text" class="floating-input form-control edit_icon" value="Delicious Food Zone" placeholder=" " required >
												<span class="highlight"></span>
												<label>Banner Tagline</label>
											</div>
										</div>
										<div class="floating-label textarea">      
											<textarea class="floating-input form-control edit_icon mb-0" placeholder=" ">I'm a paragraph. I’m a great place for you to tell a story know little more.</textarea>
											<span class="highlight"></span> 
											<label>Banner SubText</label>
										</div>
									</div>
									<div class="col-md-6 right-text-area-outer">
										<div class="home-add-more">
											<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M31.125 16.125H19.875V4.875C19.875 4.37772 19.6775 3.90081 19.3258 3.54918C18.9742 3.19754 18.4973 3 18 3C17.5027 3 17.0258 3.19754 16.6742 3.54918C16.3225 3.90081 16.125 4.37772 16.125 4.875V16.125H4.875C4.37772 16.125 3.90081 16.3225 3.54918 16.6742C3.19754 17.0258 3 17.5027 3 18C3 18.4973 3.19754 18.9742 3.54918 19.3258C3.90081 19.6775 4.37772 19.875 4.875 19.875H16.125V31.125C16.125 31.6223 16.3225 32.0992 16.6742 32.4508C17.0258 32.8025 17.5027 33 18 33C18.4973 33 18.9742 32.8025 19.3258 32.4508C19.6775 32.0992 19.875 31.6223 19.875 31.125V19.875H31.125C31.6223 19.875 32.0992 19.6775 32.4508 19.3258C32.8025 18.9742 33 18.4973 33 18C33 17.5027 32.8025 17.0258 32.4508 16.6742C32.0992 16.3225 31.6223 16.125 31.125 16.125Z" fill="#4E4E4E"/>
											</svg>
										</div>
									</div>
								</div>
							</div>
							<h2 class="section-headding"><span>About Information</span></h2>
							<div class="right-content-wrapper home-add-information">
								<div class="upload__box">
									<div class="upload__btn-box">
										<div class="upload__img-wrap"></div>
									  <label class="upload__btn">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20.75 10.75H13.25V3.25C13.25 2.91848 13.1183 2.60054 12.8839 2.36612C12.6495 2.1317 12.3315 2 12 2C11.6685 2 11.3505 2.1317 11.1161 2.36612C10.8817 2.60054 10.75 2.91848 10.75 3.25V10.75H3.25C2.91848 10.75 2.60054 10.8817 2.36612 11.1161C2.1317 11.3505 2 11.6685 2 12C2 12.3315 2.1317 12.6495 2.36612 12.8839C2.60054 13.1183 2.91848 13.25 3.25 13.25H10.75V20.75C10.75 21.0815 10.8817 21.3995 11.1161 21.6339C11.3505 21.8683 11.6685 22 12 22C12.3315 22 12.6495 21.8683 12.8839 21.6339C13.1183 21.3995 13.25 21.0815 13.25 20.75V13.25H20.75C21.0815 13.25 21.3995 13.1183 21.6339 12.8839C21.8683 12.6495 22 12.3315 22 12C22 11.6685 21.8683 11.3505 21.6339 11.1161C21.3995 10.8817 21.0815 10.75 20.75 10.75Z" fill="#4E4E4E"/>
										</svg>
										<input type="file" multiple="" data-max_length="20" class="upload__inputfile">
									  </label>
									</div>
								 </div>
								 <div class="floating-label textarea">      
									<textarea class="floating-input" placeholder=" "></textarea>
									<span class="highlight"></span>
									<label>Add Description</label>
								</div>
							</div>
							<h2 class="section-headding"><span>Take a Look at Our Dishes</span></h2>
							<div class="right-content-wrapper home-add-information">
								<div class="upload__box">
									<div class="upload__btn-box">
										<div class="upload__img-wrap"></div>
									  <label class="upload__btn">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20.75 10.75H13.25V3.25C13.25 2.91848 13.1183 2.60054 12.8839 2.36612C12.6495 2.1317 12.3315 2 12 2C11.6685 2 11.3505 2.1317 11.1161 2.36612C10.8817 2.60054 10.75 2.91848 10.75 3.25V10.75H3.25C2.91848 10.75 2.60054 10.8817 2.36612 11.1161C2.1317 11.3505 2 11.6685 2 12C2 12.3315 2.1317 12.6495 2.36612 12.8839C2.60054 13.1183 2.91848 13.25 3.25 13.25H10.75V20.75C10.75 21.0815 10.8817 21.3995 11.1161 21.6339C11.3505 21.8683 11.6685 22 12 22C12.3315 22 12.6495 21.8683 12.8839 21.6339C13.1183 21.3995 13.25 21.0815 13.25 20.75V13.25H20.75C21.0815 13.25 21.3995 13.1183 21.6339 12.8839C21.8683 12.6495 22 12.3315 22 12C22 11.6685 21.8683 11.3505 21.6339 11.1161C21.3995 10.8817 21.0815 10.75 20.75 10.75Z" fill="#4E4E4E"/>
										</svg>
										<input type="file" multiple="" data-max_length="20" class="upload__inputfile">
									  </label>
									</div>
								 </div>
								 <div class="floating-label textarea">      
									<textarea class="floating-input" placeholder=" "></textarea>
									<span class="highlight"></span>
									<label>Add Description</label>
								</div>
							</div>
							<h2 class="section-headding"><span>Download Mobile App</span></h2>
							<div class="right-content-wrapper home-add-information">
								<div class="row">
									<div class="col-md-6">
										<div class="floating-label">      
											<input type="url" class="floating-input form-control" value="" placeholder=" " required >
											<span class="highlight"></span>
											<label>Add play store link</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="floating-label">      
											<input type="url" class="floating-input form-control mb-md-0" value="" placeholder=" " required >
											<span class="highlight"></span>
											<label>Add app store link</label>
										</div>
									</div>
									<div class="col-12">
										<div class="floating-label textarea">      
											<textarea class="floating-input" placeholder=" "></textarea>
											<span class="highlight"></span>
											<label>Add Description</label>
										</div>
									</div>
								</div>
							</div>
								
							<div class="right-content-wrapper mb-0">
									<div class="button_group">
                                        <button type="button" class="comman-btn">Save</button>
                                        <button type="button" class="comman-btn white-btn">Cancel</button>
                                    </div>
							</div>
						</form>

					</div>
					
				</div>
			</div>
@include('businessOwner.dashboard.layouts.footer')
