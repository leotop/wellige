$(function() {
    "use strict";

    var $background = $('.js-bright-bg');
    if (!$background.length) return;

    var $burger = $('.js-burger');


    $(window).on('scroll load', function() {
        var $windowTop = $W.scrollTop();

        $background.each(function(){
            var $self= $(this),
            $bgTop = $self.offset().top,
            $bgHeight = $self.height(),
            $bgBottom = $bgTop + $bgHeight;

            if ($windowTop > $bgTop) {

                $burger.addClass('__green');

                if ($windowTop > $bgBottom) {
                    $burger.removeClass('__green');
                }

            } else {
                $burger.removeClass('__green');

            }
        });


    });

});

$(function() {
    "use strict";

    if (smallWidth()) {
        $('.js-header').addClass('header--fixed');
    }

    if (!$('.js-slide').length) {
        $('.js-menu').addClass('__animate');
    }

    if (smallWidth()) return;

    var $head = $('.js-fixed-head');
    if (!$head.length) return;

    if ($('.js-fullpage').length) return;

    $(window).on('scroll load', function() {

        var $windowTop = $W.scrollTop(),
        $bodyTop = $B.offset().top;

        if ($windowTop > $bodyTop) {

            $head.addClass('header--small');

        } else {
            $head.removeClass('header--small');

        }
    });

});

$(function() {
    "use strict";

    var $form = $('.js-submit-form');
    if (!$form.length) return;

    // Добавляем метод проверки на текст
    $.validator.addMethod(
        'textonly',
        function(value, element) {
            valid = false;
            check = /[^-\a-zA-Zа-яА-ЯЁё\s]/.test(value);
            if (check === false)
                valid = true;
            return this.optional(element) || valid;
        },
        $.validator.format('Используете только буквы, пробелы или дефисы')
    );

    // метод проверки на телефон

    $.validator.addMethod(
        'phone',
        function(value, element) {
            var re = /^[\+]?([0-9\(\)\s\-]{7,})$/im;
            return this.optional(element) || re.test(value);
        },
        'Неверно указан телефон'
    );

    // метод проверки на почту
    $.validator.addMethod(
        'email',
        function(value, element) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return this.optional(element) || re.test(value);
        },
        'Неверно указан Email'
    );



    $form.each(function() {
        var $form = $(this),
        $successMessage = $form.find('.js-success-message'),
        $errorMessage = $form.find('.js-error-message'),
        $button = $form.find('BUTTON'),
        $closeMessage = $form.find('.js-close-message');

        var validator = $(this).validate({
            // ignore: ":hidden:not(.js-add-file:visible #browse)",

            // onfocusout: true,
            // onkeyup: function(element) {
            //     $(element).valid()
            // },

            rules: {
                name: {
                    required: true,
                },
                company: {
                    required: true,
                },
                phone: {
                    required: true,
                    phone: true,
                },
                mail: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                },

            },

            // unhighlight: function(element, errorClass, validClass) {
            //     $(element).parent()
            //         .removeClass('__false')
            //         .addClass('__true');
            // },
            // highlight: function(element, errorClass, validClass) {
            //     $(element).parent()
            //         .addClass('__false')
            //         .removeClass('__true');
            //
            // },
            errorPlacement: function(error, element) {
                //     $(element).parent().attr('alt', error.text());
            },

            // // отправка формы
            submitHandler: function(form) {
                $form.ajaxSubmit({
                    method: 'get',
                    dataType: 'json',

                    beforeSubmit: function() {
                        $button.attr('disabled', true);

                    },

                    error: function() {
                        $button.removeAttr('disabled');
                        $errorMessage.addClass('__open');

                    },

                    success: function(data) {
                        $button.removeAttr('disabled');

                        if (data.error === 0) { // Успешная отправка
                            // $form.resetForm();
                            validator.resetForm();
                            $successMessage.addClass('__open');

                        } else { // Ошибка на сервере
                            $button.removeAttr('disabled');
                            $errorMessage.addClass('__open');

                        }

                    }
                });
            }
        });

        $closeMessage.on('click', function() {
            $errorMessage.removeClass('__open');
            $successMessage.removeClass('__open');
        });
    });

    $('.js-email-submit').each(function() {
        var $form = $(this),
        $successMessage = $form.find('.js-success-message'),
        $errorMessage = $form.find('.js-error-message'),
        $button = $form.find('BUTTON'),
        $closeMessage = $form.find('.js-close-message');

        var validator = $(this).validate({

            rules: {
                mail: {
                    required: true,
                    email: true
                },
            },


            errorPlacement: function(error, element) {
                //     $(element).parent().attr('alt', error.text());
            },

            // // отправка формы
            submitHandler: function(form) {
                $form.ajaxSubmit({
                    method: 'get',
                    dataType: 'json',

                    beforeSubmit: function() {
                        $button.attr('disabled', true);
                    },

                    error: function() {
                        $button.removeAttr('disabled');
                        $errorMessage.addClass('__open');
                    },

                    success: function(data) {
                        $button.removeAttr('disabled');

                        if (data.error === 0) { // Успешная отправка
                            // $form.resetForm();
                            validator.resetForm();
                            $successMessage.addClass('__open');

                        } else { // Ошибка на сервере
                            $button.removeAttr('disabled');
                            $errorMessage.addClass('__open');

                        }

                    }
                });
            }
        });

        $closeMessage.on('click', function() {
            $errorMessage.removeClass('__open');
            $successMessage.removeClass('__open');
        });
    });

});

$(function() {
    "use strict";

    var $btn = $('.js-dropdown-trigger'),
    $dropdown = $('.js-dropdown');

    $btn.on('click', function(e) {
        if($(e.target).closest('a').length) return;


        var $self = $(this);

        if ($self.hasClass('__open')) {
            $btn.removeClass('__open');
            $dropdown.slideUp();

        } else {
            $btn.removeClass('__open');
            $self.addClass('__open');
            $dropdown.slideUp();
            $self.next($dropdown).slideDown();
        }

    });
});

var $W = $(window),
$D = $(document),
$H = $('html'),
$B = $('body'),
app = app || {};

function library(module) {
    $(function() {
        "use strict";
        if (module.init) {
            module.init();
        }
    });
    return module;
}

function iosCheck() {
    var check = false;
    if (navigator.userAgent.match(/(iPad|iPhone|iPod)/g)) {
        check = true;
    }
    return check;
}

