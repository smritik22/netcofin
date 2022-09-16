<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
$mnu_title_var = "title_" . @Helper::currentLanguage()->code;
$mnu_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
?>

<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside dark dk" layout="column">
        <div class="navbar navbar-md no-radius">
            <!-- brand -->
            <a class="navbar-brand text-center" href="{{ route('adminHome') }}">
                <img src="{{ asset('assets/frontend/logo/netcologo.jpg') }}" alt="Control">
                <span class="hidden-folded inline">NETCO FINTECH</span>
            </a>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ __('backend.main') }}</small>
                    </li>

                    <li
                        class="{{ \Request::route()->getName() == 'adminHome' || \Request::route()->getName() == 'dashboardfilter'? 'active': ' ' }}">
                        <a href="{{ route('adminHome') }}" onclick="location.href='{{ route('adminHome') }}'">
                            <span class="nav-icon">
                                <i class="fa fa-th-large material-icons" aria-hidden="true"></i>
                            </span>
                            <span class="nav-text">{{ __('backend.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ \Request::route()->getName() == 'generalusers' || \Request::route()->getName() == 'generaluser.create' || \Request::route()->getName() == 'generaluser.edit' || \Request::route()->getName() == 'generaluser.destroy' || \Request::route()->getName() == 'generaluser.show' ? 'active' : ' ' }}">
                        <a href="{{ route('generalusers') }}" onclick="location.href='{{ route('generalusers') }}'">
                            <span class="nav-icon">
                                <i class="fa-users material-icons" aria-hidden="true"></i>
                            </span>
                            <span class="nav-text">{{ __('backend.general_user_mngmnt') }}</span>
                        </a>
                    </li>


                    
                    <?php
                        $currentFolder = 'businessOwners'; // Put folder name here
                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                        $currentFolder2 = 'categories'; // Put folder name here
                        $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                        $currentFolder3 = 'sub-categories'; // Put folder name here
                        $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));

                        $currentFolder4 = 'modifiers'; // Put folder name here
                        $PathCurrentFolder4 = substr($urlAfterRoot, 0, strlen($currentFolder4));

                        $currentFolder5 = 'items'; // Put folder name here
                        $PathCurrentFolder5 = substr($urlAfterRoot, 0, strlen($currentFolder5));

                        $currentFolder6 = 'businessOwner'; // Put folder name here
                        $PathCurrentFolder6 = substr($urlAfterRoot, 0, strlen($currentFolder6));

                        $currentFolder7 = 'category'; // Put folder name here
                        $PathCurrentFolder7 = substr($urlAfterRoot, 0, strlen($currentFolder7));

                        $currentFolder8 = 'sub-category'; // Put folder name here
                        $PathCurrentFolder8 = substr($urlAfterRoot, 0, strlen($currentFolder8));

                        $currentFolder9 = 'modifier'; // Put folder name here
                        $PathCurrentFolder9 = substr($urlAfterRoot, 0, strlen($currentFolder9));

                        $currentFolder10 = 'item'; // Put folder name here
                        $PathCurrentFolder10 = substr($urlAfterRoot, 0, strlen($currentFolder10));


                    ?>
                    <li {{ $PathCurrentFolder == $currentFolder ||$PathCurrentFolder2 == $currentFolder2 ||$PathCurrentFolder3 == $currentFolder3 ||$PathCurrentFolder4 == $currentFolder4 ||$PathCurrentFolder5 == $currentFolder5 ||$PathCurrentFolder6 == $currentFolder6 ||$PathCurrentFolder7 == $currentFolder7 ||$PathCurrentFolder8 == $currentFolder8 ||$PathCurrentFolder9 == $currentFolder9 ||$PathCurrentFolder10 == $currentFolder10  ? 'class=active': '' }}>
                        <a>
                            <span class="nav-caret">
                                <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-icon">
                            <i class="fa-brands fa-adversal material-icons"></i>
                            </span>
                            <span class="nav-text">{{ __('backend.business_owner') }}</span>
                        </a>
                        <ul class="nav-sub ">

                            <?php
                            $currentFolder_b = 'businessOwners'; // Put folder name here
                            $PathCurrentFolder_b = substr($urlAfterRoot, 0, strlen($currentFolder_b));

                            $currentFolder_b1 = 'businessOwner'; // Put folder name here
                            $PathCurrentFolder_b1 = substr($urlAfterRoot, 0, strlen($currentFolder_b1));
                            ?>
                            <li {{ trim($PathCurrentFolder_b) == $currentFolder_b || trim($PathCurrentFolder_b1) == $currentFolder_b1 ? 'class=active' : '' }}>
                                <a href="{{ route('businessOwners') }}" onclick="location.href='{{ route('businessOwners') }}'">
                                    <span class="nav-text">{{ __('backend.business_owner') }}</span>
                                </a>
                            </li>

                            <?php
                            $currentFolder_c = 'categories'; // Put folder name here
                            $PathCurrentFolder_c = substr($urlAfterRoot, 0, strlen($currentFolder_c));

                            $currentFolder_c1 = 'category'; // Put folder name here
                            $PathCurrentFolder_c1 = substr($urlAfterRoot, 0, strlen($currentFolder_c1));
                            ?>
                            <li {{ trim($PathCurrentFolder_c) == $currentFolder_c || trim($PathCurrentFolder_c1) == $currentFolder_c1 ? 'class=active' : '' }}>
                                <a href="{{ route('categories') }}" onclick="location.href='{{ route('categories') }}'">
                                    <span class="nav-text">{{ __('backend.category') }}</span>
                                </a>
                            </li>

                            <?php
                            $currentFolder_s = 'sub-category'; // Put folder name here
                            $PathCurrentFolder_s = substr($urlAfterRoot, 0, strlen($currentFolder_s));

                            $currentFolder_s1 = 'sub-categories'; // Put folder name here
                            $PathCurrentFolder_s1 = substr($urlAfterRoot, 0, strlen($currentFolder_s1));
                            ?>
                            <li {{ trim($PathCurrentFolder_s) == $currentFolder_s || trim($PathCurrentFolder_s1) == $currentFolder_s1 ? 'class=active' : '' }}>
                                <a href="{{ route('sub-categories') }}" onclick="location.href='{{ route('sub-categories') }}'">
                                    <span class="nav-text">{{ __('backend.subCategory') }}</span>
                                </a>
                            </li>

                            <?php
                            $currentFolder_m = 'modifier'; // Put folder name here
                            $PathCurrentFolder_m = substr($urlAfterRoot, 0, strlen($currentFolder_m));

                            $currentFolder_m1 = 'modifiers'; // Put folder name here
                            $PathCurrentFolder_m1 = substr($urlAfterRoot, 0, strlen($currentFolder_m1)); 

                            ?>
                            <li {{ trim($PathCurrentFolder_m) == $currentFolder_m || trim($PathCurrentFolder_m1) == $currentFolder_m1 ? 'class=active' : '' }}>
                                <a href="{{ route('modifiers') }}" onclick="location.href='{{ route('modifiers') }}'">
                                    <span class="nav-text">{{ __('backend.modifiers') }}</span>
                                </a>
                            </li>


                            <?php
                            $currentFolder_i = 'item'; // Put folder name here
                            $PathCurrentFolder_i = substr($urlAfterRoot, 0, strlen($currentFolder_i));

                            $currentFolder_i1 = 'items'; // Put folder name here
                            $PathCurrentFolder_i1 = substr($urlAfterRoot, 0, strlen($currentFolder_i1)); 

                            ?>
                            <li {{ trim($PathCurrentFolder_i) == $currentFolder_i || trim($PathCurrentFolder_i1) == $currentFolder_i1 ? 'class=active' : '' }}>
                                <a href="{{ route('items') }}" onclick="location.href='{{ route('items') }}'">
                                    <span class="nav-text">{{ __('backend.items') }}</span>
                                </a>
                            </li>
                        </ul>

                    </li>
                 

                    <li class="{{ \Request::route()->getName() == 'subscription_plans' || \Request::route()->getName() == 'subscription_plan.create' || \Request::route()->getName() == 'subscription_plan.edit' || \Request::route()->getName() == 'subscription_plan.destroy' || \Request::route()->getName() == 'subscription_plan.show' ? 'active' : ' ' }}">
                        <a href="{{ route('subscription_plans') }}" onclick="location.href='{{ route('subscription_plans') }}'">
                            <span class="nav-icon">
                                <i class="fa-light fa-rocket material-icons"></i>
                            </span>
                            <span class="nav-text">{{ __('backend.subscription_plans') }}</span>
                        </a>
                    </li>
                    
                    <?php
                    $currentFolder = 'property-report'; // Put folder name here
                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen(trim($currentFolder)));

                    $currentFolder2 = 'subscription-report'; // Put folder name here
                    $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen(trim($currentFolder2)));

                    $currentFolder3 = 'revenue-report'; // Put folder name here
                    $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen(trim($currentFolder3)));
                    ?>

                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Report</small>
                    </li>

                    <li {{ ( $currentFolder == $PathCurrentFolder || $currentFolder2 == $PathCurrentFolder2 || $currentFolder3 == $PathCurrentFolder3 )? 'class=active' : '' }}>
                        <a>
                            <span class="nav-caret">
                                <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-icon">
                                <i class="fa fa-bar-chart material-icons" aria-hidden="true"></i>
                            </span>
                            <span class="nav-text">Report Management</span>
                        </a>
                        <ul class="nav-sub ">

                            <?php
                            $currentFolder = 'revenue-report'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ trim($PathCurrentFolder) == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{route('revenue_report')}}" class="sub-link">
                                    <span class="nav-text">{!! __("backend.revenue_report") !!}</span>
                                </a>
                            </li>

                        </ul>

                    </li>

                    

                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Web {{ __('backend.settings') }}</small>
                    </li>
                    
                    <?php
                        $currentFolder = 'banner'; // Put folder name here
                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                        $currentFolder2 = 'label'; // Put folder name here
                        $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                        $currentFolder3 = 'cms'; // Put folder name here
                        $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));

                        $currentFolder4 = 'emailtemplate'; // Put folder name here
                        $PathCurrentFolder4 = substr($urlAfterRoot, 0, strlen($currentFolder4));

                        $currentFolder5 = 'webmaster'; // Put folder name here
                        $PathCurrentFolder5 = substr($urlAfterRoot, 0, strlen($currentFolder5));

                        $currentFolder6 = 'certificate'; // Put folder name here
                        $PathCurrentFolder6 = substr($urlAfterRoot, 0, strlen($currentFolder6));


                    ?>
                    <li
                        {{ $PathCurrentFolder == $currentFolder ||$PathCurrentFolder2 == $currentFolder2 ||$PathCurrentFolder3 == $currentFolder3 ||$PathCurrentFolder4 == $currentFolder4 ||$PathCurrentFolder5 == $currentFolder5 ||$PathCurrentFolder6 == $currentFolder6  ? 'class=active': '' }}>
                        <a>
                            <span class="nav-caret">
                                <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-icon">
                                <i class="fa fa-cogs material-icons" aria-hidden="true"></i>
                            </span>
                            <span class="nav-text">{{ __('backend.master') }}</span>
                        </a>
                        <ul class="nav-sub">
                            
                            <?php
                            $currentFolder = 'label'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{ route('label') }}" >
                                    <span class="nav-text">{{ __('backend.label') }}</span>
                                </a>
                            </li>



                            <?php
                            $currentFolder = 'cms'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{ route('cms') }}" >
                                    <span class="nav-text">{{ __('backend.cms') }}</span>
                                </a>
                            </li>
                            <?php
                            $currentFolder = 'emailtemplate'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{ route('emailtemplate') }}" >
                                    <span class="nav-text">{{ __('backend.emailtemplate') }}</span>
                                </a>
                            </li>
                            <?php
                            $currentFolder = 'country'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{ route('country') }}" >
                                    <span class="nav-text">{{ __('backend.country') }}</span>
                                </a>
                            </li>

                            <?php
                            $currentFolder = 'state'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{ route('state') }}" >
                                    <span class="nav-text">{{ __('backend.state') }}</span>
                                </a>
                            </li>

                            <?php
                            $currentFolder = 'city'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{ route('city') }}" >
                                    <span class="nav-text">{{ __('backend.city') }}</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                   
                   
                    <li
                        {{ $PathCurrentFolder == $currentFolder ||$PathCurrentFolder2 == $currentFolder2 ||$PathCurrentFolder3 == $currentFolder3 ||$PathCurrentFolder4 == $currentFolder4 ||$PathCurrentFolder5 == $currentFolder5 ||$PathCurrentFolder6 == $currentFolder6 ? 'class=active': '' }}>
                        <a>
                            <span class="nav-caret">
                                <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-icon">
                                <i class="fa fa-cogs material-icons" aria-hidden="true"></i>
                            </span>
                            <span class="nav-text">{{ __('backend.generalSiteSettings') }}</span>
                        </a>
                        <ul class="nav-sub">
                           

                            <?php
                            $currentFolder = 'webmaster'; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ $PathCurrentFolder == $currentFolder ? 'class=active' : '' }}>
                                <a href="{{route('webmasterSettings')}}" >
                                    <span class="nav-text">{{ __('backend.generalSettings') }}</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    

                </ul>
            </nav>
        </div>
    </div>
</div>
