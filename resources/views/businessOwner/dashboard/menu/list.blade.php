@include('businessOwner.dashboard.layouts.header')
<div class="right-content">
        <div class="right-content-box">
        @include('businessOwner.dashboard.layouts.header_with_login')
            <div class="right-content-box2">
                <div class="row">
                    <div class="col-12">
                        <div class="section-headding-box sub_pages_box back-to-page menu-main-heading">
                            <h1 class="section-headding mb-0">Menu</h1>
                            <a class="comman-btn" href="{{route('menu.create')}}">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8.5H4" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M8 12.5L8 4.5" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                            Add Menu
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-iteam-box-outer">
                        <div class="row">
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-item.png')}}" alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Linguine with Two-Cheese Sauce</h4>
                                       <p>Vegetable broth served with chicken and avocado, garnished with onions, pico Vegetable broth served with chicken and avocado, garnished with onions, pico</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$25.14</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam1.png')}}" alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Chocolate Cappuccino</h4>
                                       <p>Cinnamon Toast Crunch, Cocoa Pebbles, Fruit Loops, Fruity Pebbles Cinnamon Toast Crunch, Cocoa Pebbles, Fruit Loops, Fruity Pebbles </p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$25.14</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam2.png')}}" alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Bloody Mary</h4>
                                       <p>Tito’s Vodka, house made bloody mary mix, salt rim, queen anne olives Tito’s Vodka, house made bloody mary mix, salt rim, queen anne olives</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$35.02</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam3.png')}}"alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Margherita Pizza</h4>
                                       <p>A hugely popular margherita, with a deliciously tangy single cheese topping A hugely popular margherita, with a deliciously tangy single cheese topping</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$30.25</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam4.png')}}" alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Three-Meat Special Lasagna</h4>
                                       <p>With spinach, mushrooms and garlic special garlic cream sauce With spinach, mushrooms and garlic special garlic cream sauce</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$34.05</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam5.png')}}"alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Antipasti</h4>
                                       <p>With beef, onion, tomatoes, basil, bolognese sauce With beef, onion, tomatoes, basil, bolognese sauce</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$24.30</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam6.png')}}" alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Burrito Bowl</h4>
                                       <p>Slow cooked protein of your choice, served over white rice with fried Slow cooked protein of your choice, served over white rice with fried</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$18.20</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4 col-sm-6">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam7.png')}}" alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Alder Grilled Chinook Salmon</h4>
                                       <p>Choice of protein on organic corn tortillas, served with cabbage salad Choice of protein on organic corn tortillas, served with cabbage salad</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$25.14</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div> 
                           <div class="col-md-4">
                               <div class="menu-iteam-box">
                                   <div class="menu-iteam-box-img">
                                       <img src="{{ asset('assets/frontend/images/menu-iteam8.png')}}"alt="image">
                                   </div>
                                   <div class="menu-iteam-box-content">
                                       <h4>Mye Tye</h4>
                                       <p>house-made pineapple syrup, pineapple juice, fresh mint, lemon and lime house-made pineapple syrup, pineapple juice, fresh mint, lemon and lime</p>
                                       <div class="menu-iteam-box-price">
                                           <h4>$32.25</h4>
                                           <a href="menu-view.php">View</a>
                                       </div>
                                   </div>
                               </div>
                           </div>  
                           <div class="menu-pagination">
                               <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                  </ul>
                                </nav>
                           </div>
                        </div>
                    </div>
        </div>
</div>

@include('businessOwner.dashboard.layouts.footer')