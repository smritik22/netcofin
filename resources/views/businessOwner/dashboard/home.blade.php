@include('businessOwner.dashboard.layouts.header')
			<div class="right-content">
				
				<div class="right-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="right-content-box2">
						<div class="row">
							<div class="col-12">
								<div class="section-headding-box section-headding-dashboard">
									<h1 class="section-headding">Dashboard</h1>
									<div class="section-custom">
										<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
										    <i class="fa fa-calendar"></i>&nbsp;
										    <span></span> <i class="fa fa-caret-down"></i>
										</div>
										
										<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M0 12.0078C0 13.1978 0.91 14.1078 2.1 14.1078H11.9C13.09 14.1078 14 13.1978 14 12.0078V6.40785H0V12.0078ZM11.9 1.50785H10.5V0.807849C10.5 0.387849 10.22 0.107849 9.8 0.107849C9.38 0.107849 9.1 0.387849 9.1 0.807849V1.50785H4.9V0.807849C4.9 0.387849 4.62 0.107849 4.2 0.107849C3.78 0.107849 3.5 0.387849 3.5 0.807849V1.50785H2.1C0.91 1.50785 0 2.41785 0 3.60785V5.00785H14V3.60785C14 2.41785 13.09 1.50785 11.9 1.50785Z" fill="#4E4E4E"/>
										</svg>
									</div>
								</div>
							</div>
						</div>
						<div class="dashbord-total-order">
							<div class="row">
								<div class="col-12">
									<div class="dashbord-order-heading">
										<h4>Order</h4>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="dashbord-order dashbord-order1">
										<div class="dashbord-order-img">
											<img src="{{ asset('assets/pos/images/total-order.svg')}}" alt="total-order.svg" />
										</div>
										<div class="dashbord-order-detail">
											<h2>250+</h2>
											<p class="content">Total Order</p>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="dashbord-order dashbord-order2">
										<div class="dashbord-order-img">
											<img src="{{ asset('assets/pos/images/on-going-order-icon.svg')}}" alt="on-going-order-icon.svg" />
										</div>
										<div class="dashbord-order-detail">
											<h2>120+</h2>
											<p>On Going Order</p>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="dashbord-order  dashbord-order3 mb-0">
										<div class="dashbord-order-img">
											<img src="{{ asset('assets/pos/images/completed-order-icon.svg')}}" alt="completed-order-icon.svg" />
										</div>
										<div class="dashbord-order-detail">
											<h2>125+</h2>
											<p>Completed Order</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="table-booking">
							<div class="row">
								<div class="col-12">
									<div class="dashbord-order-heading">
										<h4>Table Booking</h4>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="table-booking-box">
										<div class="table-booking-left">
											<h3>20</h3>
										</div>
										<div class="table-booking-right">
											<p>Total Booking</p>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="table-booking-box">
										<div class="table-booking-left">
											<h3>10</h3>
										</div>
										<div class="table-booking-right">
											<p>Today Booking</p>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="table-booking-box">
										<div class="table-booking-left">
											<h3>15</h3>
										</div>
										<div class="table-booking-right">
											<p>Booking Request</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="total-items">
							<div class="row">
								<div class="col-md-7">
									<div class="dashbord-order-heading">
										<h4>Total Item <span>(250)</span></h4>
										<a href="add-menu.php">
											<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M12 7.80225H4" stroke="#1FA635" stroke-width="2" stroke-linecap="round"/>
												<path d="M8 11.7034L8 3.90112" stroke="#1FA635" stroke-width="2" stroke-linecap="round"/>
											</svg>
											ADD NEW ITEM
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="total-item-left">
									<div class="total-item-left-outer">
										<div class="total-item-box">
											<div class="total-item-detail-box">
												<div class="total-item-img">
													<img src="{{ asset('assets/pos/images/total-item.png')}}" alt="image" />
												</div>
												<div class="total-item-detail">
													<h4>Bacon</h4>
													<p>Vegetable broth served with chicken and avocado...</p>
												</div>
											</div>
											<div class="total-item-price">
												<h3>$25.14</h3>
											</div>
										</div>
										<div class="total-item-box">
											<div class="total-item-detail-box">
												<div class="total-item-img">
													<img src="{{ asset('assets/pos/images/total2.png')}}" alt="image" />
												</div>
												<div class="total-item-detail">
													<h4>Bagel and cream cheese</h4>
													<p>VegetaWith spinach, and garlic special...</p>
												</div>
											</div>
											<div class="total-item-price">
												<h3>$25.14</h3>
											</div>
										</div>
										<div class="total-item-box">
											<div class="total-item-detail-box">
												<div class="total-item-img">
													<img src="{{ asset('assets/pos/images/total3.png')}}" alt="image" />
												</div>
												<div class="total-item-detail">
													<h4>Bear claw</h4>
													<p>With mortadella, prosciutto, capicollo, salami...</p>
												</div>
											</div>
											<div class="total-item-price">
												<h3>$25.14</h3>
											</div>
										</div>
										<div class="total-item-box">
											<div class="total-item-detail-box">
												<div class="total-item-img">
													<img src="{{ asset('assets/pos/images/item-of-week.png')}}" alt="image" />
												</div>
												<div class="total-item-detail">
													<h4>Bread Pudding</h4>
													<p>With beef, onion, tomatoes, basil, bolognese...</p>
												</div>
											</div>
											<div class="total-item-price">
												<h3>$25.14</h3>
											</div>
										</div>
										<div class="total-item-box">
											<div class="total-item-detail-box">
												<div class="total-item-img">
													<img src="{{ asset('assets/pos/images/total-item.png')}}" alt="image" />
												</div>
												<div class="total-item-detail">
													<h4>Bacon</h4>
													<p>Vegetable broth served with chicken and avocado...</p>
												</div>
											</div>
											<div class="total-item-price">
												<h3>$250.14</h3>
											</div>
										</div>
										<div class="total-item-box">
											<div class="total-item-detail-box">
												<div class="total-item-img">
													<img src="{{ asset('assets/pos/images/total-item.png')}}" alt="image" />
												</div>
												<div class="total-item-detail">
													<h4>Bacon</h4>
													<p>Vegetable broth served with chicken and avocado...</p>
												</div>
											</div>
											<div class="total-item-price">
												<h3>$25.14</h3>
											</div>
										</div>
										
									</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="total-items-right">
										<div class="total-sales">
											<div class="total-sales-bar">
												<div class="single-skill">
													<div class="circlechart" data-percentage="79"><svg class="circle-chart" viewBox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg"><circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9"></circle><circle class="circle-chart__circle success-stroke" stroke-dasharray="92,100" cx="16.9" cy="16.9" r="15.9"></circle><g class="circle-chart__info">   </g></svg></div>
												</div>
												<h2>Total Sales</h2>
											</div>
										</div>
										<div class="dashbord-order-heading">
											<h4>Item of The Week</h4>
										</div>
										<div class="item-of-week">
											<div class="item-of-weak-img">
												<img src="{{ asset('assets/pos/images/item-of-week.png')}}" alt="item-of-week" />
											</div>
											<div class="item-of-weak-content">
												<div class="item-of-week-heading">
													<h3>Bread pudding</h3>
													<h4>$22.12</h4>
												</div>
												<p>With beef, onion, tomatoes, basil, bolognese sauce</p>
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
        @include('businessOwner.dashboard.layouts.footer')