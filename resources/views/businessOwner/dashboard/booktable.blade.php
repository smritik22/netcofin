@include('businessOwner.dashboard.layouts.header')

<div class="right-content">
    
    <div class="right-content-box">
        @include('businessOwner.dashboard.layouts.header_with_login')
        <div class="right-content-box2">
            <div class="row">
                <div class="col-12">
                    <div class="section-headding-box">
                        <h1 class="section-headding">Table Booking</h1>
                    </div>
                </div>
            </div>
            <div class="table-booking">
                <div class="row">
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
            <div class="new-order-tabel-outer table-booking-table">
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
                                                            <p>Order ID </p>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <p>Booking Date</p>
                                                    </th>
                                                    <th >
                                                        <p>Booking Time</p>
                                                    </th>
                                                    <th >
                                                        <p>No of Guest</p>
                                                    </th>
                                                    <th >
                                                        <p>Name</p>
                                                    </th>
                                                    <th >
                                                        <p>Special Request</p>
                                                    </th>
                                                    <th >
                                                        <p>Status</p>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>14/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>12:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">02</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Adella Goyette </p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a... </p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-Preparing">Pending</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>14/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>01:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">04</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Neil Berry</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >- </p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-Preparing">Pending</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>13/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">02</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Jarred Lebsack</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >- </p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>13/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">05</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Tiffany Dyer</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>13/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>08:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">03</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Magdalena Crist</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >-</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>06:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">03</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Davion Collier</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">06</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Monroe Smith</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">06</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Keeley Sipes</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >-</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-vancel">Rejected</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>06:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">03</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Davion Collier</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">06</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Monroe Smith</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>06:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">03</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Davion Collier</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">06</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Monroe Smith</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>07:00 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">06</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Keeley Sipes</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >-</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-vancel">Rejected</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="id">
                                                            <p>12/07/2022</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>14/07/2022</p>
                                                    </td>
                                                    <td>
                                                        <p>06:30 PM</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-total-item">03</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-booking-name">Davion Collier</p>
                                                    </td>
                                                    <td class="table-order-location">
                                                        <p >I'm a paragraph. I’m a I'm a paragraph. I’m a...</p>
                                                    </td>
                                                    <td>
                                                        <p class="table-order-received">Accepted</p>
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