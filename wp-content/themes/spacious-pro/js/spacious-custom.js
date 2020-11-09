jQuery( document ).ready( function () {

	jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 1000 ) {
				jQuery( '#scroll-up' ).fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		} );
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body,html' ).animate( {
				scrollTop : 0
			}, 800 );
			return false;
		} );
	} );

	// fixed sidebar js
	if ( ( typeof jQuery.fn.theiaStickySidebar !== 'undefined' ) && ( typeof ResizeSensor !== 'undefined' ) ) {
		jQuery( '#primary, #secondary' ).theiaStickySidebar( {
			additionalMarginTop : 40
		} );
	}

	// CounterUP
	if ( typeof jQuery.fn.counterUp !== 'undefined' ) {
		jQuery( '.counter' ).counterUp( {
			delay : 10,
			time  : 2000
		} );
	}

	jQuery( '.better-responsive-menu .menu-primary-container .menu-item-has-children' ).append( '<span class="sub-toggle"> <span class="fa  fa-caret-right"></span> </span>' );

	if ( window.matchMedia( "(max-width: 769px)" ).matches ) {
		jQuery( '.better-responsive-menu .menu-primary-container .sub-toggle' ).click( function () {
			jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
			jQuery( this ).children( '.sub-toggle .fa' ).first().toggleClass( 'fa-caret-down fa-caret-right' );
		} );
	}

	// Accordian widget
	jQuery( '#tg-accordion .accordian-header' ).click( function () {

		var $this = jQuery( this );

		if ( $this.parent().hasClass( 'active' ) ) {
			$this.parent().removeClass( 'active' );
			$this.next().slideUp( 350 );
		} else {
			$this.parent().parent().find( '.accordian-item' ).removeClass( 'active' );
			$this.parent().parent().find( '.accordian-content' ).slideUp( 350 );
			$this.parent().addClass( 'active' );
			$this.next( '.accordian-content' ).slideDown( 350 );
		}
	} );

	// Slider progressbar
	var progress  = jQuery( '#progress' ),
	    slideshow = jQuery( '.slider-cycle' );

	slideshow.on( 'cycle-initialized cycle-before', function ( e, opts ) {
		progress.stop( true ).css( 'width', 0 );
	} );

	slideshow.on( 'cycle-initialized cycle-after', function ( e, opts ) {
		if ( ! slideshow.is( '.cycle-paused' ) ) {
			progress.animate( { width : '100%' }, opts.timeout, 'linear' );
		}
	} );

	slideshow.on( 'cycle-paused', function ( e, opts ) {
		progress.stop();
	} );

	slideshow.on( 'cycle-resumed', function ( e, opts, timeoutRemaining ) {
		progress.animate( { width : '100%' }, timeoutRemaining, 'linear' );
	} );

	/**
	 * Search
	 */
	var hideSearchForm = function () {
		jQuery( '.header-search-form, .footer-search-form' ).removeClass( 'show' );
	};

	// On Search icon click.
	jQuery( '#header-right-section .search, .bottom-menu .search' ).click( function () {
		jQuery( this ).next( '.header-search-form' ).toggleClass( 'show' );
		jQuery( '.footer-search-form' ).toggleClass( 'show' );

		// focus after some time to fix conflict with toggleClass
		setTimeout( function () {
			jQuery( '.header-search-form.show input, .footer-search-form.show input' ).focus();
		}, 200 );

		// For esc key press.
		jQuery( document ).on( 'keyup', function ( e ) {

			// on esc key press.
			if ( 27 === e.keyCode ) {
				// if search box is opened
				if ( jQuery( '.header-search-form, .footer-search-form' ).hasClass( 'show' ) ) {
					hideSearchForm();
				}

			}
		} );

		jQuery( document ).on( 'click.outEvent', function ( e ) {
			if ( e.target.closest( '.search-wrapper' ) || ( e.target.closest( '.footer-search-wrapper' ) && ! e.target.closest( '.footer-search-wrapper .close' ) ) ) {
				return;
			}

			hideSearchForm();

			// Unbind current click event.
			jQuery( document ).off( 'click.outEvent' );
		} );

		jQuery( '.footer-search-form .close' ).on( 'click', function () {
			jQuery( '.search-box' ).removeClass( 'show' );
		} );

	} );

	// Header toggle sidebar.
	jQuery( '.header-toggle-wrapper' ).click( function () {
		jQuery( '.header-widgets-wrapper' ).slideToggle();
		jQuery( '.header-toggle-wrapper' ).toggleClass( 'clicked' );
	} );


	// Sticky menu JS setting.
	if ( typeof jQuery.fn.headroom !== 'undefined' ) {
		var offset_value;
		var wpAdminBar  = jQuery( '#wpadminbar' );
		var headerwidth = jQuery( '#header-text-nav-container' ).width();

		if ( wpAdminBar.length ) {
			offset_value = wpAdminBar.height() + jQuery( '#header-text-nav-container' ).offset().top;
		} else {
			offset_value = jQuery( '#header-text-nav-container' ).offset().top;
		}

		jQuery( '#header-text-nav-container' ).headroom( {
			offset    : offset_value,
			tolerance : 0,
			onPin     : function () {
				if ( wpAdminBar.length ) {
					jQuery( '#header-text-nav-container' ).css( {
						'top'      : wpAdminBar.height(),
						'position' : 'fixed',
						'width'    : headerwidth
					} );
				} else {
					jQuery( '#header-text-nav-container' ).css( {
						'top'      : 0,
						'position' : 'fixed',
						'width'    : headerwidth
					} );
				}
			},
			onTop     : function () {
				jQuery( '#header-text-nav-container' ).css( {
					'top'      : 0,
					'position' : 'relative'
				} );
			}
		} );
	}

} );

