@include('businessOwner.dashboard.layouts.header')
<div class="right-content">
				
				<div class="right-content-box contact-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="row">
						<div class="col-12">
							<h1 class="page-heading">Contact</h1>
						</div>
					</div>
					<div class="bulid-form-outer">
						<form>
							<h2 class="section-headding"><span>Contact Information</span></h2>
							<div class="right-content-wrapper banner-information">
								<div class="row">
									<div class="col-md-6">
										<div class="right-input">
											<div class="floating-label">      
												<input type="text" class="floating-input form-control edit_icon" value="02 015680721" placeholder=" " required >
												<span class="highlight"></span>
												<label>Phone</label>
											</div>
										</div>
										<div class="right-input">
											<div class="floating-label">      
												<input type="mail" class="floating-input form-control edit_icon" value="info@demo.com" placeholder=" " required >
												<span class="highlight"></span>
												<label>Mail</label>
											</div>
										</div>
										<div class="floating-label textarea">      
											<textarea class="floating-input form-control edit_icon mb-0" placeholder=" ">599 New street, Washington, USA</textarea>
											<span class="highlight"></span> 
											<label>Address</label>
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