$(function() {
    "use strict";

    var $popupBtn = $('.js-movie-popup-btn'),
    $videoPopupBtn = $('.js-movie-popup-btn--video');

    if (!$popupBtn.length) return;

    var $popup = $('.js-movie-popup'),
    $popupParrent = $('.js-popup-parrent'),
    $closePopup = $('.js-close-media-popup'),
    hash = $videoPopupBtn.parents('.js-slide').next().data('anchor');

    var vid = $('.js-film'),
    src = vid.data('src'),
    instance;

    vid.vide(src, {
        volume: 1,
        playbackRate: 1,
        muted: true,
        loop: false,
        autoplay: true,
        position: '50% 50%',
        resizing: true,
        posterType: 'none'
    });


    var video = document.querySelector(".js-film video");

    instance = vid.data('vide');

    video.addEventListener('loadeddata', function() {
        video.pause();
        }, false);

    video.addEventListener('ended', function() {
        $popupParrent.removeClass('__popup--video');
        location.hash = hash;
        $videoPopupBtn.text('смотреть еще раз');
        }, false);

    $popupBtn.on('click', function(event) {
        if ($(this).is('.js-movie-popup-btn--video')) {
            $popupParrent.addClass('__popup--video');
            instance.resize();
            video.play();
            video.muted = false;
        } else {
            $popupParrent.addClass('__popup');
        }
    });

    $closePopup.on('click', function() {
        $popupParrent.removeClass('__popup');
    });

    $popupParrent.on('click', function(event) {
        if (vid.is(':visible') && !$(event.target).is('.js-movie-popup-btn')) {
            $popupParrent.removeClass('__popup __popup--video');
            video.pause();
        }
    });
});

function mobileCheck() {
    var check = false;
    (function(a) {
        if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) {
            check = true;
        }
    })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
}

function smallWidth() {
    if (screen.width < 1024) {
        return true;
    }
}


// $(function() {
//     var $mobileEl = $('.js-if-mobile'),
//         $desktopEl = $('.js-if-desktop');

//     if ($mobileEl.length || $desktopEl.length) {
//         if (mobileCheck()) {
//             $desktopEl.hide();
//         } else {
//             $mobileEl.hide();
//         }
//     }
// });

$(function() {
    "use strict";

    var $burger = $('.js-burger');
    if (!$burger.length) return;

    var $menu = $('.js-menu'),
    $close = $('.js-close-menu'),
    $curHeight = $menu.height(),
    $hidden = $('.js-hidden-column'),
    $header = $('.js-header');


    function openMenu(menu) {
        menu.addClass('__active');

        var $autoHeight = menu.css('height', 'auto').height();
        menu.height($curHeight);
        menu.stop().animate({
            height: $autoHeight
            }, 100);

    }

    function closeMenu() {
        $menu.removeClass('__active');

        $menu.css({
            height: ''
        });
    }

    var scrollW = window.innerWidth - $W.width();

    function lockWidth() {
        var w = window.innerWidth;

        $B.css({
            'width': w - scrollW
        });

        $('.js-lock-scroll').css({
            'width': w - scrollW
        });
    }

    function lockScroll() {
        // lockWidth();
        $B.addClass('_noscroll');
    }

    function unlockScroll() {

        $B.removeClass('_noscroll').css({
            'width': ''
        });

        $('.js-lock-scroll').css({
            'width': ''
        });

    }

    $burger.on('click', function() {
        $burger.toggleClass('__close');

        if ($(window).width() > 1024) {
            $hidden.toggle(400);
        } else {
            $hidden.toggle();
        }

        $header.toggleClass('__down');


        if (!$menu.hasClass('__active')) {
            $menu.addClass('__active');
            lockScroll();

        } else {
            closeMenu($menu);
            $menu.removeClass('__active');
            unlockScroll();

        }

        var $overlay = $('.mobile-overlay');

        if (!$overlay.length) {
            $B.prepend("<div class='mobile-overlay'></div>");
            $overlay = $('.mobile-overlay');
            $overlay.addClass('__active');

        } else {
            $overlay.toggleClass('__active');
        }
    });

    $(document).click(function(event) {

        if ($(event.target).closest($menu).length || $(event.target).closest($burger).length) {
            return;
        } else {
            var $overlay = $('.mobile-overlay');
            $burger.removeClass('__close');
            $menu.removeClass('__active');
            $overlay.removeClass('__active');
            $menu.removeClass('__active');
            if ($(window).width() > 1024) {
                $hidden.hide(500);
            } else {
                $hidden.hide();
            }
            unlockScroll();

        }
    });

    // $(window).resize(function() {
    // if ($menu.hasClass('__active')) {
    // lockWidth();
    // }
    // });

});

// image popup
$(function() {
    "use strict";

    var $popupBtn = $('.js-image-popup');
    if (!$popupBtn.length) return;
    $popupBtn.magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        gallery: {
            arrowMarkup: '<button title="%title%" type="button" class="pswp__button pswp__button--arrow--%dir%"></button>',
            enabled:true,
            preload: [0,2],
            navigateByImgClick: true,
        }
    });

});

// video popup
$(function() {
    "use strict";

    var $popupBtn = $('.js-video-popup');
    if (!$popupBtn.length) return;

    $popupBtn.magnificPopup({
        type: 'iframe',
        removalDelay: 160,
        preloader: false,
        closeBtnInside: false,
        fixedContentPos: true
    });

});

// city popup
$(function() {
    "use strict";

    var $popup = $('.js-city-popup');
    if (!$popup.length) return;

    var myCookie = Cookies.get('user');

    if (myCookie === undefined) {

        Cookies.set('user', 1);

        var $closeBtn = $('.js-close-popup'),
        $listBtn = $('.js-select-city'),
        $inner = $('.js-city-popup-inner'),
        $cityList = $('.js-city-list'),
        $city = $('.js-city-item');


        $.magnificPopup.open({
            items: {
                src: $popup,
                type: 'inline'
            },
            modal: true
        });

        $closeBtn.on("click", function() {
            $.magnificPopup.close();

        });

        $city.on("click", function() {
            $.magnificPopup.close();

        });

        $listBtn.on("click", function() {
            $inner.addClass('__hide');
            $cityList.addClass('__show');
        });
    }


});

$(function() {
    "use strict";

    $('.js-print').click(function(){
        window.print();
    });
});

