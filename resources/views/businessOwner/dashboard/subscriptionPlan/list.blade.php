@include('businessOwner.dashboard.layouts.header')
	<div class="right-content">
				<div class="right-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="right-content-box2">
						<div class="row">
							<div class="col-12">
								<div class="section-headding-box sub_pages_box">
									<h1 class="section-headding">Subscription Plan</h1>
									<a href="subscription-plan-history.php" class="plan_history_btn">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5432 8.916C5.8032 5.465 9.1162 3 13.0002 3C17.9672 3 22.0002 7.033 22.0002 12C22.0002 16.967 17.9672 21 13.0002 21C9.6722 21 6.76321 19.19 5.20621 16.501C4.93021 16.023 5.0932 15.411 5.5712 15.134C6.0482 14.858 6.66021 15.021 6.93721 15.499C8.14821 17.591 10.4112 19 13.0002 19C16.8632 19 20.0002 15.863 20.0002 12C20.0002 8.136 16.8632 5 13.0002 5C9.7832 5 7.0702 7.174 6.2522 10.132L8.00421 9.132C8.48321 8.858 9.09421 9.024 9.36821 9.504C9.64221 9.983 9.4752 10.594 8.9962 10.868L5.4962 12.868C5.2592 13.004 4.97721 13.036 4.71521 12.958C4.45321 12.88 4.2352 12.699 4.1102 12.456L2.1102 8.553C1.8582 8.062 2.0532 7.459 2.5442 7.207C3.0352 6.955 3.6382 7.15 3.8902 7.641L4.5432 8.916ZM14.0002 11.586L16.7072 14.293C17.0972 14.683 17.0972 15.317 16.7072 15.707C16.3172 16.097 15.6832 16.097 15.2932 15.707L12.2932 12.707C12.1052 12.519 12.0002 12.265 12.0002 12V8C12.0002 7.448 12.4482 7 13.0002 7C13.5522 7 14.0002 7.448 14.0002 8V11.586Z" fill="#4E4E4E"/>
                                        </svg>
                                        Plan History
                                    </a>
								</div>
							</div>
						</div>
					</div>
					<div class="plan_head">
						<h4>Current Plan</h4>
					</div>
					<div class="right-content-box-bottom mb_30">
						<div class="box_head">
							<h4>Basic</h4>
							<a href="javascript:void(0)" class="comman-btn">
								<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_2927_82078)">
								<path d="M4.23529 8.0625C1.89995 8.0625 0 9.95503 0 12.2812C0 14.6075 1.89995 16.5 4.23529 16.5C6.57064 16.5 8.47059 14.6075 8.47059 12.2812C8.47059 9.95503 6.57064 8.0625 4.23529 8.0625ZM6.10529 11.7689L3.90921 13.9564C3.81735 14.048 3.69691 14.0938 3.57647 14.0938C3.45603 14.0938 3.33559 14.048 3.24373 13.9564L2.30256 13.0189C2.11878 12.8359 2.11878 12.5391 2.30256 12.356C2.48631 12.173 2.78428 12.173 2.96806 12.356L3.57647 12.9621L5.43981 11.106C5.62356 10.923 5.92154 10.923 6.10532 11.106C6.28907 11.2891 6.28907 11.5859 6.10529 11.7689Z" fill="white"/>
								<path d="M12.3921 4.5625C12.1322 4.5625 11.9215 4.35262 11.9215 4.09375V0.5H5.17641C4.39797 0.5 3.76465 1.13084 3.76465 1.90625V7.14653C3.91969 7.13253 4.07659 7.125 4.23524 7.125C5.83925 7.125 7.27514 7.8555 8.22539 9H13.3333C13.5932 9 13.8039 9.20988 13.8039 9.46875C13.8039 9.72762 13.5932 9.9375 13.3333 9.9375H8.84537C9.13952 10.5092 9.3292 11.1427 9.39009 11.8125H13.3333C13.5932 11.8125 13.8039 12.0224 13.8039 12.2812C13.8039 12.5401 13.5932 12.75 13.3333 12.75H9.39009C9.24935 14.2981 8.41899 15.6508 7.20804 16.5H14.5882C15.3666 16.5 15.9999 15.8692 15.9999 15.0938V4.5625H12.3921ZM13.3333 7.125H6.43132C6.17143 7.125 5.96073 6.91512 5.96073 6.65625C5.96073 6.39738 6.17143 6.1875 6.43132 6.1875H13.3333C13.5932 6.1875 13.8039 6.39738 13.8039 6.65625C13.8039 6.91512 13.5932 7.125 13.3333 7.125Z" fill="white"/>
								<path d="M12.8623 0.774414V3.62495H15.7238L12.8623 0.774414Z" fill="white"/>
								</g>
								<defs>
								<clipPath id="clip0_2927_82078">
								<rect width="16" height="16" fill="white" transform="translate(0 0.5)"/>
								</clipPath>
								</defs>
								</svg>
								Renew Plan
							</a>
						</div>
						<div class="remaining_days">
							<p class="includes">Includes<span>3 Days Remaining</span></p>
							<p class="price">$23.05<span>/Monthly</span></p>
						</div>
						<ul class="plan_list count_2">
							<li>I'm a paragraph. I’m a great place for</li>
							<li>I'm a paragraph. I’m a great place for</li>
							<li>I'm a paragraph. I’m a great place for</li>
							<li>I'm a paragraph. I’m a great place for</li>
						</ul>
					</div>
					<div class="plan_head">
						<h4>Upgrade Your Plan</h4>
					</div>
					<div class="row plan_row">
						<div class="col-lg-3 plan_col">
							<div class="plan_card">
								<h4>Standard</h4>
								<p class="price">$33.05<span>/Monthly</span></p>
								<p class="includes">Includes</p>
								<ul class="plan_list count_1">
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
								</ul>
								<a href="javascript:void(0)" class="comman-btn">Upgrade Plan</a>
							</div>
						</div>
						<div class="col-lg-3 plan_col">
							<div class="plan_card">
								<h4>Advanced</h4>
								<p class="price">$43.05<span>/Monthly</span></p>
								<p class="includes">Includes</p>
								<ul class="plan_list count_1">
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
								</ul>
								<a href="javascript:void(0)" class="comman-btn">Upgrade Plan</a>
							</div>
						</div>
						<div class="col-lg-3 plan_col">
							<div class="plan_card">
								<h4>Premium</h4>
								<p class="price">$48.05<span>/Monthly</span></p>
								<p class="includes">Includes</p>
								<ul class="plan_list count_1">
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
									<li>I’m a paragraph</li>
								</ul>
								<a href="javascript:void(0)" class="comman-btn">Upgrade Plan</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
@include('businessOwner.dashboard.layouts.footer')