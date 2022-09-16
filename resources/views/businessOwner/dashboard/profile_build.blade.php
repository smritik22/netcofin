@include('businessOwner.dashboard.layouts.header')

			<div class="right-content">
				
				<div class="right-content-box">
				@include('businessOwner.dashboard.layouts.header_without_login')
					<div class="row">
						<div class="col-12">
							<h1 class="page-heading">Profile build</h1>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="setup-header-outer">
								<div class="setup-header">
									<div class="setup-header-box setup-header-box-1">
										<div class="setup-number active"><span>1</span></div>
										<h4>Restaurant info</h4>
										
									</div>
									<div class="setup-header-box setup-header-box-2">
										<div class="setup-number"><span>2</span></div>
										<h4>Store Information</h4>
										
									</div>
									<div class="setup-header-box setup-header-box-3">
										<div class="setup-number"><span>3</span></div>
										<h4>Setup Payment</h4>
										
									</div>
									<div class="setup-header-box setup-header-box-4">
										<div class="setup-number"><span>4</span></div>
										<h4>Launch Store</h4>
									</div>
								</div>
								<div class="border-header">
									<div class="setup-header-line active"></div>
									<div class="setup-header-line"></div>
									<div class="setup-header-line"></div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="bulid-form-outer">
						<form>
							<h2 class="section-headding"><span>Restaurant Information</span></h2>
							<div class="right-content-wrapper">
								<div class="row">
									<div class="col-md-6">
										<div class="right-input">
											<div class="floating-label">      
												<input type="text" class="floating-input form-control" placeholder=" " required >
												<span class="highlight"></span>
												<label>Restaurant Name</label>
											</div>
										</div>
										<div class="right-input  uploadlogo right-input-box">
											<label class="form-control" >
												<input type="file" id="uploadlogo" >
												<span class=" upload-logo"></span>
												<span class="input-file-btn">Choose File</span>
											</label>
										</div>
										<h5 class="store-profile-text">Store Profile</h5>
										<div class="avatar-upload">
											<div class="avatar-edit">
												<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
												<label for="imageUpload"><img src="{{ asset('assets/pos/images/edit.svg')}}" alt="image" /></label>
											</div>
											<div class="avatar-preview">
												<div id="imagePreview" style="background-image: url({{ asset('assets/pos/images/store-profile.png')}});">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 right-text-area-outer">
										<div class="right-text-area">
											<div class="floating-label textarea">      
												<textarea class="floating-input" placeholder=" "></textarea>
												<span class="highlight"></span>
												<label>Restaurant Description</label>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							
							<h2 class="section-headding"><span>Social Media Information</span></h2>
							<div class="right-content-wrapper">
								<div class="row">
									<div class="col-md-6">
										<div class="floating-label">      
											<input type="url" class="floating-input form-control" placeholder=" " required >
											<span class="highlight"></span>
											<label>Facebook URL</label>
										</div>
										<div class="floating-label">      
											<input type="url" class="floating-input form-control mb-md-0" placeholder=" " required >
											<span class="highlight"></span>
											<label>YouTube URL</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="floating-label">      
											<input type="url" class="floating-input form-control" placeholder=" " required >
											<span class="highlight"></span>
											<label>Twitter URL</label>
										</div>
										<div class="floating-label">      
											<input type="url" class="floating-input form-control mb-0" placeholder=" " required >
											<span class="highlight"></span>
											<label>Instagram URL</label>
										</div>
									</div>
								</div>
							</div>
							<h2 class="section-headding"><span>Image Gallery</span></h2>
							<div class="right-content-wrapper">
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
							</div>
							<h2 class="section-headding"><span>Banner Image</span></h2>
							<div class="right-content-wrapper">
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
							</div>
							<div class="right-content-wrapper mb-0">
								<div class="form-btn text-end">
									<a href="profile-build2.php" class="comman-btn">Save & Continue</a>
								</div>
							</div>
						</form>
					</form>

				</div>
				
			</div>
		</div>

		@include('businessOwner.dashboard.layouts.footer')