$(function() {
    "use strict";

    $('.js-scroll-link').on('click', function() {

        var $target = $($(this).attr('href')),
        targetOffset = $target.position().top - 90;

        $('html, body').animate({
            scrollTop: targetOffset
            }, 800);

        return false;
    });
});

$(function() {

    function ie9() {
        if ($H.hasClass('no-cssanimations')) {
            return true;
        } else {
            return false;
        }
    }

    function destoySlider() {
        if (ie9() || smallWidth() === true) {
            return true;
        } else {
            return false;
        }
    }

    $('.js-fullpage').fullpage({
        
        //Navigation
        lockAnchors: destoySlider(),
        // navigationTooltips: ['firstSlide', 'secondSlide'],
        // showActiveTooltip: false,
        // slidesNavigation: true,
        // slidesNavPosition: 'bottom',

        //Scrolling
        css3: true,
        scrollingSpeed: 700,
        autoScrolling: !destoySlider(),
        // autoScrolling: false,
        fitToSection: !destoySlider(),
        // fitToSection: false,
        scrollBar: false,
        easing: 'easeInOutCubic',
        easingcss3: 'ease',
        loopBottom: false,
        loopTop: false,
        loopHorizontal: true,
        continuousVertical: false,
        normalScrollElements: '#element1, .element2',
        scrollOverflow: false,
        touchSensitivity: 15,
        normalScrollElementTouchThreshold: 6,

        //Accessibility
        keyboardScrolling: true,
        animateAnchor: true,
        recordHistory: true,

        //Design
        controlArrows: false,
        verticalCentered: false,
        resize: false,
        responsiveWidth: 768,
        responsiveHeight: 650,

        //Custom selectors
        sectionSelector: '.js-slide',
        slideSelector: '.js-slider-item',

        //events
        // afterLoad: function(anchorLink, index, slideAnchor, slideIndex) {
        //     if(index == 1) {
        //         $B.addClass("hidden-head")
        //     }

        // },

        onLeave: function(index, nextIndex, direction) {
            var currentSection = $(this),
            nextSection = currentSection.next(),
            prevSection = currentSection.prev();


            // if (nextSection.data('anim') == 'parallax') {
            // var quit = false;
            // if (nextIndex == index + 1 && !nextSection.data('anchor') == "hide") {


            //     if (direction == 'down') {
            //         // return false;
            //         currentSection.addClass("__hide");
            //         nextSection.addClass("__up");
            //         // event.preventDefault();


            //         setTimeout(function() {
            //             $.fn.fullpage.silentMoveTo('#hide');
            //             $.fn.fullpage.silentMoveTo(nextIndex);

            //             nextSection.removeClass("__up");
            //             currentSection.removeClass("__hide");
            //     // return false;

            //         }, 1000)
            //         return false;


            //     }

            setFrameSize();
            if (!destoySlider()) {

                if (direction == 'down') {
                    nextSection.addClass('__animate');
                }
            }


            if (!destoySlider()) {

                if (direction == 'down' && nextSection.data('color') == "white" || direction == 'up' && prevSection.data('color') == "white") {
                    $('.js-header').removeClass("header--transparent");
                } else {
                    $('.js-header').addClass("header--transparent");
                }

                if (currentSection.data('anchor') == "top") {
                    $('.js-header').removeClass("header--hidden");
                    nextSection.removeClass('__animate');
                    // nextSection.addClass('__animate');
                }
                if (nextIndex == 1 && prevSection.data('anchor') == "top") {
                    $('.js-header').addClass("header--hidden");
                }

                if (nextIndex !== 1) {
                    $('.js-header').addClass("header--small");
                } else {
                    // if (prevSection.data('anchor') !== "top") {
                    $('.js-header').removeClass("header--small");
                    // }
                }
            }

            // if (nextIndex == 2 && direction == 'down') {
            if (!destoySlider()) {
                if (nextIndex == 2 && currentSection.data('anchor') == "top" && direction == 'down') {
                    currentSection.addClass("__fadeOut");

                    setTimeout(function() {
                        $.fn.fullpage.silentMoveTo(nextIndex + 1);
                        $.fn.fullpage.silentMoveTo(nextIndex);
                        currentSection.removeClass("__fadeOut");

                        }, 1000);

                    return false;
                }
            }

        },
        afterLoad: function(anchorLink, index) {
            var currentSection = $(this);
            if (index == 1) {
                currentSection.addClass('__animate');
                $('.js-menu').addClass('__animate');
            }
            if (!destoySlider()) {
                if (currentSection.data('anchor') == "principles") {
                    currentSection.addClass('__animate');
                }

            }


        },
        // onLeave: function(index, nextIndex, direction) {},
        // afterRender: function() {},
        // afterResize: function() {},
        // afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex) {},
        onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex) {
            var currentSlide = $(this),
            nextSlide = currentSlide.next(),
            prevSlide = currentSlide.prev(),

            section = currentSlide.parents(".js-slide"),
            bg = section.find('.slide__bg'),
            nav = section.find('.js-slide-nav'),
            frame = section.find('.js-nav-frame');

            nav.removeClass('__active');
            nav.eq(nextSlideIndex).addClass('__active');

            bg.removeClass('__active');
            bg.eq(nextSlideIndex).addClass('__active');

            setFrameSize();

        }
    });

    $('.js-down').on('click', function() {
        $.fn.fullpage.moveTo($(this).data('dest'));

        if ($(this).data('dest') == 'top') {
            $('.js-header').addClass(" header--hidden");
        }
    });


    $('.js-principles-more').on('click', function() {
        var dest = $(this).data('dest');
        $.fn.fullpage.moveTo(dest);

    });


    $('.js-slide[data-type="sliderTextNav"]').each(function() {
        var section = $(this),
        nav = section.find('.js-slide-nav');

        nav.wrapInner('<div class="slide__nav-inner"></div>');
    });

    function setFrameSize() {
        if (!smallWidth()) {

            $('.js-slide[data-type="sliderTextNav"]').each(function() {
                var section = $(this),
                frame = section.find('.js-nav-frame'),
                nav = section.find('.js-slide-nav'),
                activeNav = nav.filter('.__active'),
                navInner = section.find('.slide__nav-inner');

                frame.css({
                    'height': activeNav.parent().innerHeight(),
                    'width': activeNav.find(navInner).innerWidth() + 40,
                    'left': activeNav.find(navInner).offset().left - 20
                });

            });
        }
    }

    setFrameSize();


    var arrowNext = $('.js-arrow-next'),
    arrowPrev = $('.js-arrow-prev'),
    section = arrowNext.parents('.js-slide'),
    sectionData = section.data('anchor'),
    slide = section.find('.js-slider-item'),
    count = slide.length,
    nav = section.find('.js-slide-nav');


    $('.js-slide[data-type="sliderArrow"], .js-slide[data-type="sliderTextArr"]').each(function() {
        var section = $(this),
        sliderItem = section.find('.js-slider-item');

        section.find('.slide__wrap').append('<div class="slide__nav slide__nav--dots"></div>');

        var nav = section.find('.slide__nav');
        sliderItem.each(function() {
            nav.append('<div class="js-slide-nav slide__dot"></div>');
        });

        var dot = section.find('.js-slide-nav');
        dot.eq(sliderItem.filter('.active').index()).addClass('__active');

    });


    $('.js-slide[data-family="collection"]').each(function() {
        var section = $(this);

        if (section.next().length || section.next().data('type') == 'sliderTextArr') {
            var collectionName = section.next().data('name');
            var nav = section.find('.slide__nav');
            if (!nav.length) {

                section.find('.slide__wrap').append('<div class="slide__nav"></div>');
                nav = section.find('.slide__nav');

            }

            nav.append('<div class="btn__next-slide js-next">Коллекция «' + collectionName + '»</div>');

            $('.js-next').on('click', function() {
                var section = $(this).parents('.js-slide'),
                index = section.index() + 1;

                $.fn.fullpage.moveTo(index + 1);
            });

        }
    });


    $('.js-slide[data-type="sliderArrow"]').each(function() {
        var section = $(this);

        section.append('<div class="slide__arrow slide__arrow--left js-arrow-prev"> <div class="btn-arrow btn-arrow--left "></div></div>');

        section.append('<div class="slide__arrow slide__arrow--right js-arrow-next"> <div class="btn-arrow btn-arrow--right "></div></div>');
        var arrowNext = $('.js-arrow-next'),
        arrowPrev = $('.js-arrow-prev');

    });

    $('.js-slide[data-type="sliderTextArr"]').each(function() {

        $('.js-slide-nav').on('click', function() {
            var index = slide.filter('.active').index();
            arrowPrev.html(slide.eq(index - 1).data('title'));

            if (index == count - 1) {
                arrowNext.html(slide.eq(0).data('title'));
            } else {
                arrowNext.html(slide.eq(index + 1).data('title'));
            }
        });

        arrowNext.on('click', function() {
            var arrow = $(this),
            index = slide.filter('.active').index(),
            nextIndex = index + 1;

            arrowPrev.html(slide.eq(index).data('title'));

            if (nextIndex == count) {

                arrowNext.html(slide.eq(1).data('title'));

            } else {

                if (nextIndex == count - 1) {
                    arrowNext.html(slide.eq(0).data('title'));
                } else {
                    arrowNext.html(slide.eq(nextIndex + 1).data('title'));
                }
            }
        });

        arrowPrev.on('click', function() {
            var index = slide.filter('.active').index(),
            prevIndex = index - 1;


            arrowNext.html(slide.eq(index).data('title'));
            arrowPrev.html(slide.eq(prevIndex - 1).data('title'));

        });
    });

    $('.js-slide').each(function() {

        var section = $(this),
        arrowNext = section.find('.js-arrow-next'),
        arrowPrev = section.find('.js-arrow-prev'),
        sectionData = section.data('anchor'),
        slide = section.find('.js-slider-item'),
        count = slide.length,
        nav = section.find('.js-slide-nav');


        nav.on('click', function() {
            var nav = $(this),
            slide = nav.index(),
            frame = section.find('.js-nav-frame');

            $.fn.fullpage.moveTo(sectionData, slide);
        });

        arrowNext.on('click', function() {
            var arrow = $(this),
            index = slide.filter('.active').index(),
            nextIndex = index + 1;

            bg = arrow.parents('.js-slide').find('slide__bg');

            arrowPrev.html(slide.eq(index).data('title'));

            if (nextIndex == count) {
                $.fn.fullpage.moveTo(sectionData, 0);

                nav.removeClass('__active');
                nav.eq(0).addClass('__active');

                // bg.eq(0).addClass('__active');

                arrowNext.html(slide.eq(1).data('title'));

            } else {
                $.fn.fullpage.moveTo(sectionData, nextIndex);
                nav.removeClass('__active');
                nav.eq(nextIndex).addClass('__active');

                if (nextIndex == count - 1) {
                    arrowNext.html(slide.eq(0).data('title'));
                } else {
                    arrowNext.html(slide.eq(nextIndex + 1).data('title'));
                }

            }

        });

        arrowPrev.on('click', function() {
            var index = slide.filter('.active').index(),
            prevIndex = index - 1;

            // arrow.removeClass('__animate');
            // arrow.addClass('__animate');

            $.fn.fullpage.moveTo(sectionData, prevIndex);
            nav.removeClass('__active');
            nav.eq(prevIndex).addClass('__active');

        });
    });

});