jQuery( window ).load( function () {
	// Slider settings
	if ( typeof jQuery.fn.cycle !== 'undefined' ) {

		if ( typeof spacious_slider_value !== 'undefined' ) {
			var transition_effect, transition_delay, transition_duration, pauseonhover, random_order;
			transition_effect   = spacious_slider_value.transition_effect;
			transition_delay    = parseInt( spacious_slider_value.transition_delay, 10 );
			transition_duration = parseInt( spacious_slider_value.transition_duration, 10 );
			pauseonhover        = parseInt( spacious_slider_value.pauseonhover, 10 );
			random_order        = spacious_slider_value.random_order;

			jQuery( '.slider-cycle' ).cycle( {
				fx               : transition_effect,
				timeout          : transition_delay,
				speed            : transition_duration,
				slides           : '> div',
				pager            : '> #controllers',
				pagerActiveClass : 'active',
				pagerTemplate    : '<a></a>',
				pauseOnHover     : Boolean( pauseonhover ),
				autoHeight       : 'container',
				swipe            : true,
				swipeFx          : 'scrollHorz',
				log              : false,
				random           : random_order
			} );
		}

		// Clients carousel
		function initCycle() {
			var width = jQuery( document ).width(); // Getting the width and checking my layout
			if ( width < 400 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( {
					carouselVisible : 1,
					swipe           : true
				} );
			} else if ( width > 400 && width < 600 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( {
					carouselVisible : 2,
					swipe           : true
				} );
			} else if ( width > 600 && width < 768 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( {
					carouselVisible : 3,
					swipe           : true
				} );
			} else if ( width > 768 && width < 992 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( {
					carouselVisible : 4,
					swipe           : true
				} );
			} else {
				jQuery( '.spacious_clients_wrap' ).cycle( {
					carouselVisible : 5,
					swipe           : true
				} );
			}
		}

		initCycle();

		function reinit_cycle() {
			var width = jQuery( window ).width(); // Checking size again after window resize
			if ( width < 400 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 1 );
			} else if ( width > 400 && width < 600 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 2 );
			} else if ( width > 600 && width < 768 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 3 );
			} else if ( width > 768 && width < 992 ) {
				jQuery( '.spacious_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 4 );
			} else {
				jQuery( '.spacious_clients_wrap' ).cycle( 'destroy' );
				reinitCycle( 5 );
			}
		}

		function reinitCycle( visibleSlides ) {
			jQuery( '.spacious_clients_wrap' ).cycle( {
				carouselVisible : visibleSlides,
				swipe           : true
			} );
		}

		var reinitTimer;
		jQuery( window ).resize( function () {
			clearTimeout( reinitTimer );
			reinitTimer = setTimeout( reinit_cycle, 100 ); // Timeout limits the number of calculations
		} );
		// Complete clients carousel

		// Testimonial SLider.
		var slider_enable, slider_speed, slider_pauseOnhover, slides_per_view, slider_delay, pauseHover;
		slider_enable       = jQuery( '.testimonial-widget' ).attr( 'data-enable' );
		slider_speed        = jQuery( '.testimonial-widget' ).attr( 'data-speed' );
		slider_delay        = jQuery( '.testimonial-widget' ).attr( 'data-delay' );
		slider_pauseOnhover = jQuery( '.testimonial-widget' ).attr( 'data-pauseOnHover' );
		slides_per_view     = jQuery( '.testimonial-widget' ).attr( 'data-slides_per_view' );
		pauseHover          = slider_pauseOnhover == 'true' ? true : false;

		if ( slider_enable == 'true' ) {
			function initTestimonialCycle() {
				var width = jQuery( document ).width(); // Getting the width and checking my layout
				if ( width > 0 && width < 600 ) {
					jQuery( '.testimonial-widget' ).cycle( {
						slides          : '.testimonial-details',
						pauseOnHover    : pauseHover,
						speed           : parseInt( slider_speed ),
						delay           : parseInt( slider_delay ),
						fx              : 'carousel',
						carouselVisible : 1,
						carouselFluid   : true,
						swipe           : true
					} );
				} else if ( width > 600 && width < 992 ) {
					jQuery( '.testimonial-widget' ).cycle( {
						slides          : '.testimonial-details',
						pauseOnHover    : pauseHover,
						speed           : parseInt( slider_speed ),
						delay           : parseInt( slider_delay ),
						fx              : 'carousel',
						carouselVisible : 2,
						carouselFluid   : true,
						swipe           : true
					} );
				} else {
					jQuery( '.testimonial-widget' ).cycle( {
						slides          : '.testimonial-details',
						pauseOnHover    : pauseHover,
						speed           : parseInt( slider_speed ),
						delay           : parseInt( slider_delay ),
						fx              : 'carousel',
						carouselVisible : slides_per_view,
						carouselFluid   : true,
						swipe           : true
					} );
				}
			}

			initTestimonialCycle();

			function reinit_testimonial_cycle() {
				var width = jQuery( window ).width(); // Checking size again after window resize
				if ( width > 0 && width < 600 ) {
					jQuery( '.testimonial-widget' ).cycle( 'destroy' );
					reinitTestimonialCycle( 1 );
				} else if ( width > 600 && width < 992 ) {
					jQuery( '.testimonial-widget' ).cycle( 'destroy' );
					reinitTestimonialCycle( 2 );
				} else {
					jQuery( '.testimonial-widget' ).cycle( 'destroy' );
					reinitTestimonialCycle( slides_per_view );
				}
			}

			function reinitTestimonialCycle( visibleSlides ) {
				jQuery( '.testimonial-widget' ).cycle( {
					slides          : '.testimonial-details',
					pauseOnHover    : pauseHover,
					speed           : parseInt( slider_speed ),
					delay           : parseInt( slider_delay ),
					fx              : 'carousel',
					carouselVisible : visibleSlides,
					carouselFluid   : true,
					swipe           : true
				} );
			}

			var reinitTestimonialTimer;
			jQuery( window ).resize( function () {
				clearTimeout( reinitTestimonialTimer );
				reinitTestimonialTimer = setTimeout( reinit_testimonial_cycle, 100 ); // Timeout limits the number of
			                                                                          // calculations
			} );
		}

		// Product Slider.
		var productSlider_enable, productSlider_speed, productSlider_pauseOnhover, product_per_view,
		    productSlider_delay, productPauseHover;
		productSlider_enable       = jQuery( '.product-wrapper.slider-enable' ).attr( 'data-enable' );
		productSlider_speed        = jQuery( '.product-wrapper.slider-enable' ).attr( 'data-speed' );
		productSlider_delay        = jQuery( '.product-wrapper.slider-enable' ).attr( 'data-delay' );
		productSlider_pauseOnhover = jQuery( '.product-wrapper.slider-enable' ).attr( 'data-productSlider_pauseOnhover' );
		product_per_view           = jQuery( '.product-wrapper.slider-enable' ).attr( 'data-product_per_view' );
		productPauseHover          = productSlider_pauseOnhover == 'true' ? true : false;

		if ( productSlider_enable == 'true' ) {
			function initProductCycle() {
				var width = jQuery( document ).width(); // Getting the width and checking my layout
				if ( width > 0 && width < 600 ) {
					jQuery( '.product-wrapper.slider-enable' ).cycle( {
						slides          : '> div',
						pauseOnHover    : productPauseHover,
						speed           : parseInt( productSlider_speed ),
						delay           : parseInt( productSlider_delay ),
						fx              : 'carousel',
						carouselVisible : 1,
						carouselFluid   : true,
						swipe           : true
					} );
				} else if ( width > 600 && width < 992 ) {
					jQuery( '.product-wrapper.slider-enable' ).cycle( {
						slides          : '> div',
						pauseOnHover    : productPauseHover,
						speed           : parseInt( productSlider_speed ),
						delay           : parseInt( productSlider_delay ),
						fx              : 'carousel',
						carouselVisible : 2,
						carouselFluid   : true,
						swipe           : true
					} );
				} else {
					jQuery( '.product-wrapper.slider-enable' ).cycle( {
						slides          : '> div',
						pauseOnHover    : productPauseHover,
						speed           : parseInt( productSlider_speed ),
						delay           : parseInt( productSlider_delay ),
						fx              : 'carousel',
						carouselVisible : parseInt( product_per_view ),
						carouselFluid   : true,
						swipe           : true
					} );
				}
			}

			initProductCycle();

			function reinit_product_cycle() {
				var width = jQuery( window ).width(); // Checking size again after window resize
				if ( width > 0 && width < 600 ) {
					jQuery( '.product-wrapper.slider-enable' ).cycle( 'destroy' );
					reinitProductCycle( 1 );
				} else if ( width > 600 && width < 992 ) {
					jQuery( '.product-wrapper.slider-enable' ).cycle( 'destroy' );
					reinitProductCycle( 2 );
				} else {
					jQuery( '.product-wrapper.slider-enable' ).cycle( 'destroy' );
					reinitProductCycle( product_per_view );
				}
			}

			function reinitProductCycle( visibleSlides ) {
				jQuery( '.product-wrapper.slider-enable' ).cycle( {
					slides          : '> div',
					pauseOnHover    : productPauseHover,
					speed           : parseInt( productSlider_speed ),
					delay           : parseInt( productSlider_delay ),
					fx              : 'carousel',
					carouselVisible : visibleSlides,
					carouselFluid   : true,
					swipe           : true
				} );
			}

			var reinitProductTimer;
			jQuery( window ).resize( function () {
				clearTimeout( reinitProductTimer );
				reinitProductTimer = setTimeout( reinit_product_cycle, 100 ); // Timeout limits the number of
				// calculations
			} );
		}
	}

	if ( typeof jQuery.fn.masonry !== 'undefined' ) {
		jQuery( '.blog-image-masonry #content' ).masonry( {
			itemSelector : '.hentry',
		} );
	}

} );
