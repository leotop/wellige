function library(e) {
    return $(function() {
        "use strict";
        e.init && e.init()
    }), e
}

function iosCheck() {
    var e = !1;
    return navigator.userAgent.match(/(iPad|iPhone|iPod)/g) && (e = !0), e
}

function mobileCheck() {
    var e = !1;
    return function(t) {
        (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(t) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0, 4))) && (e = !0)
    }(navigator.userAgent || navigator.vendor || window.opera), e
}

function smallWidth() {
    return screen.width < 1024 ? !0 : void 0
}
$(function() {
    "use strict";
    var e = $(".js-bright-bg");
    if (e.length) {
        var t = $(".js-burger");
        $(window).on("scroll load", function() {
            var i = $W.scrollTop();
            e.each(function() {
                var e = $(this),
                    a = e.offset().top,
                    o = e.height(),
                    s = a + o;
                i > a ? (t.addClass("__green"), i > s && t.removeClass("__green")) : t.removeClass("__green")
            })
        })
    }
}), $(function() {
    "use strict";
    if (smallWidth() && $(".js-header").addClass("header--fixed"), $(".js-slide").length || $(".js-menu").addClass("__animate"), !smallWidth()) {
        var e = $(".js-fixed-head");
        e.length && ($(".js-fullpage").length || $(window).on("scroll load", function() {
            var t = $W.scrollTop(),
                i = $B.offset().top;
            t > i ? e.addClass("header--small") : e.removeClass("header--small")
        }))
    }
}), $(function() {
    "use strict";
    var e = $(".js-submit-form");
    e.length && ($.validator.addMethod("textonly", function(e, t) {
        return valid = !1, check = /[^-\a-zA-Zа-яА-ЯЁё\s]/.test(e), check === !1 && (valid = !0), this.optional(t) || valid
    }, $.validator.format("Используете только буквы, пробелы или дефисы")), $.validator.addMethod("phone", function(e, t) {
        var i = /^[\+]?([0-9\(\)\s\-]{7,})$/im;
        return this.optional(t) || i.test(e)
    }, "Неверно указан телефон"), $.validator.addMethod("email", function(e, t) {
        var i = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return this.optional(t) || i.test(e)
    }, "Неверно указан Email"), e.each(function() {
        var e = $(this),
            t = e.find(".js-success-message"),
            i = e.find(".js-error-message"),
            a = e.find("BUTTON"),
            o = e.find(".js-close-message"),
            s = $(this).validate({
                rules: {
                    name: {
                        required: !0
                    },
                    company: {
                        required: !0
                    },
                    phone: {
                        required: !0,
                        phone: !0
                    },
                    mail: {
                        required: !0,
                        email: !0
                    },
                    message: {
                        required: !0
                    }
                },
                errorPlacement: function(e, t) {},
                submitHandler: function(o) {
                    e.ajaxSubmit({
                        method: "get",
                        dataType: "json",
                        beforeSubmit: function() {
                            a.attr("disabled", !0)
                        },
                        error: function() {
                            a.removeAttr("disabled"), i.addClass("__open")
                        },
                        success: function(e) {
                            a.removeAttr("disabled"), 0 === e.error ? (s.resetForm(), t.addClass("__open")) : (a.removeAttr("disabled"), i.addClass("__open"))
                        }
                    })
                }
            });
        o.on("click", function() {
            i.removeClass("__open"), t.removeClass("__open")
        })
    }), $(".js-email-submit").each(function() {
        var e = $(this),
            t = e.find(".js-success-message"),
            i = e.find(".js-error-message"),
            a = e.find("BUTTON"),
            o = e.find(".js-close-message"),
            s = $(this).validate({
                rules: {
                    mail: {
                        required: !0,
                        email: !0
                    }
                },
                errorPlacement: function(e, t) {},
                submitHandler: function(o) {
                    e.ajaxSubmit({
                        method: "get",
                        dataType: "json",
                        beforeSubmit: function() {
                            a.attr("disabled", !0)
                        },
                        error: function() {
                            a.removeAttr("disabled"), i.addClass("__open")
                        },
                        success: function(e) {
                            a.removeAttr("disabled"), 0 === e.error ? (s.resetForm(), t.addClass("__open")) : (a.removeAttr("disabled"), i.addClass("__open"))
                        }
                    })
                }
            });
        o.on("click", function() {
            i.removeClass("__open"), t.removeClass("__open")
        })
    }))
}), $(function() {
    "use strict";
    var e = $(".js-dropdown-trigger"),
        t = $(".js-dropdown");
    e.on("click", function(i) {
        if (!$(i.target).closest("a").length) {
            var a = $(this);
            a.hasClass("__open") ? (e.removeClass("__open"), t.slideUp()) : (e.removeClass("__open"), a.addClass("__open"), t.slideUp(), a.next(t).slideDown())
        }
    })
});
var $W = $(window),
    $D = $(document),
    $H = $("html"),
    $B = $("body"),
    app = app || {};