$(window).on('load resize', function() {
    "use strict";
    var mvp = document.getElementById('viewport'),
    screenWidth = screen.width,
    scale = screenWidth / 640;
    
    if (screenWidth <= 640) {
        mvp.setAttribute('content', 'width=480, initial-scale='+ scale +', maximum-scale='+ scale +', minimum-scale='+ scale +'');
        // $H.width('440px');
    } else {
        mvp.setAttribute('content', 'width=device-width, initial-scale=1, maximum-scale=1');
    }
});

(function () {
    $.fn.photoswipe = function(options){
        var galleries = [],
        _options = options;

        var init = function($this){
            galleries = [];
            $this.each(function(i, gallery){
                galleries.push({
                    id: i,
                    items: []
                });

                $(gallery).find('a').each(function(k, link) {
                    var $link = $(link),
                    size = $link.data('size').split('x');
                    if (size.length != 2){
                        throw SyntaxError("Missing data-size attribute.");
                    }
                    $link.data('gallery-id',i+1);
                    $link.data('photo-id', k);

                    var item = {
                        src: link.href,
                        msrc: link.children[0].getAttribute('src'),
                        w: parseInt(size[0],10),
                        h: parseInt(size[1],10),
                        title: $link.data('title'),
                        el: link
                    };

                    galleries[i].items.push(item);

                });

                $(gallery).on('click', 'a', function(e){
                    e.preventDefault();
                    var gid = $(this).data('gallery-id'),
                    pid = $(this).data('photo-id');

                    openGallery(gid,pid);
                });
            });
        };

        var parseHash = function() {
            var hash = window.location.hash.substring(1),
            params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if(pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            if(!params.hasOwnProperty('pid')) {
                return params;
            }
            params.pid = parseInt(params.pid, 10);
            return params;
        };

        var openGallery = function(gid,pid){
            var pswpElement = document.querySelectorAll('.pswp')[0],
            items = galleries[gid-1].items,
            options = {
                index: pid,
                galleryUID: gid,
                getThumbBoundsFn: function(index) {
                    var thumbnail = items[index].el.children[0],
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                    return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                }
            };
            $.extend(options,_options);
            options.index = pid;
            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // initialize
        init(this);

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = parseHash();
        if(hashData.pid > 0 && hashData.gid > 0) {
            openGallery(hashData.gid,hashData.pid);
        }

        return this;
    };

    var photoSwipeOptions = {
        history: false,
        focus: false,
        index: 0,
        showHideOpacity: true,
        bgOpacity: 0.8,
        showAnimationDuration: 300,
        hideAnimationDuration: 300,
        closeOnScroll: false,
        counterEl: false,
        fullscreenEl: false,
        zoomEl: false,
        shareEl: false,
        spacing: 0.3,
        closeOnVerticalDrag: false
    };

    if ($('.js-certificates').length) {
        $('.js-certificates').photoswipe(photoSwipeOptions);
    }
    }());

$(function() {
    "use strict";

    var $slideCarousel = $('.js-slider');
    if (!$slideCarousel.length) return;

    $slideCarousel.slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        speed: 500,
        /*fade: true,*/
        cssEase: 'linear',
        prevArrow: '<div class="slide-carousel__arrow slide-carousel__arrow--left"></div>',
        nextArrow: '<div class="slide-carousel__arrow slide-carousel__arrow--right"></div>'
    });
});

