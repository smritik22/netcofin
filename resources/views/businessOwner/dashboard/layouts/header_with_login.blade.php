<div class="right-header">
    <div class="header-left">
        <div class="hamburger " >
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        <p data-bs-toggle="modal" data-bs-target="#chooselocation">
            <span class="location-icon">
                <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.00004 0C9.29208 0 12.0001 2.63152 12.0001 5.94732C12.0001 8.63153 10.1948 10.263 8.65506 12.3684L6.00019 16L3.29216 12.3684C1.75231 10.2631 0.0001297 8.63156 0.0001297 5.94732C0.0001297 2.63167 2.655 0 6.00022 0L6.00004 0ZM6.00004 3.26308C7.48675 3.26308 8.65492 4.47355 8.65492 5.94729C8.65492 7.42092 7.48675 8.57882 6.00004 8.57882C4.51334 8.57882 3.29202 7.42092 3.29202 5.94729C3.29202 4.47366 4.51322 3.26308 6.00004 3.26308Z" fill="#4E4E4E"/>
                </svg>
            </span>
            <span class="location-text">1512 Town Center Dr, Pflugerville</span>
            <span class="select-down">
                <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.1671 1.13452L6.99946 5.91646L1.83185 1.13452C1.73953 1.04891 1.61558 1.00098 1.48652 1.00098C1.35746 1.00098 1.23351 1.04891 1.14119 1.13452C1.09648 1.1761 1.06096 1.22573 1.03672 1.28051C1.01247 1.33528 0.999985 1.3941 0.999985 1.45351C0.999985 1.51293 1.01247 1.57174 1.03672 1.62652C1.06096 1.68129 1.09648 1.73092 1.14119 1.7725L6.63861 6.86067C6.73515 6.95 6.86464 7 6.99946 7C7.13427 7 7.26376 6.95 7.3603 6.86067L12.8577 1.77349C12.9027 1.73187 12.9385 1.68212 12.963 1.62716C12.9874 1.57221 13 1.51316 13 1.45351C13 1.39386 12.9874 1.33481 12.963 1.27986C12.9385 1.2249 12.9027 1.17515 12.8577 1.13354C12.7654 1.04793 12.6415 1 12.5124 1C12.3833 1 12.2594 1.04793 12.1671 1.13354V1.13452Z" fill="black" stroke="black" stroke-width="0.5"/>
                </svg>
            </span>
        </p>
    </div>
    <div class="header-righr-side">
        <!-- <div class="hamburger d-sm-none d-inline-block">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div> -->
        <div class="header-righr-side">
            <div class="header-toggle">
                <input type="checkbox" class="toggle" id="toggle" checked/>
                    <label for="toggle">
                    <span class="on">Online</span>
                    <span class="off">Offline</span>
                </label>
            </div>
            <div class="dropdown">
                <span class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" role="link">
                    <span class="login-img"><img src="{{ asset('assets/pos/images/user-img.png')}}" alt="user-img.png"></span>
                    @if(isset(session('login_data')->full_name))
                    <span class="custmor-name">{{session('login_data')->full_name}}</span>
                    @else
                    <span class="custmor-name">User</span>
                    @endif
                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.15175 7.47309C4.10825 7.43071 3.92225 7.2707 3.76925 7.12165C2.807 6.24781 1.232 3.96822 0.75125 2.77509C0.674 2.59389 0.5105 2.13578 0.5 1.89101C0.5 1.65648 0.554 1.4329 0.6635 1.21956C0.8165 0.953605 1.05725 0.740258 1.3415 0.623356C1.53875 0.5481 2.129 0.431198 2.1395 0.431198C2.78525 0.314296 3.8345 0.25 4.994 0.25C6.09875 0.25 7.10525 0.314296 7.76075 0.41001C7.77125 0.420969 8.50475 0.537871 8.756 0.665733C9.215 0.900268 9.5 1.35838 9.5 1.84864V1.89101C9.48875 2.2103 9.20375 2.88176 9.19325 2.88176C8.71175 4.01059 7.214 6.23758 6.21875 7.13261C6.21875 7.13261 5.963 7.38468 5.80325 7.49428C5.57375 7.66525 5.2895 7.75 5.00525 7.75C4.688 7.75 4.3925 7.65429 4.15175 7.47309Z" fill="#4E4E4E"/>
                    </svg>
                        
                </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="store-profile.php">Profile </a></li>
                    <li><a class="dropdown-item" href="about.php">About Us</a></li>
                    <li><a class="dropdown-item" href="privacy-policy.php">Privacy Policy</a></li>
                    <li><a class="dropdown-item" href="terms-and-conditions.php">Terms & Condition</a></li>
                    <li><a class="dropdown-item" href="faq.php">Faq</a></li>
                    <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                    <li><a class="dropdown-item " href="{{url('/admin/login')}}">Logout</a></li>
                </ul>
            </div>
            
        </div>
    </div>
</div>