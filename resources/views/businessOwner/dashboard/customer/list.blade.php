@include('businessOwner.dashboard.layouts.header')
<div class="right-content">
				<div class="right-content-box">
                @include('businessOwner.dashboard.layouts.header_with_login')
					<div class="right-content-box2">
						<div class="row">
							<div class="col-12">
								<div class="section-headding-box">
									<h1 class="section-headding">Customer Management</h1>
								</div>
							</div>
						</div>
						<div class="new-order-tabel-outer customer-management">
                            <div class="manage-order-header">
                                <div class="manage-order-search">
                                    <!-- <div class="manage-order-search-box">
                                        <input type="text" placeholder="Search by Order ID">
                                        <img src="aseets/images/search.svg" alt="search.svg">
                                    </div> -->
                                    
                                </div>
                            </div>
                            <div class="order-summary-preparing manage-order">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="order-summary">
                                            <div class="new-order ">
                                                <div class="">
                                                    <table class="table student-list-table program-manage" id="list_student">
                                                        <thead>
                                                            <tr >
                                                                <th >
                                                                    <div class="id">
                                                                        <p>Customer Name</p>
                                                                    </div>
                                                                </th>
                                                                <th>
                                                                    <p>Mobile No</p>
                                                                </th>
                                                                <th >
                                                                    <p>Register Date</p>
                                                                </th>
                                                                <th >
                                                                    <p>Total Order</p>
                                                                </th>
                                                                <th >
                                                                    <p>Spent Money</p>
                                                                </th>
                                                                <th >
                                                                    <p>Active/Deactive</p>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Adella Goyette</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(631) 325-1849</p>
                                                                </td>
                                                                <td>
                                                                    <p>14/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">3</p>
                                                                </td>
                                                                <td >
                                                                    <p>$124.32</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle1" checked/>
                                                                                <label for="toggle1">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Selina McDermott</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(856) 985-4560</p>
                                                                </td>
                                                                <td>
                                                                    <p>13/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">6</p>
                                                                </td>
                                                                <td >
                                                                    <p >$305.20</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle2" checked/>
                                                                                <label for="toggle2">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Neil Berry</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(615) 849-1974</p>
                                                                </td>
                                                                <td>
                                                                    <p>13/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">9</p>
                                                                </td>
                                                                <td >
                                                                    <p >$450.08</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle3" checked/>
                                                                                <label for="toggle3">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Jarred Lebsack</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(920) 262-2400</p>
                                                                </td>
                                                                <td>
                                                                    <p>12/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">5</p>
                                                                </td>
                                                                <td >
                                                                    <p >$200.05</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle4" checked/>
                                                                                <label for="toggle4">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Tiffany Dyer</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(703) 778-1135</p>
                                                                </td>
                                                                <td>
                                                                    <p>12/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>
                                                                </td>
                                                                <td >
                                                                    <p >$220.85</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle5" checked/>
                                                                                <label for="toggle5">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Magdalena Crist</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(425) 329-4054</p>
                                                                </td>
                                                                <td>
                                                                    <p>11/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">12</p>
                                                                </td>
                                                                <td >
                                                                    <p >$990.20</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle6" checked/>
                                                                                <label for="toggle6">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Davion Collier</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(309) 446-3483</p>
                                                                </td>
                                                                <td>
                                                                    <p>10/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">10</p>
                                                                </td>
                                                                <td >
                                                                    <p >$832.06</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle7" checked/>
                                                                                <label for="toggle7">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Monroe Kertzmann</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(404) 344-8884</p>
                                                                </td>
                                                                <td>
                                                                    <p>10/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">4</p>
                                                                </td>
                                                                <td >
                                                                    <p >$174.89</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle8" checked/>
                                                                                <label for="toggle8">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="id">
                                                                        <p class="table-booking-name">Sophie Champlin</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>(303) 860-7885</p>
                                                                </td>
                                                                <td>
                                                                    <p>10/07/2022</p>
                                                                </td>
                                                                <td>
                                                                    <p class="table-total-item">8</p>
                                                                </td>
                                                                <td >
                                                                    <p >$757.65</p>
                                                                </td>
                                                                <td>
                                                                    <div class="customer-toggle">
                                                                        <div class="header-toggle">
                                                                            <input type="checkbox" class="toggle" id="toggle9" checked/>
                                                                                <label for="toggle9">
                                                                            </label>
                                                                        </div>
                                                                    </div>
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