var app = app || {};

app.Filter = library(function() {
    return {
        init: function() {
            this.elements = {
                filter: $('.js-collection-filter')
            };

            if(!this.elements.filter) return;

            this.bind();
        },
        bind: function () {
            var obj = this,
            closeBtn = $('.js-filter-toggle-close'),
            openBtn = $('.js-filter-toggle-open'),
            toggleBtn = $('.js-filter-toggle'),
            filterItem = $('.js-filter-item'),
            allItemsLink = $('.js-all');


            filterItem.on('click', $.proxy(obj._hideFilterCategory, this));
            filterItem.on('click', $.proxy(obj._getItems, this));
            filterItem.on('selectstart', function () { return false; });

            openBtn.on('click', $.proxy(obj._openFilter, this));
            closeBtn.on('click', $.proxy(obj._closeFilter, this));
            toggleBtn.on('selectstart', function () { return false; });


            allItemsLink.on('click', $.proxy(obj._showAll, this));
        },
        _getItems: function (event) {
            var request,
            obj = this,
            itemsWrap = $('.js-collection-items'),
            allItem = $('.collection-item'),
            item = $(event.target),
            catType = item.closest('.js-filter-item').data('filter-type'),
            cat = item.closest('.js-filter-item').data('filter'),
            section = item.closest('.js-filter-item').data('section'), //change by gk  
            action = this.elements.filter.data('action'),
            openBtn = $('.js-filter-toggle-open'),
            layout = $('.js-ajax-layout'),
            catText = item.closest('.js-filter-item').data('name');
            if (item.hasClass('filter-active')) return false;
            if((item.closest('.js-filter-item').hasClass("collection-filter__room-item")==true)||(catType=='sub')) {
                this._closeFilter(catType, item);
            }

            request = $.ajax({
                url: action,
                method: "GET",
                data: { id : cat, section: section }, //change by gk
                beforeSend: function() {
                    layout.fadeToggle();
                }
            });

            request.done(function(msg) {
                itemsWrap.hide().delay(100).html(msg).fadeIn(400);
                layout.fadeToggle(function () {
                    obj._anchorSlide();
                });
            })

            request.fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
                layout.fadeToggle();
            });

            openBtn.html(catText+' X');
        },
        _closeFilter: function (type, item) {
            var obj = this,
            items = $('.js-filter-item'),
            mainFilter = $('.js-collection-main-filter'),
            toggleBtn = $('.js-filter-toggle-close'),
            openBtn = $('.js-filter-toggle-open'),
            catText;

            if (item) {
                catText = item.data('name');
            }
            if (type == 'sub') {
                mainFilter.slideUp();

                items.removeClass('filter-active');

                item.addClass('filter-active');
            } else {
                toggleBtn.hide();
                obj.elements.filter.stop(false, true).slideToggle();
            }

            toggleBtn.html(catText+' X');
            //openBtn.html('все наборы');
        },
        _openFilter: function () {
            var obj = this,
            mainFilter = $('.js-collection-main-filter'),
            toggleBtn = $('.js-filter-toggle-close'),
            openBtn = $('.js-filter-toggle-open');


            toggleBtn.html('скрыть').show();
            //openBtn.html('все наборы');
            mainFilter.slideDown(10, function () {

                obj.elements.filter.stop(false, true).slideDown();
            });
        },
        _hideFilterCategory: function () {
            $('.js-collection-cat-filter').fadeOut(400);

        },
        _showAll: function (event) {

            var obj = this,
            item = $(event.target),
            mainFilter = $('.js-collection-main-filter'),
            openBtn = $('.js-filter-toggle-open'),
            closeBtn = $('.js-filter-toggle-close'),
            type = item.data('type');

            if(type=='rooms') {
                obj.elements.filter.stop(false, true).slideToggle();
                openBtn.show();  
                closeBtn.hide();
                openBtn.html('все комнаты X');
            } else if (type=='item') {
                openBtn.show(); 
                closeBtn.hide(); 
                openBtn.html('все предметы X');
                $('.js-collection-filter').hide();
            }

            $('.js-collection-cat-filter').hide();  
            $('.js-collection-items').html('');
            $('.js-collection-cat-filter-' + type).fadeIn(600);

            this._anchorSlide();
        },
        _anchorSlide: function () {
            var itemsWrap = $('.js-items-top'),
            targetOffset = itemsWrap.offset().top - 80; 

            $('html, body').animate({
                scrollTop: targetOffset
                }, 400);
        }
    };
    }());

