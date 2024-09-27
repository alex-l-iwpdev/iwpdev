'use strict';

gsap.registerPlugin( ScrollTrigger, ScrollSmoother );
jQuery( document ).ready( function( $ ) {
	if ( ScrollTrigger.isTouch !== 1 ) {
		ScrollSmoother.create( {
			wrapper: '.wrapper',
			content: '.content',
			smooth: '1.5',
			effects: true
		} );
	}

	var burgerButton = $( '.burger-menu' );
	var headerMenu = $( 'header .menu' );
	var itemsT = gsap.utils.toArray( '.portfolio-item, .top' );
	var itemsR = gsap.utils.toArray( '.right' );
	var itemsL = gsap.utils.toArray( '.left' );
	itemsT.forEach( function( item ) {
		gsap.fromTo( item, { y: 30, opacity: 0 }, {
			opacity: 1,
			y: 0,
			scrollTrigger: {
				trigger: item,
				scrub: true
			}
		} );
	} );

	itemsR.forEach( function( item ) {
		gsap.fromTo( item, { x: 100, opacity: 0 }, {
			opacity: 1,
			x: 0,
			scrollTrigger: {
				trigger: item,
				scrub: true
			}
		} );
	} );

	itemsL.forEach( function( item ) {
		gsap.fromTo( item, { x: -100, opacity: 0 }, {
			opacity: 1,
			x: 0,
			scrollTrigger: {
				trigger: item,
				scrub: true
			}
		} );
	} );

	burgerButton.click( function() {
		$( this ).toggleClass( 'close' );
		headerMenu.toggleClass( 'open' );
	} );

	var menuChevron = $( '.menu-item-has-children' ),
		chevronEl = '<i class="icon-chevron"></i>';
	if ( menuChevron.length ) {
		menuChevron.children( 'a' ).after( chevronEl );
	}

	var testimonials = $( '.testimonial-items' );
	if ( testimonials.length ) {
		testimonials.slick( {
			dots: true,
			arrows: false,
			infinite: true,
			slidesToShow: 3
		} );
	}

	var formEl = $( 'input:not([type="radio"]), textarea' );
	formEl.focus( function() {
		$( this ).parent().addClass( 'focus' );
	} );

	formEl.blur( function() {
		if ( $( this ).val().length == 0 ) {
			$( this ).parent().removeClass( 'focus' );
		}
	} );

	formEl.each( function() {
		if ( $( this ).val().length < 1 ) {
			$( this ).parent().removeClass( 'focus' );
		} else {
			$( this ).parent().addClass( 'focus' );
		}
	} );

	if ( $( '.content-text code' ).length ) {
		hljs.initHighlightingOnLoad();
		var allCodes = document.getElementsByTagName( 'code' );
		var copyCodeButtons = document.querySelectorAll( '.copy-code-button' );
		var i = 0;

		for ( i = 0; i < copyCodeButtons.length; i++ ) {
			copyCodeButtons[ i ].addEventListener( 'click', function( e ) {
				var code = e.target.parentElement.getElementsByTagName( 'code' )[ 0 ];
				var originalText = 'Copy&nbsp;<i class="icon-copy"></i>';
				setTimeout( function() {
					e.preventDefault();
					e.target.innerHTML = originalText;
				}, 2000 );
				e.target.innerHTML = 'copied&nbsp<i class="icon-check"></i>';
			} );
		}
	}

	$( '.icon-arrow-down' ).click( function() {
		var scrollNextRow = $( this ).parents( '.row' ).next();
		$( 'html,body' ).animate( {
			scrollTop: scrollNextRow.offset().top
		}, 1000 );
	} );
} );
