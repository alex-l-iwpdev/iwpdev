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

	var formEl = $( 'input, textarea' );
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
} );
