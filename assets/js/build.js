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
    //    $('a[href*=#]:not([href=#]), a[href*=#]:not(.icon-arrow-down)').click(function () {
    //        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
    //            var target = $(this.hash);
    //            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    //            if (target.length) {
    //                $('html,body').animate({
    //                    scrollTop: target.offset().top
    //                }, 1000);
    //                return false;
    //            }
    //        }
    //    });
    var buttonCopy = '<button class="copy-code-button"> Copy <i class="icon-copy"></i></button>';
    var codeBlock = $('section .container code');
    if (codeBlock.length) {
        codeBlock.each(function () {
            hljs.highlightBlock(this);
            $(this).after(buttonCopy);
        });

        hljs.initLineNumbersOnLoad();
        codeBlock.dblclick(function () {
            var range = document.createRange();
            range.selectNodeContents(this);
            var selection = window.getSelection();
            console.log(range.selectNodeContents(this));
            selection.removeAllRanges();
            selection.addRange(range);
        });
        var copyCodeButtons = document.querySelectorAll(".copy-code-button");
        var allCodes = document.getElementsByTagName("code");
        var i = 0;

        for (i = 0; i < copyCodeButtons.length; i++) {
            copyCodeButtons[i].addEventListener("click", function (e) {
                var code = e.target.parentElement.getElementsByTagName("code")[0];
                var originalText = 'Copy&nbsp;<i class="icon-copy"></i>';
                setTimeout(function () {
                    e.preventDefault();
                    e.target.innerHTML = originalText;
                }, 2000);
                e.target.innerHTML = 'copied&nbsp<i class="icon-check"></i>';
            });
        }
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