<header id="js-header" class="site_header">
    <div class="container">
        <div class="header_block">
            <div class="header_logo">
                <a href="{{ route('frontend.homePage') }}"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="logo"/></a>
            </div>
            <div class="header_menu">
                <nav id="site-navigation" class="navigation main-navigation desktop_menu" role="navigation">
                    <div class="menu-menu-1-container">
                        <ul id="primary-menu" class="nav-menu">
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('frontend.homePage') }}">HOME</a></li>
                            <li class="{{ Request::is('about-us') ? 'active' : '' }}"><a href="{{ route('frontend.about_us') }}">ABOUT US</a></li>
                            <li class="{{ Request::is('features') ? 'active' : '' }}"><a href="{{ route('frontend.features') }}">Features</a></li>
                            <li class="{{ Request::is('subscription-plans') ? 'active' : '' }}"><a href="{{ route('frontend.planlist') }}">Pricing</a></li>
                            <li class="{{ Request::is('contact-us') ? 'active' : '' }}"><a href="{{ route('frontend.contact_us') }}">Contact us</a></li>
                        </ul>
                    </div>                            
                </nav>
                <div class="header_btn desktop">
                    <a href="{{ route('frontend.register') }}" class="common_btn">REGISTER</a>
                </div>
            </div>

            <div class="mobile_sidebar_menu">
                <button class="mobile-header__menu-button mobile_only" type="button">
                    <img src="{{asset('assets/frontend/images/menu.png')}}" alt="menu">
                </button>    
                <div class="mobile-menu mobile_only">
                    <div class="mobile-menu__backdrop"></div>
                    <div class="mobile-menu__body">			
                        <button class="mobile-menu__close" type="button"><i class="icon_24 icon_close"></i></button>
                        
                        <div class="mobile-menu__panel">
                            <div class="mobile-menu__panel-header">
                                <div class="mobile-menu__panel-title">
                                    <div class="top_logo"><a href="{{ route('frontend.homePage') }}"></a></div>
                                </div>
                            </div>
                            <div class="mobile-menu__panel-body">
                                <ul class="mobile-menu__links">
                                    <li data-mobile-menu-item>
                                        <a href="{{ route('frontend.homePage') }}">Home</a>
                                    </li>
                                    <div class="mobile-menu__divider"></div>
                                    <li data-mobile-menu-item>
                                        <a href="{{ route('frontend.about_us') }}">About Us</a>
                                    </li>
                                    <div class="mobile-menu__divider"></div>
                                    <li data-mobile-menu-item>
                                        <a href="{{ route('frontend.features') }}">Features</a>
                                    </li>
                                    <div class="mobile-menu__divider"></div>
                                    <li data-mobile-menu-item>
                                        <a href="{{ route('frontend.planlist') }}">Pricing</a>
                                    </li>
                                    <div class="mobile-menu__divider"></div>
                                    <li data-mobile-menu-item>
                                        <a href="{{ route('frontend.contact_us') }}">Contact us</a>
                                    </li>
                                    <div class="mobile-menu__divider"></div>
                                    <li data-mobile-menu-item>
                                        <a href="{{ route('frontend.not_found') }}">Register</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>