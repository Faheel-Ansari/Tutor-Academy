/*--------------------- Copyright (c) 2024 -----------------------
[Master Javascript]
Project: eLearning HTML
-------------------------------------------------------------------*/
var cursor = document.querySelector(".custom-cursor__cursor");
var cursorinner = document.querySelector(".custom-cursor__cursor-two");
var a = document.querySelectorAll("a");

document.addEventListener("mousemove", function (e) {
    var x = e.clientX;
    var y = e.clientY;
    cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
});

document.addEventListener("mousemove", function (e) {
    var x = e.clientX;
    var y = e.clientY;
    cursorinner.style.left = x + "px";
    cursorinner.style.top = y + "px";
});

document.addEventListener("mousedown", function () {
    cursor.classList.add("click");
    cursorinner.classList.add("custom-cursor__innerhover");
});

document.addEventListener("mouseup", function () {
    cursor.classList.remove("click");
    cursorinner.classList.remove("custom-cursor__innerhover");
});

a.forEach((item) => {
    item.addEventListener("mouseover", () => {
        cursor.classList.add("custom-cursor__hover");
    });
    item.addEventListener("mouseleave", () => {
        cursor.classList.remove("custom-cursor__hover");
    });
});
// var strickyScrollPos = 100;
// if ($(window).scrollTop() > strickyScrollPos) {
//     $(".scroll-to-top").fadeIn(500);
// } else if ($(this).scrollTop() <= strickyScrollPos) {
//     $(".scroll-to-top").fadeOut(500);
// }
$(".scroll-to-target").on("click", function () {
    var target = $(this).attr("data-target");
    // animate
    $("html, body").animate(
        {
            scrollTop: $(target).offset().top,
        },
        1000
    );

    return false;
});

