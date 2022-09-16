$(".hamburger").click(function(){
    $("#wrapper").toggleClass("hide-side-bar");
  });
  
  //password show hide
  
  $(".toggle-password").click(function() {
      $(this).toggleClass("eye-open eye-close");
      input = $(this).parent().find("input");
      if (input.attr("type") == "password") {
          input.attr("type", "text");
      } else {
          input.attr("type", "password");
      }
  });
  
  $(".eye-open").click(function(){
    $(this).hide();
  });
  
  $(".eye-open").click(function(){
    $(".eye-close").show();
  });		
  
  $(".eye-close").click(function(){
    $(this).hide();
  });
  
  $(".eye-close").click(function(){
    $(".eye-open").show();
  });		
  
  $(".toggle-password1").click(function() {
      $(this).toggleClass("eye-open1 eye-close1");
      input = $(this).parent().find("input");
      if (input.attr("type") == "password") {
          input.attr("type", "text");
      } else {
          input.attr("type", "password");
      }
  });
  
  $(".eye-open1").click(function(){
    $(this).hide();
  });
  
  $(".eye-open1").click(function(){
    $(".eye-close1").show();
  });		
  
  $(".eye-close1").click(function(){
    $(this).hide();
  });
  
  $(".eye-close1").click(function(){
    $(".eye-open1").show();
  });		
  
  $(".toggle-password2").click(function() {
      $(this).toggleClass("eye-open2 eye-close2");
      input = $(this).parent().find("input");
      if (input.attr("type") == "password") {
          input.attr("type", "text");
      } else {
          input.attr("type", "password");
      }
  });
  
  $(".eye-open2").click(function(){
    $(this).hide();
  });
  
  $(".eye-open2").click(function(){
    $(".eye-close2").show();
  });		
  
  $(".eye-close2").click(function(){
    $(this).hide();
  });
  
  $(".eye-close2").click(function(){
    $(".eye-open2").show();
  });		
  

  $(".back-to-login").click(function(){
    $('.forgot-page').hide();
  });
  $(".back-to-login").click(function(){
    $('.login-page').show();
  });
  
  $(".forget-link").click(function(){
    $(".forgot-page").show();
  });		
  $(".forget-link").click(function(){
    $(".login-page").hide();
  });		
  
  //-------input-text-change

  $(document).ready(function() {
    // set text to select company logo 
    $("#uploadlogo").after("<span class='file_placeholder'>Upload Logo</span>");
    // on change
    $('#uploadlogo').change(function() {
      //  show file name 
      if ($("#uploadlogo").val().length > 0) {
        $(".file_placeholder").empty();
        $('#uploadlogo').removeClass('vendor_logo_hide').addClass('vendor_logo');
        console.log($("#uploadlogo").val());
      } else {
        // show select company logo
        $('#uploadlogo').removeClass('vendor_logo').addClass('vendor_logo_hide');
        $("#uploadlogo").after("<span class='file_placeholder'>Upload Logo</span>");
      }
  
    });
  
  });

  $(document).ready(function() {
    // set text to select company logo 
    $("#uploadprofile").after("<span class='file_placeholder'>UploadStore Profile Image</span>");
    // on change
    $('#uploadprofile').change(function() {
      //  show file name 
      if ($("#uploadprofile").val().length > 0) {
        $(".file_placeholder").empty();
        $('#uploadprofile').removeClass('vendor_logo_hide').addClass('vendor_logo');
        console.log($("#uploadprofile").val());
      } else {
        // show select company logo
        $('#uploadprofile').removeClass('vendor_logo').addClass('vendor_logo_hide');
        $("#uploadprofile").after("<span class='file_placeholder'>UploadStore Profile Image</span>");
      }
  
    });
  
  });


