$(document).ready(function () {
    $(".navbar-toggler").on("click", function() {
        $(".header").toggleClass("med-overflow");
        $("body").toggleClass("overflow-y");
    });
    $(".header .dropdown-item").on('click', function () {
        if ($(window).width() <= 991) { 
          $(".header").toggleClass("med-overflow");
          $("body").toggleClass("overflow-y");
          $("#navbarSupportedContent").removeClass("show");
          $(".nd-menu .nav-link").removeClass('active');
        }
    })
    $('.re-header').on('click', function () {
        if ($(window).width() <= 991) { 
            $(".header").toggleClass("med-overflow");
            $("body").toggleClass("overflow-y");
            $("#navbarSupportedContent").removeClass("show");
        }
    })
    $(".nd-menu .nav-link").on("click", function() {
        $(".nd-menu .nav-link").not(this).removeClass('active');
        $(this).toggleClass('active');
    });

    $(".add-select label").on("click", function() {
        $(".add-select label").removeClass("active");
        $(this).addClass("active");
    });

    var rtlDirection = null; // detect direction of body
   $("body").hasClass( "rtl" ) ? rtlDirection = true : rtlDirection = false
  
    $(".home-slider").owlCarousel({
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout:2000,
        loop: true,
        rtl:rtlDirection,
        responsive: {
           0: {
                items:3,
            },
            550: {
                items: 3,
            },
            786: {
                items: 4,

            },
            1000: {
                items: 5
            }
            ,
            1200: {
                items: 6
            }
        }
    });


  $(".product-slider").owlCarousel({
        items: 1,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout:2000,
        loop: true,
        rtl:rtlDirection,
        responsive: {
          0: {
          items: 1,
          stagePadding: 25,
          },
          390: {
            items: 1,
            stagePadding: 50,
          },
          450: {
          items:2,
          },
          600: {
          items:3,
          },
          850: {
          items: 4,

          },
          1000: {
          items: 5
          }
          ,
          1200: {
          items: 5.4
          }
        }
    });

    $(".video-popup").magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        zoom: {
          enabled: true,
        },
      });
    
      $(".img-popup").magnificPopup({
        type: "image",
        gallery: {
          enabled: true,
        },
      });
    
      $(".pro-dec-big-img-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: ".product-dec-slider",
      });
      $(".product-dec-slider").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        vertical: true,
        asNavFor: ".pro-dec-big-img-slider",
        dots: false,
        focusOnSelect: true,
        fade: false,
        prevArrow:
          '<span class="pro-dec-icon pro-dec-prev"><i class="fa fa-angle-up"></i></span>',
        nextArrow:
          '<span class="pro-dec-icon pro-dec-next"><i class="fa fa-angle-down"></i></span>',
        responsive: [
          {
            breakpoint: 767,
            settings: {},
          },
          {
            breakpoint: 420,
            settings: {
              autoplay: true,
              slidesToShow: 2,
            },
          },
        ],
      });
    
      $(".sidebar-active").stickySidebar({
        topSpacing: 80,
        bottomSpacing: 30,
        minWidth: 991,
      });
  
     ////////////// create zoom in to the master image product
    $('.easyzoom-img').on("mouseover", function () {
        $(".master-product-img").css({ transform: "scale(2)" });
    }).on("mouseout", function () {
        $(".master-product-img").css({ transform: "scale(1) " });
    }).on("mousemove", function (e) {
        $(".master-product-img").css({
                "transform-origin":
                    ((e.pageX - $(this).offset().left) / $(this).width()) *
                        100 +
                    "% " +
                    ((e.pageY - $(this).offset().top) / $(this).height()) *
                        100 +
                    "%",
            });
    });
  
})

function getVals(){
    // Get slider values
    var parent = this.parentNode;
    var slides = parent.getElementsByTagName("input");
      var slide1 = parseFloat( slides[0].value );
      var slide2 = parseFloat( slides[1].value );
    // Neither slider will clip the other, so make sure we determine which is larger
    if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
    
    var displayElement = parent.getElementsByClassName("rangeValues")[0];
    displayElement.innerHTML =  ` OMR  ${slide1} : OMR ${slide2} `
  }
  
  window.onload = function(){
    // Initialize Sliders
    var sliderSections = document.getElementsByClassName("range-slider");
        for( var x = 0; x < sliderSections.length; x++ ){
          var sliders = sliderSections[x].getElementsByTagName("input");
          for( var y = 0; y < sliders.length; y++ ){
            if( sliders[y].type ==="range" ){
              sliders[y].oninput = getVals;
              // Manually trigger event first time to display values
              sliders[y].oninput();
            }
          }
        }
}
  ///////////////////////