$(function() {
    "use strict";
    var e = $(".js-movie-popup-btn"),
        t = $(".js-movie-popup-btn--video");
    if (e.length) {
        var i, a = ($(".js-movie-popup"), $(".js-popup-parrent")),
            o = $(".js-close-media-popup"),
            s = t.parents(".js-slide").next().data("anchor"),
            n = $(".js-film"),
            r = n.data("src");
        n.vide(r, {
            volume: 1,
            playbackRate: 1,
            muted: !0,
            loop: !1,
            autoplay: !0,
            position: "50% 50%",
            resizing: !0,
            posterType: "none"
        });
        var l = document.querySelector(".js-film video");
        i = n.data("vide"), l.addEventListener("loadeddata", function() {
            l.pause()
        }, !1), l.addEventListener("ended", function() {
            a.removeClass("__popup--video"), location.hash = s, t.text("смотреть еще раз")
        }, !1), e.on("click", function(e) {
            $(this).is(".js-movie-popup-btn--video") ? (a.addClass("__popup--video"), i.resize(), l.play(), l.muted = !1) : a.addClass("__popup")
        }), o.on("click", function() {
            a.removeClass("__popup")
        }), a.on("click", function(e) {
            n.is(":visible") && !$(e.target).is(".js-movie-popup-btn") && (a.removeClass("__popup __popup--video"), l.pause())
        })
    }
}), $(function() {
    "use strict";

    function e() {
        o.removeClass("__active"), o.css({
            height: ""
        })
    }

    function t() {
        $B.addClass("_noscroll")
    }

    function i() {
        $B.removeClass("_noscroll").css({
            width: ""
        }), $(".js-lock-scroll").css({
            width: ""
        })
    }
    var a = $(".js-burger");
    if (a.length) {
        var o = $(".js-menu"),
            s = ($(".js-close-menu"), o.height(), $(".js-hidden-column")),
            n = $(".js-header");
        window.innerWidth - $W.width();
        a.on("click", function() {
            a.toggleClass("__close"), $(window).width() > 1024 ? s.toggle(400) : s.toggle(), n.toggleClass("__down"), o.hasClass("__active") ? (e(o), o.removeClass("__active"), i()) : (o.addClass("__active"), t());
            var r = $(".mobile-overlay");
            r.length ? r.toggleClass("__active") : ($B.prepend("<div class='mobile-overlay'></div>"), r = $(".mobile-overlay"), r.addClass("__active"))
        }), $(document).click(function(e) {
            if (!$(e.target).closest(o).length && !$(e.target).closest(a).length) {
                var t = $(".mobile-overlay");
                a.removeClass("__close"), o.removeClass("__active"), t.removeClass("__active"), o.removeClass("__active"), $(window).width() > 1024 ? s.hide(500) : s.hide(), i()
            }
        })
    }
}), $(function() {
    "use strict";
    var e = $(".js-image-popup");
    e.length && e.magnificPopup({
        type: "image",
        closeOnContentClick: !0,
        closeBtnInside: !1,
        fixedContentPos: !0
    })
}), $(function() {
    "use strict";
    var e = $(".js-video-popup");
    e.length && e.magnificPopup({
        type: "iframe",
        removalDelay: 160,
        preloader: !1,
        closeBtnInside: !1,
        fixedContentPos: !0
    })
}), $(function() {
    "use strict";
    var e = $(".js-city-popup");
    if (e.length) {
        var t = Cookies.get("user");
        if (void 0 === t) {
            Cookies.set("user", 1);
            var i = $(".js-close-popup"),
                a = $(".js-select-city"),
                o = $(".js-city-popup-inner"),
                s = $(".js-city-list"),
                n = $(".js-city-item");
            $.magnificPopup.open({
                items: {
                    src: e,
                    type: "inline"
                },
                modal: !0
            }), i.on("click", function() {
                $.magnificPopup.close()
            }), n.on("click", function() {
                $.magnificPopup.close()
            }), a.on("click", function() {
                o.addClass("__hide"), s.addClass("__show")
            })
        }
    }
}), $(function() {
    "use strict";
    $(".js-print").click(function() {
        window.print()
    })
}), $(function() {
    "use strict";
    $(".js-scroll-link").on("click", function() {
        var e = $($(this).attr("href")),
            t = e.position().top - 90;
        return $("html, body").animate({
            scrollTop: t
        }, 800), !1
    })
}), $(function() {
    function e() {
        return $H.hasClass("no-cssanimations") ? !0 : !1
    }

    function t() {
        return e() || smallWidth() === !0 ? !0 : !1
    }

    function i() {
        smallWidth() || $('.js-slide[data-type="sliderTextNav"]').each(function() {
            var e = $(this),
                t = e.find(".js-nav-frame"),
                i = e.find(".js-slide-nav"),
                a = i.filter(".__active"),
                o = e.find(".slide__nav-inner");
            t.css({
                height: a.parent().innerHeight(),
                width: a.find(o).innerWidth() + 40,
                left: a.find(o).offset().left - 20
            })
        })
    }
    $(".js-fullpage").fullpage({
        lockAnchors: t(),
        css3: !0,
        scrollingSpeed: 700,
        autoScrolling: !t(),
        fitToSection: !t(),
        scrollBar: !1,
        easing: "easeInOutCubic",
        easingcss3: "ease",
        loopBottom: !1,
        loopTop: !1,
        loopHorizontal: !0,
        continuousVertical: !1,
        normalScrollElements: "#element1, .element2",
        scrollOverflow: !1,
        touchSensitivity: 15,
        normalScrollElementTouchThreshold: 6,
        keyboardScrolling: !0,
        animateAnchor: !0,
        recordHistory: !0,
        controlArrows: !1,
        verticalCentered: !1,
        resize: !1,
        responsiveWidth: 768,
        responsiveHeight: 650,
        sectionSelector: ".js-slide",
        slideSelector: ".js-slider-item",
        onLeave: function(e, a, o) {
            var s = $(this),
                n = s.next(),
                r = s.prev();
            return i(), t() || "down" == o && n.addClass("__animate"), t() || ("down" == o && "white" == n.data("color") || "up" == o && "white" == r.data("color") ? $(".js-header").removeClass("header--transparent") : $(".js-header").addClass("header--transparent"), "top" == s.data("anchor") && ($(".js-header").removeClass("header--hidden"), n.removeClass("__animate")), 1 == a && "top" == r.data("anchor") && $(".js-header").addClass("header--hidden"), 1 !== a ? $(".js-header").addClass("header--small") : $(".js-header").removeClass("header--small")), t() || 2 != a || "top" != s.data("anchor") || "down" != o ? void 0 : (s.addClass("__fadeOut"), setTimeout(function() {
                $.fn.fullpage.silentMoveTo(a + 1), $.fn.fullpage.silentMoveTo(a), s.removeClass("__fadeOut")
            }, 1e3), !1)
        },
        afterLoad: function(e, i) {
            var a = $(this);
            1 == i && (a.addClass("__animate"), $(".js-menu").addClass("__animate")), t() || "principles" == a.data("anchor") && a.addClass("__animate")
        },
        onSlideLeave: function(e, t, a, o, s) {
            var n = $(this),
                r = (n.next(), n.prev(), n.parents(".js-slide")),
                l = r.find(".slide__bg"),
                d = r.find(".js-slide-nav");
            r.find(".js-nav-frame");
            d.removeClass("__active"), d.eq(s).addClass("__active"), l.removeClass("__active"), l.eq(s).addClass("__active"), i()
        }
    }), $(".js-down").on("click", function() {
        $.fn.fullpage.moveTo($(this).data("dest")), "top" == $(this).data("dest") && $(".js-header").addClass(" header--hidden")
    }), $(".js-principles-more").on("click", function() {
        var e = $(this).data("dest");
        $.fn.fullpage.moveTo(e)
    }), $('.js-slide[data-type="sliderTextNav"]').each(function() {
        var e = $(this),
            t = e.find(".js-slide-nav");
        t.wrapInner('<div class="slide__nav-inner"></div>')
    }), i();
    var a = $(".js-arrow-next"),
        o = $(".js-arrow-prev"),
        s = a.parents(".js-slide"),
        n = (s.data("anchor"), s.find(".js-slider-item")),
        r = n.length;
    s.find(".js-slide-nav");
    $('.js-slide[data-type="sliderArrow"], .js-slide[data-type="sliderTextArr"]').each(function() {
        var e = $(this),
            t = e.find(".js-slider-item");
        e.find(".slide__wrap").append('<div class="slide__nav slide__nav--dots"></div>');
        var i = e.find(".slide__nav");
        t.each(function() {
            i.append('<div class="js-slide-nav slide__dot"></div>')
        });
        var a = e.find(".js-slide-nav");
        a.eq(t.filter(".active").index()).addClass("__active")
    }), $('.js-slide[data-family="collection"]').each(function() {
        var e = $(this);
        if (e.next().length || "sliderTextArr" == e.next().data("type")) {
            var t = e.next().data("name"),
                i = e.find(".slide__nav");
            i.length || (e.find(".slide__wrap").append('<div class="slide__nav"></div>'), i = e.find(".slide__nav")), i.append('<div class="btn__next-slide js-next">Коллекция «' + t + "»</div>"), $(".js-next").on("click", function() {
                var e = $(this).parents(".js-slide"),
                    t = e.index() + 1;
                $.fn.fullpage.moveTo(t + 1)
            })
        }
    }), $('.js-slide[data-type="sliderArrow"]').each(function() {
        var e = $(this);
        e.append('<div class="slide__arrow slide__arrow--left js-arrow-prev"> <div class="btn-arrow btn-arrow--left "></div></div>'), e.append('<div class="slide__arrow slide__arrow--right js-arrow-next"> <div class="btn-arrow btn-arrow--right "></div></div>');
        $(".js-arrow-next"), $(".js-arrow-prev")
    }), $('.js-slide[data-type="sliderTextArr"]').each(function() {
        $(".js-slide-nav").on("click", function() {
            var e = n.filter(".active").index();
            o.html(n.eq(e - 1).data("title")), e == r - 1 ? a.html(n.eq(0).data("title")) : a.html(n.eq(e + 1).data("title"))
        }), a.on("click", function() {
            var e = ($(this), n.filter(".active").index()),
                t = e + 1;
            o.html(n.eq(e).data("title")), t == r ? a.html(n.eq(1).data("title")) : t == r - 1 ? a.html(n.eq(0).data("title")) : a.html(n.eq(t + 1).data("title"))
        }), o.on("click", function() {
            var e = n.filter(".active").index(),
                t = e - 1;
            a.html(n.eq(e).data("title")), o.html(n.eq(t - 1).data("title"))
        })
    }), $(".js-slide").each(function() {
        var e = $(this),
            t = e.find(".js-arrow-next"),
            i = e.find(".js-arrow-prev"),
            a = e.data("anchor"),
            o = e.find(".js-slider-item"),
            s = o.length,
            n = e.find(".js-slide-nav");
        n.on("click", function() {
            var t = $(this),
                i = t.index();
            e.find(".js-nav-frame");
            $.fn.fullpage.moveTo(a, i)
        }), t.on("click", function() {
            var e = $(this),
                r = o.filter(".active").index(),
                l = r + 1;
            bg = e.parents(".js-slide").find("slide__bg"), i.html(o.eq(r).data("title")), l == s ? ($.fn.fullpage.moveTo(a, 0), n.removeClass("__active"), n.eq(0).addClass("__active"), t.html(o.eq(1).data("title"))) : ($.fn.fullpage.moveTo(a, l), n.removeClass("__active"), n.eq(l).addClass("__active"), l == s - 1 ? t.html(o.eq(0).data("title")) : t.html(o.eq(l + 1).data("title")))
        }), i.on("click", function() {
            var e = o.filter(".active").index(),
                t = e - 1;
            $.fn.fullpage.moveTo(a, t), n.removeClass("__active"), n.eq(t).addClass("__active")
        })
    })
}), $(window).on("load resize", function() {
    "use strict";
    var e = document.getElementById("viewport"),
        t = screen.width,
        i = t / 640;
    640 >= t ? e.setAttribute("content", "width=480px, initial-scale=" + i + ", maximum-scale=" + i + ", minimum-scale=" + i) : e.setAttribute("content", "width=device-width, initial-scale=1, maximum-scale=1")
}), $(function() {
    "use strict";
    var e = $(".js-slider");
    e.length && e.slick({
        dots: !0,
        infinite: !0,
        slidesToShow: 1,
        speed: 500,
        cssEase: "linear",
        prevArrow: '<div class="slide-carousel__arrow slide-carousel__arrow--left"></div>',
        nextArrow: '<div class="slide-carousel__arrow slide-carousel__arrow--right"></div>'
    })
});
var app = app || {};
app.Filter = library(function() {
    return {
        init: function() {
            this.elements = {
                filter: $(".js-collection-filter")
            }, this.elements.filter && this.bind()
        },
        bind: function() {
            var e = this,
                t = $(".js-filter-toggle-close"),
                i = $(".js-filter-toggle-open"),
                a = $(".js-filter-toggle"),
                o = $(".js-filter-item"),
                s = $(".js-all");
            o.on("click", $.proxy(e._getItems, this)), o.on("selectstart", function() {
                return !1
            }), i.on("click", $.proxy(e._openFilter, this)), t.on("click", $.proxy(e._closeFilter, this)), a.on("selectstart", function() {
                return !1
            }), o.on("click", $.proxy(e._hideFilterCategory, this)), s.on("click", $.proxy(e._showAll, this))
        },
        _getItems: function(e) {
            var t, i = this,
                a = $(".js-collection-items"),
                o = $(e.target),
                s = o.closest(".js-filter-item").data("filter-type"),
                n = o.closest(".js-filter-item").data("filter"),
                r = this.elements.filter.data("action"),
                l = $(".js-filter-toggle-open"),
                d = $(".js-ajax-layout"),
                c = o.closest(".js-filter-item").data("name");
            return o.hasClass("filter-active") ? !1 : (this._closeFilter(s, o), t = $.ajax({
                url: r,
                method: "GET",
                data: {
                    id: n
                },
                beforeSend: function() {
                    d.fadeToggle()
                }
            }), t.done(function(e) {
                a.html(e), d.fadeToggle(function() {
                    i._anchorSlide()
                })
            }), t.fail(function(e, t) {
                console.log("Request failed: " + t), d.fadeToggle()
            }), void l.html(c + " X"))
        },
        _closeFilter: function(e, t) {
            var i, a = this,
                o = $(".js-filter-item"),
                s = $(".js-collection-main-filter"),
                n = $(".js-filter-toggle-close"),
                r = $(".js-filter-toggle-open");
            t && (i = t.data("name")), "sub" == e ? (s.slideUp(), o.removeClass("filter-active"), t.addClass("filter-active")) : (n.hide(), a.elements.filter.stop(!1, !0).slideToggle()), n.html(i + " X"), r.html("все наборы")
        },
        _openFilter: function() {
            var e = this,
                t = $(".js-collection-main-filter"),
                i = $(".js-filter-toggle-close"),
                a = $(".js-filter-toggle-open");
            i.html("скрыть").show(), a.html("все наборы"), t.slideDown(10, function() {
                e.elements.filter.stop(!1, !0).slideDown()
            })
        },
        _hideFilterCategory: function() {
            $(".js-collection-cat-filter").hide()
        },
        _showAll: function(e) {
            var t = $(e.target),
                i = t.data("type");
            $(".js-collection-cat-filter").hide(), $(".js-collection-items").html(""), $(".js-collection-cat-filter-" + i).fadeIn(600), this._anchorSlide()
        },
        _anchorSlide: function() {
            var e = $(".js-items-top"),
                t = e.offset().top - 80;
            $("html, body").animate({
                scrollTop: t
            }, 400)
        }
    }
}());
var app = app || {};
app.Filter = library(function() {
        return {
            init: function() {
                this.elements = {
                    search: $(".js-search")
                }, this.elements.search && this.bind()
            },
            bind: function() {
                var e = this,
                    t = this.elements.search.find(".js-search-input");
                t.on("keyup", $.proxy(e._getQuery, this)), $B.on("click", $.proxy(e._closeDropdown, this))
            },
            _getQuery: function() {
                var e = this.elements.search.find(".js-search-input").val(),
                    t = this.elements.search.attr("action"),
                    i = $(".js-search-dropdown");
                if (e.length) {
                    var a = new RegExp(e, "i"),
                        o = 0;
                    $.getJSON(t, function(e) {
                        var t = '<ul class="searchresults">';
                        $.each(e.searchItems, function(e, i) {
                            -1 !== i.title.search(a) && (o = 1, t += '<li class="searchresults__item">', t += '<a class="searchresults__link clearfix" href="' + i.link + '">', t += '<span class="searchresults__img"><img src="' + i.img + '"></span>', t += '<span class="searchresults__title">' + i.title + "</span>", t += "</a>", t += "</li>")
                        }), t += "</ul>", 1 == o ? (i.removeClass("_hidden"), i.html(t)) : i.addClass("_hidden")
                    })
                } else i.addClass("_hidden")
            },
            _closeDropdown: function() {
                var e = $(".js-search-dropdown");
                e.addClass("_hidden")
            }
        }
    }()),
    function() {
        $.fn.photoswipe = function(e) {
            var t = [],
                i = e,
                a = function(e) {
                    t = [], e.each(function(e, i) {
                        t.push({
                            id: e,
                            items: []
                        }), $(i).find("a").each(function(i, a) {
                            var o = $(a),
                                s = o.data("size").split("x");
                            if (2 != s.length) throw SyntaxError("Missing data-size attribute.");
                            o.data("gallery-id", e + 1), o.data("photo-id", i);
                            var n = {
                                src: a.href,
                                msrc: a.children[0].getAttribute("src"),
                                w: parseInt(s[0], 10),
                                h: parseInt(s[1], 10),
                                title: o.data("title"),
                                el: a
                            };
                            t[e].items.push(n)
                        }), $(i).on("click", "a", function(e) {
                            e.preventDefault();
                            var t = $(this).data("gallery-id"),
                                i = $(this).data("photo-id");
                            s(t, i)
                        })
                    })
                },
                o = function() {
                    var e = window.location.hash.substring(1),
                        t = {};
                    if (e.length < 5) return t;
                    for (var i = e.split("&"), a = 0; a < i.length; a++)
                        if (i[a]) {
                            var o = i[a].split("=");
                            o.length < 2 || (t[o[0]] = o[1])
                        }
                    return t.gid && (t.gid = parseInt(t.gid, 10)), t.hasOwnProperty("pid") ? (t.pid = parseInt(t.pid, 10), t) : t
                },
                s = function(e, a) {
                    var o = document.querySelectorAll(".pswp")[0],
                        s = t[e - 1].items,
                        n = {
                            index: a,
                            galleryUID: e,
                            getThumbBoundsFn: function(e) {
                                var t = s[e].el.children[0],
                                    i = window.pageYOffset || document.documentElement.scrollTop,
                                    a = t.getBoundingClientRect();
                                return {
                                    x: a.left,
                                    y: a.top + i,
                                    w: a.width
                                }
                            }
                        };
                    $.extend(n, i), n.index = a;
                    var r = new PhotoSwipe(o, PhotoSwipeUI_Default, s, n);
                    r.init()
                };
            a(this);
            var n = o();
            return n.pid > 0 && n.gid > 0 && s(n.gid, n.pid), this
        };
        var e = {
            history: !1,
            focus: !1,
            index: 0,
            showHideOpacity: !0,
            bgOpacity: .8,
            showAnimationDuration: 300,
            hideAnimationDuration: 300,
            closeOnScroll: !1,
            counterEl: !1,
            fullscreenEl: !1,
            zoomEl: !1,
            shareEl: !1,
            spacing: .3,
            closeOnVerticalDrag: !1
        };
        $(".js-certificates").length && $(".js-certificates").photoswipe(e)
    }(), $(function() {
        "use strict";
        var e = $(".js-item-color");
        if (e.length) {
            var t = $(".js-color-text"),
                i = $(".js-color-image");
            e.on("click", function() {
                var a = $(this),
                    o = t.filter("[data-color=" + a.data("color") + "]"),
                    s = i.filter("[data-color=" + a.data("color") + "]");
                e.removeClass("__selected"), a.addClass("__selected"), t.removeClass("__selected"), o.addClass("__selected"), i.removeClass("__selected"), s.addClass("__selected")
            })
        }
    }), $(function() {
        "use strict";

        function e(e) {
            a.filter("[data-target=" + e + "]").animate({
                height: "toggle",
                opacity: "toggle",
                paddingTop: "toggle",
                paddingBottom: "toggle"
            })
        }

        function t(e, t) {
            var i = e.filter("[data-target =" + t + " ] ").position().top - 69;
            $("html, body").animate({
                scrollTop: i
            }, 800)
        }
        var i = $(".js-show-hidden");
        if (i.length) {
            var a = $(".js-hidden");
            i.on("click", function() {
                var o = $(this),
                    s = o.data("target"),
                    n = o.text();
                console.log(s), o.hasClass("__active") ? (o.removeClass("__active"), e(s), o.text(o.data("text"))) : (i.removeClass("__active"), o.addClass("__active"), i.each(function() {
                    var e = $(this);
                    e.text(e.data("text"))
                }), o.text(o.data("swap")), o.data("text", n), a.filter(":visible").length ? (a.filter(":visible").slideUp(500), setTimeout(function() {
                    e(s), t(a, s)
                }, 600)) : (e(s), t(a, s)))
            })
        }
    }), $(function() {
        "use strict";
        var e = $(".js-anim-video");
        if (e.length) {
            var t = $(".js-anim-videos");
            iosCheck() ? t.each(function() {
                var e = $(this),
                    t = e.data("bg");
                e.css("background-image", "url(" + t + ")")
            }) : e.on("canplay", function() {
                $(this).addClass("__loaded")
            })
        }
    }), $(function() {
        "use strict";
        var e = $(".js-footer");
        e.length && ($(".js-vk-link").on({
            mouseenter: function() {
                e.addClass("__vk")
            },
            mouseleave: function() {
                e.removeClass("__vk")
            }
        }), $(".js-fb-link").on({
            mouseenter: function() {
                e.addClass("__fb")
            },
            mouseleave: function() {
                e.removeClass("__fb")
            }
        }))
    }), $(function() {
        "use strict";
        var e = $(".js-carousel");
        e.length && e.each(function(t, i) {
            var a = "carousel" + t;
            this.id = a, $(this).slick({
                infinite: !0,
                slidesToShow: 3,
                arrows: !0,
                variableWidth: !0,
                slidesToScroll: 1,
                appendArrows: e.filter("#" + a).parent().find(".carousel__nav"),
                prevArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--left carousel__arrow carousel__arrow-left"></div>',
                nextArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--right carousel__arrow carousel__arrow-right"></div>',
                responsive: []
            })
        })
    }),
    function() {
        var e = {
                history: !1,
                focus: !1,
                index: 0,
                showHideOpacity: !0,
                bgOpacity: .8,
                showAnimationDuration: 300,
                hideAnimationDuration: 300,
                closeOnScroll: !1,
                counterEl: !1,
                fullscreenEl: !1,
                zoomEl: !1,
                shareEl: !1,
                spacing: .3,
                closeOnVerticalDrag: !1
            },
            t = function() {
                var t = document.querySelectorAll(".pswp")[0],
                    i = new PhotoSwipe(t, PhotoSwipeUI_Default, window.gallery, e);
                i.init()
            };
        $H.on("click", ".js-open-gallery", function() {
            e.index = $(this).data("id"), t()
        })
    }(),
    function() {
        function e() {
            $D.width() > a && !i ? i = t.slick({
                infinite: !0,
                slidesToShow: 4,
                arrows: !0,
                variableWidth: !0,
                slidesToScroll: 1,
                appendArrows: t.parent().find(".carousel__nav"),
                prevArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--left carousel__arrow carousel__arrow-left"></div>',
                nextArrow: '<div class="btn-arrow btn-arrow--small btn-arrow--green btn-arrow--right carousel__arrow carousel__arrow-right"></div>'
            }) : $D.width() <= a && i && (t.slick("unslick"), i = null)
        }
        var t = $(".js-store-images");
        if (t.length) {
            var i, a = 1023;
            e(), $W.on("resize", function() {
                clearTimeout($.data(this, "resizeTimer")), $.data(this, "resizeTimer", setTimeout(function() {
                    e()
                }, 100))
            })
        }
    }(), $(function() {
        "use strict";

        function e(e, t, i) {
            a && a.close(), $(".map-bbl-wrap").remove(), a = new InfoBubble({
                map: o,
                content: i,
                position: new google.maps.LatLng(e, t),
                shadowStyle: 0,
                padding: 0,
                backgroundColor: "transparent",
                borderRadius: 0,
                arrowSize: 6,
                borderWidth: 0,
                borderColor: "transparent",
                disableAutoPan: !0,
                hideCloseButton: !0,
                arrowPosition: 50,
                backgroundClassName: "map-bbl store-popup",
                arrowStyle: 0,
                maxWidth: 0,
                maxHeight: 0,
                disableAnimation: !0
            })
        }

        function t() {
            var e = {
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: !1,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_CENTER
                },
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_CENTER
                }
            };
            o = new google.maps.Map(document.getElementById("map"), e);
            var t = i.data("lat"),
                a = i.data("lng"),
                s = new google.maps.LatLng(t, a);
            o.panTo(s), o.panBy(0, -20), google.maps.event.addDomListener(window, "resize", function() {
                o.setCenter(s)
            })
        }
        var i = $(".js-store-map");
        if (!i.length) return !1;
        var a, o, s = i.data("name"),
            n = i.data("address");
        t(), e(i.data("lat"), i.data("lng"), '<div class="store-popup-title">' + s + '</div><div class="store-popup-desc">' + n + "</div>"), a.open(), google.maps.event.trigger(o, "resize")
    }), $(function() {
        "use strict";

        function e(e, t, i) {
            r && r.close(), $(".map-bbl-wrap").remove(), r = new InfoBubble({
                map: l,
                content: i,
                position: new google.maps.LatLng(e, t),
                shadowStyle: 0,
                padding: 0,
                backgroundColor: "transparent",
                borderRadius: 0,
                arrowSize: 6,
                borderWidth: 0,
                borderColor: "transparent",
                disableAutoPan: !0,
                hideCloseButton: !1,
                arrowPosition: 50,
                backgroundClassName: "map-bbl store-popup",
                arrowStyle: 0,
                maxWidth: 0,
                maxHeight: 0,
                disableAnimation: !0
            })
        }

        function t() {
            var e = {
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: !1,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_CENTER
                },
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_CENTER
                }
            };
            l = new google.maps.Map(document.getElementById("map"), e);
            var t, a;
            void 0 !== f ? (t = Cookies.get("lat"), a = Cookies.get("lng")) : (t = n.data("lat"), a = n.data("lng"));
            new google.maps.LatLng(t, a);
            i()
        }

        function i() {
            var e = n.data("marker-url"),
                t = n.data("marker-hover"),
                i = n.data("marker-group-url"),
                s = [{
                    url: i,
                    height: 46,
                    width: 46,
                    textColor: "#fff",
                    textSize: 24,
                    fontFamily: "PFDinTextCompPro",
                    fontWeight: "normal",
                    maxZoom: 15
                }];
            $.each(d, function(i) {
                var a = new google.maps.LatLng(this.lat, this.lng),
                    o = new google.maps.Marker({
                        position: a,
                        icon: e
                    });
                m.push(o), google.maps.event.addListener(o, "mouseover", function() {
                    o.setIcon(t)
                }), google.maps.event.addListener(o, "mouseout", function() {
                    o.setIcon(e)
                })
            });
            var r = new MarkerClusterer(l, m, {
                styles: s
            });
            google.maps.event.addListener(r, "click", function(e) {
                m = e.getMarkers(), a()
            }), void 0 !== f ? (u = Cookies.get("zoom"), c = Cookies.get("lat"), p = Cookies.get("lng"), l.setCenter(new google.maps.LatLng(c, p)), l.setZoom(+u)) : a(), o()
        }

        function a() {
            var e = new google.maps.LatLngBounds;
            m.length > 0 ? ($.each(m, function() {
                var t = new google.maps.LatLng(this.position.lat(), this.position.lng());
                e.extend(t)
            }), m.length > 1 ? (l.fitBounds(e), l.panBy(0, 80), l.setZoom(l.getZoom() - 1)) : (l.panTo(e.getCenter()), l.setZoom(13))) : l.center.lat() + l.center.lng() === 0 && (l.setCenter(new google.maps.LatLng(58.6555915313906, 43.27900886535656)), l.setZoom(5))
        }

        function o() {
            $.each(m, function(t) {
                google.maps.event.addListener(this, "click", function() {
                    var i = d[t],
                        a = new google.maps.LatLng(i.lat, i.lng);
                    e(i.lat, i.lng, '<div class="store-popup-title">' + i.name + '</div><div class="store-popup-desc">' + i.address + '</div><a href="' + i.url + '" class="store-popup-link">Подробнее о салоне</a>'), r.open(), l.panTo(a), l.panBy(0, -70)
                })
            })
        }

        function s() {
            var e = n.offset().top,
                t = $D.height();
            t - e > h && n.height(t - e)
        }
        var n = $(".js-stores-map");
        if (!n.length) return !1;
        var r, l, d, c, p, u, m = [],
            h = n.height(),
            f = Cookies.get("lat");
        s(),
            function() {
                $.ajax({
                    url: n.data("objects-url"),
                    success: function(e) {
                        d = e.objects, t()
                    },
                    error: function() {
                        console.error("Ошибка получения гео-объектов")
                    }
                })
            }(), $W.on("resize", function() {
                clearTimeout($.data(this, "resizeTimer")), $.data(this, "resizeTimer", setTimeout(function() {
                    s()
                }, 100))
            }), $H.on("click", ".js-map-bbl-close", function() {
                r.close()
            }), $W.on("load", function() {
                s()
            });
        var v = $(".js-go-to-map");
        v.on("click", function() {
            var e = $(this).data("lat"),
                t = $(this).data("lng"),
                i = $(this).data("zoom");
            Cookies.set("lat", e), Cookies.set("lng", t), Cookies.set("zoom", i), l.getCenter().lat() !== e && l.getCenter().lng() !== t ? (l.setCenter(new google.maps.LatLng(e, t)), l.setZoom(i)) : l.getZoom() !== i && l.setZoom(i)
        })
    });