'use strict';

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);
jQuery(document).ready(function ($) {

    if (ScrollTrigger.isTouch !== 1) {
        ScrollSmoother.create({
            wrapper: '.wrapper',
            content: '.content',
            smooth: '1.5',
            effects: true
        });
    }
    var burgerButton = $('.burger-menu');
    var headerMenu = $('header .menu');
    var itemsT = gsap.utils.toArray('.portfolio-item, .top');
    var itemsR = gsap.utils.toArray('.right');
    var itemsL = gsap.utils.toArray('.left');
    itemsT.forEach(function (item) {
        gsap.fromTo(item, { y: 30, opacity: 0 }, {
            opacity: 1,
            y: 0,
            scrollTrigger: {
                trigger: item,
                scrub: true
            }
        });
    });
    itemsR.forEach(function (item) {
        gsap.fromTo(item, { x: 100, opacity: 0 }, {
            opacity: 1,
            x: 0,
            scrollTrigger: {
                trigger: item,
                scrub: true
            }
        });
    });
    itemsL.forEach(function (item) {
        gsap.fromTo(item, { x: -100, opacity: 0 }, {
            opacity: 1,
            x: 0,
            scrollTrigger: {
                trigger: item,
                scrub: true
            }
        });
    });
    burgerButton.click(function () {
        $(this).toggleClass('close');
        headerMenu.toggleClass('open');
    });
    var menuChevron = $('.menu-item-has-children'),
        chevronEl = '<i class="icon-chevron"></i>';
    if (menuChevron.length) {
        menuChevron.children("a").after(chevronEl);
    };
    var iconChevron = $('.menu .icon-chevron');
    iconChevron.click(function () {
        $(this).toggleClass('chevron-up');
        $(this).next().slideToggle();
    });
    var testimonials = $('.testimonial-items');
    if (testimonials.length) {
        testimonials.slick({
            dots: true,
            arrows: false,
            infinite: true,
            slidesToShow: 3,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1.3,
                    infinite: false
                }
            }, {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                    infinite: false
                }
            }]
        });
    };
    var formEl = $('input:not([type="radio"]), textarea');
    formEl.focus(function () {
        $(this).parent().addClass('focus');
    });
    formEl.blur(function () {
        if ($(this).val().length == 0) {
            $(this).parent().removeClass('focus');
        }
    });
    formEl.each(function () {
        if ($(this).val().length < 1) {
            $(this).parent().removeClass('focus');
        } else {
            $(this).parent().addClass('focus');
        }
    });
    $('.icon-arrow-down').click(function () {
        var scrollNextRow = $(this).parents('.row').next();
        $('html,body').animate({
            scrollTop: scrollNextRow.offset().top
        }, 1000);
    });
    $('a[href*="#"]:not([href="#"]), a[href*="#"]:not(.icon-arrow-down)').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
    var codeBlocks = $('.wp-block-code code');
    if (codeBlocks.length) {
        var COPY_TEXT_CHANGE_OFFSET = 1000;
        var COPY_BUTTON_TEXT_BEFORE = "Copy";
        var COPY_BUTTON_TEXT_AFTER = "Copied";
        var COPY_ERROR_MESSAGE = "No copy";
        var codeWrappers = document.querySelectorAll(".wp-block-code ");
        var copyBlockCode = async function copyBlockCode() {
            var target = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

            if (!target) return;
            try {
                var code = decodeURI(target.dataset.code);
                await navigator.clipboard.writeText(code);
                target.textContent = COPY_BUTTON_TEXT_AFTER;
                setTimeout(function () {
                    target.textContent = COPY_BUTTON_TEXT_BEFORE;
                }, COPY_TEXT_CHANGE_OFFSET);
            } catch (error) {
                alert(COPY_ERROR_MESSAGE);
                console.error(error);
            }
        };
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
            for (var _iterator = codeWrappers[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var codeWrapper = _step.value;

                var codeBlock = codeWrapper.querySelector(".wp-block-code code");
                var codes = codeBlock.innerHTML;
                console.log(codeBlock);
                var copyButton = '<button type="button" class="copy-btn icon-copy" data-code="' + encodeURI(codeBlock.textContent) + '"> ' + COPY_BUTTON_TEXT_BEFORE + '</button>';
                var codeBody = '<div class="code-body"><div class="code-text">' + codes + '</div></div>';
                var codeHeader = '\n            <div class="code-header">\n                <span class="red btn"></span>\n                <span class="yellow btn"></span>\n                <span class="green btn"></span>\n                ' + copyButton + '\n            </div>';
                codeBlock.innerHTML = codeHeader + codeBody;
            }
        } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
        } finally {
            try {
                if (!_iteratorNormalCompletion && _iterator.return) {
                    _iterator.return();
                }
            } finally {
                if (_didIteratorError) {
                    throw _iteratorError;
                }
            }
        }

        $('.copy-btn').click(function () {
            copyBlockCode(this);
        });
        //        for (var pres = document.querySelectorAll(".wp-block-code .code-body"), i = 0; i < pres.length; i++) pres[i].addEventListener("dblclick", function() {
        //            var e = getSelection(),
        //                t = document.createRange();
        //            t.selectNodeContents(this), e.removeAllRanges(), e.addRange(t)
        //        }, !1);

        document.querySelectorAll('.wp-block-code .code-body').forEach(function (block) {
            hljs.highlightBlock(block);
            hljs.initLineNumbersOnLoad();
        });
    }
    var faqItem = $('.faq-item .icon-chevron');
    faqItem.click(function () {
        var allItems = $('.faq-item .hide'),
            currItem = $(this).parent().find('.hide');
        if ($(this).hasClass('chevron-up')) {
            currItem.slideUp(300);
            faqItem.removeClass('chevron-up');
        } else {
            faqItem.removeClass('chevron-up');
            $(this).addClass('chevron-up');
            allItems.slideUp(300);
            currItem.slideDown(300);
        }
    });
});