var app = app || {};

app.Filter = library(function() {
    return {
        init: function() {
            this.elements = {
                search: $('.js-search')
            };

            if(!this.elements.search) return;

            this.bind();
        },
        bind: function () {
            var obj = this,
            input = this.elements.search.find('.js-search-input');

            input.on('keyup', $.proxy(obj._getQuery, this));
            $B.on('click', $.proxy(obj._closeDropdown, this));
        },
        _getQuery: function () {
            var searchField = this.elements.search.find('.js-search-input').val(),
            data = this.elements.search.data('ajax'), //cange by gk
            section = this.elements.search.data('section'),
            dropdown = $('.js-search-dropdown');
            if (searchField.length) {
                var myExp = new RegExp(searchField, "i"),
                found = 0;

                $.getJSON(data,{query:searchField, section:section}, function (data) { //cange by gk
                    var output = '<ul class="searchresults">';
                    $.each(data.searchItems, function(key, val) {
                        //if (val.title.search(myExp) !== -1) {         //cange by gk
                        found = 1;
                        output += '<li class="searchresults__item">';
                        output += '<a class="searchresults__link clearfix" href="' + val.link + '">';
                        if (val.img) {                                                                    //cange by gk
                            output += '<span class="searchresults__img"><img src="' + val.img + '"></span>';    
                        }                                                                               //cange by gk
                        output += '<span class="searchresults__title">' + val.title + '</span>';
                        output += '</a>';
                        output += '</li>';
                        //}                                        //cange by gk
                    });
                    output += '</ul>';

                    if (found == 1) {
                        dropdown.removeClass('_hidden');
                        dropdown.html(output);
                    }
                    else {
                        dropdown.addClass('_hidden');
                    }

                });
            } else {
                dropdown.addClass('_hidden');
            }
        },
        _closeDropdown: function () {
            var dropdown = $('.js-search-dropdown');

            dropdown.addClass('_hidden');
        }
    };
    }());
$(function() {
    "use strict";

    var $color = $('.js-item-color');
    if (!$color.length) return;


    var $colorText = $('.js-color-text'),
    //для страницы товара
    $colorImage = $('.product__image-wrap');
    //для страницы комнаты
    if (!$colorImage.length) {
        $colorImage = $('.js-color-image');
    }

    $color.on('click', function() {
        var $self = $(this),
        $selfText = $colorText.filter("[data-color="+ $self.data('color') + "]"),
        $selfImage = $colorImage.filter("[data-color="+ $self.data('color') + "]");

        $color.removeClass('__selected');
        $self.addClass('__selected');

        $colorText.removeClass('__selected');
        $selfText.addClass('__selected');

        $colorImage.removeClass('__selected');
        $selfImage.addClass('__selected'); 

    });
});

$(function() {
    "use strict";

    var $btn = $('.js-show-hidden');
    if (!$btn.length) return;

    var $hidden = $('.js-hidden');

    $btn.on('click', function() {

        var $self = $(this),
        $target = $self.data('target'),
        $btnText = $self.text();
        console.log($target);

        if ($self.hasClass('__active')) {

            $self.removeClass('__active');
            toggle($target);

            $self.text($self.data("text"));

        } else {

            $btn.removeClass('__active');
            $self.addClass('__active');

            $btn.each(function() {
                var $currentBtn = $(this);

                $currentBtn.text($currentBtn.data("text"));
            });

            $self.text($self.data("swap"));
            $self.data("text", $btnText);

            if ($hidden.filter(':visible').length) {

                $hidden.filter(':visible').slideUp(500);

                setTimeout(function() {
                    toggle($target);
                    animateOffsetTop($hidden, $target);
                    }, 600);

            } else {
                toggle($target);
                animateOffsetTop($hidden, $target);
            }
        }

    });

    function toggle(target) {
        $hidden.filter('[data-target=' + target + ']').animate({
            height: "toggle",
            opacity: "toggle",
            paddingTop: "toggle",
            paddingBottom: "toggle"
        });
    }

    function animateOffsetTop(hidden, target) {
        var targetOffset = hidden.filter('[data-target =' + target + ' ] ').position().top - 69;

        $('html, body').animate({
            scrollTop: targetOffset
            }, 800);
    }
});

// $(function() {
//     "use strict";
//
//     var $slide = $('.js-slide');
//     if (!$slide.length) return;
//
//     if (screen.width <= 480) {
//         $slide.each(function() {
//
//             var $bg = $(this).find('.slide__bg');
//             $bg.each(function() {
//                 $bgImage = $(this).data('mobile-bg');
//                 console.log($bgImage);
//                 $(this).css('background-image', 'url(' + $bgImage + ')');
//             });
//         });
//     }
//
//     if (screen.width > 480) {
//         var $bg = $('.js-bg');
//         if (!$bg.length) return;
//
//         $bg.each(function() {
//             var $bg = $(this),
//                 $backgrounds = $bg.data('bg'),
//                 $current = 0;
//
//             for (var i = 0; i < $backgrounds.length; i++) {
//                 var img = new Image();
//                 img.src = $backgrounds[i];
//                 $bg.after('<div class="js-bg slide__bg slide__bg--green" style="background-image: url(' + $backgrounds[i] + ')"></div>');
//             }
//
//             setInterval( nextBackground($current, $backgrounds), 500);
//             // setInterval(function() { funca(10,3); })
//             // setInterval( function() { nextBackground($current, $backgrounds); }, 500 );
//             $bg.css('background-image', $backgrounds[0]);
//         });
//
//     }
//
//     function nextBackground(current, backgrounds) {
//         var $bgs = $('.js-bg');
//
//         $bgs.removeClass('__active');
//         $bgs.eq(current = ++current % (backgrounds.length + 1)).addClass('__active');
//     }
//
// });

$(function() {
    "use strict";

    var $video = $('.js-anim-video');
    if (!$video.length) return;

    var $videoParent = $('.js-anim-videos');

    if (iosCheck()){

        $videoParent.each(function(){
            var $that = $(this),
            $bg = $that.data('bg');

            $that.css('background-image', 'url(' + $bg + ')');

        });

    } else {

        $video.on('canplay', function() {
            // $(this).animate( { opacity: 1 }, 'slow');
            $(this).addClass('__loaded');
        });
    }

});

