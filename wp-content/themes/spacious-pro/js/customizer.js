/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ( $ ) {

	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Site layout option.
	wp.customize( 'spacious[spacious_site_layout]', function ( value ) {
		value.bind( function ( layout ) {
				var layout_options = layout;

				if ( layout_options == 'box_1218px' ) {

					$( 'body' ).removeClass( 'narrow-978 wide-1218 wide-978' );
					$( 'body' ).addClass( 'narrow-1218' );

				} else if ( layout_options == 'box_978px' ) {

					$( 'body' ).removeClass( 'wide-1218 wide-978 narrow-1218' );
					$( 'body' ).addClass( 'narrow-978' );

				} else if ( layout_options == 'wide_1218px' ) {

					$( 'body' ).removeClass( 'wide-978 narrow-978 narrow-1218' );
					$( 'body' ).addClass( 'wide-1218' );

				} else if ( layout_options == 'wide_978px' ) {

					$( 'body' ).removeClass( 'wide-1218 narrow-978 narrow-1218' );
					$( 'body' ).addClass( 'wide-978' );

				}
			}
		);
	} );

	// Copyright alignment setting
	wp.customize( 'spacious[spacious_copyright_layout]', function ( value ) {
		value.bind( function ( layout ) {
				var layout_options = layout;

				if ( layout_options == 'left' ) {
					$( '.footer-socket-wrapper' ).removeClass( 'copyright-center copyright-right' );
				} else if ( layout_options == 'center' ) {
					$( '.footer-socket-wrapper' ).addClass( 'copyright-center' ).removeClass( 'copyright-right' );
				} else if ( layout_options == 'right' ) {
					$('.footer-socket-wrapper' ).addClass( 'copyright-right' ).removeClass( 'copyright-center' );
				}
			}
		);
	} );

	// Primary color option
	wp.customize( 'spacious[spacious_primary_color]', function ( value ) {
		value.bind( function ( primaryColor ) {
			// Store internal style for primary color
			var primaryColorStyle = '<style id="spacious-internal-primary-color">  blockquote { border-left: 3px solid ' + primaryColor + '; }' +
				'.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button,' +
				'.spacious-woocommerce-cart-views .cart-value { background-color: ' + primaryColor + '; }' +
				'.previous a:hover, .next a:hover { color: ' + primaryColor + '; }' +
				'a { color: ' + primaryColor + '; }' +
				'#site-title a:hover,.widget_fun_facts .counter-icon,.team-title a:hover { color: ' + primaryColor + '; }' +
				'.main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { color: ' + primaryColor + '; }' +
				'.main-navigation ul li ul { border-top: 1px solid ' + primaryColor + '; }' +
				'.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a,' +
				'.main-navigation ul li.current-menu-item ul li a:hover { color: ' + primaryColor + '; }' +
				'.site-header .menu-toggle:hover.entry-meta a.read-more:hover,' +
				'#featured-slider .slider-read-more-button:hover, .slider-cycle .cycle-prev:hover, .slider-cycle .cycle-next:hover' +
				'.call-to-action-button:hover,.entry-meta .read-more-link:hover,.spacious-button:hover, input[type="reset"]:hover,' +
				'.main-small-navigation li:hover { background: ' + primaryColor + '; }' +
				'.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: ' + primaryColor + '; }' +
				'.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a,' +
				'.main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a,' +
				'.main-navigation ul li:hover > a  { color: ' + primaryColor + '; }' +
				'.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a,' +
				'.small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a,' +
				'.small-menu ul li:hover > a, ' +
				'#featured-slider .slider-read-more-button,' +
				'.slider-cycle .cycle-prev, .slider-cycle .cycle-next, #progress,' +
				'.widget_our_clients .clients-cycle-prev,' +
				'.widget_our_clients .clients-cycle-next { background-color: ' + primaryColor + '; }' +
				'#controllers a:hover, #controllers a.active { background-color: ' + primaryColor + '; color: ' + primaryColor + '; }' +
				'.widget_service_block a.more-link:hover, .widget_featured_single_post a.read-more:hover,' +
				'.breadcrumb a:hover { color: ' + primaryColor + '; }' +
				'.tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover,' +
				'.tg-one-fourth .widget-title a:hover { color: ' + primaryColor + '; }' +
				'.pagination span,.site-header .menu-toggle:hover,#team-controllers a.active,' +
				'#team-controllers a:hover { background-color: ' + primaryColor + '; }' +
				'.pagination a span:hover { color: ' + primaryColor + '; border-color: ' + primaryColor + '; }' +
				'.widget_testimonial .testimonial-post { border-color: ' + primaryColor + ' #EAEAEA #EAEAEA #EAEAEA; }' +
				'.call-to-action-content-wrapper { border-color: #EAEAEA #EAEAEA #EAEAEA ' + primaryColor + '; }' +
				'.call-to-action-button { background-color: ' + primaryColor + '; }' +
				'#content .comments-area a.comment-permalink:hover { color: ' + primaryColor + '; }' +
				'.comments-area .comment-author-link a:hover { color: ' + primaryColor + '; }' +
				'.comments-area .comment-author-link spanm,.team-social-icon a:hover { background-color: ' + primaryColor + '; }' +
				'.comment .comment-reply-link:hover { color: ' + primaryColor + '; }' +
				'.team-social-icon a:hover{ border-color: ' + primaryColor + '; }' +
				'.nav-previous a:hover, .nav-next a:hover { color: ' + primaryColor + '; }' +
				'#wp-calendar #today { color: ' + primaryColor + '; }' +
				'.widget-title span { border-bottom: 2px solid ' + primaryColor + '; }' +
				'.footer-widgets-area a:hover { color: ' + primaryColor + ' !important; }' +
				'.footer-socket-wrapper .copyright a:hover { color: ' + primaryColor + '; }' +
				'a#back-top:before { background-color: ' + primaryColor + '; }' +
				'.read-more, .more-link { color: ' + primaryColor + '; }' +
				'.post .entry-title a:hover, .page .entry-title a:hover { color: ' + primaryColor + '; }' +
				'.entry-meta .read-more-link { background-color: ' + primaryColor + '; }' +
				'.entry-meta a:hover, .type-page .entry-meta a:hover { color: ' + primaryColor + '; }' +
				'.single #content .tags a:hover { color: ' + primaryColor + '; }' +
				'.widget_testimonial .testimonial-icon:before { color: ' + primaryColor + '; }' +
				'a#scroll-up { background-color: ' + primaryColor + '; }' +
				'#search-form span { background-color: ' + primaryColor + '; }' +
				'.single #content .tags a:hover,.previous a:hover, .next a:hover{border-color: ' + primaryColor + ';}' +
				'.widget_featured_posts .tg-one-half .entry-title a:hover,' +
				'.main-small-navigation li:hover > .sub-toggle { color: ' + primaryColor + '; }' +
				'.woocommerce a.button, .woocommerce button.button, .woocommerce input.button,' +
				'.woocommerce #respond input#submit, .woocommerce #content input.button,' +
				'.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,' +
				'.woocommerce-page #respond input#submit, .woocommerce-page #content input.button { background-color: ' + primaryColor + '; }' +
				'.woocommerce a.button:hover,.woocommerce button.button:hover,' +
				'.woocommerce input.button:hover,.woocommerce #respond input#submit:hover,' +
				'.woocommerce #content input.button:hover,.woocommerce-page a.button:hover,' +
				'.woocommerce-page button.button:hover,.woocommerce-page input.button:hover,' +
				'.woocommerce-page #respond input#submit:hover,' +
				'.woocommerce-page #content input.button:hover { background-color: ' + primaryColor + '; }' +
				'#content .wp-pagenavi .current, #content .wp-pagenavi a:hover,.sub-toggle { background-color: ' + primaryColor + '; } </style>';

			// Remove previously create internal style and add new one.
			$( 'head #spacious-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );
		}
		);
	} );

	// Header text color
	wp.customize( 'header_textcolor', function ( value ) {
		value.bind( function ( headerTextColor ) {
			$( '#site-title a, #site-description' ).css( {
				'color': headerTextColor
			} );
		} );
	} );

	/**
	 * Header font size Options
	 */

	// Site title
	wp.customize( "spacious[spacious_site_title_font_size]", function ( value ) {
		value.bind( function ( siteTitleFontSize ) {
			$( '#site-title a' ).css( 'fontSize', parseInt( siteTitleFontSize ) );
		} );
	} );

	// Site tagline
	wp.customize( "spacious[spacious_tagline_font_size]", function ( value ) {
		value.bind( function ( siteTaglineFontSize ) {
			$( '#site-description' ).css( 'fontSize', parseInt( siteTaglineFontSize ) );
		} );
	} );

	// Primary menu
	wp.customize( "spacious[spacious_primary_menu_font_size]", function ( value ) {
		value.bind( function ( primaryMenuFontSize ) {
			$( '.main-navigation ul li a' ).not( '.main-navigation ul li ul li a' ).css( 'fontSize', parseInt( primaryMenuFontSize ) );
		} );
	} );

	// Primary sub menu
	wp.customize( "spacious[spacious_primary_sub_menu_font_size]", function ( value ) {
		value.bind( function ( primarySubMenuFontSize ) {
			$( '.main-navigation ul li ul li a, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a, .main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a' ).css( 'fontSize', parseInt( primarySubMenuFontSize ) );
		} );
	} );

	// Header small menu
	wp.customize( "spacious[spacious_small_header_menu_font_size]", function ( value ) {
		value.bind( function ( smallMenuFontSize ) {
			$( '.small-menu a' ).css( 'fontSize', parseInt( smallMenuFontSize ) );
		} );
	} );

	// Header top bar small info text
	wp.customize( "spacious[spacious_small_info_text_size]", function ( value ) {
		value.bind( function ( topbarInfoFontSize ) {
			$( '.small-info-text p' ).css( 'fontSize', parseInt( topbarInfoFontSize ) );
		} );
	} );

	/**
	 * Slider font size Options
	 */
	// Slider title
	wp.customize( "spacious[spacious_slider_title_font_size]", function ( value ) {
		value.bind( function ( sliderTitleFontSize ) {
			$( '#featured-slider .entry-title span' ).css( 'fontSize', parseInt( sliderTitleFontSize ) );
		} );
	} );

	// Slider content
	wp.customize( "spacious[spacious_slider_content_font_size]", function ( value ) {
		value.bind( function ( sliderContentFontSize ) {
			$( '#featured-slider .entry-content p' ).css( 'fontSize', parseInt( sliderContentFontSize ) );
		} );
	} );

	// Slider button text
	wp.customize( "spacious[spacious_slider_button_font_size]", function ( value ) {
		value.bind( function ( sliderButtonFontSize ) {
			$( '#featured-slider .slider-read-more-button' ).css( 'fontSize', parseInt( sliderButtonFontSize ) );
		} );
	} );

	/**
	 * Header Bar
	 */
	// Breadcrumb Text
	wp.customize( "spacious[spacious_breadcrumb_text_font_size]", function ( value ) {
		value.bind( function ( breadcrumbTextFontSize ) {
			$( '.breadcrumb' ).css( 'fontSize', parseInt( breadcrumbTextFontSize ) );
		} );
	} );

	// Page title and post title
	wp.customize( "spacious[spacious_title_font_size]", function ( value ) {
		value.bind( function ( titleFontSize ) {
			$( '.header-post-title-class' ).css( 'fontSize', parseInt( titleFontSize ) );
		} );
	} );

	/**
	 * Title and widget related font size options
	 */
	// Title in posts listing or blog/category view and TG:Featured Posts widget.
	wp.customize( "spacious[spacious_archive_title_font_size]", function ( value ) {
		value.bind( function ( archiveTitleFontSize ) {
			$( '.post .entry-title, .page .entry-title, .widget_featured_posts .tg-one-half .entry-title' ).css( 'fontSize', parseInt( archiveTitleFontSize ) );
		} );
	} );

	// Widget title
	wp.customize( "spacious[spacious_widget_title_font_size]", function ( value ) {
		value.bind( function ( widgetTitleFontSize ) {
			$( '#secondary h3.widget-title, .widget_service_block .widget-title, .widget_featured_single_post .widget-title, .widget_testimonial .widget-title, .widget_recent_work .tg-one-half .widget-title, .widget_recent_work .tg-one-third .widget-title, .widget_recent_work .tg-one-fourth .widget-title' ).css( 'fontSize', parseInt( widgetTitleFontSize ) );
		} );
	} );

	// Main title of TG: Featured Posts widget and TG: Our Clients widget
	wp.customize( "spacious[spacious_client_widget_title_font_size]", function ( value ) {
		value.bind( function ( clientWidgetTitleFontSize ) {
			$( '.widget_our_clients .widget-title, .widget_featured_posts .widget-title' ).css( 'fontSize', parseInt( clientWidgetTitleFontSize ) );
		} );
	} );

	// Title of TG: Call To Action widget
	wp.customize( "spacious[spacious_call_to_action_title_font_size]", function ( value ) {
		value.bind( function ( ctaWidgetTitleFontSize ) {
			$( '.call-to-action-content h3' ).css( 'fontSize', parseInt( ctaWidgetTitleFontSize ) );
		} );
	} );

	// Button text of TG: Call To Action widget
	wp.customize( "spacious[spacious_call_to_action_button_font_size]", function ( value ) {
		value.bind( function ( ctaWidgetButtonFontSize ) {
			$( '.call-to-action-button' ).css( 'fontSize', parseInt( ctaWidgetButtonFontSize ) );
		} );
	} );

	// Comment Title ( Leave a Reply text )
	wp.customize( "spacious[spacious_comment_title_font_size]", function ( value ) {
		value.bind( function ( commentTitleFontSize ) {
			$( '.comments-title, .comment-reply-title' ).css( 'fontSize', parseInt( commentTitleFontSize ) );
		} );
	} );

	/**
	 * Content
	 */
	// Main content
	wp.customize( "spacious[spacious_content_font_size]", function ( value ) {
		value.bind( function ( contentFontSize ) {
			$( 'body, button, input, select, textarea, p, dl, .spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .widget_testimonial .testimonial-author span, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget' ).css( 'fontSize', parseInt( contentFontSize ) );
		} );
	} );

	// Post meta
	wp.customize( "spacious[spacious_post_meta_font_size]", function ( value ) {
		value.bind( function ( postMetaFontSize ) {
			$( '.entry-meta' ).css( 'fontSize', parseInt( postMetaFontSize ) );
		} );
	} );

	// Read more link
	wp.customize( "spacious[spacious_read_more_font_size]", function ( value ) {
		value.bind( function ( readMoreFontSize ) {
			$( '.read-more, .more-link' ).css( 'fontSize', parseInt( readMoreFontSize ) );
		} );
	} );

	/**
	 * Footer
	 */
	// Footer widget title
	wp.customize( "spacious[spacious_footer_widget_title_font_size]", function ( value ) {
		value.bind( function ( footerWidgetTitleFontSize ) {
			$( '#colophon .widget-title' ).css( 'fontSize', parseInt( footerWidgetTitleFontSize ) );
		} );
	} );

	// Footer widget content
	wp.customize( "spacious[spacious_footer_widget_content_font_size]", function ( value ) {
		value.bind( function ( footerWidgetContentFontSize ) {
			$( '#colophon, #colophon p' ).css( 'fontSize', parseInt( footerWidgetContentFontSize ) );
		} );
	} );

	// Footer copyright text
	wp.customize( "spacious[spacious_footer_copyright_text_font_size]", function ( value ) {
		value.bind( function ( footerCopyrightFontSize ) {
			$( '#colophon .footer-socket-wrapper .copyright, #colophon .footer-socket-wrapper .copyright p' ).css( 'fontSize', parseInt( footerCopyrightFontSize ) );
		} );
	} );

	// Footer small menu
	wp.customize( "spacious[spacious_small_footer_menu_font_size]", function ( value ) {
		value.bind( function ( smallFooterMenuFontSize ) {
			$( '#colophon .small-menu a' ).css( 'fontSize', parseInt( smallFooterMenuFontSize ) );
		} );
	} );


	/**
	 * Header Color
	 */
	// Primary menu text
	wp.customize( "spacious[spacious_primary_menu_text_color]", function ( value ) {
		value.bind( function ( primaryMenuColor ) {
			$( '.main-navigation a' ).not( '.main-navigation ul li ul li a' ).css( 'color', primaryMenuColor );
		} );
	} );

	// Primary sub menu text
	wp.customize( "spacious[spacious_primary_sub_menu_text_color]", function ( value ) {
		value.bind( function ( primarySubMenuColor ) {
			$( '.main-navigation ul li ul li a' ).css( 'color', primarySubMenuColor );
		} );
	} );

	// Header background
	wp.customize( "spacious[spacious_header_background_color]", function ( value ) {
		value.bind( function ( headerBgColor ) {
			$( '#header-text-nav-container' ).css( 'backgroundColor', headerBgColor );
		} );
	} );

	// Header top bar background
	wp.customize( "spacious[spacious_header_top_bar_background_color]", function ( value ) {
		value.bind( function ( headerTopbarBgColor ) {
			$( '#header-meta' ).css( 'backgroundColor', headerTopbarBgColor );
		} );
	} );

	// Header top bar info text
	wp.customize( "spacious[spacious_header_info_text_color]", function ( value ) {
		value.bind( function ( headerInfoColor ) {
			$( '.small-info-text p' ).css( 'color', headerInfoColor );
		} );
	} );

	// Header small menu text
	wp.customize( "spacious[spacious_header_small_menu_text_color]", function ( value ) {
		value.bind( function ( headerSmallMenuColor ) {
			$( '.small-menu a' ).css( 'color', headerSmallMenuColor );
		} );
	} );

	/**
	 * Slider Color
	 */
	// Slider title
	wp.customize( "spacious[spacious_slider_title_color]", function ( value ) {
		value.bind( function ( sliderTitleColor ) {
			$( '#featured-slider .entry-title span' ).css( 'color', sliderTitleColor );
		} );
	} );

	// Slider content
	wp.customize( "spacious[spacious_slider_content_color]", function ( value ) {
		value.bind( function ( sliderContentColor ) {
			$( '#featured-slider .entry-content p' ).css( 'color', sliderContentColor );
		} );
	} );

	// Slider button text
	wp.customize( "spacious[spacious_slider_button_color]", function ( value ) {
		value.bind( function ( sliderButtonColor ) {
			$( '#featured-slider .slider-read-more-button' ).css( 'color', sliderButtonColor );
		} );
	} );

	// Slider button background
	wp.customize( "spacious[spacious_slider_button_background_color]", function ( value ) {
		value.bind( function ( sliderButtonBgColor ) {
			$( '#featured-slider .slider-read-more-button' ).css( 'backgroundColor', sliderButtonBgColor );
		} );
	} );

	/**
	 * Header Bar Color
	 */
	// Page title and post title in single view
	wp.customize( "spacious[spacious_page_post_title_color]", function ( value ) {
		value.bind( function ( pagePostTitleColor ) {
			$( '.header-post-title-class' ).css( 'color', pagePostTitleColor );
		} );
	} );

	// Breadcrumb text
	wp.customize( "spacious[spacious_breadcrumb_text_color]", function ( value ) {
		value.bind( function ( breadcrumbTextColor ) {
			$( '.breadcrumb, .breadcrumb a' ).css( 'color', breadcrumbTextColor );
		} );
	} );

	// Header bar background
	wp.customize( "spacious[spacious_header_bar_background_color]", function ( value ) {
		value.bind( function ( headerBarBgColor ) {
			$( '.header-post-title-container' ).css( 'backgroundColor', headerBarBgColor );
		} );
	} );

	/**
	 * Content part color
	 */
	// Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts
	wp.customize( "spacious[spacious_posts_title_color]", function ( value ) {
		value.bind( function ( postsTitleColor ) {
			$( '.post .entry-title a, .page .entry-title a, .widget_featured_posts .tg-one-half .entry-title a' ).css( 'color', postsTitleColor );
		} );
	} );

	// Widget title
	wp.customize( "spacious[spacious_widget_title_color]", function ( value ) {
		value.bind( function ( widgetTitleColor ) {
			$( '#secondary h3.widget-title, .widget_service_block .widget-title a, .widget_featured_single_post .widget-title a, .widget_testimonial .widget-title, .widget_recent_work .tg-one-half .widget-title, .widget_recent_work .tg-one-third .widget-title, .widget_recent_work .tg-one-fourth .widget-title, .widget_our_clients .widget-title, .widget_featured_posts .widget-title' ).css( 'color', widgetTitleColor );
		} );
	} );

	// Content text
	wp.customize( "spacious[spacious_content_text_color]", function ( value ) {
		value.bind( function ( contentTextColor ) {
			$( 'body, button, input, select, textarea, p, dl, .spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .widget_testimonial .testimonial-author span, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget' ).css( 'color', contentTextColor );
		} );
	} );

	// Post meta icon
	wp.customize( "spacious[spacious_post_meta_icon_color]", function ( value ) {
		value.bind( function ( postMetaIconColor ) {
			$( '.entry-meta' ).css( 'color', postMetaIconColor );
		} );
	} );

	// Post meta text
	wp.customize( "spacious[spacious_post_meta_color]", function ( value ) {
		value.bind( function ( postMetaColor ) {
			$( '.entry-meta a, .type-page .entry-meta a' ).css( 'color', postMetaColor );
		} );
	} );

	// Read more text in post meta
	wp.customize( "spacious[spacious_post_meta_read_more_color]", function ( value ) {
		value.bind( function ( postMetaReadmoreColor ) {
			$( '.entry-meta a.read-more' ).css( 'color', postMetaReadmoreColor );
		} );
	} );

	// Read more text background
	wp.customize( "spacious[spacious_post_meta_read_more_background_color]", function ( value ) {
		value.bind( function ( postMetaReadmoreBgColor ) {
			$( '.entry-meta .read-more-link' ).css( 'backgroundColor', postMetaReadmoreBgColor );
		} );
	} );

	// Read more link
	wp.customize( "spacious[spacious_tg_widget_read_more_color]", function ( value ) {
		value.bind( function ( widgetReadmoreColor ) {
			$( '.read-more, .more-link' ).css( 'color', widgetReadmoreColor );
		} );
	} );

	// Content part background
	wp.customize( "spacious[spacious_content_background_color]", function ( value ) {
		value.bind( function ( contentBgColor ) {
			$( '#main' ).css( 'backgroundColor', contentBgColor );
		} );
	} );

	/**
	 * Comment part color
	 */
	// Comment part background
	wp.customize( "spacious[spacious_comment_part_background_color]", function ( value ) {
		value.bind( function ( commentBgColor ) {
			$( '#comments' ).css( 'backgroundColor', commentBgColor );
		} );
	} );

	// Comment title
	wp.customize( "spacious[spacious_comment_title_color]", function ( value ) {
		value.bind( function ( commentTitleColor ) {
			$( '.comments-title, .comment-reply-title' ).css( 'color', commentTitleColor );
		} );
	} );

	// Comment meta
	wp.customize( "spacious[spacious_comment_meta_color]", function ( value ) {
		value.bind( function ( commentMetaColor ) {
			$( '.comments-area .comment-edit-link, .comments-area .comment-permalink, .comments-area .comment-date-time, .comments-area .comment-author-link' ).css( 'color', commentMetaColor );
		} );
	} );

	// Single comment background
	wp.customize( "spacious[spacious_single_comment_background_color]", function ( value ) {
		value.bind( function ( singleCommentBgColor ) {
			$( '.comment-content' ).css( 'backgroundColor', singleCommentBgColor );
		} );
	} );

	// Commenting field background
	wp.customize( "spacious[spacious_commenting_field_background_color]", function ( value ) {
		value.bind( function ( commentFieldBgColor ) {
			$( 'input[type="text"], input[type="email"], input[type="password"], textarea' ).css( 'backgroundColor', commentFieldBgColor );
		} );
	} );

	/**
	 * TG:Call to action widget color
	 */
	// Title
	wp.customize( "spacious[spacious_call_to_action_title_color]", function ( value ) {
		value.bind( function ( ctaColor ) {
			$( '.call-to-action-content h3' ).css( 'color', ctaColor );
		} );
	} );

	// Background
	wp.customize( "spacious[spacious_call_to_action_background_color]", function ( value ) {
		value.bind( function ( ctaBgColor ) {
			$( '.call-to-action-content-wrapper' ).css( 'backgroundColor', ctaBgColor );
		} );
	} );

	// Button text
	wp.customize( "spacious[spacious_call_to_action_button_color]", function ( value ) {
		value.bind( function ( ctaButtonColor ) {
			$( '.call-to-action-button' ).css( 'color', ctaButtonColor );
		} );
	} );

	// Button background
	wp.customize( "spacious[spacious_call_to_action_button_background_color]", function ( value ) {
		value.bind( function ( ctaBgColor ) {
			$( '.call-to-action-button' ).css( 'backgroundColor', ctaBgColor );
		} );
	} );

	/**
	 * Footer part color
	 */
	// Widget title
	wp.customize( "spacious[spacious_footer_widget_title_color]", function ( value ) {
		value.bind( function ( widgetTitleColor ) {
			$( '#colophon .widget-title' ).css( 'color', widgetTitleColor );
		} );
	} );

	// Widget content
	wp.customize( "spacious[spacious_footer_widget_content_color]", function ( value ) {
		value.bind( function ( widgetContentColor ) {
			$( '.footer-widgets-area, .footer-widgets-area .tg-one-fourth p' ).css( 'color', widgetContentColor );
		} );
	} );

	// Widget background
	wp.customize( "spacious[spacious_footer_widget_background_color]", function ( value ) {
		value.bind( function ( widgetBgColor ) {
			$( '.footer-widgets-wrapper' ).css( 'backgroundColor', widgetBgColor );
		} );
	} );

	// Footer copyright text
	wp.customize( "spacious[spacious_footer_copyright_text_color]", function ( value ) {
		value.bind( function ( copyrightColor ) {
			$( '.footer-socket-wrapper .copyright, .footer-socket-wrapper .copyright a' ).css( 'color', copyrightColor );
		} );
	} );

	// Footer small menu text
	wp.customize( "spacious[spacious_footer_small_menu_color]", function ( value ) {
		value.bind( function ( footerSmallMenuColor ) {
			$( '#colophon .small-menu a' ).css( 'color', footerSmallMenuColor );
		} );
	} );

	// Footer copyright part background
	wp.customize( "spacious[spacious_footer_copyright_part_background_color]", function ( value ) {
		value.bind( function ( copyrightBgColor ) {
			$( '.footer-socket-wrapper' ).css( 'backgroundColor', copyrightBgColor );
		} );
	} );

})( jQuery );