(function ($) {
    "use strict";
    var eLearning = {
        initialised: false,
        version: 1.0,
        mobile: false,
        init: function () {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-------------- eLearning Functions Calling ---------------------------------------------------
		------------------------------------------------------------------------------------------------*/
            this.SearchBox();
            this.ToggleMenu();
            this.Select2();
            this.BottomTop();
            this.VideoPopup();
            this.counter();
            this.CourseSlider();
            this.TeamSlider();
            this.DatePicker();
            this.TesmnlSlider();
            this.BlogSlider();
            this.CheckoutPayment();
            this.HeaderFixed();
        },

        /*-------------- eLearning Functions Calling ---------------------------------------------------
		--------------------------------------------------------------------------------------------------*/

        // Search Box
        SearchBox: function () {
            $(".el-header-search").on("click", function () {
                $(".searchBox").addClass("show");
            });
            $(".closeBtn").on("click", function () {
                $(".searchBox").removeClass("show");
            });
            $(".searchBox").on("click", function () {
                $(".searchBox").removeClass("show");
            });
            $(".search-bar-inner").on("click", function () {
                event.stopPropagation();
            });
        },
        // Search Box

        // Toggle Menu
        ToggleMenu: function () {
            $(".el_toggle_btn").on("click", function (e) {
                e.stopPropagation();
                $(".el-header-right").toggleClass("el_menu_open");
            });

            $(".el-header-right").click(function (e) {
                e.stopPropagation();
            });

            $("body,html").click(function (e) {
                $(".el-header-right").removeClass("el_menu_open");
            });

            // Submenu
            $(".el-has-menu > a").click(function (event) {
                event.preventDefault();
                var $submenu = $(this).next(".el-sub-menu");

                $(".el-sub-menu")
                    .not($submenu)
                    .slideUp()
                    .removeClass("el-submenu-open");

                $submenu.slideToggle().toggleClass("el-submenu-open");
            });

            $(".el-sub-menu a").click(function (event) {
                event.stopPropagation();
            });
        },
        // Toggle Menu

        // Select 2
        Select2: function () {
            $(".mySelect").select2({
                placeholder: "Select an option",
                width: "100%",
                dropdownAutoWidth: true,
                minimumResultsForSearch: Infinity,
            });
        },
        // Select 2

        // Bottom To Top
        BottomTop: function () {
            if ($("#button").length > 0) {
                var btn = $("#button");
                $(window).scroll(function () {
                    if ($(window).scrollTop() > 300) {
                        btn.addClass("show");
                    } else {
                        btn.removeClass("show");
                    }
                });
                btn.on("click", function (e) {
                    e.preventDefault();
                    $("html, body").animate({ scrollTop: 0 }, "300");
                });
            }
        },
        // Bottom To Top

        // Video Popup
        VideoPopup: function () {
            $(".video-popup").magnificPopup({
                type: "iframe",
            });
        },
        // Video Popup

        // counter
        counter: function () {
            $(".el-counting").text("");
            $(".el-counting").each(function () {
                var $this = $(this),
                    countTo = $this.attr("data-to");
                $({ countNum: $this.text() }).animate(
                    { countNum: countTo },
                    {
                        duration: 3000,
                        easing: "linear",
                        step: function () {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.text(this.countNum);
                        },
                    }
                );
            });
        },
        // counter

        // Course Slider
        CourseSlider: function () {
            var swiper = new Swiper(".el-tab-slider-parent", {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                autoplay: true,
                speed: 1000,
                effect: "slide",
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    575: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                },
            });
        },
        // Course Slider

        // Team Slider
        TeamSlider: function () {
            var swiper = new Swiper(".el-team-parent", {
                slidesPerView: 4,
                spaceBetween: 30,
                loop: true,
                autoplay: true,
                speed: 1000,
                effect: "slide",
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 15,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                },
            });
        },
        // Team Slider

        // Date Picker
        DatePicker: function () {
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
            });
        },
        // Date Picker

        // Testimonial Slider
        TesmnlSlider: function () {
            if ($(".el-testmnl-slider").length) {
                var BannerSlider = new Swiper(".el-testmnl-slider", {
                    loop: true,
                    speed: 1000,
                    autoplay: true,
                    effect: "coverflow",
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: "auto",
                    initialSlide: 1,
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 70,
                        depth: 200,
                        modifier: 1,
                        slideShadows: false,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        1400: {
                            rotate: 0,
                            stretch: 70,
                            depth: 200,
                        },
                        481: {
                            rotate: 0,
                            depth: 100,
                        },
                        0: {
                            rotate: 0,
                            depth: 0,
                            centeredSlides: false,
                            effect: "slide",
                        },
                    },
                });
            }
            var swiper = new Swiper(".el-temnl-text-slider", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: true,
                speed: 1000,
                effect: "slide",
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        },
        // Testimonial Slider

        // Blog Slider
        BlogSlider: function () {
            var swiper = new Swiper(".el-blog-slider-parent", {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                // autoplay:true,
                speed: 1000,
                effect: "slide",
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    1199: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    575: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                },
            });
        },
        // Blog Slider

        // Checkout Payment
        CheckoutPayment: function () {
            $("input[name$='checkout']").on("click", function () {
                var test = $(this).val();
                $(".payment_box").hide("slow");
                $(".payment_box[data-period='" + test + "']").show("slow");
            });
        },
        // Checkout Payment

        // Header Fixed
        HeaderFixed: function () {
            // Menu js for Position fixed
            var widthh = window.innerWidth;
            if (widthh >= 1200) {
                $(window).scroll(function () {
                    var window_top = $(window).scrollTop() + 1;
                    if (window_top > 500) {
                        $(".el-header-wrapper").addClass(
                            "header_fixed animated fadeInDown"
                        );
                    } else {
                        $(".el-header-wrapper").removeClass(
                            "header_fixed animated fadeInDown"
                        );
                    }
                });
            }

            if (widthh <= 1199) {
                $(window).scroll(function () {
                    var window_top = $(window).scrollTop() + 1;
                    if (window_top > 500) {
                        $(".el-header-wrapper").addClass("header_fixed");
                    } else {
                        $(".el-header-wrapper").removeClass("header_fixed");
                    }
                });
            }
        },
        // Header Fixed
    };
    eLearning.init();
})(jQuery);