$(function() {
    "use strict";

    var $footer = $('.js-footer');
    if (!$footer.length) return;

    $('.js-vk-link').on({
        mouseenter: function() {
            $footer.addClass('__vk');
        },
        mouseleave: function() {
            $footer.removeClass('__vk');
        }
    });

    $('.js-fb-link').on({
        mouseenter: function() {
            $footer.addClass('__fb');
        },
        mouseleave: function() {
            $footer.removeClass('__fb');
        }
    });
});

$(function() {
    "use strict";

    $('.js-image-slider').each(function(){

        var $slideCarousel = $(this);
        if (!$slideCarousel.length) return;

        var offerID = $slideCarousel.data("offer");
        var $image = $slideCarousel.find('img[data-offer=' + offerID + ']'),
        $thumbnails = $slideCarousel.siblings('.js-thumbnails');

        $image.each(function(indx) {
            var $imageSrc = $(this).attr('src');
            $thumbnails.append('<div class="product__thumbnail js-thumbnail"><img src="' + $imageSrc + '" /></div>');
        });

        $slideCarousel.slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            speed: 300,
            adaptiveHeight: true,
            cssEase: 'linear',
            prevArrow: '<div class="slide-carousel__arrow slide-carousel__arrow--left"></div>',
            nextArrow: '<div class="slide-carousel__arrow slide-carousel__arrow--right"></div>'
        });  




        var $thumbnail =  $slideCarousel.parent().find('.js-thumbnail');

        $thumbnail.eq(0).addClass('__active');  


        $slideCarousel.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            $thumbnail.removeClass('__active');
            $thumbnail.eq(nextSlide).addClass('__active');
        });

        $thumbnail.on('click', function() {
            var $self = $(this),
            index = $self.index();
            $slideCarousel.slick('slickGoTo', index);

            $thumbnail.removeClass('__active');
            $self.addClass('__active');
        }); 

    })        


});

