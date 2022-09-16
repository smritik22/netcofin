// Onclick  [ Resposive menu ] -------------------------------------------------------------------

$('.menuToggle').on("click", function() {
    if ($(window).width() < 992) {
        $('.menu-menu-1-container').slideToggle();
    }
    $('.menu-menu-1-container').toggleClass('toggled-on');
});

// Resize Function

$(window).on("load resize", function(e) {
    if ($(window).width() > 991) {
        $(".menu-menu-1-container").show();
    } else {
        $(".menu-menu-1-container").hide();
    }
});

// Sticky Header ---------------------------------------------------------------------------------

function resizeHeaderOnScroll() {
    const distanceY = window.pageYOffset || document.documentElement.scrollTop,
        shrinkOn = 50,
        headerEl = document.getElementById('js-header');
    if (distanceY > shrinkOn) {
        headerEl.classList.add("smaller");
    } else {
        headerEl.classList.remove("smaller");
    }
}

window.addEventListener('scroll', resizeHeaderOnScroll);

// Resize Function

$(window).on("load resize", function(e) {
    if ($(window).width() > 999) {
        $(".navigation-menu").show();
    } else {
        $(".navigation-menu").hide();
    }
});


$(window).on("load resize", function(e) {
    if ($(window).width() > 767) {
        $(".footer_details").show();
    } else {
        $(".footer_details").hide();
    }
});

// Navigation Menu [ With Submenu ] ------------------------------------------------------------------

$(".menuToggle").click(function(e) {
    $('.navigation-menu').slideToggle('slow');
});
$(".navigation-menu li > ul.sub-menu").before('<span class="arw"><i class="fa fa-plus"></i></span>');
$(".navigation-menu .arw").click(function(e) {
    $(this).next().slideToggle('slow');
    $(this).children(".fa").toggleClass('fa-minus');
});

// Footer Link --------------------------------------------------------------------------------------

jQuery('.footer_title').click(function() {
    if (jQuery(window).width() < 768) {
        jQuery(this).next().slideToggle(300);
        jQuery(this).toggleClass("active");
    }
});

var resizeTimer;
$(window).resize(function(e) {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        $(window).trigger('delayed-resize', e);
    }, 250);
});