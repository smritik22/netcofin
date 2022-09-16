@include('businessOwner.dashboard.layouts.header')
<div class="right-content">
				
				<div class="right-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="right-content-box2">
						<div class="row">
							<div class="col-12">
								<div class="section-headding-box">
									<h1 class="section-headding">Order Management</h1>
								</div>
							</div>
						</div>
						<div class="new-order-tabel-outer manage-order-table">
                            <div class="manage-order-header">
                                <div class="manage-order-search">
                                    
                                </div>
                            </div>
                            <div class="order-summary-preparing manage-order">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="order-summary">
                                            <div class="manage-order-status">
                                                <div class=" floating-label">
                                                    <select class="form-select floating-select mb-0" onclick="this.setAttribute('value', this.value);" value="">
                                                        <option value="" selected="" disabled="" hidden=""></option>
                                                        <option>Delivery</option>
                                                        <option>Preparing</option>
                                                        <option>Received</option>
                                                        <option>Out of Delivery</option>
                                                        <option>Cancel</option>
                                                    </select>
                                                    <span class="highlight"></span>
                                                    <label>Status</label>
                                                </div>
                                            </div>
                                            <div class="manage-order-status manage-order-type">
                                                <div class=" floating-label">
                                                    <select class="form-select floating-select mb-0" onclick="this.setAttribute('value', this.value);" value="">
                                                        <option value="" selected="" disabled="" hidden=""></option>
                                                        <option>Cash</option>
                                                        <option>Online</option>
                                                    </select>
                                                    <span class="highlight"></span>
                                                    <label>Order Type</label>
                                                </div>
                                            </div>
                                            <div class="new-order ">
                                                <div class="">
                                                    <table class="table student-list-table program-manage" id="list_student">
                                                        <thead>
                                                            <tr >
                                                                <th >
                                                                    <div class="id">
                                                                        <p>Order ID </p>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <p>Order Type</p>
                                                                </th>
                                                                <th >
                                                                    <p>Customer Name</p>
                                                                </th>
                                                                <th >
                                                                    <p>Total Item</p>
                                                                </th>
                                                                <th >
                                                                    <p>Order Location</p>
                                                                </th>
                                                                <th >
                                                                    <p>Amount</p>
                                                                </th>
                                                                <th >
                                                                    <p>Payment</p>
                                                                </th>
                                                                <th >
                                                                    <p>Status</p>
                                                                </th>
                                                                <th class="action sorting-disabled">
                                                                    <p >Action</p>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>
                                                                </td>
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-Preparing">Preparing</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-received">Received</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-delivered">Delivered</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-out-of-delivery">Out of Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-vancel">Cancel</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-Preparing">Preparing</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-Preparing">Preparing</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-Preparing">Preparing</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>
                                                                </td>
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-Preparing">Preparing</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-received">Received</p>
                                                                </td>
                                                                <td>
                                                                    <a href="order-detail.html" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-delivered">Delivered</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-out-of-delivery">Out of Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p>#01AIT112</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>Delivery</p>
                                                                </td>
                                                                <td>
                                                                    <p>Allie Grater</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>   
                                                                <td class="table-order-location">
                                                                    <p >1212 Hazelwood 1212 Hazelwood 1212 Hazelwood 1212 Hazelwood...</p>
                                                                </td>
                                                                <td>
                                                                    <p>$120.29 </p>
                                                                </td>
                                                                <td>
                                                                    <p>Cash</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-order-vancel">Cancel</p>
                                                                </td>
                                                                <td>
                                                                    <a href="view-order.php" class="table-icon">
                                                                        <span  class="table-edit-icon"><img src="{{asset('assets/frontend/images/eye.svg')}}" alt="icon-eye.svg"></span>
                                                                    </a>
                                                                </td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>
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

@include('businessOwner.dashboard.layouts.footer')