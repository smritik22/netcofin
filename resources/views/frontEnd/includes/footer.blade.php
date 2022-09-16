<?php
use Illuminate\Support\Str;
?>

<footer class="footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-3">
                <div class="footer_logo">
                    <a href="{{ route('frontend.homePage') }}"><img src="{{asset('assets/frontend/images/footer_logo.png')}}" alt="footer_logo"></a>
                </div>
                <div class="footer_para">
                    <p>I'm a paragraph. I’m a great place for you to tell a story and let your users know a little more about you.</p>
                </div>
                <ul class="social_media">
                    <li><a href="#"><img src="{{asset('assets/frontend/images/fb_icon.svg')}}" alt="fb_icon"></a></li>
                    <li><a href="#"><img src="{{asset('assets/frontend/images/twitter_icon.svg')}}" alt="fb_icon"></a></li>
                    <li><a href="#"><img src="{{asset('assets/frontend/images/youtube_icon.svg')}}" alt="fb_icon"></a></li>
                    <li><a href="#"><img src="{{asset('assets/frontend/images/insta_icon.svg')}}" alt="fb_icon"></a></li>
                </ul>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 footer_col">
                        <div class="quick_links">
                            <h4 class="footer_title">Quick Links</h4>
                            <ul class="footer_details">
                                <li><a href="{{ route('frontend.homePage') }}">Home</a></li>
                                <li><a href="{{ route('frontend.about_us') }}">About Us</a></li>
                                <li><a href="{{ route('frontend.features') }}">Features</a></li>
                                <li><a href="{{ route('frontend.planlist') }}">Pricing</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4 footer_col">
                        <div class="support">
                            <h4 class="footer_title">Support</h4>
                            <ul class="footer_details">
                                <li><a href="{{ route('frontend.contact_us') }}">Contact Us</a></li>
                                <li><a href="{{ route('frontend.terms_and_conditions') }}">Terms & Conditions</a></li>
                                <li><a href="{{ route('frontend.privacy_policy') }}">Privacy Policy</a></li>
                                <li><a href="">Site map</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4 footer_col">
                        <div class="get_in_touch">
                            <h4 class="footer_title">Get in Touch</h4>
                            <ul class="footer_details">
                                <li><img src="{{asset('assets/frontend/images/location.svg')}}" alt="location"/>1512 Town Center Dr, <br>
                                    Pflugerville, Texas, 78660</li>
                                <li><a href="tel:15122516763"><img src="{{asset('assets/frontend/images/phone.svg')}}" alt="phone"/>+1 (512) 251-6763</a></li>
                                <li><a href="mailto:info@netcofintech.com"><img src="{{asset('assets/frontend/images/mail_icon.svg')}}" alt="mail_icon"/>info@netcofintech.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="copyright">
                    <p>{{ (Helper::getWebsiteDetails()) ? Helper::getWebsiteDetails()->copyright_en : "@2022 Copyright netcoproperty classified. All rights reserved.. "}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>