<!DOCTYPE html>
<html lang="{{ @Helper::currentLanguage()->code }}" dir="{{ @Helper::currentLanguage()->direction }}">
<head>
    @include('frontEnd.includes.head')

</head>

<body>
    <div id="wrapper">
        <!-- start header -->
        @include('frontEnd.includes.header')
        <!-- end header -->
        <div name="location" class="d-none" id="location"></div>
        <input type="hidden" name="cur_latitude" id="cur_latitude">
        <input type="hidden" name="cur_longitude" id="cur_longitude">

        <!-- Content Section -->
        <div class="contents">
            @yield('content')
        </div>
        <!-- end of Content Section -->

        <!-- start footer -->
        @include('frontEnd.includes.footer')
        <!-- end footer -->
    </div>
    @include('frontEnd.includes.foot')
    @yield('footerInclude')
   
</body>

</html>
