/**
 *
 * @description Spacious custom javascript functions
 * @author ThemeGril
 *
 */

/*===============================
 =       Elementor widgets      =
 ===============================*/
jQuery( window ).on( 'elementor/frontend/init', function () {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function ( $scope ) {

		// Counter
		if ( ( typeof jQuery.fn.waypoint !== 'undefined' ) && ( typeof jQuery.fn.countTo !== 'undefined' ) ) {
			$scope.waypoint( function ( direction ) {
				if ( 'down' === direction ) {
					$scope.find( '.counter__number' ).countTo();
				}
			}, {
				triggerOnce : true,
				offset      : '80%'
			} );
		}

		/**
		 * Slider 1
		 */
		var WidgetTgElslider1Handler = function ( $scope, $ ) {

			var sliderClass = $scope.find( '.swiper-container' ),
				buttonNext  = $scope.find( '.swiper-button-next' ),
				buttonPrev  = $scope.find( '.swiper-button-prev' ),
				transition_autoplaySlider,
				transition_delay,
				transition_speed,
				pause_on_hover = false,
				pauseHoverElement   = jQuery( sliderClass ).attr( 'data-pause_on_hover' ),
				sliderOptions;

			transition_autoplaySlider = jQuery( sliderClass ).attr( 'data-autoplay' );
			transition_delay          = parseInt( jQuery( sliderClass ).attr( 'data-delay' ), 10 );
			transition_speed          = parseInt( jQuery( sliderClass ).attr( 'data-speed' ), 10 );

			if ( 'yes' === pauseHoverElement ) {
				pause_on_hover = true;
			}

			sliderOptions = {
				speed      : transition_speed,
				navigation : {
					nextEl : buttonNext,
					prevEl : buttonPrev
				} // autoHeight: true
			};

			if ( 'yes' === transition_autoplaySlider ) {
				sliderOptions.autoplay = {
					delay                : transition_delay,
					disableOnInteraction : false
				};
			}

			var swiperSlide = new Swiper( sliderClass, sliderOptions );

			if ( pause_on_hover ) {
				jQuery( sliderClass ).mouseenter( function(){
					swiperSlide.autoplay.stop();
				});

				jQuery( sliderClass ).mouseleave( function(){
					swiperSlide.autoplay.start();
				});
			}
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/SPT-SLIDER-1.default', WidgetTgElslider1Handler );

		/**
		 * Product Carousel 1
		 */
		var WidgetTgElproductcarousel1Handler = function ( $scope, $ ) {

			var productClass = $scope.find( '.swiper-container.product-carousel-container' ),
				buttonNext   = $scope.find( '.swiper-button-next' ),
				buttonPrev   = $scope.find( '.swiper-button-prev' ),
				transition_autoplayProductslider,
				productTransition_delay,
				productTransition_speed,
				productOptions,
				productPerview;

			transition_autoplayProductslider = jQuery( productClass ).attr( 'data-autoplay' );
			productTransition_delay          = parseInt( jQuery( productClass ).attr( 'data-delay' ), 10 );
			productTransition_speed          = parseInt( jQuery( productClass ).attr( 'data-speed' ), 10 );
			productPerview                   = parseInt( jQuery( productClass ).attr( 'data-columns' ), 10 );

			productOptions = {
				speed         : productTransition_speed,
				slidesPerView : productPerview,
				spaceBetween  : 30,
				breakpoints   : {
					// when window width is <= 600px
					600 : {
						slidesPerView : 1,
						spaceBetween  : 10
					},
					// when window width is <= 768px
					768 : {
						slidesPerView : 2,
						spaceBetween  : 30
					}
				},
				navigation    :
					{
						nextEl : buttonNext,
						prevEl : buttonPrev
					}// autoHeight: true
			};

			if ( 'yes' === transition_autoplayProductslider ) {
				productOptions.autoplay = {
					delay                : productTransition_delay,
					disableOnInteraction : false
				};
			}

			new Swiper( productClass, productOptions );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/SPT-PRODUCT-CAUROSEL-1.default', WidgetTgElproductcarousel1Handler );

		/**
		 * team 5
		 */
		var WidgetTgElteam5Handler = function ( $scope, $ ) {

			var teamClass  = $scope.find( '.swiper-container.team-container' ),
				buttonNext = $scope.find( '.swiper-button-next' ),
				buttonPrev = $scope.find( '.swiper-button-prev' ),
				transition_autoplayTeamslider,
				teamTransition_delay,
				teamTransition_speed,
				teamOptions,
				teamPerview;

			transition_autoplayTeamslider = jQuery( teamClass ).attr( 'data-autoplay' );
			teamTransition_delay          = parseInt( jQuery( teamClass ).attr( 'data-delay' ), 10 );
			teamTransition_speed          = parseInt( jQuery( teamClass ).attr( 'data-speed' ), 10 );
			teamPerview                   = parseInt( jQuery( teamClass ).attr( 'data-columns' ), 10 );

			teamOptions = {
				speed         : teamTransition_speed,
				slidesPerView : teamPerview,
				spaceBetween  : 30,
				breakpoints   : {
					// when window width is <= 600px
					600 : {
						slidesPerView : 1,
						spaceBetween  : 10
					},
					// when window width is <= 768px
					768 : {
						slidesPerView : 2,
						spaceBetween  : 30
					}
				},
				navigation    :
					{
						nextEl : buttonNext,
						prevEl : buttonPrev
					} // autoHeight: true
			};

			if ( 'yes' === transition_autoplayTeamslider ) {
				teamOptions.autoplay = {
					delay                : teamTransition_delay,
					disableOnInteraction : false
				};
			}

			new Swiper( teamClass, teamOptions );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/SPT-TEAM-5.default', WidgetTgElteam5Handler );

		/**
		 * Block 2
		 */
		var WidgetTgElBlockPosts2Handler = function ( $scope, $ ) {

			var blogClass  = $scope.find( '.swiper-container.post-carousel-container' ),
				buttonNext = $scope.find( '.swiper-button-next' ),
				buttonPrev = $scope.find( '.swiper-button-prev' ),
				transition_autoplayBlogslider,
				blogTransition_delay,
				blogTransition_speed,
				blogOptions,
				blogPerview;

			transition_autoplayBlogslider = jQuery( blogClass ).attr( 'data-autoplay' );
			blogTransition_delay          = parseInt( jQuery( blogClass ).attr( 'data-delay' ), 10 );
			blogTransition_speed          = parseInt( jQuery( blogClass ).attr( 'data-speed' ), 10 );
			blogPerview                   = parseInt( jQuery( blogClass ).attr( 'data-columns' ), 10 );

			blogOptions = {
				speed         : blogTransition_speed,
				slidesPerView : blogPerview,
				spaceBetween  : 30,
				breakpoints   : {
					// when window width is <= 600px
					600 : {
						slidesPerView : 1,
						spaceBetween  : 10
					},
					// when window width is <= 768px
					768 : {
						slidesPerView : 2,
						spaceBetween  : 30
					}
				},
				navigation    :
					{
						nextEl : buttonNext,
						prevEl : buttonPrev
					} // autoHeight: true
			};

			if ( 'yes' === transition_autoplayBlogslider ) {
				blogOptions.autoplay = {
					delay                : blogTransition_delay,
					disableOnInteraction : false
				};
			}

			new Swiper( blogClass, blogOptions );
		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/SPT-BLOCK-2.default', WidgetTgElBlockPosts2Handler );


		// Slider 2.
		var WidgetTgElslider2Handler = function ( $scope, $ ) {

			var sliderstyletwoClass = $scope.find( '.swiper-container.slider-style-two-container' ),
				buttonNext          = $scope.find( '.swiper-button-next' ),
				buttonPrev          = $scope.find( '.swiper-button-prev' ),
				transition_autoplaySliderstyletwo,
				sliderstyletwotransition_delay,
				sliderstyletwotransition_speed,
				sliderstyletwoPerview,
				pause_on_hover      = false,
				pauseHoverElement   = jQuery( sliderstyletwoClass ).attr( 'data-pause_on_hover' ),
				sliderstyletwoOptions;

			transition_autoplaySliderstyletwo = jQuery( sliderstyletwoClass ).attr( 'data-autoplay' );
			sliderstyletwotransition_delay    = parseInt( jQuery( sliderstyletwoClass ).attr( 'data-delay' ), 10 );
			sliderstyletwotransition_speed    = parseInt( jQuery( sliderstyletwoClass ).attr( 'data-speed' ), 10 );
			sliderstyletwoPerview             = parseInt( jQuery( sliderstyletwoClass ).attr( 'data-columns' ), 10 );

			if ( 'yes' === pauseHoverElement ) {
				pause_on_hover = true;
			}

			sliderstyletwoOptions = {
				speed      : sliderstyletwotransition_speed,
				slidesPerView : sliderstyletwoPerview,
				spaceBetween  : 30,
				breakpoints   : {
					// when window width is <= 600px
					600 : {
						slidesPerView : 1,
						spaceBetween  : 10
					},
					// when window width is <= 768px
					768 : {
						slidesPerView : 2,
						spaceBetween  : 30
					}
				},
				navigation : {
					nextEl : buttonNext,
					prevEl : buttonPrev
				} // autoHeight: true
			};

			if ( 'yes' === transition_autoplaySliderstyletwo ) {
				sliderstyletwoOptions.autoplay = {
					delay                : sliderstyletwotransition_delay,
					disableOnInteraction : false
				};
			}

			var swiperSlide = new Swiper( sliderstyletwoClass, sliderstyletwoOptions );

			if ( pause_on_hover ) {
				jQuery( sliderstyletwoClass ).mouseenter( function(){
					swiperSlide.autoplay.stop();
				});

				jQuery( sliderstyletwoClass ).mouseleave( function(){
					swiperSlide.autoplay.start();
				});
			}

		};

		elementorFrontend.hooks.addAction( 'frontend/element_ready/SPT-SLIDER-2.default', WidgetTgElslider2Handler );

		// Block Posts 1
		var WidgetTgElBlockPostsHandler = function ( $scope, $ ) {

			/* ------------------- Pagination ---------------------- */

			var handlePageNavigation = function ( $target ) {

				var userAction = 'next';

				var currentPage = 1;

				var $blockElem = $target.closest( '.tg-block-wrapper' );

				var paged = $target.data( 'page' );

				if ( 'prev' === paged ) {
					if ( 1 === currentPage ) {
						return;
					}

					currentPage --;

					userAction = 'prev';
				} else if ( 'next' === paged ) {

				}

			};

			$scope.find( '.tgel-pagination a.tgel-page-nav' ).on( 'click', function ( e ) {

				e.preventDefault();

				handlePageNavigation( $( this ) );

			} );
		};
		elementorFrontend.hooks.addAction( 'frontend/element_ready/SPT-BLOCK-1.default', WidgetTgElBlockPostsHandler );
	} );
} );