//progress-bar
function makesvg(percentage, inner_text=""){

  var abs_percentage = Math.abs(percentage).toString();
  var percentage_str = percentage.toString();
  var classes = ""

  if(percentage < 0){
    classes = "success-stroke";
  } else if(percentage > 0 && percentage <= 30){
    classes = "success-stroke";
  } else{
    classes = "success-stroke";
  }

 var svg = '<svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg">'
     + '<circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9" />'
     + '<circle class="circle-chart__circle '+classes+'"'
     + 'stroke-dasharray="'+ abs_percentage+',100"    cx="16.9" cy="16.9" r="15.9" />'
     + '<g class="circle-chart__info">'
     + '   <text class="circle-chart__percent" x="17.9" y="15.5">'+percentage_str+'%</text>';

  if(inner_text){
    svg += '<text class="circle-chart__subline" x="16.91549431" y="22">'+inner_text+'</text>'
  }
  
  svg += ' </g></svg>';
  
  return svg
}

(function( $ ) {

    $.fn.circlechart = function() {
        this.each(function() {
            var percentage = $(this).data("percentage");
            var inner_text = $(this).text();
            $(this).html(makesvg(percentage, inner_text));
        });
        return this;
    };

}( jQuery ));

$(function () {
     $('.circlechart').circlechart();
});


function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
          $('#imagePreview').css('background-image', 'url('+e.target.result +')');
          $('#imagePreview').hide();
          $('#imagePreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
$("#imageUpload").change(function() {
  readURL(this);
});

//multiple image
jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}


//hover add class

// $(".hamburger").click(function(){
//   $(".navigation").toggleClass("navigation1");
// });

// $(".navigation").hover(function () {
//   $(this).toggleClass("navigation1");
// });


//slide toggle menu

// jQuery('.sidebar-toggle').click(function(){ 
//     if (jQuery(window).width() > 100 ) {
//         jQuery(".sidebar-toggle").next().slideUp(300);
//         jQuery(this).next().slideDown(300);
//         jQuery(".sidebar-toggle-open").next().slideUp();
//         jQuery(".sidebar-toggle").removeClass("sidebar-toggle-open active");
//         jQuery(this).toggleClass("sidebar-toggle-open active"); 
//     }
// });



// $(document).on("click", function (e) {
//     console.log(e.target);
//     if ($(e.target).is(".sidebar-toggle-menu")==false&&$(e.target).is('.sidebar-toggle')==false&&$(e.target).is('.sidebar-toggle-menu *')==false) {
//         $(".sidebar-toggle").removeClass("sidebar-toggle-open active");
//         jQuery(".sidebar-toggle").next().hide(300);
//     }
// });


//add menu img
function readURL(input, imgControlName) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(imgControlName).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imag").change(function() {
  // add your logic to decide which image control you'll use
  var imgControlName = "#ImgPreview";
  readURL(this, imgControlName);
  $('.preview1').addClass('it');
  $('.btn-rmv1').addClass('rmv');
});





$("#removeImage1").click(function(e) {
  e.preventDefault();
  $("#imag").val("");
  $("#ImgPreview").attr("src", "");
  $('.preview1').removeClass('it');
  $('.btn-rmv1').removeClass('rmv');
});


      $(document).ready(function(){
        $('#dynamicAttributes').select2({
          allowClear: true,
          minimumResultsForSearch: -1,
        });
        $("select").on("select2:select", function(evt) {
          var element = evt.params.data.element;
          var $element = $(element);
          $element.detach();
          $(this).append($element);
          $(this).trigger("change");
        });
      });
//
// jQuery('.js-select').select2().on('select2:open', (elm) => {
//   const targetLabel = $(elm.target).prev('label');
//   targetLabel.addClass('selected');
// }).on('select2:close', (elm) => {
//   const target = $(elm.target);
//   const targetLabel = target.prev('label');
//   const targetOptions = $(elm.target.selectedOptions);
//   if (targetOptions.length === 0) {
//     targetLabel.removeAttr('class');
//   }
// });


// $('.js-select').click(function(e){
//    if($(this).find('.select2-container--open')) {
//       $(this).prev('.head_ctrl_label').addClass('selected'); }
//       e.preventDefault();
// });

$('.dropdown').on('show.bs.dropdown', function(e){
  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
});

$('.dropdown').on('hide.bs.dropdown', function(e){
  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
});