$(function() {
    "use strict";

    var $carousel = $('.js-carousel');
    if (!$carousel.length) return;

    $carousel.each(function(idx, item) {

        var carouselId = "carousel" + idx;
        this.id = carouselId;

        $(this).slick({
            infinite: true,
            slidesToShow: 3,
            arrows: true,
            variableWidth: true,
            slidesToScroll: 1,
            // appendArrows: "#" + carouselId + " .prev_next",
            appendArrows: $carousel.filter("#" + carouselId).parent().find('.carousel__nav'),
            prevArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--left carousel__arrow carousel__arrow-left"></div>',
            nextArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--right carousel__arrow carousel__arrow-right"></div>',
            responsive: [
                // {
                //   breakpoint: 1024,
                //   settings: {
                //     slidesToShow: 3,
                //     slidesToScroll: 3,
                //   }
                // },
                // {
                //     breakpoint: 768,
                //     settings: {
                //         slidesToShow: 2,
                //         slidesToScroll: 2
                //     }
                // }, {
                //     breakpoint: 480,
                //     settings: {
                //         slidesToShow: 1,
                //         slidesToScroll: 1
                //     }
                // }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

});

(function () {
    var photoSwipeOptions = {
        history: false,
        focus: false,
        index: 0,
        showHideOpacity: true,
        bgOpacity: 0.8,
        showAnimationDuration: 300,
        hideAnimationDuration: 300,
        closeOnScroll: false,
        counterEl: false,
        fullscreenEl: false,
        zoomEl: false,
        shareEl: false,
        spacing: 0.3,
        closeOnVerticalDrag: false
    },
    openPhotoSwipe = function () {
        var pswpElement = document.querySelectorAll('.pswp')[0];
        var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, window.gallery, photoSwipeOptions);
        gallery.init();
    };


    $H.on('click', '.js-open-gallery', function () {
        photoSwipeOptions.index = $(this).data('id');
        openPhotoSwipe ();
    });
    }());

(function () {
    var $carousel = $('.js-store-images');
    if (!$carousel.length) return;

    var slider,
    minSize = 1023;

    function setStoresImgSlider() {
        if ($D.width() > minSize && !slider) {
            slider = $carousel.slick({
                infinite: true,
                slidesToShow: 4,
                arrows: true,
                variableWidth: true,
                slidesToScroll: 1,
                appendArrows: $carousel.parent().find('.carousel__nav'),
                prevArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--left carousel__arrow carousel__arrow-left"></div>',
                nextArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--right carousel__arrow carousel__arrow-right"></div>'
            });

        } else if ($D.width() <= minSize && slider) {
            $carousel.slick('unslick');
            slider = null;
        }
    }

    setStoresImgSlider();

    $W.on('resize', function() {
        clearTimeout($.data(this, 'resizeTimer'));
        $.data(this, 'resizeTimer', setTimeout(function() {
            setStoresImgSlider();
            }, 100));
    });
    }());

$(function() {
    "use strict";

    var $storeMap = $('.js-store-map');

    if (!$storeMap.length)
        return false;

    var infoBubble,
    map,
    name = $storeMap.data('name'),
    address = $storeMap.data('address');


    function createBubble(lat, lng, content) {
        if (infoBubble) {
            infoBubble.close();
        }
        $('.map-bbl-wrap').remove();

        infoBubble = new InfoBubble({
            map: map,
            content: content,
            position: new google.maps.LatLng(lat, lng),
            shadowStyle: 0,
            padding: 0,
            backgroundColor: 'transparent',
            borderRadius: 0,
            arrowSize: 6,
            borderWidth: 0,
            borderColor: 'transparent',
            disableAutoPan: true,
            hideCloseButton: true,
            arrowPosition: 50,
            backgroundClassName: 'map-bbl store-popup',
            arrowStyle: 0,
            maxWidth: 0,
            maxHeight: 0,
            disableAnimation: true
        });
    }



    function initialize() {

        var myOptions = {
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            }
        };

        map = new google.maps.Map(document.getElementById('map'), myOptions);

        var mapLat = $storeMap.data('lat'),
        maplng = $storeMap.data('lng'),
        myLatlng = new google.maps.LatLng(mapLat, maplng);

        // marker = new google.maps.Marker({
        //     position: myLatlng,
        //     map: map,
        //     animation: google.maps.Animation.DROP,
        // });

        map.panTo(myLatlng);
        map.panBy(0, -20);

        google.maps.event.addDomListener(window, 'resize', function() {
            map.setCenter(myLatlng);
        });

    }

    initialize();


    createBubble($storeMap.data('lat'), $storeMap.data('lng'),
        '<div class="store-popup-title">' + name + '</div>' + '<div class="store-popup-desc">' + address + '</div>');

    infoBubble.open();

    google.maps.event.trigger(map, 'resize');

});

$(function() {
    "use strict";

    var $storeMap = $('.js-stores-map');

    if (!$storeMap.length)
        return false;

    var infoBubble,
    map,
    markers = [],
    markersData,
    mapHeight = $storeMap.height(),
    userCoordinates = Cookies.get('lat'), 
    mapLat,
    maplng,
    zoom;


    function createBubble(lat, lng, content) {
        if (infoBubble) {
            infoBubble.close();
        }
        $('.map-bbl-wrap').remove();

        infoBubble = new InfoBubble({
            map: map,
            content: content,
            position: new google.maps.LatLng(lat, lng),
            shadowStyle: 0,
            padding: 0,
            backgroundColor: 'transparent',
            borderRadius: 0,
            arrowSize: 6,
            borderWidth: 0,
            borderColor: 'transparent',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 50,
            backgroundClassName: 'map-bbl store-popup',
            arrowStyle: 0,
            maxWidth: 0,
            maxHeight: 0,
            disableAnimation: true
        });
    }


    function mapInitialize() {
        var myOptions = {
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            }
        };

        map = new google.maps.Map(document.getElementById('map'), myOptions);


        var mapLat,
        maplng;

        if (userCoordinates !== undefined) {

            mapLat = Cookies.get('lat');
            maplng = Cookies.get('lng');

        } else {

            mapLat = $storeMap.data('lat');
            maplng = $storeMap.data('lng');

        }



        var myLatlng = new google.maps.LatLng(mapLat, maplng);
        createMarkers();
    }


    function createMarkers() {
        var markerUrl = $storeMap.data('marker-url'),
        markerHover = $storeMap.data('marker-hover'),
        markerGroupUrl = $storeMap.data('marker-group-url'),
        markerStyles = [{
            url: markerGroupUrl,
            height: 46,
            width: 46,
            textColor: '#fff',
            textSize: 24,
            fontFamily: 'PFDinTextCompPro',
            fontWeight: 'normal',
            // zoomOnClick: true,
            maxZoom: 15,
            // anchorIcon: [-10, 18]
        }];

        $.each(markersData, function(i) {
            var latLng = new google.maps.LatLng(this.lat, this.lng);
            var marker = new google.maps.Marker({
                'position': latLng,
                'icon': markerUrl
            });
            markers.push(marker);

            google.maps.event.addListener(marker, 'mouseover', function() {
                marker.setIcon(markerHover);
            });

            google.maps.event.addListener(marker, 'mouseout', function() {
                marker.setIcon(markerUrl);
            });
        });

        var markerCluster = new MarkerClusterer(map, markers, {
            'styles': markerStyles
        });

        google.maps.event.addListener(markerCluster, 'click', function(cluster) {
            markers = cluster.getMarkers();
            centerMap();
            // console.log(markers);
        });

        if (userCoordinates !== undefined) {
            zoom = Cookies.get('zoom');
            mapLat = Cookies.get('lat');
            maplng = Cookies.get('lng');

            map.setCenter(new google.maps.LatLng(mapLat, maplng));
            map.setZoom(+zoom);
        } else {
            centerMap();

        }
        bindMarkersClick();
    }


    function centerMap() {
        var markersBounds = new google.maps.LatLngBounds();

        if (markers.length > 0) {
            $.each(markers, function() {
                var markerCoords = new google.maps.LatLng(this.position.lat(), this.position.lng());
                markersBounds.extend(markerCoords);
            });

            if (markers.length > 1) {




                map.fitBounds(markersBounds);
                map.panBy(0, 80);
                map.setZoom(map.getZoom() - 1);





            } else {
                map.panTo(markersBounds.getCenter());
                map.setZoom(13);
            }
        } else {
            if (map.center.lat() + map.center.lng() === 0) {
                map.setCenter(new google.maps.LatLng(58.6555915313906, 43.27900886535656));
                map.setZoom(5);
            }
        }
    }


    function bindMarkersClick() {
        $.each(markers, function(i) {
            google.maps.event.addListener(this, 'click', function() {
                var data = markersData[i];
                var latlng = new google.maps.LatLng(data.lat, data.lng);

                createBubble(data.lat, data.lng,
                    '<div class="store-popup-title">' + data.name + '</div>' + '<div class="store-popup-desc">' + data.address + '</div>' + '<a href="' + data.url + '" class="store-popup-link">Подробнее о салоне</a>');

                infoBubble.open();

                map.panTo(latlng);
                map.panBy(0, -70);
            });
        });

        // $D.click(function(event) {
        //     if ($(event.target).closest('.map-bbl').length) {
        //         return;
        //     } else if (infoBubble) {
        //         infoBubble.close();
        //     }
        // });
    }



    function setMapSize() {
        var top = $storeMap.offset().top,
        docHeight = $D.height();

        if (docHeight - top > mapHeight) {
            $storeMap.height(docHeight - top);
        }
    }
    setMapSize();


    (function() {
        //change by gk
        markersData = shopsAddresses.objects;
        mapInitialize();
        /*
        $.ajax({
        url: $storeMap.data('objects-url'),
        success: function(data) {
        markersData = data.objects;
        mapInitialize();
        },
        error: function() {
        console.error('Ошибка получения гео-объектов');
        }
        });
        */
        }());


    $W.on('resize', function() {
        clearTimeout($.data(this, 'resizeTimer'));
        $.data(this, 'resizeTimer', setTimeout(function() {
            setMapSize();
            }, 100));
    });


    $H.on('click', '.js-map-bbl-close', function() {
        infoBubble.close();
    });

    $W.on('load', function() {
        setMapSize();
    });

    var $goToBtn = $('.js-go-to-map');

    $goToBtn.on('click', function() {
        var $lat = $(this).data('lat'),
        $lng = $(this).data('lng'),
        $zoom = $(this).data('zoom');

        Cookies.set('lat', $lat);
        Cookies.set('lng', $lng);
        Cookies.set('zoom', $zoom);

        if (map.getCenter().lat() !== $lat && map.getCenter().lng() !== $lng) {
            map.setCenter(new google.maps.LatLng($lat, $lng));
            map.setZoom($zoom);
        } else if (map.getZoom() !== $zoom) {
            map.setZoom($zoom);
        }
    });
});