// --------select2-------
$(document).ready(function() {
  
  //---- select2 multiple----
  $('.customSelectMultiple').each(function() {
    var dropdownParents = $(this).parents('.select2Part');
    // var placehldrget = $(this).attr("data-placeholder");
    $(this).select2({
      dropdownParent: dropdownParents,
      // placeholder: placehldrget,
      // tags: true,
      // closeOnSelect: false,
    }).on("select2:open", function (e) { 
      $(this).parents('.floating-group').addClass('focused');
    }).on("select2:close", function (e) {
      if($(this).val() != ''){
        $(this).parents('.floating-group').addClass('focused');
      }else{
        $(this).parents('.floating-group').removeClass('focused');
      }
    }).on("select2:select", function (e) { 
      $(this).parents('.floating-group').addClass('focused');
    }).on("select2:unselect", function (e) {
      $(this).parents('.floating-group').addClass('focused');
    })
  });
});

// ====== Subscription Plan JS
jQuery('.toggle_btn').click(function() {
  if (jQuery(window).width() < 999999999999999999) {
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

// Resize Function

$(window).on("load resize", function(e) {
  if ($(window).width() > 999999999999999999) {
      $(".toggle_body").show();
  } else {
      $(".toggle_body").hide();
  }
});

//custom-calender
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

//color-picker

var Chrome = VueColor.Chrome;
Vue.component('colorpicker', {
  components: {
    'chrome-picker': Chrome,
  },
  template: `
<div class="input-group color-picker" ref="colorpicker">
<div class="floating-label right-content-fill">     
  <input type="text" class="form-control floating-input mb-0" v-model="colorValue" @focus="showPicker()" @input="updateFromInput" />
  <span class="highlight"></span>
    <label>Primary Color</label>
</div>
<div class="color-picker-round">
  <img src="./assets/images/color_icon.svg">
</div>
  <span class="input-group-addon color-picker-container">
    <span class="current-color" :style="'background-color: ' + colorValue" @click="togglePicker()"></span>
    <chrome-picker :value="colors" @input="updateFromPicker" v-if="displayPicker" />
  </span>
</div>`,
  props: ['color'],
  data() {
    return {
      colors: {
        hex: '#000000',
      },
      colorValue: '',
      displayPicker: false,
    }
  },
  mounted() {
    this.setColor(this.color || '#000000');
  },
  methods: {
    setColor(color) {
      this.updateColors(color);
      this.colorValue = color;
    },
    updateColors(color) {
      if(color.slice(0, 1) == '#') {
        this.colors = {
          hex: color
        };
      }
      else if(color.slice(0, 4) == 'rgba') {
        var rgba = color.replace(/^rgba?\(|\s+|\)$/g,'').split(','),
          hex = '#' + ((1 << 24) + (parseInt(rgba[0]) << 16) + (parseInt(rgba[1]) << 8) + parseInt(rgba[2])).toString(16).slice(1);
        this.colors = {
          hex: hex,
          a: rgba[3],
        }
      }
    },
    showPicker() {
      document.addEventListener('click', this.documentClick);
      this.displayPicker = true;
    },
    hidePicker() {
      document.removeEventListener('click', this.documentClick);
      this.displayPicker = false;
    },
    togglePicker() {
      this.displayPicker ? this.hidePicker() : this.showPicker();
    },
    updateFromInput() {
      this.updateColors(this.colorValue);
    },
    updateFromPicker(color) {
      this.colors = color;
      if(color.rgba.a == 1) {
        this.colorValue = color.hex;
      }
      else {
        this.colorValue = 'rgba(' + color.rgba.r + ', ' + color.rgba.g + ', ' + color.rgba.b + ', ' + color.rgba.a + ')';
      }
    },
    documentClick(e) {
      var el = this.$refs.colorpicker,
        target = e.target;
      if(el !== target && !el.contains(target)) {
        this.hidePicker()
      }
    }
  },
  watch: {
    colorValue(val) {
      if(val) {
        this.updateColors(val);
        this.$emit('input', val);
        //document.body.style.background = val;
      }
    }
  },
});
new Vue({
  el: '#app',
  data: {
    defaultColor: '#DB3944'
  }
});